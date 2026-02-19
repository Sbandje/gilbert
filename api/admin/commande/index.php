<?php
session_start();
require_once __DIR__ . '/../../includes/config.php';

// Vérifier si l'utilisateur est admin
if (!isAdmin()) {
    header('Location: /gilbert/authentification/login.php');
    exit;
}

// Utilise la connexion PDO déjà définie dans config.php
// $pdo est déjà disponible

// Traitement de la mise à jour du statut
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_status'])) {
    $commandeId = $_POST['commande_id'];
    $newStatus = $_POST['statut'];
    
    $stmt = $pdo->prepare("UPDATE commandes SET statut = :statut, date_traitement = NOW() WHERE id = :id");
    $stmt->execute([':statut' => $newStatus, ':id' => $commandeId]);
    
    $_SESSION['message'] = 'Statut mis à jour avec succès';
    $_SESSION['message_type'] = 'success';
    header('Location: /gilbert/admin/commandes.php');
    exit;
}

// Récupérer toutes les commandes
$stmt = $pdo->query("SELECT * FROM commandes ORDER BY date_commande DESC");
$commandes = $stmt->fetchAll();

// Récupérer les détails des commandes
$details = [];
if (!empty($commandes)) {
    $ids = implode(',', array_column($commandes, 'id'));
    $stmt = $pdo->query("SELECT * FROM commande_details WHERE commande_id IN ($ids)");
    while ($row = $stmt->fetch()) {
        $details[$row['commande_id']][] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des commandes - Admin</title>
    <link rel="stylesheet" href="../../css/commande_admin.css">
    <link rel="stylesheet" href="../../css/sidebar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body>
    <?php include __DIR__ . '/../../includes/sidebar.php'; ?>

    <div class="commandes-container">
        <div class="commandes-header">
            <h1><i class="fas fa-shopping-cart"></i> Gestion des commandes</h1>
            <p>Suivez et gérez toutes les commandes des clients</p>
        </div>

        <?php if (isset($_SESSION['message'])): ?>
            <div class="message <?php echo $_SESSION['message_type']; ?>">
                <?php 
                echo $_SESSION['message'];
                unset($_SESSION['message']);
                unset($_SESSION['message_type']);
                ?>
            </div>
        <?php endif; ?>

        <!-- Statistiques -->
        <?php
        $stats = [
            'en_attente' => 0,
            'confirmee' => 0,
            'preparation' => 0,
            'terminee' => 0,
            'annulee' => 0
        ];
        
        foreach ($commandes as $commande) {
            $stats[$commande['statut']]++;
        }
        ?>

        <div class="stats-grid">
            <div class="stat-card en-attente">
                <i class="fas fa-clock"></i>
                <div class="stat-number"><?php echo $stats['en_attente']; ?></div>
                <div class="stat-label">En attente</div>
            </div>
            <div class="stat-card confirmee">
                <i class="fas fa-check-circle"></i>
                <div class="stat-number"><?php echo $stats['confirmee']; ?></div>
                <div class="stat-label">Confirmées</div>
            </div>
            <div class="stat-card" style="border-left: 4px solid #3498db;">
                <i class="fas fa-spinner"></i>
                <div class="stat-number"><?php echo $stats['preparation']; ?></div>
                <div class="stat-label">En préparation</div>
            </div>
            <div class="stat-card terminee">
                <i class="fas fa-check-double"></i>
                <div class="stat-number"><?php echo $stats['terminee']; ?></div>
                <div class="stat-label">Terminées</div>
            </div>
            <div class="stat-card annulee">
                <i class="fas fa-times-circle"></i>
                <div class="stat-number"><?php echo $stats['annulee']; ?></div>
                <div class="stat-label">Annulées</div>
            </div>
        </div>

        <!-- Liste des commandes -->
        <div class="commandes-table">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Client</th>
                        <th>Email</th>
                        <th>Total</th>
                        <th>Date</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($commandes as $commande): ?>
                    <tr>
                        <td>#<?php echo $commande['id']; ?></td>
                        <td><?php echo htmlspecialchars($commande['nom_client']); ?></td>
                        <td><?php echo htmlspecialchars($commande['email_client']); ?></td>
                        <td><?php echo number_format($commande['total'], 0, ',', ' '); ?> FCFA</td>
                        <td><?php echo date('d/m/Y H:i', strtotime($commande['date_commande'])); ?></td>
                        <td>
                            <span class="statut-badge statut-<?php echo $commande['statut']; ?>">
                                <?php 
                                switch($commande['statut']) {
                                    case 'en_attente': echo 'En attente'; break;
                                    case 'confirmee': echo 'Confirmée'; break;
                                    case 'preparation': echo 'En préparation'; break;
                                    case 'terminee': echo 'Terminée'; break;
                                    case 'annulee': echo 'Annulée'; break;
                                }
                                ?>
                            </span>
                        </td>
                        <td>
                            <button class="details-btn" onclick="showDetails(<?php echo $commande['id']; ?>)">
                                <i class="fas fa-eye"></i> Détails
                            </button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal pour les détails de commande -->
    <?php foreach ($commandes as $commande): ?>
    <div id="modal-<?php echo $commande['id']; ?>" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal(<?php echo $commande['id']; ?>)">&times;</span>
            <h2>Détails de la commande #<?php echo $commande['id']; ?></h2>
            
            <div style="margin: 20px 0;">
                <p><strong>Client:</strong> <?php echo htmlspecialchars($commande['nom_client']); ?></p>
                <p><strong>Email:</strong> <?php echo htmlspecialchars($commande['email_client']); ?></p>
                <p><strong>Date:</strong> <?php echo date('d/m/Y H:i', strtotime($commande['date_commande'])); ?></p>
                <p><strong>Total:</strong> <?php echo number_format($commande['total'], 0, ',', ' '); ?> FCFA</p>
                
                <form method="POST" class="update-status-form" style="margin: 20px 0;">
                    <input type="hidden" name="commande_id" value="<?php echo $commande['id']; ?>">
                    <select name="statut" class="statut-select">
                        <option value="en_attente" <?php echo $commande['statut'] == 'en_attente' ? 'selected' : ''; ?>>En attente</option>
                        <option value="confirmee" <?php echo $commande['statut'] == 'confirmee' ? 'selected' : ''; ?>>Confirmée</option>
                        <option value="preparation" <?php echo $commande['statut'] == 'preparation' ? 'selected' : ''; ?>>En préparation</option>
                        <option value="terminee" <?php echo $commande['statut'] == 'terminee' ? 'selected' : ''; ?>>Terminée</option>
                        <option value="annulee" <?php echo $commande['statut'] == 'annulee' ? 'selected' : ''; ?>>Annulée</option>
                    </select>
                    <button type="submit" name="update_status" class="details-btn">Mettre à jour</button>
                </form>
            </div>

            <h3>Articles commandés</h3>
            <table style="width: 100%; border-collapse: collapse; margin-top: 20px;">
                <thead>
                    <tr style="background: linear-gradient(135deg, #667eea, #764ba2); color: white;">
                        <th style="padding: 10px;">Produit</th>
                        <th style="padding: 10px;">Type</th>
                        <th style="padding: 10px;">Description</th>
                        <th style="padding: 10px;">Prix</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (isset($details[$commande['id']])): ?>
                        <?php foreach ($details[$commande['id']] as $item): ?>
                        <tr>
                            <td style="padding: 10px; border-bottom: 1px solid #eee;"><?php echo htmlspecialchars($item['produit_nom']); ?></td>
                            <td style="padding: 10px; border-bottom: 1px solid #eee;"><?php echo ucfirst($item['produit_type']); ?></td>
                            <td style="padding: 10px; border-bottom: 1px solid #eee;">-</td>
                            <td style="padding: 10px; border-bottom: 1px solid #eee;"><?php echo number_format($item['prix_unitaire'], 0, ',', ' '); ?> FCFA</td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php endforeach; ?>

    <script>
    function showDetails(id) {
        document.getElementById('modal-' + id).style.display = 'block';
    }

    function closeModal(id) {
        document.getElementById('modal-' + id).style.display = 'none';
    }

    // Fermer le modal en cliquant en dehors
    window.onclick = function(event) {
        if (event.target.classList.contains('modal')) {
            event.target.style.display = 'none';
        }
    }
    </script>
</body>
</html>
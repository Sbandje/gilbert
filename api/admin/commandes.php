<?php
// admin/commandes.php
require_once '../includes/config.php';

// Vérifier si l'utilisateur est admin
if (!isAdmin()) {
    header('Location: ../authentification/login.php');
    exit;
}

// Mettre à jour le statut d'une commande
if (isset($_POST['update_statut'])) {
    $commande_id = $_POST['commande_id'];
    $nouveau_statut = $_POST['statut'];
    
    $sql = "UPDATE commandes SET statut = :statut WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':statut' => $nouveau_statut, ':id' => $commande_id]);
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_status'])) {
    $commandeId = $_POST['commande_id'];
    $newStatus = $_POST['statut'];
    
    // Récupérer les infos du client avant la mise à jour
    $stmt = $pdo->prepare("SELECT nom_client, email_client FROM commandes WHERE id = :id");
    $stmt->execute([':id' => $commandeId]);
    $client = $stmt->fetch();
    
    $stmt = $pdo->prepare("UPDATE commandes SET statut = :statut, date_traitement = NOW() WHERE id = :id");
    $stmt->execute([':statut' => $newStatus, ':id' => $commandeId]);
    
    // Envoyer email de notification
    if ($client && $client['email_client']) {
        require_once __DIR__ . '/../../includes/mail_config.php';
        sendStatusUpdateEmail($client['email_client'], $client['nom_client'], $commandeId, $newStatus);
    }
    
    $_SESSION['message'] = 'Statut mis à jour avec succès';
    $_SESSION['message_type'] = 'success';
    header('Location: /gilbert/admin/commandes.php');
    exit;
}

// Récupérer toutes les commandes
$sql = "SELECT * FROM commandes ORDER BY date_commande DESC";
$stmt = $pdo->query($sql);
$commandes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion des commandes - Admin</title>
    <link rel="stylesheet" href="/gilbert/css/style.css">
    <link rel="stylesheet" href="/gilbert/css/pages.css">
</head>
<body>
    <?php include '../includes/navbar.php'; ?>

    <div class="admin-container">
        <h1>Gestion des commandes</h1>
        
        <div class="commandes-table">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Client</th>
                        <th>Email</th>
                        <th>Téléphone</th>
                        <th>Date</th>
                        <th>Total</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($commandes as $commande): ?>
                    <tr>
                        <td>#<?= $commande['id'] ?></td>
                        <td><?= htmlspecialchars($commande['nom_client']) ?></td>
                        <td><?= htmlspecialchars($commande['email_client']) ?></td>
                        <td><?= htmlspecialchars($commande['telephone']) ?></td>
                        <td><?= date('d/m/Y H:i', strtotime($commande['date_commande'])) ?></td>
                        <td><?= $commande['total'] ?> FCFA</td>
                        <td>
                            <form method="POST" class="statut-form">
                                <input type="hidden" name="commande_id" value="<?= $commande['id'] ?>">
                                <select name="statut" class="statut-<?= $commande['statut'] ?>">
                                    <option value="en_attente" <?= $commande['statut'] == 'en_attente' ? 'selected' : '' ?>>En attente</option>
                                    <option value="confirmee" <?= $commande['statut'] == 'confirmee' ? 'selected' : '' ?>>Confirmée</option>
                                    <option value="preparation" <?= $commande['statut'] == 'preparation' ? 'selected' : '' ?>>En préparation</option>
                                    <option value="livree" <?= $commande['statut'] == 'livree' ? 'selected' : '' ?>>Livrée</option>
                                    <option value="annulee" <?= $commande['statut'] == 'annulee' ? 'selected' : '' ?>>Annulée</option>
                                </select>
                                <button type="submit" name="update_statut" class="btn-update">Mettre à jour</button>
                            </form>
                        </td>
                        <td>
                            <a href="voir_commande.php?id=<?= $commande['id'] ?>" class="btn-voir">
                                <i class="fa-solid fa-eye"></i>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
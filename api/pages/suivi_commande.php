<?php
session_start();
require_once __DIR__ . '/../includes/config.php';

$orderId = isset($_GET['order_id']) ? intval($_GET['order_id']) : 0;
$email = isset($_GET['email']) ? $_GET['email'] : '';

if (!$orderId || !$email) {
    header('Location: /gilbert/index.php');
    exit;
}

$pdo = getPDOConnection();

// Récupérer la commande
$stmt = $pdo->prepare("SELECT * FROM commandes WHERE id = :id AND email_client = :email");
$stmt->execute([':id' => $orderId, ':email' => $email]);
$commande = $stmt->fetch();

if (!$commande) {
    $error = "Commande non trouvée";
}

// Récupérer les détails
if ($commande) {
    $stmt = $pdo->prepare("SELECT * FROM commande_details WHERE commande_id = :commande_id");
    $stmt->execute([':commande_id' => $orderId]);
    $details = $stmt->fetchAll();
}

$statusLabels = [
    'en_attente' => ['label' => 'En attente', 'color' => '#f39c12', 'icon' => 'fa-clock'],
    'confirmee' => ['label' => 'Confirmée', 'color' => '#27ae60', 'icon' => 'fa-check-circle'],
    'preparation' => ['label' => 'En préparation', 'color' => '#3498db', 'icon' => 'fa-spinner'],
    'terminee' => ['label' => 'Terminée', 'color' => '#2ecc71', 'icon' => 'fa-check-double'],
    'annulee' => ['label' => 'Annulée', 'color' => '#e74c3c', 'icon' => 'fa-times-circle']
];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suivi de commande #<?php echo $orderId; ?></title>
    <link rel="stylesheet" href="/gilbert/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            margin: 0;
            padding: 20px;
        }

        .tracking-container {
            max-width: 800px;
            margin: 40px auto;
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            overflow: hidden;
            animation: slideUp 0.5s ease;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .tracking-header {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            padding: 30px;
            text-align: center;
        }

        .tracking-header h1 {
            margin: 0;
            font-size: 28px;
        }

        .tracking-header p {
            margin: 10px 0 0;
            opacity: 0.9;
        }

        .tracking-content {
            padding: 30px;
        }

        .order-info {
            background: #f8f9ff;
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 30px;
            border-left: 4px solid #667eea;
        }

        .order-info p {
            margin: 10px 0;
            color: #333;
        }

        .order-info strong {
            color: #667eea;
        }

        .status-timeline {
            position: relative;
            padding: 20px 0;
            margin: 30px 0;
        }

        .status-step {
            display: flex;
            align-items: flex-start;
            margin-bottom: 30px;
            position: relative;
        }

        .status-step:last-child {
            margin-bottom: 0;
        }

        .status-step::before {
            content: '';
            position: absolute;
            left: 20px;
            top: 40px;
            bottom: -20px;
            width: 2px;
            background: #ddd;
        }

        .status-step:last-child::before {
            display: none;
        }

        .status-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: white;
            border: 2px solid;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 20px;
            position: relative;
            z-index: 1;
        }

        .status-step.active .status-icon {
            background: <?php echo $statusLabels[$commande['statut']]['color']; ?>;
            border-color: <?php echo $statusLabels[$commande['statut']]['color']; ?>;
            color: white;
        }

        .status-step.completed .status-icon {
            background: #2ecc71;
            border-color: #2ecc71;
            color: white;
        }

        .status-content {
            flex: 1;
        }

        .status-content h3 {
            margin: 0 0 5px;
            color: #333;
        }

        .status-content p {
            margin: 0;
            color: #666;
            font-size: 14px;
        }

        .status-badge {
            display: inline-block;
            padding: 8px 16px;
            border-radius: 20px;
            color: white;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .order-details {
            margin-top: 30px;
            border-top: 1px solid #eee;
            padding-top: 20px;
        }

        .order-details table {
            width: 100%;
            border-collapse: collapse;
        }

        .order-details th {
            background: #f0f4ff;
            padding: 12px;
            text-align: left;
            color: #333;
        }

        .order-details td {
            padding: 12px;
            border-bottom: 1px solid #eee;
        }

        .total-price {
            margin-top: 20px;
            text-align: right;
            font-size: 18px;
            font-weight: bold;
            color: #667eea;
        }

        .error-message {
            background: #f8d7da;
            color: #721c24;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
        }

        .btn-retour {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: transform 0.3s ease;
        }

        .btn-retour:hover {
            transform: translateY(-2px);
        }

        @media print {
            body {
                background: white;
                padding: 0;
            }
            .tracking-container {
                box-shadow: none;
                margin: 0;
            }
            .btn-retour {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="tracking-container">
        <div class="tracking-header">
            <h1><i class="fas fa-truck"></i> Suivi de commande</h1>
            <p>Commande #<?php echo $orderId; ?></p>
        </div>

        <div class="tracking-content">
            <?php if (isset($error)): ?>
                <div class="error-message">
                    <i class="fas fa-exclamation-triangle"></i>
                    <?php echo $error; ?>
                </div>
            <?php else: ?>
                <div class="order-info">
                    <p><strong><i class="fas fa-user"></i> Client:</strong> <?php echo htmlspecialchars($commande['nom_client']); ?></p>
                    <p><strong><i class="fas fa-envelope"></i> Email:</strong> <?php echo htmlspecialchars($commande['email_client']); ?></p>
                    <?php if (!empty($commande['telephone'])): ?>
                        <p><strong><i class="fas fa-phone"></i> Téléphone:</strong> <?php echo htmlspecialchars($commande['telephone']); ?></p>
                    <?php endif; ?>
                    <p><strong><i class="fas fa-calendar"></i> Date commande:</strong> <?php echo date('d/m/Y H:i', strtotime($commande['date_commande'])); ?></p>
                </div>

                <div style="text-align: center; margin-bottom: 20px;">
                    <div class="status-badge" style="background: <?php echo $statusLabels[$commande['statut']]['color']; ?>">
                        <i class="fas <?php echo $statusLabels[$commande['statut']]['icon']; ?>"></i>
                        <?php echo $statusLabels[$commande['statut']]['label']; ?>
                    </div>
                </div>

                <div class="status-timeline">
                    <?php 
                    $steps = [
                        'en_attente' => 'Commande reçue',
                        'confirmee' => 'Commande confirmée',
                        'preparation' => 'En cours de préparation',
                        'terminee' => 'Commande terminée'
                    ];
                    
                    $currentStatus = $commande['statut'];
                    $completed = true;
                    
                    foreach ($steps as $status => $label):
                        $isActive = ($status == $currentStatus);
                        $isCompleted = array_search($currentStatus, array_keys($steps)) > array_search($status, array_keys($steps));
                        $statusClass = $isActive ? 'active' : ($isCompleted ? 'completed' : '');
                    ?>
                        <div class="status-step <?php echo $statusClass; ?>">
                            <div class="status-icon" style="border-color: <?php echo $statusLabels[$status]['color']; ?>;">
                                <i class="fas <?php echo $statusLabels[$status]['icon']; ?>"></i>
                            </div>
                            <div class="status-content">
                                <h3><?php echo $label; ?></h3>
                                <p>
                                    <?php 
                                    if ($isActive) {
                                        echo 'En cours';
                                    } elseif ($isCompleted) {
                                        echo 'Terminé';
                                    } else {
                                        echo 'En attente';
                                    }
                                    ?>
                                </p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="order-details">
                    <h3><i class="fas fa-shopping-bag"></i> Détails de la commande</h3>
                    <table>
                        <thead>
                            <tr>
                                <th>Produit</th>
                                <th>Type</th>
                                <th>Prix</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($details as $item): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($item['produit_nom']); ?></td>
                                <td><?php echo ucfirst($item['produit_type']); ?></td>
                                <td><?php echo number_format($item['produit_prix'], 0, ',', ' '); ?> FCFA</td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <div class="total-price">
                        Total: <?php echo number_format($commande['total'], 0, ',', ' '); ?> FCFA
                    </div>
                </div>

                <div style="text-align: center;">
                    <a href="/gilbert/index.php" class="btn-retour">
                        <i class="fas fa-home"></i> Retour à l'accueil
                    </a>
                    <button onclick="window.print()" class="btn-retour" style="margin-left: 10px; background: linear-gradient(135deg, #95a5a6, #7f8c8d);">
                        <i class="fas fa-print"></i> Imprimer
                    </button>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
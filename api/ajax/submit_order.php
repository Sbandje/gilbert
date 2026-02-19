<?php
session_start();
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/panier_fonctions.php';
require_once __DIR__ . '/../includes/mail_config.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Méthode non autorisée']);
    exit;
}

$nom = isset($_POST['name']) ? trim($_POST['name']) : '';
$email = isset($_POST['email']) ? trim($_POST['email']) : '';
$telephone = isset($_POST['telephone']) ? trim($_POST['telephone']) : '';
$adresse = isset($_POST['adresse']) ? trim($_POST['adresse']) : '';

if (empty($nom) || empty($email) || empty($_SESSION['panier'])) {
    echo json_encode(['success' => false, 'message' => 'Données incomplètes']);
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['success' => false, 'message' => 'Email invalide']);
    exit;
}

try {
    // Utilise la connexion PDO déjà définie dans config.php
    // $pdo est déjà disponible
    $pdo->beginTransaction();

    // Calculer le total
    $total = 0;
    foreach ($_SESSION['panier'] as $item) {
        $total += $item['prix'];
    }

    // Insérer la commande principale
    $stmt = $pdo->prepare("INSERT INTO commandes (nom_client, email_client, telephone, adresse, total, statut) VALUES (:nom, :email, :telephone, :adresse, :total, 'en_attente')");
    $stmt->execute([
        ':nom' => $nom,
        ':email' => $email,
        ':telephone' => $telephone,
        ':adresse' => $adresse,
        ':total' => $total
    ]);
    
    $commandeId = $pdo->lastInsertId();

    // Insérer les détails de la commande
    $stmt = $pdo->prepare("INSERT INTO commande_details (commande_id, produit_nom, produit_type, prix_unitaire, quantite) VALUES (:commande_id, :nom, :type, :prix, :quantite)");
    foreach ($_SESSION['panier'] as $item) {
        $stmt->execute([
            ':commande_id' => $commandeId,
            ':nom' => $item['nom'],
            ':type' => $item['type'] ?? 'autre',
            ':prix' => $item['prix'],
            ':quantite' => isset($item['quantite']) ? $item['quantite'] : 1
        ]);
    }

    $pdo->commit();

    // Envoyer l'email de confirmation
    $orderDetails = [];
    foreach ($_SESSION['panier'] as $item) {
        $orderDetails[] = [
            'produit_nom' => $item['nom'],
            'produit_type' => $item['type'] ?? 'autre',
            'produit_prix' => $item['prix']
        ];
    }
    
    $emailSent = sendOrderConfirmationEmail($email, $nom, $commandeId, $orderDetails, $total);

    // Vider le panier
    $_SESSION['panier'] = [];

    echo json_encode([
        'success' => true,
        'commande_id' => $commandeId,
        'email_sent' => $emailSent,
        'message' => 'Commande enregistrée avec succès' . ($emailSent ? '' : ' (Email non envoyé)')
    ]);

} catch (Exception $e) {
    if ($pdo && $pdo->inTransaction()) {
        $pdo->rollBack();
    }
    error_log("Erreur commande: " . $e->getMessage());
    echo json_encode([
        'success' => false,
        'message' => "Erreur lors de l'enregistrement de la commande : " . $e->getMessage(),
        'trace' => $e->getTraceAsString()
    ]);
}
?>
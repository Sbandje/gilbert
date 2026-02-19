<?php
require_once __DIR__ . '/../../includes/config.php';

// Vérifier si l'utilisateur est admin
if (!isAdmin()) {
    header('Location: /gilbert/authentification/login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = isset($_POST['nom']) ? trim($_POST['nom']) : '';
    $description = isset($_POST['description']) ? trim($_POST['description']) : '';

    if (empty($nom)) {
        $_SESSION['error'] = "Le nom du service est obligatoire.";
        header('Location: form_add_service.php');
        exit;
    }

    try {
        $stmt = $pdo->prepare("INSERT INTO service (nom, description) VALUES (:nom, :description)");
        $stmt->execute([':nom' => $nom, ':description' => $description]);
        
        $_SESSION['success'] = "Service ajouté avec succès.";
        header('Location: list_services.php');
        exit;
    } catch (PDOException $e) {
        $_SESSION['error'] = "Erreur lors de l'ajout : " . htmlspecialchars($e->getMessage());
        header('Location: form_add_service.php');
        exit;
    }
}

// Redirection si pas de POST
header('Location: form_add_service.php');
exit;
?>
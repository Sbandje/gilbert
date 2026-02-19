<?php

require_once __DIR__ . '/../includes/config.php'; 

// --- Configure the admin account here ---
$adminUsername = 'admin';
$adminEmail = 'admin@gilbert.com';
$adminPasswordPlain = 'admin123'; 

try {
    // Check if an admin already exists
    $check = $pdo->prepare("SELECT COUNT(*) AS cnt FROM users WHERE role = 'admin'");
    $check->execute();
    $row = $check->fetch(PDO::FETCH_ASSOC);
    if ($row && $row['cnt'] > 0) {
        echo "Un administrateur existe déjà. Supprimez ce fichier ou modifiez la condition si vous voulez en créer un autre.";
        exit;
    }

    // Ensure username/email not already used
    $exists = $pdo->prepare("SELECT id FROM users WHERE username = :u OR email = :e LIMIT 1");
    $exists->execute([':u' => $adminUsername, ':e' => $adminEmail]);
    if ($exists->fetch()) {
        echo "Le nom d'utilisateur ou l'email existe déjà. Choisissez-en un autre ou supprimez l'entrée existante.";
        exit;
    }

    $passwordHash = password_hash($adminPasswordPlain, PASSWORD_DEFAULT);
    $insert = $pdo->prepare("INSERT INTO users (username, email, password, role, created_at) VALUES (:u, :e, :p, 'admin', NOW())");
    $insert->execute([':u' => $adminUsername, ':e' => $adminEmail, ':p' => $passwordHash]);

    echo "Administrateur créé avec succès. Supprimez ou déplacez admin/create_admin.php maintenant pour des raisons de sécurité.";
} catch (PDOException $ex) {
    echo "Erreur PDO: " . htmlspecialchars($ex->getMessage());
}

?>
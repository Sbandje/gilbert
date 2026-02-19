<?php
// Script sécurisé pour créer un seul administrateur. Lancer une seule fois, puis supprimer
require_once __DIR__ . '/includes/config.php'; // fournit $pdo et session_start()

// --- CONFIGUREZ ICI le compte admin à créer ---
$adminUsername = 'admin';
$adminEmail = 'admin@example.com';
$adminPasswordPlain = 'ChangeMe!123'; // changez avant d'exécuter
// ------------------------------------------------

try {
    // Vérifier s'il existe déjà un admin
    $check = $pdo->prepare("SELECT COUNT(*) AS cnt FROM users WHERE role = 'admin'");
    $check->execute();
    $row = $check->fetch(PDO::FETCH_ASSOC);
    if ($row && $row['cnt'] > 0) {
        echo "Un administrateur existe déjà. Supprimez ce fichier ou changez la condition si vous voulez en créer un autre.";
        exit;
    }

    // Vérifier que le username/email n'existe pas
    $exists = $pdo->prepare("SELECT id FROM users WHERE username = :u OR email = :e LIMIT 1");
    $exists->execute([':u' => $adminUsername, ':e' => $adminEmail]);
    if ($exists->fetch()) {
        echo "Le nom d'utilisateur ou l'email existe déjà. Choisissez-en un autre ou supprimez l'entrée existante.";
        exit;
    }

    $passwordHash = password_hash($adminPasswordPlain, PASSWORD_DEFAULT);
    $insert = $pdo->prepare("INSERT INTO users (username, email, password, role, created_at) VALUES (:u, :e, :p, 'admin', NOW())");
    $insert->execute([':u' => $adminUsername, ':e' => $adminEmail, ':p' => $passwordHash]);

    echo "Administrateur créé avec succès. Supprimez ou renommez create_admin.php maintenant pour des raisons de sécurité.";
} catch (PDOException $ex) {
    echo "Erreur PDO: " . htmlspecialchars($ex->getMessage());
}

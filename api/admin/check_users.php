<?php
// Safe users debug page — only accessible from localhost. Remove after use.
require_once __DIR__ . '/../includes/config.php';

$allowed = ['127.0.0.1', '::1', 'localhost'];
$remote = $_SERVER['REMOTE_ADDR'] ?? '';
if (!in_array($remote, $allowed, true)) {
    http_response_code(403);
    echo "Forbidden\n";
    exit;
}

try {
    $stmt = $pdo->query("SELECT id, username, email, role, created_at FROM users ORDER BY id DESC");
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Erreur DB: " . htmlspecialchars($e->getMessage());
    exit;
}

?><!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="utf-8">
<title>Vérifier les utilisateurs</title>
<link rel="stylesheet" href="/css/style.css">
</head>
<body>
    <main style="padding:20px;">
        <h1>Utilisateurs (local)</h1>
        <?php if (empty($users)): ?>
            <p>Aucun utilisateur trouvé.</p>
        <?php else: ?>
            <table border="1" cellpadding="6" cellspacing="0">
                <thead><tr><th>id</th><th>username</th><th>email</th><th>role</th><th>created_at</th></tr></thead>
                <tbody>
                <?php foreach ($users as $u): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($u['id']); ?></td>
                        <td><?php echo htmlspecialchars($u['username']); ?></td>
                        <td><?php echo htmlspecialchars($u['email']); ?></td>
                        <td><?php echo htmlspecialchars($u['role'] ?? ''); ?></td>
                        <td><?php echo htmlspecialchars($u['created_at'] ?? ''); ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
        <p>Supprimez ce fichier après vérification.</p>
    </main>
</body>
</html>

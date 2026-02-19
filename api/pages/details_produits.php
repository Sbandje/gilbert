<?php
require_once '../includes/config.php';
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: index.php');
    exit;
}

$produitId = (int)$_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM produits WHERE id = :id");
$stmt->execute(['id' => $produitId]);
$produit = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$produit) {
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails du produit - <?php echo htmlspecialchars($produit['nom']); ?></title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <?php include '../includes/navbar.php'; ?>
    <div class="product-details-container">
        <div class="produit-img">
            <img src="../assets/images/<?php echo htmlspecialchars($produit['image']); ?>" alt="<?php echo htmlspecialchars($produit['nom']); ?>">
        </div>
        <h1><?php echo htmlspecialchars($produit['nom']); ?></h1>
        <p><strong>Catégorie :</strong> <?php echo htmlspecialchars($produit['type']); ?></p>
        <p><strong>Description :</strong> <?php echo nl2br(htmlspecialchars($produit['description'])); ?></p>
        <a href="../pages/service.php" class="back-link">Retour à la liste des produits</a>
    </div>
    <?php include '../includes/footer.php'; ?>
</body>
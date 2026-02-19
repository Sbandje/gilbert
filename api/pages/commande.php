<?php
// pages/commande.php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../includes/panier_fonctions.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Passer la commande</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/pages.css">
</head>
<body>
    <?php include __DIR__ . '/../includes/navbar.php'; ?>

    <div class="commande-container">
        <h1>Passer la commande</h1>

        <div class="commande-cont">
            <?php if (empty($_SESSION['panier'])): ?>
            <p>Votre panier est vide. <a href="service.php">Voir les services</a></p>
        <?php else: ?>
            <div class="commande-items">
                <?php foreach ($_SESSION['panier'] as $item): ?>
                    <div class="commande-item">
                        <h3><?= htmlspecialchars($item['nom']) ?></h3>
                        <p><?= htmlspecialchars($item['description']) ?></p>
                        <p>Prix: <?= (int)$item['prix'] ?> FCFA</p>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="commande-summary">
                <h3>Récapitulatif</h3>
                <p>Total: <?= getCartTotal() ?> FCFA</p>

                <form action="../ajax/submit_order.php" method="POST">
                    <input type="hidden" name="total" value="<?= getCartTotal() ?>">
                    <div>
                        <label for="name">Nom complet</label>
                        <input id="name" name="name" required>
                    </div>
                    <div>
                        <label for="email">Email</label>
                        <input id="email" name="email" type="email" required>
                    </div>
                    <div>
                        <label for="telephone">Téléphone</label>
                        <input id="telephone" name="telephone" type="tel" required>
                    </div>
                    <div>
                        <label for="adresse">Adresse de livraison</label>
                        <textarea id="adresse" name="adresse" required></textarea>
                    </div>
                    <button type="submit" class="btn-commander">Confirmer la commande</button>
                </form>
            </div>
        <?php endif; ?>
        </div>
    </div>

    <?php include __DIR__ . '/../includes/footer.php'; ?>
</body>
</html>
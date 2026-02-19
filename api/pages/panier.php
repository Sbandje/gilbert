<?php
// panier.php
require_once __DIR__ . '/../includes/panier_fonctions.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mon Panier</title>
    <link rel="stylesheet" href="/gilbert/css/style.css">
    <link rel="stylesheet" href="/gilbert/css/panier.css">
</head>
<body>
    <?php include __DIR__ . '/../includes/navbar.php'; ?>

    <div class="panier-container">
        <h1>Mon Panier</h1>
        
                <?php if (empty($_SESSION['panier'])): ?>
            <div class="panier-vide">
                <i class="fa-solid fa-cart-shopping"></i>
                <p>Votre panier est vide</p>
                <a href="service.php" class="btn-commencer">Commencer mes achats</a>
            </div>
        <?php else: ?>
            <div class="panier-content">
                <div class="panier-items">
                    <?php foreach ($_SESSION['panier'] as $item): ?>
                        <div class="panier-item">
                            <div class="item-info">
                                <h3><?= htmlspecialchars($item['nom']) ?></h3>
                                <p><?= htmlspecialchars($item['description']) ?></p>
                                <p class="item-prix"><?= $item['prix'] ?> FCFA</p>
                            </div>
                            <div class="item-actions">
                                            <a href="supprimer_panier.php?id=<?= $item['id'] ?>" class="btn-supprimer">
                                    <i class="fa-solid fa-trash"></i>
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                
                <div class="panier-resume">
                    <h3>Récapitulatif</h3>
                    <div class="total">
                        <span>Total:</span>
                        <span class="total-prix"><?= getCartTotal() ?> FCFA</span>
                    </div>
                    <a href="commande.php" class="btn-commander">Passer la commande</a>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <?php include __DIR__ . '/../includes/footer.php'; ?>
</body>
</html>
<?php
// pages/supprimer_panier.php
require_once __DIR__ . '/../includes/panier_fonctions.php';

if (isset($_GET['id'])) {
    $item_id = $_GET['id']; // garder comme string car uniqid() retourne une string
    removeFromCart($item_id);
}

header('Location: panier.php');
exit;
?>

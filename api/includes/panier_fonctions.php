<?php
// includes/panier_fonctions.php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function getCartTotal()
{
    $total = 0;
    if (!empty($_SESSION['panier']) && is_array($_SESSION['panier'])) {
        foreach ($_SESSION['panier'] as $item) {
            $prix = 0;
            if (isset($item['prix'])) {
                $prix = (int) $item['prix'];
            }
            $total += $prix;
        }
    }
    return $total;
}

function clearCart()
{
    if (isset($_SESSION['panier'])) {
        unset($_SESSION['panier']);
    }
}

function removeFromCart($id)
{
    if (!empty($_SESSION['panier']) && is_array($_SESSION['panier'])) {
        foreach ($_SESSION['panier'] as $key => $item) {
            if (isset($item['id']) && $item['id'] == $id) { 
                unset($_SESSION['panier'][$key]);
                
                $_SESSION['panier'] = array_values($_SESSION['panier']);
                return true;
            }
        }
    }
    return false;
}

<?php
// panier_functions.php
require_once 'includes/config.php';

// Ajouter au panier
function addToCart($produit) {
    if (!isset($_SESSION['panier'])) {
        $_SESSION['panier'] = [];
    }
    
    $produit['id'] = uniqid();
    $_SESSION['panier'][] = $produit;
    return true;
}

// Supprimer du panier
function removeFromCart($itemId) {
    if (isset($_SESSION['panier'])) {
        foreach ($_SESSION['panier'] as $key => $item) {
            if ($item['id'] == $itemId) {
                unset($_SESSION['panier'][$key]);
                $_SESSION['panier'] = array_values($_SESSION['panier']); 
                return true;
            }
        }
    }
    return false;
}

// Vider le panier
function clearCart() {
    $_SESSION['panier'] = [];
}

// Calculer le total du panier
function getCartTotal() {
    $total = 0;
    if (isset($_SESSION['panier'])) {
        foreach ($_SESSION['panier'] as $item) {
            $total += $item['prix'];
        }
    }
    return $total;
}

// Sauvegarder la commande en base de données
function saveCommande($userData, $cartItems, $total) {
    global $pdo;
    
    try {
        $pdo->beginTransaction();
        
        // Insérer la commande
        $sql = "INSERT INTO commandes (user_id, nom_client, email_client, telephone, total, adresse_livraison) 
                VALUES (:user_id, :nom_client, :email_client, :telephone, :total, :adresse)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':user_id' => $_SESSION['user_id'] ?? null,
            ':nom_client' => $userData['nom'],
            ':email_client' => $userData['email'],
            ':telephone' => $userData['telephone'],
            ':total' => $total,
            ':adresse' => $userData['adresse']
        ]);
        
        $commande_id = $pdo->lastInsertId();
        
        // Insérer les détails de la commande
        $sql = "INSERT INTO commande_details (commande_id, produit_nom, produit_type, prix_unitaire) 
                VALUES (:commande_id, :produit_nom, :produit_type, :prix)";
        $stmt = $pdo->prepare($sql);
        
        foreach ($cartItems as $item) {
            $stmt->execute([
                ':commande_id' => $commande_id,
                ':produit_nom' => $item['nom'],
                ':produit_type' => $item['type'],
                ':prix' => $item['prix']
            ]);
        }
        
        $pdo->commit();
        clearCart(); // Vider le panier après sauvegarde
        return $commande_id;
        
    } catch (Exception $e) {
        $pdo->rollBack();
        return false;
    }
}
?>
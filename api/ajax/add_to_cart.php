<?php
// ajax/add_to_cart.php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    
    if (!isset($_SESSION['panier'])) {
        $_SESSION['panier'] = [];
    }
    
    $produit = [
        'id' => uniqid(),
        'nom' => $data['nom'],
        'prix' => $data['prix'],
        'type' => $data['type'],
        'description' => $data['description']
    ];
    
    $_SESSION['panier'][] = $produit;
    
    echo json_encode([
        'success' => true,
        'cartCount' => count($_SESSION['panier'])
    ]);
    exit;
}
?>
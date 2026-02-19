<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord</title>
    <link rel="stylesheet" href="../css/dashboard.css">
</head>
<body>
    <?php include '../includes/sidebar.php'; ?>
    <div class="dashboard-act">
        <div class="head-dash">
            <h1>Tableau de bord</h1>
        </div>
        <div class="act-recent">
            <div class="entete-grid">
                <h2>Activités récentes</h2>
                <a href="produits/form_add.php" class="btn-ajout">Ajouter un produit</a>
            </div>
            <div class="grid-act">
                <div class="act-item">
                    <h3>Commandes en attente</h3>
                    <p>5</p>
                </div>
                <div class="act-item">
                    <h3>Utilisateurs inscrits</h3>
                    <p>120</p>
                </div>
                <div class="act-item">
                    <h3>Produits disponibles</h3>
                    <p>30</p>
                </div>
        </div>
    </div>
</body>
</html>
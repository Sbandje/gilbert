<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un service</title>
</head>
<body>
    <?php include '../includes/sidebar.php'; ?>

    <div class="admin-content">
        <h1>Ajouter un nouveau service</h1>
        <form action="process_add_service.php" method="POST">
            <div class="form-group">
                <label for="nom">Nom du service</label>
                <input type="text" id="nom" name="nom" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description" required></textarea>
            </div>
            <button type="submit">Ajouter le service</button>
        </form>
</body>
</html>
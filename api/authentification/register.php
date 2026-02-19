<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="../css/auth.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body>
    <div class="register-cont">
        <h2>Créer un compte</h2>
        <form action="process_register.php" method="POST">
            <div class="input-group">
                <label for="fullname">Nom complet</label>
                <input type="text" id="fullname" name="fullname" required>
            </div>
            <div class="input-group">
                <label for="username">Nom d'utilisateur</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="input-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="input-group">
                <label for="password">Mot de passe</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="input-group">
                <input type="checkbox" id="accept_terms" name="accept_terms" required>
                <label for="accept_terms">
                    J'accepte <a href="../pages/cgu.php" target="_blank"> la politique de confidentialité et les conditions générales d'utilisation</a>.
                </label>
            </div>
            <button type="submit" class="register-btn">S'inscrire</button>
            <p>Vous avez déjà un compte ? <a href="login.php">Se connecter</a></p>
        </form>
    </div>
</body>
</html>
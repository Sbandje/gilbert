<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>navbar</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body>
    
    <nav>
        <div class="logo-site">
            <img src="/gilbert/assets/images/logo.png" alt="logo du site">
        </div>
        <div class="navbar-content">
            <ul class="navbar-ul">
                <li class="navbar-li"><a href="/gilbert/index.php">Accueil</a></li>
                <li class="navbar-li"><a href="/gilbert/about.php">A Propos</a></li>
                <li class="navbar-li"><a href="/gilbert/pages/service.php">Services</a></li>
                <li class="navbar-li"><a href="/gilbert/pages/contact.php">Contact</a></li>
            </ul>
        </div>
        <div class="navbar-content">
                <!-- condition pour l'apparition du bouton selon le rôle de l'utilisateur -->
                 <?php
                    if (isset($_SESSION['user_id'])) {
                        // admin
                        if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin') {
                            echo '<li class="navbar-li dropdown">';
                            echo '<a href="#" class="dropbtn">' . htmlspecialchars($_SESSION['username'] ?? 'Admin') . ' <i class="fa-solid fa-caret-down"></i></a>';
                            echo '<div class="dropdown-content">';
                            echo '<a href="/gilbert/admin/dashboard.php">Tableau de bord</a>';
                            echo '<a href="/gilbert/authentification/logout.php">Déconnexion</a>';
                            echo '</div>';
                            echo '</li>';
                        } else {
                            // utilisateur connecté classique
                            echo '<li class="navbar-li dropdown">';
                            echo '<a href="#" class="dropbtn">' . htmlspecialchars($_SESSION['username'] ?? 'Compte') . ' <i class="fa-solid fa-caret-down"></i></a>';
                            echo '<div class="dropdown-content">';
                            echo '<a href="/gilbert/profile.php">Profil</a>';
                            echo '<a href="/gilbert/pages/commande.php">Mes commandes</a>';
                            echo '<a href="/gilbert/authentification/logout.php">Déconnexion</a>';
                            echo '</div>';
                            echo '</li>';
                        }
                    } else {
                        // invité
                        echo '<li class="navbar-li dropdown">';
                        echo '<a href="#" class="dropbtn">Compte <i class="fa-solid fa-caret-down"></i></a>';
                        echo '<div class="dropdown-content">';
                        echo '<a href="/gilbert/authentification/login.php">Connexion</a>';
                        echo '<a href="/gilbert/authentification/register.php">Inscription</a>';
                        echo '</div>';
                        echo '</li>';
                    }
                 ?>
                <li class="navbar-panier">
                    <a href="/gilbert/pages/panier.php">
                        <i class="fa-solid fa-cart-plus"></i>
                        <span class="cart-counter"><?php echo isset($_SESSION['panier']) ? count($_SESSION['panier']) : 0; ?></span>
                    </a>
                </li>
        </div>
    </nav>

    <script>
        // Script pour le dropdown menu
        document.addEventListener('DOMContentLoaded', function() {
            var dropdowns = document.querySelectorAll('.dropdown');
            dropdowns.forEach(function(dropdown) {
                dropdown.addEventListener('click', function(event) {
                    event.stopPropagation();
                    this.classList.toggle('active');
                });
            });

            // Fermer le dropdown si l'utilisateur clique en dehors
            document.addEventListener('click', function() {
                dropdowns.forEach(function(dropdown) {
                    dropdown.classList.remove('active');
                });
            });
        });
    </script>
</body>
</html>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Services</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/service.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body>
    <?php include '../includes/navbar.php'; ?>

    
    <?php
require_once __DIR__ . '/../includes/config.php';

// Connexion à la base de données
$host = 'localhost';
$db   = 'gilbert';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}

// Récupérer les produits par catégorie
function getProduitsByType($pdo, $type) {
    $stmt = $pdo->prepare("SELECT * FROM produits WHERE type = :type ORDER BY created_at DESC");
    $stmt->execute([':type' => $type]);
    return $stmt->fetchAll();
}

$logos = getProduitsByType($pdo, 'logo');
$affiches = getProduitsByType($pdo, 'affiche');
$flyers = getProduitsByType($pdo, 'flyer');
?>

    <div class="services-content">
        <div class="services-header">
            <h1>Nos Services</h1>
            <p>Explorez nos solutions créatives et professionnelles</p>
        </div>

        <div class="service-conte">
            <div class="section-btn">
                <button class="catalogue-btn"><a href="#catalogue-logos">Catalogue de logos</a></button>
                <button class="catalogue-btn"><a href="#catalogue-affiches">Catalogue d'affiches</a></button>
                <button class="catalogue-btn"><a href="#catalogue-flyers">Catalogue de flyers</a></button>
            </div>

            <!-- Section Logos -->
            <section class="service-grid" id="catalogue-logos">
                <div class="logo-cat">
                    <?php if (!empty($logos)): ?>
                        <?php foreach ($logos as $logo): ?>
                        <div class="logo-class">
                            <div class="img-logo">
                                <img src="<?php echo htmlspecialchars($logo['image_url']); ?>" 
                                     alt="<?php echo htmlspecialchars($logo['nom']); ?>"
                                     onerror="this.src='../assets/images/placeholder.jpg'">
                            </div>
                            <div class="text-logo">
                                <h3><?php echo htmlspecialchars($logo['nom']); ?></h3>
                                <p><?php echo htmlspecialchars($logo['description']); ?></p>
                                <p class="price"><?php echo number_format($logo['prix'], 0, ',', ' '); ?>FCFA</p>
                            </div>
                            <div class="com-btn">
                                <button class="catalogue-btn add-to-cart" 
                                    data-id="<?php echo $logo['id']; ?>"
                                    data-nom="<?php echo htmlspecialchars($logo['nom']); ?>" 
                                    data-prix="<?php echo $logo['prix']; ?>"
                                    data-type="logo"
                                    data-description="<?php echo htmlspecialchars($logo['description']); ?>">
                                    Ajouter au panier
                                </button>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="no-products">Aucun logo disponible pour le moment.</p>
                    <?php endif; ?>
                </div>
            </section>
            <section class="service-grid" id="catalogue-affiches">
                <div class="affiche-cat">
                    <?php if (!empty($affiches)): ?>
                        <?php foreach ($affiches as $affiche): ?>
                        <div class="affiche-class">
                            <div class="img-affiche">
                                <img src="<?php echo htmlspecialchars($affiche['image_url']); ?>" 
                                     alt="<?php echo htmlspecialchars($affiche['nom']); ?>"
                                     onerror="this.src='../assets/images/placeholder.jpg'">
                            </div>
                            <div class="text-affiche">
                                <h3><?php echo htmlspecialchars($affiche['nom']); ?></h3>
                                <p><?php echo htmlspecialchars($affiche['description']); ?></p>
                                <p class="price"><?php echo number_format($affiche['prix'], 0, ',', ' '); ?>FCFA</p>
                            </div>
                            <div class="com-btn">
                                <button class="catalogue-btn add-to-cart" 
                                    data-id="<?php echo $affiche['id']; ?>"
                                    data-nom="<?php echo htmlspecialchars($affiche['nom']); ?>" 
                                    data-prix="<?php echo $affiche['prix']; ?>"
                                    data-type="affiche"
                                    data-description="<?php echo htmlspecialchars($affiche['description']); ?>">
                                    Ajouter au panier
                                </button>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="no-products">Aucune affiche disponible pour le moment.</p>
                    <?php endif; ?>
                </div>
            </section>
            <section class="service-grid" id="catalogue-flyers">
                <div class="flyer-cat">
                    <?php if (!empty($flyers)): ?>
                        <?php foreach ($flyers as $flyer): ?>
                        <div class="flyer-class">
                            <div class="img-flyer">
                                <img src="<?php echo htmlspecialchars($flyer['image_url']); ?>" 
                                     alt="<?php echo htmlspecialchars($flyer['nom']); ?>"
                                     onerror="this.src='../assets/images/placeholder.jpg'">
                            </div>
                            <div class="text-flyer">
                                <h3><?php echo htmlspecialchars($flyer['nom']); ?></h3>
                                <p><?php echo htmlspecialchars($flyer['description']); ?></p>
                                <p class="price"><?php echo number_format($flyer['prix'], 0, ',', ' '); ?>FCFA</p>
                            </div>
                            <div class="com-btn">
                                <button class="catalogue-btn add-to-cart" 
                                    data-id="<?php echo $flyer['id']; ?>"
                                    data-nom="<?php echo htmlspecialchars($flyer['nom']); ?>" 
                                    data-prix="<?php echo $flyer['prix']; ?>"
                                    data-type="flyer"
                                    data-description="<?php echo htmlspecialchars($flyer['description']); ?>">
                                    Ajouter au panier
                                </button>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="no-products">Aucun flyer disponible pour le moment.</p>
                    <?php endif; ?>
                </div>
            </section>

        </div>
    </div>


    <?php include '../includes/footer.php'; ?>

    <script>
document.addEventListener('DOMContentLoaded', function() {
    // Récupérer tous les boutons et sections
    const buttons = document.querySelectorAll('.section-btn .catalogue-btn');
    const sections = document.querySelectorAll('.service-grid');
    
    // Fonction pour activer une section
    function activateSection(sectionId) {
        // Masquer toutes les sections
        sections.forEach(section => {
            section.classList.remove('active-section');
        });
        
        // Désactiver tous les boutons
        buttons.forEach(btn => {
            btn.classList.remove('active');
        });
        
        // Afficher la section correspondante
        const activeSection = document.getElementById(sectionId);
        if (activeSection) {
            activeSection.classList.add('active-section');
        }
        
        // Activer le bouton correspondant
        const activeButton = Array.from(buttons).find(btn => 
            btn.querySelector('a').getAttribute('href') === '#' + sectionId
        );
        if (activeButton) {
            activeButton.classList.add('active');
        }
    }
    
    // Ajouter l'événement click à chaque bouton
    buttons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const link = this.querySelector('a');
            const href = link.getAttribute('href');
            const sectionId = href.substring(1); // Enlever le #
            
            activateSection(sectionId);
        });
    });
    
    // Activer la première section par défaut (logos)
    if (sections.length > 0) {
        activateSection('catalogue-logos');
    }
});

document.addEventListener('DOMContentLoaded', function() {
    // Gestion de l'ajout au panier
    const addToCartButtons = document.querySelectorAll('.add-to-cart');
    
    addToCartButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            
            const produit = {
                nom: this.dataset.nom,
                prix: parseInt(this.dataset.prix),
                type: this.dataset.type,
                description: this.dataset.description
            };
            
            // Appel AJAX pour ajouter au panier (chemin relatif depuis /pages)
            fetch('../ajax/add_to_cart.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(produit)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Notification de succès
                    showNotification('Produit ajouté au panier!', 'success');
                    // Mettre à jour le compteur du panier
                    updateCartCounter(data.cartCount);
                }
            })
            .catch(error => {
                showNotification('Erreur lors de l\'ajout au panier', 'error');
            });
        });
    });
    
    function showNotification(message, type) {
        const notification = document.createElement('div');
        notification.className = `notification ${type}`;
        notification.textContent = message;
        document.body.appendChild(notification);
        
        setTimeout(() => {
            notification.remove();
        }, 3000);
    }
    
    function updateCartCounter(count) {
        const cartCounter = document.querySelector('.cart-counter');
        if (cartCounter) {
            cartCounter.textContent = count;
        }
    }
});
</script>
</body>
</html>

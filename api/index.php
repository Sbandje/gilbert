<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>site logo</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

</head>
<body>
    <?php include 'includes/navbar.php'; ?>

    <div class="accueil-content">
        <div class="header-cont">
            <h1>Bienvenue sur notre site de vente en ligne</h1>
            <p>Découvrez une large gamme de produits de qualité à des prix compétitifs. Profitez de nos offres exclusives et faites vos achats en toute simplicité.</p>
            <a href="/pages/service.php" class="btn">Voir nos services</a>
        </div>

        <div class="service-content">
            <h2>Nos services</h2>
            <div class="service-item">
                <div class="serv-img">
                    <img src="assets/images/service1.jpg" alt="service 1">
                </div>
                <div class="service-text">
                    <h2>Conception de logos</h2>
                    <p>
                        Nous créons des logos uniques et mémorables qui reflètent l'identité de votre marque. Notre équipe de designers talentueux travaille en étroite collaboration avec vous pour comprendre vos besoins et créer un logo qui se démarque.
                    </p>
                    <button class="catalogue-btn"><a href="/pages/service.php#catalogue-logo">Consulter le catalogue</a></button>
                </div>
            </div>
            <div class="service-item">
                <div class="serv-img">
                    <img src="assets/images/service2.jpg" alt="service 2">
                </div>
                <div class="service-text">
                    <h2>Conception d'affiches</h2>
                    <p>
                        Nous concevons des affiches attrayants et percutants qui captent l'attention et transmettent votre message de manière claire et efficace. Nos designers créent des visuels uniques qui s'adaptent à vos besoins spécifiques, que ce soit pour une campagne marketing ou une promotion événementielle.
                    </p>
                    <button class="catalogue-btn"><a href="/pages/service.php#catalogue-affiches">Consulter le catalogue</a></button>
                </div>
            </div>
            <div class="service-item">
                <div class="serv-img">
                    <img src="assets/images/service3.jpg" alt="service 3">
                </div>
                <div class="service-text">
                    <h2>Conception de flyers</h2>
                    <p>
                        Nous créons des flyers attrayants et percutants qui captent l'attention et transmettent votre message de manière claire et efficace. Nos designers créent des visuels uniques qui s'adaptent à vos besoins spécifiques, que ce soit pour une campagne marketing ou une promotion événementielle.
                    </p>
                    <button class="catalogue-btn"><a href="/pages/service.php#catalogue-flyers">Consulter le catalogue</a></button>
                </div>
            </div>
        </div>

        <div class="realisation-content">
            <h2>Nos réalisations</h2>
            <div class="realisation-div">
                <div class="realisation-item">
                    <div class="realisation-img">
                        <img src="assets/images/realisation1.jpg" alt="réalisation 1">
                    </div>
                    <div class="realisation-text">
                        <h3>Logo pour une entreprise de technologie</h3>
                        <p>
                            Nous avons conçu un logo moderne et innovant pour une entreprise de technologie, en utilisant des formes géométriques et des couleurs vives pour refléter leur identité dynamique.
                        </p>
                        <button class="catalogue-btn"><a href="/pages/details_produits.php?id=1">Voir Plus</a></button>
                    </div>
                </div>
                <div class="realisation-item">
                    <div class="realisation-img">
                        <img src="assets/images/realisation2.jpg" alt="réalisation 2">
                    </div>
                    <div class="realisation-text">
                        <h3>Affiche pour un événement musical</h3>
                        <p>
                            Nous avons créé une affiche vibrante et accrocheuse pour un événement musical, en utilisant des éléments graphiques dynamiques et des couleurs audacieuses pour attirer l'attention du public.
                        </p>
                        <button class="catalogue-btn"><a href="/pages/details_produits.php?id=2">Voir Plus</a></button>
                    </div>
                </div>
                <div class="realisation-item">
                    <div class="realisation-img">
                        <img src="assets/images/realisation3.jpg" alt="réalisation 3">
                    </div>
                    <div class="realisation-text">
                        <h3>Flyer pour une promotion de vente</h3>
                        <p>
                            Nous avons conçu un flyer attrayant et informatif pour une promotion de vente, en utilisant des images accrocheuses et un design clair pour inciter les clients à profiter de l'offre.
                        </p>
                        <button class="catalogue-btn"><a href="/pages/details_produits.php?id=3">Voir Plus</a></button>
                    </div>
                </div>
            </div>
        </div>

        <div class="contact-accueil">
            <div class="contact-icon">
                <i class="fa-solid fa-phone"></i>
            </div>
            <h2>Contactez-nous</h2>
            <p>Pour toute question ou demande de renseignements, n'hésitez pas à nous contacter. Nous sommes là pour vous aider et répondre à vos besoins.</p>
            <button class="contact-btn"><a href="/pages/contact.php">Nous Contacter</a></button>
        </div>
    </div>

    <?php include 'includes/footer.php'; ?>
</body>
</html>
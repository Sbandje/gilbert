<?php include 'includes/navbar.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>site logo</title>
    <link rel="stylesheet" href="/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        :root {
    --primary-color: #91dfdd;
    --secondary-color: #02777d;
    --background-color: #639e90;
    --text-color: #282929;
    --white-color: #fff;
    --dark-color: #000;
}

body {
    color: var(--text-color);
    font-family: 'Arial', sans-serif;
    margin: 0;
    padding: 0;
}

/* Style de la navbar */
nav {
    background-color: var(--secondary-color);
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0 20px;
    height: 70px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    position: sticky;
    top: 0;
    z-index: 1000;
}

.logo-site {
    display: flex;
    align-items: center;
}

.logo-site img {
    height: 50px;
    width: auto;
    transition: transform 0.3s ease;
}

.logo-site img:hover {
    transform: scale(1.05);
}

.navbar-content {
    display: flex;
    align-items: center;
}

.navbar-ul {
    display: flex;
    list-style: none;
    margin: 0;
    padding: 0;
    gap: 30px;
}

.navbar-li {
    margin: 0;
}

.navbar-li a {
    color: white;
    text-decoration: none;
    font-weight: 500;
    font-size: 16px;
    padding: 8px 12px;
    border-radius: 4px;
    transition: all 0.3s ease;
    position: relative;
}

.navbar-li a:hover {
    background-color: rgba(255, 255, 255, 0.1);
    color: var(--primary-color);
}

/* Effet de soulignement animé */
.navbar-li a::after {
    content: '';
    position: absolute;
    width: 0;
    height: 2px;
    bottom: 0;
    left: 50%;
    background-color: var(--primary-color);
    transition: all 0.3s ease;
    transform: translateX(-50%);
}

.navbar-li a:hover::after {
    width: 80%;
}

/* Style spécifique pour le panier */
.navbar-panier a i.fa-cart-plus {
    font-size: 18px;
    color: white;
    cursor: pointer;
    transition: all 0.3s ease;
}

/* Animation de rotation à 180° pour le panier */
.navbar-panier:hover {
    animation: rotateCart 0.5s ease-in-out;
}

@keyframes rotateCart {
    0% {
        transform: rotate(0deg);
    }
    100% {
        transform: rotate(180deg);
    }
}

.navbar-panier a i.fa-cart-plus {
    font-size: 18px;
    color: white;
    cursor: pointer;
    transition: transform 0.5s ease-in-out;
    display: inline-block;
}

.navbar-panier:hover i.fa-cart-plus {
    transform: rotate(180deg);
}

.navbar-panier.active i.fa-cart-plus {
    transform: rotate(180deg);
}

/* Style pour le lien de connexion */
.navbar-content:last-child .navbar-li a {
    background-color: var(--primary-color);
    color: var(--secondary-color);
    padding: 8px 16px;
    border-radius: 20px;
    font-weight: bold;
}

.navbar-content:last-child .navbar-li a:hover {
    background-color: #fff;
    color: var(--secondary-color);
}

/* Style pour le panier dans le dernier conteneur */
.navbar-content:last-child .navbar-panier:last-child a {
    background-color: transparent;
    padding: 8px;
    border-radius: 50%;
}

.navbar-content:last-child .navbar-panier:last-child a:hover {
    background-color: rgba(255, 255, 255, 0.2);
    color: white;
}

.navbar-btn {
    background-color: var(--white-color);
    color: var(--secondary-color);
    padding: 1rem 2rem;
    border: none;
    border-radius: 1rem;
    font-weight: bold;
    cursor: pointer;
    transition: background-color 0.3s ease, color 0.3s ease;
}

.navbar-btn:hover {
    background-color: var(--primary-color);
    color: var(--white-color);
}

.navbar-btn a {
    color: inherit;
    text-decoration: none;
}

.navbar-panier {
    background-color: transparent;
    padding: 8px;
    border-radius: 50%;
    list-style-type: none;
}

/* Responsive design */
@media screen and (max-width: 768px) {
    nav {
        flex-direction: column;
        height: auto;
        padding: 15px;
    }
    
    .navbar-ul {
        flex-direction: column;
        gap: 10px;
        text-align: center;
        width: 100%;
    }
    
    .navbar-content {
        width: 100%;
        margin: 5px 0;
    }
    
    .navbar-content:last-child {
        display: flex;
        justify-content: center;
        gap: 20px;
    }
    
    .navbar-li a::after {
        display: none;
    }
    
    .logo-site {
        margin-bottom: 10px;
    }
}

/* Pour les très petits écrans */
@media screen and (max-width: 480px) {
    .navbar-content:last-child {
        flex-direction: column;
        align-items: center;
        gap: 10px;
    }
    
    .navbar-content:last-child .navbar-li a {
        width: 100%;
        text-align: center;
    }
}

/* Style pour le dropdown */
.dropdown {
    position: relative;
    list-style: none;
}

.dropbtn {
    display: flex;
    align-items: center;
    gap: 5px;
    background-color: var(--primary-color) !important;
    color: var(--secondary-color) !important;
    padding: 8px 16px !important;
    border-radius: 20px !important;
    font-weight: bold !important;
}

.dropbtn i {
    font-size: 14px;
    transition: transform 0.3s ease;
}

.dropdown.active .dropbtn i {
    transform: rotate(180deg);
}

/* Contenu du dropdown */
.dropdown-content {
    display: none;
    position: absolute;
    top: 100%;
    right: 0;
    background-color: white;
    min-width: 180px;
    border-radius: 10px;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    z-index: 1001;
    overflow: hidden;
    animation: slideDown 0.3s ease;
}

.dropdown.active .dropdown-content {
    display: block;
}

/* Liens du dropdown */
.dropdown-content a {
    color: var(--text-color) !important;
    padding: 12px 20px !important;
    text-decoration: none;
    display: flex;
    align-items: center;
    gap: 10px;
    transition: all 0.3s ease;
    border-radius: 0 !important;
    background-color: transparent !important;
    font-weight: normal !important;
}

.dropdown-content a i {
    width: 20px;
    color: var(--secondary-color);
}

.dropdown-content a:hover {
    background-color: rgba(2, 119, 125, 0.1) ;
    color: var(--secondary-color) ;
    padding-left: 25px ;
}

.dropdown-content a:hover i {
    color: var(--primary-color);
}

/* Séparateur dans le dropdown */
.dropdown-content hr {
    margin: 5px 0;
    border: none;
    border-top: 1px solid rgba(0, 0, 0, 0.1);
}

/* Animation du dropdown */
@keyframes slideDown {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Responsive pour le dropdown */
@media screen and (max-width: 768px) {
    .dropdown-content {
        position: static;
        box-shadow: none;
        background-color: rgba(255, 255, 255, 0.1);
        margin-top: 5px;
        width: 100%;
    }
    
    .dropdown-content a {
        color: white;
        justify-content: center;
    }
    
    .dropdown-content a:hover {
        background-color: rgba(255, 255, 255, 0.2) ;
    }
    
    .dropbtn {
        justify-content: center;
        width: 100%;
    }
}

/* Version avec icônes (optionnel) */
.dropdown-content a i {
    font-size: 16px;
}

/* Style spécifique pour le lien de déconnexion */
.dropdown-content a:last-child {
    color: #dc3545 ;
}



.dropdown-content a:last-child:hover {
    background-color: rgba(220, 53, 69, 0.1);
}

/* style du contenu de la page d'accueil */


/* Header avec image de fond */
.header-cont {
    background: linear-gradient(rgba(2, 119, 125, 0.5), rgba(99, 158, 144, 0.8)), url('https://images.unsplash.com/photo-1626785774573-4b799315345d?ixlib=rb-4.0.3&auto=format&fit=crop&w=2071&q=80');
    background-size: cover;
    background-position: center;
    background-attachment: fixed; 
    color: white;
    text-align: center;
    padding: 100px 20px;
    margin-bottom: 40px;
}

.header-cont h1 {
    font-size: 2.5em;
    margin-bottom: 20px;
    color: white;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
}

.header-cont p {
    font-size: 1.2em;
    max-width: 800px;
    margin: 0 auto 30px;
    line-height: 1.6;
    text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);
}

.btn {
    display: inline-block;
    background-color: var(--primary-color);
    color: var(--secondary-color);
    padding: 12px 30px;
    border-radius: 30px;
    text-decoration: none;
    font-weight: bold;
    font-size: 1.1em;
    transition: all 0.3s ease;
    border: 2px solid var(--primary-color);
}

.btn:hover {
    background-color: transparent;
    color: white;
    border-color: white;
    transform: translateY(-3px);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
}

/* Section services */
.service-content {
    max-width: 1200px;
    margin: 0 auto 60px;
    padding: 0 20px;
}

.service-item {
    display: flex;
    align-items: center;
    gap: 40px;
    margin-bottom: 60px;
    background-color: white;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease;
}

.service-item:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
}

.service-item:nth-child(even) {
    flex-direction: row-reverse;
}

.serv-img {
    flex: 1;
    overflow: hidden;
}

.serv-img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}

.service-item:hover .serv-img img {
    transform: scale(1.1);
}

.service-text {
    flex: 1;
    padding: 30px;
}

.service-text h2 {
    color: var(--secondary-color);
    margin-bottom: 15px;
    font-size: 1.8em;
}

.service-text p {
    line-height: 1.8;
    color: var(--text-color);
}


.catalogue-btn {
    display: inline-block;
    background-color: var(--secondary-color);
    color: var(--white-color);
    padding: 10px 25px;
    border-radius: 30px;
    text-decoration: none;
    font-weight: bold;
    font-size: 1em;
    transition: all 0.3s ease;
    border: 2px solid var(--secondary-color);
    justify-content: center;
    margin-top: 2rem;
    /* center le bouton */
    margin-left: auto;
    margin-right: auto;
}

.catalogue-btn:hover {
    background-color: transparent;
    color: var(--secondary-color);
    border-color: var(--secondary-color);
    transform: translateY(-3px);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
}

.catalogue-btn a {
    color: inherit;
    text-decoration: none;
}

/* Section réalisations */
/* Section réalisations */
.realisation-content {
    max-width: 1200px;
    margin: 0 auto 60px;
    padding: 0 20px;
}

.realisation-content h2, .service-content h2 {
    text-align: center;
    color: var(--secondary-color);
    font-size: 2.2em;
    margin-bottom: 40px;
    position: relative;
}

.realisation-content h2::after, .service-content h2::after {
    content: '';
    display: block;
    width: 60px;
    height: 3px;
    background-color: var(--primary-color);
    margin: 15px auto 0;
}

/* Grille pour les réalisations */
.realisation-div {
    display: grid;
    grid-template-columns: repeat(3, 1fr); /* 3 colonnes égales */
    gap: 30px;
    margin-top: 40px;
}

.realisation-item {
    background-color: white;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 3px 15px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
    display: flex;
    flex-direction: column;
    height: 100%;
}

.realisation-item:hover {
    transform: translateY(-10px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
}

.realisation-img {
    width: 100%;
    height: 250px; /* Hauteur fixe pour toutes les images */
    overflow: hidden;
}

.realisation-img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}

.realisation-item:hover .realisation-img img {
    transform: scale(1.1);
}

.realisation-text {
    padding: 25px;
    flex: 1;
    display: flex;
    flex-direction: column;
}

.realisation-text h3 {
    color: var(--secondary-color);
    margin-bottom: 15px;
    font-size: 1.4em;
    line-height: 1.3;
}

.realisation-text p {
    line-height: 1.6;
    color: var(--text-color);
    margin: 0;
}

/* Responsive design */
@media screen and (max-width: 992px) {
    .realisation-div {
        grid-template-columns: repeat(2, 1fr); /* 2 colonnes sur tablettes */
    }
}

@media screen and (max-width: 768px) {
    .realisation-div {
        grid-template-columns: 1fr; /* 1 colonne sur mobile */
        gap: 20px;
    }
    
    .realisation-content h2 {
        font-size: 1.8em;
    }
    
    .realisation-img {
        height: 220px;
    }
}

@media screen and (max-width: 480px) {
    .realisation-img {
        height: 200px;
    }
    
    .realisation-text {
        padding: 20px;
    }
    
    .realisation-text h3 {
        font-size: 1.2em;
    }
}

/* Animation d'apparition au scroll (optionnel) */
.realisation-item {
    opacity: 0;
    transform: translateY(30px);
    animation: fadeInUp 0.6s ease forwards;
}

.realisation-item:nth-child(1) { animation-delay: 0.2s; }
.realisation-item:nth-child(2) { animation-delay: 0.4s; }
.realisation-item:nth-child(3) { animation-delay: 0.6s; }

@keyframes fadeInUp {
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Responsive design */
@media screen and (max-width: 768px) {
    .header-cont {
        padding: 60px 20px;
    }

    .header-cont h1 {
        font-size: 2em;
    }

    .service-item,
    .service-item:nth-child(even),
    .realisation-item,
    .realisation-item:nth-child(even) {
        flex-direction: column;
    }

    .serv-img,
    .realisation-img {
        width: 100%;
        max-width: 100%;
        height: 250px;
    }

    .service-text,
    .realisation-text {
        padding: 20px;
    }

    .service-text h2 {
        font-size: 1.5em;
    }
}

@media screen and (max-width: 480px) {
    .header-cont h1 {
        font-size: 1.5em;
    }

    .header-cont p {
        font-size: 1em;
    }

    .btn {
        padding: 10px 20px;
        font-size: 1em;
    }

    .realisation-img {
        height: 200px;
    }
}

/* Animation au scroll (optionnel) */
.service-item, .realisation-item {
    opacity: 0;
    transform: translateY(30px);
    animation: fadeInUp 0.6s ease forwards;
}

@keyframes fadeInUp {
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Délais d'animation pour chaque élément */
.service-item:nth-child(1) { animation-delay: 0.2s; }
.service-item:nth-child(2) { animation-delay: 0.4s; }
.service-item:nth-child(3) { animation-delay: 0.6s; }
.realisation-item:nth-child(1) { animation-delay: 0.3s; }
.realisation-item:nth-child(2) { animation-delay: 0.5s; }
.realisation-item:nth-child(3) { animation-delay: 0.7s; }

/* style du footer */

/* Style du footer */
footer {
    background-color: var(--secondary-color);
    color: white;
    padding: 30px 0 20px;
    margin-top: 60px;
    box-shadow: 0 -5px 15px rgba(0, 0, 0, 0.1);
}

.footer-content {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 20px;
}

.footer-content p {
    margin: 0;
    font-size: 14px;
    color: rgba(255, 255, 255, 0.9);
}

/* Style des icônes sociales */
.social-media {
    display: flex;
    list-style: none;
    margin: 0;
    padding: 0;
    gap: 15px;
}

.social-media li {
    margin: 0;
}

.social-media li a {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 40px;
    height: 40px;
    background-color: rgba(255, 255, 255, 0.1);
    border-radius: 50%;
    color: white;
    font-size: 20px;
    transition: all 0.3s ease;
    text-decoration: none;
}

/* Couleurs spécifiques au survol */
.social-media li a:hover {
    transform: translateY(-5px);
}

.social-media li a[href*="facebook"]:hover,
.social-media li a i.fa-facebook:hover {
    background-color: #1877f2;
    box-shadow: 0 5px 15px rgba(24, 119, 242, 0.4);
}

.social-media li a[href*="tiktok"]:hover,
.social-media li a i.fa-tiktok:hover {
    background-color: #000000;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.4);
}

.social-media li a[href*="instagram"]:hover,
.social-media li a i.fa-instagram:hover {
    background: linear-gradient(45deg, #f09433, #d62976, #962fbf, #4f5bd5);
    box-shadow: 0 5px 15px rgba(225, 48, 108, 0.4);
}

.social-media li a[href*="whatsapp"]:hover,
.social-media li a i.fa-whatsapp:hover {
    background-color: #25d366;
    box-shadow: 0 5px 15px rgba(37, 211, 102, 0.4);
}

/* Version alternative avec sélecteurs plus simples */
.social-media li:nth-child(1) a:hover { background-color: #1877f2; } /* Facebook */
.social-media li:nth-child(2) a:hover { background-color: #000000; } /* TikTok */
.social-media li:nth-child(3) a:hover { background: linear-gradient(45deg, #f09433, #d62976, #962fbf, #4f5bd5); } /* Instagram */
.social-media li:nth-child(4) a:hover { background-color: #25d366; } /* WhatsApp */

/* Animation de rotation au survol */
.social-media li a i {
    transition: transform 0.3s ease;
}

.social-media li a:hover i {
    transform: rotate(360deg);
}

/* Responsive design */
@media screen and (max-width: 768px) {
    .footer-content {
        flex-direction: column;
        text-align: center;
        gap: 15px;
    }
    
    .social-media {
        justify-content: center;
    }
    
    footer {
        padding: 25px 0 15px;
    }
}

@media screen and (max-width: 480px) {
    .social-media {
        gap: 10px;
    }
    
    .social-media li a {
        width: 35px;
        height: 35px;
        font-size: 18px;
    }
    
    .footer-content p {
        font-size: 12px;
    }
}

/* Version avec plus d'informations (optionnel) */
.footer-extended {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 40px;
    max-width: 1200px;
    margin: 0 auto 30px;
    padding: 0 20px;
}

.footer-section h4 {
    color: var(--primary-color);
    margin-bottom: 20px;
    font-size: 18px;
    position: relative;
    padding-bottom: 10px;
}

.footer-section h4::after {
    content: '';
    position: absolute;
    left: 0;
    bottom: 0;
    width: 40px;
    height: 2px;
    background-color: var(--primary-color);
}

.footer-section ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.footer-section ul li {
    margin-bottom: 10px;
}

.footer-section ul li a {
    color: rgba(255, 255, 255, 0.8);
    text-decoration: none;
    transition: color 0.3s ease;
}

.footer-section ul li a:hover {
    color: var(--primary-color);
    padding-left: 5px;
}

.footer-bottom {
    text-align: center;
    padding-top: 20px;
    border-top: 1px solid rgba(255, 255, 255, 0.1);
}

/* style contact-accueil */
/* Section Contact Accueil */
.contact-accueil {
    background: linear-gradient(135deg, var(--secondary-color) 0%, var(--background-color) 100%);
    padding: 60px 20px;
    text-align: center;
    color: white;
    margin: 40px 0 0;
    position: relative;
    overflow: hidden;
}

/* Effet de forme géométrique en arrière-plan */
.contact-accueil::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -50%;
    width: 100%;
    height: 200%;
    background: rgba(255, 255, 255, 0.05);
    transform: rotate(35deg);
    pointer-events: none;
}

.contact-accueil::after {
    content: '';
    position: absolute;
    bottom: -50%;
    left: -50%;
    width: 100%;
    height: 200%;
    background: rgba(255, 255, 255, 0.05);
    transform: rotate(25deg);
    pointer-events: none;
}

.contact-accueil h2 {
    font-size: 2.5em;
    margin-bottom: 20px;
    position: relative;
    display: inline-block;
}

.contact-accueil h2::after {
    content: '';
    display: block;
    width: 60px;
    height: 3px;
    background-color: var(--primary-color);
    margin: 15px auto 0;
    border-radius: 2px;
}

.contact-accueil p {
    max-width: 700px;
    margin: 0 auto 30px;
    font-size: 1.1em;
    line-height: 1.8;
    position: relative;
    opacity: 0.95;
}

/* Style du bouton */
.contact-btn {
    background-color: var(--primary-color);
    border: none;
    padding: 0;
    border-radius: 50px;
    cursor: pointer;
    position: relative;
    overflow: hidden;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
}

.contact-btn a {
    display: inline-block;
    color: var(--secondary-color);
    text-decoration: none;
    font-weight: bold;
    font-size: 1.1em;
    padding: 15px 40px;
    transition: all 0.3s ease;
}

/* Effet de survol */
.contact-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
}

.contact-btn:hover a {
    color: white;
}

.contact-btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    transition: left 0.5s ease;
}

.contact-btn:hover::before {
    left: 100%;
}

/* Animation d'apparition */
.contact-accueil {
    animation: fadeInUp 0.8s ease;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Style alternatif - Version carte */
.contact-card {
    background-color: white;
    border-radius: 20px;
    padding: 50px 30px;
    max-width: 800px;
    margin: 40px auto;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    text-align: center;
    border: 1px solid rgba(2, 119, 125, 0.1);
}

.contact-card h2 {
    color: var(--secondary-color);
    font-size: 2.2em;
    margin-bottom: 20px;
}

.contact-card p {
    color: var(--text-color);
    margin-bottom: 30px;
    line-height: 1.6;
}

.contact-card .contact-btn {
    background-color: var(--secondary-color);
}

.contact-card .contact-btn a {
    color: white;
}

.contact-card .contact-btn:hover {
    background-color: var(--primary-color);
}

.contact-card .contact-btn:hover a {
    color: var(--secondary-color);
}

/* Responsive */
@media screen and (max-width: 768px) {
    .contact-accueil {
        padding: 40px 20px;
    }
    
    .contact-accueil h2 {
        font-size: 2em;
    }
    
    .contact-accueil p {
        font-size: 1em;
        padding: 0 15px;
    }
    
    .contact-btn a {
        padding: 12px 30px;
        font-size: 1em;
    }
    
    .contact-card {
        padding: 30px 20px;
        margin: 30px 15px;
    }
    
    .contact-card h2 {
        font-size: 1.8em;
    }
}

@media screen and (max-width: 480px) {
    .contact-accueil h2 {
        font-size: 1.8em;
    }
    
    .contact-btn a {
        padding: 10px 25px;
        font-size: 0.9em;
    }
}

/* Option avec icône */
.contact-accueil i {
    font-size: 3em;
    color: var(--white-color);
    margin-bottom: 20px;
    animation: bounce 2s infinite;
}

@keyframes bounce {
    0%, 20%, 50%, 80%, 100% {
        transform: translateY(0);
    }
    40% {
        transform: translateY(-20px);
    }
    60% {
        transform: translateY(-10px);
    }
}

/* Version avec icône de message */
.contact-icon {
    text-align: center;
    margin-bottom: 20px;
}

.contact-icon i {
    font-size: 4em;
    color: var(--white-color);
    background: rgba(255, 255, 255, 0.2);
    padding: 20px;
    border-radius: 50%;
    display: inline-block;
}
    </style>

</head>
<body>
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
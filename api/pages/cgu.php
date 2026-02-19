<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Politique de confidentialité - GILBERT SERVICES</title>
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary-color: #91dfdd;
            --secondary-color: #02777d;
            --background-color: #639e90;
            --text-color: #282929;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, rgba(145, 223, 221, 0.1) 0%, rgba(2, 119, 125, 0.1) 100%);
            color: var(--text-color);
            line-height: 1.6;
        }

        /* Navbar */
        .navbar {
            background: rgba(255, 255, 255, 0.95);
            box-shadow: 0 2px 10px rgba(2, 119, 125, 0.1);
            padding: 15px 0;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .nav-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 24px;
            font-weight: bold;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            text-decoration: none;
        }

        .nav-links {
            display: flex;
            gap: 30px;
        }

        .nav-links a {
            text-decoration: none;
            color: var(--text-color);
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .nav-links a:hover {
            color: var(--secondary-color);
        }

        /* Conteneur principal */
        .privacy-container {
            max-width: 1000px;
            margin: 40px auto;
            padding: 0 20px;
        }

        /* En-tête */
        .privacy-header {
            background: white;
            border-radius: 20px 20px 0 0;
            padding: 40px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(2, 119, 125, 0.1);
            position: relative;
            overflow: hidden;
        }

        .privacy-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        }

        .privacy-header h1 {
            font-size: 36px;
            color: var(--text-color);
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
        }

        .privacy-header h1 i {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .privacy-header .subtitle {
            color: #666;
            font-size: 16px;
        }

        .update-date {
            display: inline-block;
            margin-top: 20px;
            padding: 8px 20px;
            background: rgba(145, 223, 221, 0.1);
            border-radius: 50px;
            color: var(--secondary-color);
            font-size: 14px;
            border: 1px solid var(--primary-color);
        }

        /* Contenu principal */
        .privacy-content {
            background: white;
            padding: 40px;
            border-radius: 0 0 20px 20px;
            box-shadow: 0 10px 30px rgba(2, 119, 125, 0.1);
            margin-top: 2px;
        }

        /* Sections */
        .privacy-section {
            margin-bottom: 40px;
            padding-bottom: 30px;
            border-bottom: 1px solid rgba(145, 223, 221, 0.3);
        }

        .privacy-section:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }

        .privacy-section h2 {
            font-size: 24px;
            color: var(--secondary-color);
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .privacy-section h2 i {
            color: var(--primary-color);
            font-size: 28px;
        }

        .privacy-section h3 {
            font-size: 18px;
            color: var(--secondary-color);
            margin: 20px 0 10px;
        }

        .privacy-section p {
            color: var(--text-color);
            margin-bottom: 15px;
            font-size: 15px;
        }

        /* Listes */
        .privacy-list {
            list-style: none;
            margin: 15px 0;
        }

        .privacy-list li {
            margin-bottom: 10px;
            padding-left: 25px;
            position: relative;
            color: var(--text-color);
        }

        .privacy-list li:before {
            content: '✓';
            color: var(--secondary-color);
            position: absolute;
            left: 0;
            font-weight: bold;
        }

        .bullet-list {
            list-style: none;
            margin: 15px 0;
        }

        .bullet-list li {
            margin-bottom: 8px;
            padding-left: 25px;
            position: relative;
            color: var(--text-color);
        }

        .bullet-list li:before {
            content: '•';
            color: var(--primary-color);
            position: absolute;
            left: 0;
            font-weight: bold;
            font-size: 18px;
        }

        /* Tableaux */
        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            background: #f8f9fa;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(2, 119, 125, 0.1);
        }

        .data-table th {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 12px 15px;
            text-align: left;
            font-weight: 500;
        }

        .data-table td {
            padding: 12px 15px;
            border-bottom: 1px solid rgba(145, 223, 221, 0.3);
            color: var(--text-color);
        }

        .data-table tr:last-child td {
            border-bottom: none;
        }

        .data-table tr:hover td {
            background: rgba(145, 223, 221, 0.1);
        }

        /* Cartes */
        .engagement-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin: 30px 0;
        }

        .engagement-card {
            background: #f8f9fa;
            padding: 25px;
            border-radius: 15px;
            text-align: center;
            transition: transform 0.3s ease;
            border: 1px solid rgba(145, 223, 221, 0.3);
        }

        .engagement-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(2, 119, 125, 0.2);
            border-color: var(--secondary-color);
        }

        .engagement-card i {
            font-size: 40px;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 15px;
        }

        .engagement-card h3 {
            color: var(--secondary-color);
            margin-bottom: 10px;
        }

        .engagement-card p {
            color: var(--text-color);
            font-size: 14px;
            margin: 0;
        }

        /* Droits grid */
        .rights-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin: 20px 0;
        }

        .right-card {
            background: rgba(145, 223, 221, 0.05);
            border: 1px solid var(--primary-color);
            border-radius: 10px;
            padding: 15px;
            display: flex;
            align-items: center;
            gap: 12px;
            transition: all 0.3s ease;
        }

        .right-card:hover {
            background: rgba(2, 119, 125, 0.1);
            transform: translateX(5px);
        }

        .right-card i {
            font-size: 20px;
            color: var(--secondary-color);
            width: 30px;
            text-align: center;
        }

        .right-card span {
            color: var(--text-color);
            font-weight: 500;
        }

        /* Badges */
        .badge {
            display: inline-block;
            padding: 5px 15px;
            border-radius: 50px;
            font-size: 13px;
            font-weight: 500;
            margin-right: 10px;
            margin-bottom: 10px;
        }

        .badge-primary {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
        }

        .badge-light {
            background: rgba(145, 223, 221, 0.2);
            color: var(--secondary-color);
            border: 1px solid var(--secondary-color);
        }

        /* Info bulle */
        .info-bubble {
            background: #fff3cd;
            border-left: 4px solid #ffc107;
            padding: 15px 20px;
            border-radius: 5px;
            margin: 20px 0;
        }

        .info-bubble i {
            color: #ffc107;
            margin-right: 10px;
        }

        /* Contact box */
        .contact-box {
            background: rgba(145, 223, 221, 0.1);
            border: 2px solid var(--secondary-color);
            border-radius: 15px;
            padding: 25px;
            margin: 30px 0;
            text-align: center;
        }

        .contact-box i {
            font-size: 50px;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 15px;
        }

        .contact-box h3 {
            color: var(--secondary-color);
            margin-bottom: 10px;
        }

        .contact-email {
            display: inline-block;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 12px 30px;
            border-radius: 50px;
            text-decoration: none;
            margin-top: 15px;
            font-weight: 500;
            transition: transform 0.3s ease;
        }

        .contact-email:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(2, 119, 125, 0.3);
        }

        /* Récapitulatif */
        .summary-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin: 20px 0;
        }

        .summary-box {
            background: rgba(145, 223, 221, 0.1);
            padding: 20px;
            border-radius: 10px;
        }

        .summary-box h4 {
            color: var(--secondary-color);
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .summary-box h4 i {
            color: var(--primary-color);
        }

        .summary-box ul {
            list-style: none;
        }

        .summary-box ul li {
            margin-bottom: 10px;
            padding-left: 25px;
            position: relative;
            color: var(--text-color);
        }

        .summary-box ul li:before {
            content: '✓';
            color: var(--secondary-color);
            position: absolute;
            left: 0;
        }

        /* Footer */
        .privacy-footer {
            text-align: center;
            margin-top: 40px;
            padding: 20px;
            color: var(--secondary-color);
            background: white;
            border-radius: 10px;
            box-shadow: 0 5px 20px rgba(2, 119, 125, 0.1);
        }

        .privacy-footer a {
            color: var(--secondary-color);
            text-decoration: none;
            margin: 0 10px;
            transition: color 0.3s ease;
        }

        .privacy-footer a:hover {
            color: var(--primary-color);
            text-decoration: underline;
        }

        /* Responsive */
        @media screen and (max-width: 768px) {
            .privacy-header h1 {
                font-size: 28px;
                flex-direction: column;
                gap: 5px;
            }

            .privacy-content {
                padding: 25px;
            }

            .privacy-section h2 {
                font-size: 20px;
            }

            .engagement-grid {
                grid-template-columns: 1fr;
            }

            .rights-grid {
                grid-template-columns: 1fr;
            }

            .data-table {
                display: block;
                overflow-x: auto;
            }

            .summary-grid {
                grid-template-columns: 1fr;
            }
        }

        @media screen and (max-width: 480px) {
            .privacy-container {
                margin: 20px auto;
            }

            .privacy-header {
                padding: 30px 20px;
            }

            .privacy-content {
                padding: 20px;
            }
        }

        /* Print styles */
        @media print {
            body {
                background: white;
            }
            
            .navbar, .privacy-footer {
                display: none;
            }
            
            .privacy-container {
                margin: 0;
                padding: 0;
            }
            
            .privacy-header, .privacy-content {
                box-shadow: none;
                border: 1px solid var(--secondary-color);
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="nav-container">
            <a href="index.php" class="logo">
                <i class="fas fa-paint-brush"></i> GILBERT SERVICES
            </a>
            <div class="nav-links">
                <a href="index.php">Accueil</a>
                <a href="service.php">Services</a>
                <a href="contact.php">Contact</a>
            </div>
        </div>
    </nav>

    <!-- Contenu principal -->
    <div class="privacy-container">
        <!-- En-tête -->
        <div class="privacy-header">
            <h1>
                <i class="fas fa-shield-alt"></i>
                Politique de Confidentialité
            </h1>
            <p class="subtitle">Protection de vos données personnelles - GILBERT SERVICES</p>
            <div class="update-date">
                <i class="far fa-calendar-alt"></i> Dernière mise à jour : 19 février 2026
            </div>
        </div>

        <!-- Contenu -->
        <div class="privacy-content">
            <!-- INTRODUCTION -->
            <section class="privacy-section">
                <h2><i class="fas fa-info-circle"></i> Introduction</h2>
                <p><strong>GILBERT SERVICES</strong> est une plateforme numérique spécialisée dans la conception et la vente de services de design graphique (logos, affiches, flyers). Nous mettons un point d'honneur à offrir des solutions créatives et professionnelles à nos clients. La protection des informations personnelles et le respect de la vie privée sont fondamentaux pour nos opérations quotidiennes et notre succès.</p>
            </section>

            <!-- OBJECTIF ET PORTÉE -->
            <section class="privacy-section">
                <h2><i class="fas fa-bullseye"></i> Objectif et portée</h2>
                <p>Cette politique détaille la manière dont GILBERT SERVICES collecte, utilise et protège vos informations. Elle s'applique lorsque vous :</p>
                <ul class="privacy-list">
                    <li>Utilisez nos services de conception graphique</li>
                    <li>Visitez notre site Internet</li>
                    <li>Passez commande de logos, affiches ou flyers</li>
                    <li>Interagissez avec nous via nos canaux de communication</li>
                    <li>Vous inscrivez à notre newsletter</li>
                    <li>Postulez à des offres d'emploi</li>
                </ul>
                <div class="info-bubble">
                    <i class="fas fa-exclamation-triangle"></i>
                    <strong>Important :</strong> En fournissant vos données, vous déclarez avoir lu cette politique et y consentir expressément.
                </div>
            </section>

            <!-- RESPONSABLE DU TRAITEMENT -->
            <section class="privacy-section">
                <h2><i class="fas fa-user-tie"></i> Responsable du traitement</h2>
                <p><strong>GILBERT SERVICES</strong> est le responsable du traitement de vos données.</p>
                <div style="background: rgba(145, 223, 221, 0.1); padding: 20px; border-radius: 10px; margin-top: 15px;">
                    <p><i class="fas fa-map-marker-alt" style="color: var(--secondary-color); width: 25px;"></i> <strong>Adresse :</strong> ADAKPAME - LOME </p>
                    <p><i class="fas fa-phone" style="color: var(--secondary-color); width: 25px;"></i> <strong>Téléphone :</strong> +228 70 09 33 59</p>
                    <p><i class="fas fa-envelope" style="color: var(--secondary-color); width: 25px;"></i> <strong>Email :</strong> schalombandje@gmail.com</p>
                    <p><i class="fas fa-globe" style="color: var(--secondary-color); width: 25px;"></i> <strong>Site web :</strong> www.gilbertservices.com</p>
                </div>
            </section>

            <!-- NOS ENGAGEMENTS -->
            <section class="privacy-section">
                <h2><i class="fas fa-handshake"></i> Nos engagements</h2>
                <div class="engagement-grid">
                    <div class="engagement-card">
                        <i class="fas fa-eye"></i>
                        <h3>Transparence</h3>
                        <p>Nous détaillons comment vos données sont obtenues, stockées et utilisées.</p>
                    </div>
                    <div class="engagement-card">
                        <i class="fas fa-lock"></i>
                        <h3>Sécurité</h3>
                        <p>Des mesures techniques et organisationnelles de pointe protègent vos données.</p>
                    </div>
                    <div class="engagement-card">
                        <i class="fas fa-share-alt-slash"></i>
                        <h3>Non-diffusion</h3>
                        <p>Vos données ne sont jamais vendues à des tiers.</p>
                    </div>
                    <div class="engagement-card">
                        <i class="fas fa-gavel"></i>
                        <h3>Respect des droits</h3>
                        <p>Nous garantissons tous vos droits d'accès, rectification et suppression.</p>
                    </div>
                </div>
            </section>

            <!-- DONNÉES COLLECTÉES -->
            <section class="privacy-section">
                <h2><i class="fas fa-database"></i> Données personnelles collectées</h2>
                
                <h3><i class="fas fa-tag"></i> Catégories de données</h3>
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Catégorie</th>
                            <th>Données collectées</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><strong>Identification</strong></td>
                            <td>Nom, prénom, email, téléphone, adresse</td>
                        </tr>
                        <tr>
                            <td><strong>Commande</strong></td>
                            <td>Historique, préférences de design, fichiers projets</td>
                        </tr>
                        <tr>
                            <td><strong>Paiement</strong></td>
                            <td>Informations de transaction (via prestataire sécurisé)</td>
                        </tr>
                        <tr>
                            <td><strong>Connexion</strong></td>
                            <td>Adresse IP, journaux, type navigateur, pages visitées</td>
                        </tr>
                        <tr>
                            <td><strong>Recrutement</strong></td>
                            <td>CV, lettres de motivation, portfolio</td>
                        </tr>
                        <tr>
                            <td><strong>Communication</strong></td>
                            <td>Messages, réclamations, demandes d'assistance</td>
                        </tr>
                    </tbody>
                </table>
            </section>

            <!-- BASE JURIDIQUE -->
            <section class="privacy-section">
                <h2><i class="fas fa-balance-scale"></i> Base juridique du traitement</h2>
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Base juridique</th>
                            <th>Application</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><span class="badge badge-primary">Votre consentement</span></td>
                            <td>Newsletter, acceptation des cookies</td>
                        </tr>
                        <tr>
                            <td><span class="badge badge-primary">Exécution du contrat</span></td>
                            <td>Traitement des commandes, livraison des services</td>
                        </tr>
                        <tr>
                            <td><span class="badge badge-primary">Obligation légale</span></td>
                            <td>Facturation, conservation comptable</td>
                        </tr>
                        <tr>
                            <td><span class="badge badge-primary">Intérêt légitime</span></td>
                            <td>Amélioration des services, sécurité du site</td>
                        </tr>
                    </tbody>
                </table>
            </section>

            <!-- FINALITÉS -->
            <section class="privacy-section">
                <h2><i class="fas fa-tasks"></i> Finalités du traitement</h2>
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Finalité</th>
                            <th>Données utilisées</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr><td>Gestion des commandes</td><td>Identification, coordonnées</td></tr>
                        <tr><td>Création de designs</td><td>Préférences, fichiers fournis</td></tr>
                        <tr><td>Facturation</td><td>Coordonnées, historique</td></tr>
                        <tr><td>Service client</td><td>Messages, réclamations</td></tr>
                        <tr><td>Envoi de confirmations</td><td>Email, détails de commande</td></tr>
                        <tr><td>Newsletter</td><td>Email (avec consentement)</td></tr>
                    </tbody>
                </table>
            </section>

            <!-- DURÉE DE CONSERVATION -->
            <section class="privacy-section">
                <h2><i class="fas fa-clock"></i> Durée de conservation</h2>
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Type de données</th>
                            <th>Durée</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr><td>Données de commande</td><td>5 ans (obligation comptable)</td></tr>
                        <tr><td>Compte client</td><td>Jusqu'à suppression</td></tr>
                        <tr><td>Emails de confirmation</td><td>3 ans</td></tr>
                        <tr><td>Newsletter</td><td>Jusqu'au désabonnement</td></tr>
                        <tr><td>CV et candidatures</td><td>2 ans</td></tr>
                        <tr><td>Données de connexion</td><td>1 an</td></tr>
                        <tr><td>Cookies</td><td>13 mois</td></tr>
                    </tbody>
                </table>
            </section>

            <!-- VOS DROITS -->
            <section class="privacy-section">
                <h2><i class="fas fa-user-check"></i> Vos droits</h2>
                <div class="rights-grid">
                    <div class="right-card"><i class="fas fa-eye"></i><span>Droit d'accès</span></div>
                    <div class="right-card"><i class="fas fa-info-circle"></i><span>Droit d'information</span></div>
                    <div class="right-card"><i class="fas fa-edit"></i><span>Droit de rectification</span></div>
                    <div class="right-card"><i class="fas fa-trash"></i><span>Droit à l'effacement</span></div>
                    <div class="right-card"><i class="fas fa-pause-circle"></i><span>Droit à la limitation</span></div>
                    <div class="right-card"><i class="fas fa-ban"></i><span>Droit d'opposition</span></div>
                    <div class="right-card"><i class="fas fa-file-export"></i><span>Droit à la portabilité</span></div>
                    <div class="right-card"><i class="fas fa-cookie-bite"></i><span>Gestion des cookies</span></div>
                </div>

                <div class="contact-box">
                    <i class="fas fa-envelope-open-text"></i>
                    <h3>Comment exercer vos droits ?</h3>
                    <p>Contactez notre Délégué à la Protection des Données :</p>
                    <a href="mailto:data_privacy@gilbertservices.com" class="contact-email">
                        <i class="fas fa-envelope"></i> data_privacy@gilbertservices.com
                    </a>
                    <p style="margin-top: 15px; font-size: 14px;">Réponse sous 1 mois maximum</p>
                </div>
            </section>

            <!-- COOKIES -->
            <section class="privacy-section">
                <h2><i class="fas fa-cookie-bite"></i> Cookies</h2>
                <p>Notre site utilise différents types de cookies :</p>
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Type</th>
                            <th>Finalité</th>
                            <th>Durée</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr><td>Fonctionnels</td><td>Connexion, panier</td><td>Session</td></tr>
                        <tr><td>Analytiques</td><td>Mesure d'audience</td><td>13 mois</td></tr>
                        <tr><td>Préférences</td><td>Mémorisation des choix</td><td>6 mois</td></tr>
                        <tr><td>Panier</td><td>Sauvegarde articles</td><td>Session</td></tr>
                    </tbody>
                </table>
            </section>

            <!-- RÉCAPITULATIF -->
            <section class="privacy-section">
                <h2><i class="fas fa-clipboard-check"></i> Récapitulatif</h2>
                <div class="summary-grid">
                    <div class="summary-box">
                        <h4><i class="fas fa-check-circle" style="color: var(--secondary-color);"></i> Ce que nous faisons</h4>
                        <ul>
                            <li>Nous sécurisons vos données</li>
                            <li>Nous utilisons vos données pour vos commandes</li>
                            <li>Nous ne vendons pas vos données</li>
                            <li>Nous respectons vos choix</li>
                            <li>Nous vous informons des changements</li>
                        </ul>
                    </div>
                    <div class="summary-box">
                        <h4><i class="fas fa-user-cog" style="color: var(--secondary-color);"></i> Ce que vous pouvez faire</h4>
                        <ul>
                            <li>Consulter vos données</li>
                            <li>Rectifier vos données</li>
                            <li>Supprimer votre compte</li>
                            <li>Refuser les cookies</li>
                            <li>Nous contacter à tout moment</li>
                        </ul>
                    </div>
                </div>
            </section>

            <!-- CONTACT DPD -->
            <section class="privacy-section">
                <h2><i class="fas fa-phone-alt"></i> Contact du Délégué à la Protection des Données</h2>
                <div style="text-align: center;">
                    <p>Pour toute question concernant vos données personnelles :</p>
                    <p style="font-size: 18px; margin: 15px 0;">
                        <i class="fas fa-envelope" style="color: var(--secondary-color);"></i> 
                        <strong>schalombandje@gmail.com</strong>
                    </p>
                </div>
            </section>
        </div>

        <!-- Footer -->
        <div class="privacy-footer">
            <p>© 2026 AMAH SHALOM BANDJE - Tous droits réservés</p>
            <p>
                <a href="index.php">Accueil</a> |
                <a href="service.php">Services</a> |
                <a href="contact.php">Contact</a>
            </p>
        </div>
    </div>
</body>
</html>
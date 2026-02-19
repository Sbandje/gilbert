<?php
// contact.php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact - GILBERT SERVICES</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        :root {
            --primary-color: #91dfdd;
            --secondary-color: #02777d;
            --background-color: #639e90;
            --text-color: #282929;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, rgba(145, 223, 221, 0.1) 0%, rgba(2, 119, 125, 0.1) 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .contact-cont {
            max-width: 600px;
            width: 100%;
            background: white;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 10px 40px rgba(2, 119, 125, 0.2);
            animation: slideUpFade 0.6s ease;
        }

        @keyframes slideUpFade {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        h1 {
            color: var(--secondary-color);
            font-size: 2.2em;
            margin-bottom: 15px;
            text-align: center;
        }

        h1::after {
            content: '';
            display: block;
            width: 60px;
            height: 3px;
            background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
            margin: 10px auto 0;
            border-radius: 2px;
        }

        .contact-cont > p {
            color: var(--text-color);
            text-align: center;
            margin-bottom: 30px;
            line-height: 1.6;
        }

        /* Messages de notification */
        .alert {
            padding: 15px 20px;
            border-radius: 10px;
            margin-bottom: 25px;
            text-align: center;
            animation: slideDown 0.5s ease;
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
            border-left: 4px solid #28a745;
        }

        .alert-error {
            background: #f8d7da;
            color: #721c24;
            border-left: 4px solid #dc3545;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Méthodes de contact */
        .contact-methods {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 15px;
            margin-bottom: 30px;
        }

        .contact-link {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 12px 15px;
            border-radius: 10px;
            text-decoration: none;
            color: white;
            font-weight: bold;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .contact-link::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            transition: left 0.5s ease;
        }

        .contact-link:hover::before {
            left: 100%;
        }

        .contact-link:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
        }

        /* Couleurs spécifiques par réseau */
        .contact-link[href*="mailto"] { background: linear-gradient(135deg, #667eea, #764ba2); }
        .contact-link[href*="facebook"] { background: #1877f2; }
        .contact-link[href*="instagram"] { background: linear-gradient(45deg, #f09433, #d62976, #962fbf, #4f5bd5); }
        .contact-link[href*="linkedin"] { background: #0077b5; }
        .contact-link[href*="wa.me"] { background: #25d366; }
        .contact-link[href*="tiktok"] { background: #000000; }

        /* Formulaire */
        .contact-form {
            background: #f8f9fa;
            border-radius: 15px;
            padding: 30px;
            margin-top: 20px;
        }

        .contact-form h2 {
            color: var(--secondary-color);
            margin-bottom: 20px;
            font-size: 1.5em;
        }

        /* Sélecteur de réseau */
        .social-selector {
            display: flex;
            gap: 10px;
            margin-bottom: 25px;
            flex-wrap: wrap;
        }

        .social-option {
            flex: 1;
            min-width: 80px;
            padding: 10px;
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            background: white;
            color: var(--text-color);
            font-size: 14px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 5px;
        }

        .social-option i {
            font-size: 20px;
        }

        .social-option:hover {
            border-color: var(--primary-color);
            transform: translateY(-2px);
        }

        .social-option.active {
            border-color: var(--secondary-color);
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
        }

        /* Groupes d'input */
        .input-group {
            margin-bottom: 20px;
        }

        .input-group label {
            display: block;
            margin-bottom: 8px;
            color: var(--secondary-color);
            font-weight: 600;
            font-size: 0.95em;
        }

        .input-group input,
        .input-group textarea,
        .input-group select {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            font-size: 16px;
            transition: all 0.3s ease;
            background: white;
            font-family: inherit;
        }

        .input-group input:focus,
        .input-group textarea:focus,
        .input-group select:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 4px rgba(145, 223, 221, 0.2);
        }

        /* Champ spécifique au réseau */
        .social-field {
            background: white;
            border-radius: 10px;
            padding: 20px;
            margin: 20px 0;
            border-left: 4px solid var(--secondary-color);
            animation: slideIn 0.3s ease;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(-20px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .social-field label {
            color: var(--secondary-color);
            font-weight: bold;
            margin-bottom: 10px;
            display: block;
        }

        .social-field .social-icon {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 5px;
            color: white;
            font-size: 12px;
            margin-left: 10px;
        }

        /* Bouton d'envoi */
        .contact-btn {
            width: 100%;
            padding: 15px;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 1.1em;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .contact-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(2, 119, 125, 0.4);
        }

        .contact-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            transition: left 0.5s ease;
        }

        .contact-btn:hover::before {
            left: 100%;
        }

        /* Informations de contact */
        .contact-info {
            margin-top: 15px;
            color: var(--text-color);
            font-size: 14px;
            text-align: center;
        }

        .contact-info a {
            color: var(--secondary-color);
            text-decoration: none;
            font-weight: bold;
        }

        .contact-info a:hover {
            text-decoration: underline;
        }

        /* Responsive */
        @media screen and (max-width: 768px) {
            .contact-cont {
                padding: 30px 20px;
            }

            h1 {
                font-size: 1.8em;
            }

            .contact-methods {
                grid-template-columns: repeat(3, 1fr);
            }

            .contact-link {
                padding: 10px;
                font-size: 14px;
            }

            .social-selector {
                flex-wrap: wrap;
            }

            .social-option {
                min-width: calc(33.33% - 10px);
            }
        }

        @media screen and (max-width: 480px) {
            .contact-cont {
                padding: 20px 15px;
            }

            .contact-methods {
                grid-template-columns: repeat(2, 1fr);
            }

            .social-option {
                min-width: calc(50% - 5px);
            }
        }
    </style>
</head>
<body>
    <?php include '../includes/navbar.php' ?>
    <div class="contact-cont">
        <?php
        // Affichage des messages de retour
        if (isset($_GET['success']) && $_GET['success'] == 1) {
            echo '<div class="alert alert-success">✓ Votre message a bien été envoyé. Merci de nous avoir contactés !</div>';
        } elseif (isset($_GET['error'])) {
            $errorMsg = 'Une erreur est survenue.';
            switch ($_GET['error']) {
                case '1': $errorMsg = 'Veuillez remplir tous les champs.'; break;
                case '2': $errorMsg = 'Adresse email invalide.'; break;
                case '3': $errorMsg = "Erreur lors de l'envoi du message."; break;
                case '4': $errorMsg = 'Méthode non autorisée.'; break;
                case '5': $errorMsg = 'Le message ne peut pas être vide.'; break;
            }
            echo '<div class="alert alert-error">⚠ ' . $errorMsg . '</div>';
        }
        ?>
        
        <h1>Contactez-nous</h1>
        <p>Vous avez des questions, des suggestions ou besoin d'assistance ? N'hésitez pas à nous contacter via les réseaux sociaux ou par email. Nous sommes là pour vous aider !</p>
        
        <div class="contact-methods">
            <a href="mailto:schalombandje@gmail.com" class="contact-link">
                <i class="fas fa-envelope"></i> Email
            </a>
            <a href="https://www.facebook.com/gilbertservices" target="_blank" class="contact-link">
                <i class="fab fa-facebook"></i> Facebook
            </a>
            <a href="https://www.instagram.com/gilbertservices" target="_blank" class="contact-link">
                <i class="fab fa-instagram"></i> Instagram
            </a>
            <a href="https://www.linkedin.com/company/gilbertservices" target="_blank" class="contact-link">
                <i class="fab fa-linkedin"></i> LinkedIn
            </a>
            <a href="https://wa.me/22870093359" target="_blank" class="contact-link">
                <i class="fab fa-whatsapp"></i> WhatsApp
            </a>
            <a href="https://www.tiktok.com/@gilbertservices" target="_blank" class="contact-link">
                <i class="fab fa-tiktok"></i> TikTok
            </a>
        </div>

        <div class="contact-form">
            <h2>Envoyez-nous un message</h2>
            
            <!-- Sélecteur de réseau -->
            <div class="social-selector" id="socialSelector">
                <div class="social-option active" data-social="email">
                    <i class="fas fa-envelope"></i>
                    <span>Email</span>
                </div>
                <div class="social-option" data-social="facebook">
                    <i class="fab fa-facebook"></i>
                    <span>Facebook</span>
                </div>
                <div class="social-option" data-social="instagram">
                    <i class="fab fa-instagram"></i>
                    <span>Instagram</span>
                </div>
                <div class="social-option" data-social="whatsapp">
                    <i class="fab fa-whatsapp"></i>
                    <span>WhatsApp</span>
                </div>
                <div class="social-option" data-social="linkedin">
                    <i class="fab fa-linkedin"></i>
                    <span>LinkedIn</span>
                </div>
                <div class="social-option" data-social="tiktok">
                    <i class="fab fa-tiktok"></i>
                    <span>TikTok</span>
                </div>
            </div>

            <form action="process_contact.php" method="POST" id="contactForm">
                <input type="hidden" name="contact_method" id="contactMethod" value="email">
                
                <!-- Champ commun à tous -->
                <div class="input-group">
                    <label for="name">Nom complet</label>
                    <input type="text" id="name" name="name" required>
                </div>

                <!-- Champ dynamique selon le réseau -->
                <div id="dynamicFields">
                    <!-- Email par défaut -->
                    <div class="input-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                </div>

                <div class="input-group">
                    <label for="message">Message</label>
                    <textarea id="message" name="message" rows="5" required></textarea>
                </div>

                <button type="submit" class="contact-btn">Envoyer</button>
            </form>

            <p class="contact-info">Vous pouvez également nous contacter par email à <a href="mailto:schalombandje@gmail.com">schalombandje@gmail.com</a></p>
            <p class="contact-info">Ou par téléphone au <a href="tel:+22870093359">+228 70 09 33 59</a></p>
            <p class="contact-info">Nous sommes disponibles du lundi au vendredi de 9h à 18h.</p>
        </div>
    </div>
<?php include '../includes/footer.php' ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const socialOptions = document.querySelectorAll('.social-option');
            const contactMethod = document.getElementById('contactMethod');
            const dynamicFields = document.getElementById('dynamicFields');

            // Configuration des champs pour chaque réseau
            const fieldsConfig = {
                email: `
                    <div class="input-group">
                        <label for="email">Adresse email</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                `,
                facebook: `
                    <div class="social-field">
                        <label>Compte Facebook <span class="social-icon" style="background: #1877f2;">Facebook</span></label>
                        <div class="input-group">
                            <label for="facebook_name">Nom sur Facebook</label>
                            <input type="text" id="facebook_name" name="facebook_name" placeholder="Votre nom Facebook" required>
                        </div>
                        <div class="input-group">
                            <label for="facebook_url">Lien de votre profil (optionnel)</label>
                            <input type="url" id="facebook_url" name="facebook_url" placeholder="https://facebook.com/votre.profil">
                        </div>
                    </div>
                `,
                instagram: `
                    <div class="social-field">
                        <label>Compte Instagram <span class="social-icon" style="background: linear-gradient(45deg, #f09433, #d62976);">Instagram</span></label>
                        <div class="input-group">
                            <label for="instagram_username">Nom d'utilisateur Instagram</label>
                            <input type="text" id="instagram_username" name="instagram_username" placeholder="@votre_pseudo" required>
                        </div>
                        <div class="input-group">
                            <label for="instagram_post">Lien du post (optionnel)</label>
                            <input type="url" id="instagram_post" name="instagram_post" placeholder="https://instagram.com/p/...">
                        </div>
                    </div>
                `,
                whatsapp: `
                    <div class="social-field">
                        <label>WhatsApp <span class="social-icon" style="background: #25d366;">WhatsApp</span></label>
                        <div class="input-group">
                            <label for="whatsapp_number">Numéro WhatsApp</label>
                            <input type="tel" id="whatsapp_number" name="whatsapp_number" placeholder="+228 XX XX XX XX" required>
                        </div>
                        <div class="input-group">
                            <label for="whatsapp_country">Pays</label>
                            <select id="whatsapp_country" name="whatsapp_country">
                                <option value="TG">Togo (+228)</option>
                                <option value="BJ">Bénin (+229)</option>
                                <option value="CI">Côte d'Ivoire (+225)</option>
                                <option value="SN">Sénégal (+221)</option>
                                <option value="CM">Cameroun (+237)</option>
                            </select>
                        </div>
                    </div>
                `,
                linkedin: `
                    <div class="social-field">
                        <label>LinkedIn <span class="social-icon" style="background: #0077b5;">LinkedIn</span></label>
                        <div class="input-group">
                            <label for="linkedin_profile">URL du profil LinkedIn</label>
                            <input type="url" id="linkedin_profile" name="linkedin_profile" placeholder="https://linkedin.com/in/votre-profil" required>
                        </div>
                        <div class="input-group">
                            <label for="linkedin_headline">Titre professionnel</label>
                            <input type="text" id="linkedin_headline" name="linkedin_headline" placeholder="Ex: Directeur Marketing">
                        </div>
                    </div>
                `,
                tiktok: `
                    <div class="social-field">
                        <label>TikTok <span class="social-icon" style="background: #000000;">TikTok</span></label>
                        <div class="input-group">
                            <label for="tiktok_username">Nom d'utilisateur TikTok</label>
                            <input type="text" id="tiktok_username" name="tiktok_username" placeholder="@votre_pseudo" required>
                        </div>
                        <div class="input-group">
                            <label for="tiktok_video">Lien de la vidéo (optionnel)</label>
                            <input type="url" id="tiktok_video" name="tiktok_video" placeholder="https://tiktok.com/@user/video/...">
                        </div>
                    </div>
                `
            };

            // Gestionnaire de clic sur les options
            socialOptions.forEach(option => {
                option.addEventListener('click', function() {
                    socialOptions.forEach(opt => opt.classList.remove('active'));
                    this.classList.add('active');
                    
                    const social = this.dataset.social;
                    contactMethod.value = social;
                    
                    dynamicFields.innerHTML = fieldsConfig[social] || fieldsConfig.email;
                    
                    dynamicFields.style.animation = 'none';
                    dynamicFields.offsetHeight;
                    dynamicFields.style.animation = 'slideIn 0.3s ease';
                });
            });

            document.getElementById('contactForm').addEventListener('submit', function(e) {
                const method = contactMethod.value;
                let isValid = true;
                let errorMessage = '';

                // Validation selon la méthode choisie
                switch(method) {
                    case 'email':
                        const email = document.getElementById('email');
                        if (email && !email.value.match(/^[^\s@]+@[^\s@]+\.[^\s@]+$/)) {
                            isValid = false;
                            errorMessage = 'Veuillez entrer une adresse email valide';
                        }
                        break;
                    case 'whatsapp':
                        const phone = document.getElementById('whatsapp_number');
                        const msg = document.getElementById('message');
                        if (phone && !phone.value.match(/^[+]?[0-9\s]{8,}$/)) {
                            isValid = false;
                            errorMessage = 'Veuillez entrer un numéro WhatsApp valide';
                        }
                        if (isValid) {
                            e.preventDefault();
                            // Générer le lien WhatsApp
                            const country = document.getElementById('whatsapp_country').value;
                            let phoneNumber = phone.value.replace(/\D/g, '');
                            if (country === 'TG') phoneNumber = '228' + phoneNumber.replace(/^228/, '');
                            if (country === 'BJ') phoneNumber = '229' + phoneNumber.replace(/^229/, '');
                            if (country === 'CI') phoneNumber = '225' + phoneNumber.replace(/^225/, '');
                            if (country === 'SN') phoneNumber = '221' + phoneNumber.replace(/^221/, '');
                            if (country === 'CM') phoneNumber = '237' + phoneNumber.replace(/^237/, '');
                            const text = encodeURIComponent(msg.value);
                            window.open('https://wa.me/' + phoneNumber + '?text=' + text, '_blank');
                        }
                        break;
                    // Ajoutez d'autres validations selon les besoins pour Facebook, Instagram, etc.
                    default:
                        // Pour les autres réseaux, empêcher l'envoi et afficher un message ou rediriger
                        if (method !== 'email') {
                            e.preventDefault();
                            alert('Merci d\'utiliser le bouton ou le lien du réseau choisi pour nous contacter.');
                        }
                }

                if (!isValid) {
                    e.preventDefault();
                    alert(errorMessage);
                }
            });
        });
    </script>
</body>
</html>
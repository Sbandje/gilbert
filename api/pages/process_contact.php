<?php
// process_contact.php

// Démarrer la session pour les messages
session_start();

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: contact.php?error=4');
    exit;
}

// Récupérer et nettoyer les données
$nom = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$message = trim($_POST['message'] ?? '');
$contact_method = $_POST['contact_method'] ?? 'email';

// Validation des champs communs
if (empty($nom) || empty($message)) {
    header('Location: contact.php?error=1');
    exit;
}

if (empty($message)) {
    header('Location: contact.php?error=5');
    exit;
}

// Traitement selon la méthode de contact choisie
$email = '';
$social_data = '';

switch ($contact_method) {
    case 'email':
        $email = trim($_POST['email'] ?? '');
        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            header('Location: contact.php?error=2');
            exit;
        }
        $social_data = "Email: $email\n";
        break;
        
    case 'facebook':
        $facebook_name = trim($_POST['facebook_name'] ?? '');
        $facebook_url = trim($_POST['facebook_url'] ?? '');
        if (empty($facebook_name)) {
            header('Location: contact.php?error=1');
            exit;
        }
        $email = 'contact@facebook.com'; // Email par défaut pour validation
        $social_data = "Facebook Name: $facebook_name\nFacebook URL: $facebook_url\n";
        break;
        
    case 'instagram':
        $instagram_username = trim($_POST['instagram_username'] ?? '');
        $instagram_post = trim($_POST['instagram_post'] ?? '');
        if (empty($instagram_username)) {
            header('Location: contact.php?error=1');
            exit;
        }
        $email = 'contact@instagram.com';
        $social_data = "Instagram Username: $instagram_username\nInstagram Post: $instagram_post\n";
        break;
        
    case 'whatsapp':
        $whatsapp_number = trim($_POST['whatsapp_number'] ?? '');
        $whatsapp_country = trim($_POST['whatsapp_country'] ?? '');
        if (empty($whatsapp_number)) {
            header('Location: contact.php?error=1');
            exit;
        }
        // Validation simple du numéro
        if (!preg_match('/^[+]?[0-9\s]{8,}$/', $whatsapp_number)) {
            header('Location: contact.php?error=2');
            exit;
        }
        $email = 'contact@whatsapp.com';
        $social_data = "WhatsApp Number: $whatsapp_number\nCountry: $whatsapp_country\n";
        break;
        
    case 'linkedin':
        $linkedin_profile = trim($_POST['linkedin_profile'] ?? '');
        $linkedin_headline = trim($_POST['linkedin_headline'] ?? '');
        if (empty($linkedin_profile)) {
            header('Location: contact.php?error=1');
            exit;
        }
        $email = 'contact@linkedin.com';
        $social_data = "LinkedIn Profile: $linkedin_profile\nHeadline: $linkedin_headline\n";
        break;
        
    case 'tiktok':
        $tiktok_username = trim($_POST['tiktok_username'] ?? '');
        $tiktok_video = trim($_POST['tiktok_video'] ?? '');
        if (empty($tiktok_username)) {
            header('Location: contact.php?error=1');
            exit;
        }
        $email = 'contact@tiktok.com';
        $social_data = "TikTok Username: $tiktok_username\nTikTok Video: $tiktok_video\n";
        break;
        
    default:
        header('Location: contact.php?error=4');
        exit;
}

// Configuration de l'email
$to = $_ENV['MAIL_FROM_ADDRESS'] ?? 'shalombandje@gmail.com';
$subject = 'Nouveau message de contact - GILBERT SERVICES';
$headers = "From: $email\r\n";
$headers .= "Reply-To: $email\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

// Corps du message
$body = " NOUVEAU MESSAGE DE CONTACT \n\n";
$body .= "Méthode de contact: " . strtoupper($contact_method) . "\n";
$body .= "Nom: $nom\n";
$body .= $social_data;
$body .= "\n----- MESSAGE -----\n";
$body .= $message;
$body .= "\n\n-------------------\n";
$body .= "Date: " . date('d/m/Y H:i:s') . "\n";
$body .= "IP: " . ($_SERVER['REMOTE_ADDR'] ?? 'Inconnue') . "\n";

// Envoi de l'email
require_once __DIR__ . '/../includes/mail_config.php';

if (mail($to, $subject, $body, $headers)) {
    header('Location: contact.php?success=1');
} else {
    // Tentative avec une autre méthode si mail() échoue
    $message_erreur = "Erreur d'envoi. Détails: " . error_get_last()['message'] ?? 'Inconnue';
    error_log($message_erreur);
    header('Location: contact.php?error=3');
}
exit;
?>
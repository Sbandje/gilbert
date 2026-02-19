<?php
// includes/mail_config.php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Vos couleurs personnalisées
$primaryColor = '#91dfdd';    // primary-color
$secondaryColor = '#02777d';  // secondary-color
$backgroundColor = '#639e90'; // background-color

// Charger les variables d'environnement depuis .env
if (file_exists(__DIR__ . '/../.env')) {
    $lines = file(__DIR__ . '/../.env', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0) continue;
        list($name, $value) = array_map('trim', explode('=', $line, 2));
        $_ENV[$name] = $value;
    }
}

require_once __DIR__ . '/../vendor/autoload.php';

function sendOrderConfirmationEmail($to, $clientName, $orderId, $orderDetails, $total) {
    $mail = new PHPMailer(true);
    
    // Vos couleurs
    $primaryColor = '#91dfdd';
    $secondaryColor = '#02777d';
    $backgroundColor = '#639e90';
    
    try {
        // Configuration du serveur
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'shalombandje@gmail.com';
        $mail->Password   = 'k d y l t r t f h j y d v m f k';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // Expéditeur et destinataire
        $mail->setFrom('shalombandje@gmail.com', 'Gilbert Services');
        $mail->addAddress($to, $clientName);

        // Contenu
        $mail->isHTML(true);
        $mail->Subject = 'Confirmation de votre commande #' . $orderId;
        
        // Construction du corps de l'email
        $orderItemsHtml = '';
        foreach ($orderDetails as $item) {
            $orderItemsHtml .= "
                <tr style='border-bottom: 1px solid #eee;'>
                    <td style='padding: 12px;'>{$item['produit_nom']}</td>
                    <td style='padding: 12px;'>{$item['produit_type']}</td>
                    <td style='padding: 12px; text-align: right; color: {$secondaryColor}; font-weight: bold;'>" . number_format($item['produit_prix'], 0, ',', ' ') . " FCFA</td>
                </tr>
            ";
        }

        $mail->Body = "
        <!DOCTYPE html>
        <html>
        <head>
            <style>
                body { 
                    font-family: Arial, sans-serif; 
                    line-height: 1.6; 
                    color: #282929; 
                    margin: 0;
                    padding: 0;
                }
                .container { 
                    max-width: 600px; 
                    margin: 20px auto; 
                    background: white;
                    border-radius: 15px;
                    overflow: hidden;
                    box-shadow: 0 10px 30px rgba(2, 119, 125, 0.1);
                }
                .header { 
                    background: linear-gradient(135deg, {$primaryColor}, {$secondaryColor}); 
                    color: white; 
                    padding: 30px 20px; 
                    text-align: center;
                }
                .header h1 {
                    margin: 0;
                    font-size: 24px;
                }
                .content { 
                    background: #f9f9f9; 
                    padding: 30px; 
                }
                .order-details { 
                    background: white; 
                    padding: 25px; 
                    border-radius: 10px; 
                    margin: 20px 0;
                    border: 1px solid {$primaryColor};
                }
                table { 
                    width: 100%; 
                    border-collapse: collapse; 
                    margin-bottom: 20px;
                }
                th { 
                    background: {$secondaryColor}; 
                    color: white; 
                    padding: 12px; 
                    text-align: left;
                }
                th:first-child { border-radius: 8px 0 0 8px; }
                th:last-child { border-radius: 0 8px 8px 0; }
                .total { 
                    font-size: 20px; 
                    font-weight: bold; 
                    color: {$secondaryColor}; 
                    margin-top: 20px;
                    text-align: right;
                    padding-top: 20px;
                    border-top: 2px dashed {$primaryColor};
                }
                .tracking-link { 
                    display: inline-block; 
                    background: linear-gradient(135deg, {$primaryColor}, {$secondaryColor}); 
                    color: white; 
                    padding: 14px 30px; 
                    text-decoration: none; 
                    border-radius: 25px; 
                    margin-top: 20px;
                    font-weight: bold;
                    transition: all 0.3s ease;
                }
                .tracking-link:hover {
                    transform: translateY(-2px);
                    box-shadow: 0 10px 20px rgba(2, 119, 125, 0.3);
                }
                .footer { 
                    margin-top: 30px; 
                    text-align: center; 
                    color: #666; 
                    font-size: 12px;
                    padding: 20px;
                    background: white;
                }
                .info-client {
                    background: rgba(145, 223, 221, 0.1);
                    padding: 15px;
                    border-radius: 8px;
                    margin-bottom: 20px;
                    border-left: 4px solid {$secondaryColor};
                }
                .info-client p {
                    margin: 5px 0;
                }
            </style>
        </head>
        <body>
            <div class='container'>
                <div class='header'>
                    <h1> Merci pour votre commande !</h1>
                </div>
                <div class='content'>
                    <div class='info-client'>
                        <p><strong>Bonjour {$clientName},</strong></p>
                        <p>Nous avons bien reçu votre commande <strong>#{$orderId}</strong>.</p>
                    </div>
                    
                    <div class='order-details'>
                        <h3 style='color: {$secondaryColor}; margin-top: 0;'>Récapitulatif de votre commande</h3>
                        <table>
                            <thead>
                                <tr>
                                    <th>Produit</th>
                                    <th>Type</th>
                                    <th>Prix</th>
                                </tr>
                            </thead>
                            <tbody>
                                {$orderItemsHtml}
                            </tbody>
                        </table>
                        
                        <div class='total'>
                            Total: " . number_format($total, 0, ',', ' ') . " FCFA
                        </div>
                    </div>
                    
                    <p style='text-align: center;'>Suivez l'évolution de votre commande en temps réel :</p>
                    
                    <div style='text-align: center;'>
                        <a href='http://localhost/gilbert/pages/suivi_commande.php?order_id={$orderId}&email={$to}' class='tracking-link'>
                             Suivre ma commande
                        </a>
                    </div>
                    
                    <p style='margin-top: 30px;'>Nous vous tiendrons informé par email de chaque changement de statut.</p>
                    
                    <p>Cordialement,<br><strong>L'équipe Gilbert Services</strong></p>
                </div>
                <div class='footer'>
                    <p> Cet email a été envoyé automatiquement, merci de ne pas y répondre.</p>
                    <p>© 2024 Gilbert Services. Tous droits réservés.</p>
                </div>
            </div>
        </body>
        </html>
        ";

        $mail->AltBody = "Commande #{$orderId} confirmée. Total: " . number_format($total, 0, ',', ' ') . " FCFA. Suivez votre commande sur notre site.";

        $mail->send();
        return true;
    } catch (Exception $e) {
        error_log("Erreur d'envoi d'email: " . $mail->ErrorInfo);
        return false;
    }
}

function sendStatusUpdateEmail($to, $clientName, $orderId, $newStatus) {
    $mail = new PHPMailer(true);
    
    // Vos couleurs
    $primaryColor = '#91dfdd';
    $secondaryColor = '#02777d';
    $backgroundColor = '#639e90';
    
    $statusLabels = [
        'en_attente' => 'En attente de confirmation',
        'confirmee' => 'Confirmée',
        'preparation' => 'En préparation',
        'terminee' => 'Terminée',
        'annulee' => 'Annulée'
    ];

    $statusColors = [
        'en_attente' => '#f39c12',
        'confirmee' => '#27ae60',
        'preparation' => '#3498db',
        'terminee' => '#2ecc71',
        'annulee' => '#e74c3c'
    ];

    try {
        $mail->isSMTP();
        $mail->Host       = $_ENV['MAIL_HOST'] ?? 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = $_ENV['MAIL_USERNAME'] ?? 'shalombandje@gmail.com';
        $mail->Password   = $_ENV['MAIL_PASSWORD'] ?? 'k d y l t r t f h j y d v m f k';
        $mail->SMTPSecure = ($_ENV['MAIL_ENCRYPTION'] ?? 'tls') === 'tls' ? PHPMailer::ENCRYPTION_STARTTLS : PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = (int) ($_ENV['MAIL_PORT'] ?? 587);

        $mail->setFrom($_ENV['MAIL_FROM_ADDRESS'] ?? 'shalombandje@gmail.com', $_ENV['MAIL_FROM_NAME'] ?? 'Gilbert Services');
        $mail->addAddress($to, $clientName);

        $mail->isHTML(true);
        $mail->Subject = 'Mise à jour de votre commande #' . $orderId;

        $mail->Body = "
        <!DOCTYPE html>
        <html>
        <head>
            <style>
                body { 
                    font-family: Arial, sans-serif; 
                    line-height: 1.6; 
                    color: #282929; 
                    margin: 0;
                    padding: 0;
                }
                .container { 
                    max-width: 600px; 
                    margin: 20px auto; 
                    background: white;
                    border-radius: 15px;
                    overflow: hidden;
                    box-shadow: 0 10px 30px rgba(2, 119, 125, 0.1);
                }
                .header { 
                    background: linear-gradient(135deg, {$primaryColor}, {$secondaryColor}); 
                    color: white; 
                    padding: 30px 20px; 
                    text-align: center;
                }
                .header h1 {
                    margin: 0;
                    font-size: 24px;
                }
                .content { 
                    background: #f9f9f9; 
                    padding: 30px; 
                }
                .status-update { 
                    background: white; 
                    padding: 30px; 
                    border-radius: 10px; 
                    margin: 20px 0;
                    text-align: center;
                    border: 2px solid {$primaryColor};
                }
                .status-badge { 
                    display: inline-block; 
                    padding: 12px 30px; 
                    border-radius: 30px; 
                    color: white; 
                    background: {$statusColors[$newStatus]}; 
                    font-weight: bold;
                    font-size: 18px;
                    margin: 15px 0;
                }
                .tracking-link { 
                    display: inline-block; 
                    background: linear-gradient(135deg, {$primaryColor}, {$secondaryColor}); 
                    color: white; 
                    padding: 14px 30px; 
                    text-decoration: none; 
                    border-radius: 25px; 
                    margin-top: 20px;
                    font-weight: bold;
                    transition: all 0.3s ease;
                }
                .tracking-link:hover {
                    transform: translateY(-2px);
                    box-shadow: 0 10px 20px rgba(2, 119, 125, 0.3);
                }
                .info-box {
                    background: rgba(145, 223, 221, 0.1);
                    padding: 20px;
                    border-radius: 10px;
                    margin: 20px 0;
                    border-left: 4px solid {$secondaryColor};
                }
                .emoji {
                    font-size: 24px;
                    margin-bottom: 10px;
                }
            </style>
        </head>
        <body>
            <div class='container'>
                <div class='header'>
                    <h1> Mise à jour de votre commande</h1>
                </div>
                <div class='content'>
                    <div class='info-box'>
                        <p><strong>Bonjour {$clientName},</strong></p>
                        <p>Le statut de votre commande <strong>#{$orderId}</strong> a été modifié.</p>
                    </div>
                    
                    <div class='status-update'>
                        <div class='emoji'>📋</div>
                        <p style='font-size: 18px; margin-bottom: 10px;'>Nouveau statut :</p>
                        <div class='status-badge'>
                            {$statusLabels[$newStatus]}
                        </div>
                    </div>
                    
                    <div style='text-align: center; margin: 30px 0;'>
                        <p>Cliquez sur le bouton ci-dessous pour voir tous les détails :</p>
                        <a href='http://localhost/gilbert/pages/suivi_commande.php?order_id={$orderId}&email={$to}' class='tracking-link'>
                             Voir ma commande
                        </a>
                    </div>
                    
                    <p>Nous restons à votre disposition pour toute question.</p>
                    
                    <p>Cordialement,<br><strong>L'équipe Gilbert Services</strong></p>
                </div>
                <div style='text-align: center; padding: 20px; background: white; color: #666; font-size: 12px;'>
                    <p>© 2024 Gilbert Services. Tous droits réservés.</p>
                </div>
            </div>
        </body>
        </html>
        ";

        $mail->send();
        return true;
    } catch (Exception $e) {
        error_log("Erreur d'envoi d'email: " . $mail->ErrorInfo);
        return false;
    }
}
?>
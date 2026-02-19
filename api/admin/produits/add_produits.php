<?php
require_once __DIR__ . '/../../includes/config.php';


if (!isAdmin()) {
    header('Location: /gilbert/authentification/login.php');
    exit;
}

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
    die("Erreur de connexion : " . $e->getMessage());
}

$message = '';
$messageType = '';

// Configuration de l'upload
$uploadDir = __DIR__ . '/../../assets/uploads/';
$allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/jpg', 'image/webp'];
$maxFileSize = 5 * 1024 * 1024; // 5 Mo

// Créer le dossier d'upload s'il n'existe pas
if (!file_exists($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = trim($_POST['nom']);
    $description = trim($_POST['description']);
    $prix = floatval($_POST['prix']);
    $type = $_POST['type'];
    
    // Gestion de l'upload d'image
    $imagePath = '';
    $uploadError = '';

    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $fileInfo = $_FILES['image'];
        $fileSize = $fileInfo['size'];
        $fileType = $fileInfo['type'];
        $fileTmpName = $fileInfo['tmp_name'];
        $originalName = $fileInfo['name'];
        
        // Vérifier le type de fichier
        if (!in_array($fileType, $allowedTypes)) {
            $uploadError = "Type de fichier non autorisé. Utilisez JPG, PNG, GIF ou WEBP.";
        }
        // Vérifier la taille
        elseif ($fileSize > $maxFileSize) {
            $uploadError = "Le fichier est trop volumineux. Taille maximum : 5 Mo";
        }
        else {
            // Générer un nom unique pour le fichier
            $extension = pathinfo($originalName, PATHINFO_EXTENSION);
            $newFileName = uniqid() . '_' . date('Y-m-d') . '.' . $extension;
            $destination = $uploadDir . $newFileName;
            
            // Déplacer le fichier
            if (move_uploaded_file($fileTmpName, $destination)) {
                // Chemin relatif pour la base de données
                $imagePath = '../assets/uploads/' . $newFileName;
            } else {
                $uploadError = "Erreur lors de l'upload du fichier.";
            }
        }
    } else {
        // Gérer les erreurs d'upload
        switch ($_FILES['image']['error']) {
            case UPLOAD_ERR_NO_FILE:
                $uploadError = "Veuillez sélectionner une image.";
                break;
            case UPLOAD_ERR_INI_SIZE:
            case UPLOAD_ERR_FORM_SIZE:
                $uploadError = "Le fichier est trop volumineux.";
                break;
            default:
                $uploadError = "Erreur lors de l'upload.";
        }
    }

    // Validation
    $errors = [];
    
    if (empty($nom)) {
        $errors[] = "Le nom du produit est obligatoire.";
    }
    
    if ($prix <= 0) {
        $errors[] = "Le prix doit être supérieur à 0.";
    }
    
    if (empty($type)) {
        $errors[] = "La catégorie est obligatoire.";
    }
    
    if (!empty($uploadError)) {
        $errors[] = $uploadError;
    }

    if (empty($errors) && !empty($imagePath)) {
        try {

            $stmt = $pdo->prepare("INSERT INTO produits (nom, description, prix, image_url, type) VALUES (:nom, :description, :prix, :image_url, :type)");
            $stmt->execute([
                ':nom' => $nom,
                ':description' => $description,
                ':prix' => $prix,
                ':image_url' => $imagePath,
                ':type' => $type
            ]);

            $message = "Produit ajouté avec succès !";
            $messageType = "success";
            

            header("refresh:2;url=/gilbert/pages/service.php");
            
        } catch (PDOException $e) {
            $message = "Erreur lors de l'ajout : " . $e->getMessage();
            $messageType = "error";
        }
    } elseif (!empty($errors)) {
        $message = implode("<br>", $errors);
        $messageType = "error";
    }
}
?>
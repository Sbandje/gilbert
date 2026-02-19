<?php
    session_start();
    $host = 'localhost';
    $dbname = 'gilbert';
    $username = 'root';
    $password = '';

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Erreur de connexion à la base de données : " . $e->getMessage());
    }


    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (!isset($_POST['accept_terms'])) {
            echo "Vous devez accepter la politique de confidentialité et les conditions générales d'utilisation.";
            exit();
        }
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $stmt = $pdo->prepare("INSERT INTO users (username, email, password, role) VALUES (:username, :email, :password, :role)");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $role = 'user';
        $stmt->bindParam(':role', $role);

        if ($stmt->execute()) {
            header("Location: login.php");
            exit();
        } else {
            echo "Erreur lors de l'inscription. Veuillez réessayer.";
        }
    }

    $pdo = null;
?>
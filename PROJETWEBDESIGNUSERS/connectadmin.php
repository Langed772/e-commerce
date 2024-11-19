<?php
session_start();

// Connexion à la base de données avec PDO
$dsn = 'mysql:host=localhost;dbname=connectadmin'; // Remplacez par vos informations
$username = 'root'; // Remplacez par votre nom d'utilisateur de base de données
$password = ''; // Remplacez par votre mot de passe de base de données

try {
    $conn = new PDO($dsn, $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Échec de la connexion : " . $e->getMessage());
}

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = htmlspecialchars(trim($_POST['username']));
    $pass = htmlspecialchars(trim($_POST['password']));
    $category = $_POST['productCategory'];

    // Vérifiez si la catégorie est "Administrateur smart"
    if ($category === "kitchen") {
        // Requête pour récupérer l'utilisateur administrateur
        $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND category = 'kitchen'");
        $stmt->execute([$user]);
        $userRow = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($userRow && $userRow['password'] === $pass) {
            $_SESSION['username'] = $userRow['username'];
            header("Location: smart.html");
            exit();
        } else {
            echo "Nom d'utilisateur ou mot de passe incorrect.";
        }
    }
    // Vérifiez si la catégorie est "Partenaires"
    elseif ($category === "laundry") {
        // Requête pour récupérer l'utilisateur partenaire
        $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND category = 'laundry'");
        $stmt->execute([$user]);
        $userRow = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($userRow && $userRow['password'] === $pass) {
            $_SESSION['username'] = $userRow['username'];
            header("Location: partenaire2.html");
            exit();
        } else {
            echo "Nom d'utilisateur ou mot de passe incorrect.";
        }
    }
}
?>

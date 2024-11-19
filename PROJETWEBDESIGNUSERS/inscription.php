<?php
session_start();

// Connexion à la base de données
try {
    $pdo = new PDO('mysql:host=localhost;dbname=ecomm', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Erreur de connexion : ' . $e->getMessage();
}

// Inscription
if (isset($_POST['inscription'])) {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $mot_de_passe = password_hash($_POST['mot_de_passe'], PASSWORD_BCRYPT);

    $stmt = $pdo->prepare("INSERT INTO utilisateurs (nom, prenom, email, mot_de_passe) VALUES (?, ?, ?, ?)");
    $stmt->execute([$nom, $prenom, $email, $mot_de_passe]);

    // Message d'alerte pour l'inscription réussie
    $_SESSION['message'] = "Inscription réussie ! Bienvenue " . htmlspecialchars($nom);
    header("Location: Pageaccueil.html");
    exit;
}

// Connexion
if (isset($_POST['connexion'])) {
    $email = $_POST['email'];
    $mot_de_passe = $_POST['mot_de_passe'];

    $stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE email = ?");
    $stmt->execute([$email]);
    $utilisateur = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($utilisateur && password_verify($mot_de_passe, $utilisateur['mot_de_passe'])) {
        $_SESSION['utilisateur'] = $utilisateur;
        // Message d'alerte pour la connexion réussie
        $_SESSION['message'] = "Connexion réussie ! Bienvenue " . htmlspecialchars($utilisateur['nom']);
        header("Location: Pageaccueil.html");
        exit;
    } else {
        echo "<script>alert('Identifiants invalides.');</script>";
    }
}

// Déconnexion
if (isset($_POST['deconnexion'])) {
    session_unset();
    session_destroy();
    header("Location: inscription.php");
    exit;
}
?>

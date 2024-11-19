<?php
// Connexion à la base de données
$host = 'localhost';  
$dbname = 'ecomm';  
$username = 'root';  
$password = '';  

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}

// Vérifier si le formulaire de connexion a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['connexion'])) {
    // Récupérer les données du formulaire de connexion
    $email = htmlspecialchars($_POST['email']);
    $nom = htmlspecialchars($_POST['nom']);  // Récupérer également le nom de l'utilisateur

    // Rechercher l'utilisateur dans la base de données avec l'email et le nom
    $stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE email = ? AND nom = ?");
    $stmt->execute([$email, $nom]);
    $user = $stmt->fetch();

    if ($user) {
        // Connexion réussie, démarrer la session
        session_start();
        $_SESSION['utilisateur'] = $user['id'];  // Stocker l'ID de l'utilisateur dans la session
        header("Location: monespace.php");  // Rediriger vers l'espace utilisateur
        exit();
    } else {
        echo "Email ou nom incorrect.";
    }
}
?>

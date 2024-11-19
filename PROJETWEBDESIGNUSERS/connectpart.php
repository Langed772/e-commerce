<?php
// Database connection settings
$servername = "localhost"; // Replace with your server name
$username = "root"; // Replace with your database username
$password = ""; // Replace with your database password
$dbname = "connectpart"; // Replace with your database name

try {
    // Create a PDO connection
    $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve form data
        $nom = htmlspecialchars(trim($_POST['nom']));
        $prenom = htmlspecialchars(trim($_POST['prenom']));
        $lieu = htmlspecialchars(trim($_POST['lieu']));
        $email = htmlspecialchars(trim($_POST['email']));
        $matricule = htmlspecialchars(trim($_POST['matricule']));
        $username = htmlspecialchars(trim($_POST['username'])); // Retrieve username

        // Basic validation
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            die("Le format de l'email est invalide.");
        }

        // SQL query to insert data into the database
        $sql = "INSERT INTO partenaires (nom, prenom, lieu, email, matricule, username) VALUES (:nom, :prenom, :lieu, :email, :matricule, :username)";
        
        // Prepare the statement
        $stmt = $conn->prepare($sql);

        // Bind parameters
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':prenom', $prenom);
        $stmt->bindParam(':lieu', $lieu);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':matricule', $matricule);
        $stmt->bindParam(':username', $username); // Bind username

        // Execute the statement
        if ($stmt->execute()) {
            // Optionally send a confirmation email
            $subject = "Confirmation de votre inscription en tant que partenaire";
            $body = "Bonjour $prenom $nom,\n\n"
                  . "Nous avons le plaisir de vous confirmer que votre inscription en tant que partenaire de notre plateforme e-commerce a bien été enregistrée.\n"
                  . "Voici les informations que vous avez fournies :\n"
                  . "Nom : $nom\n"
                  . "Prénom : $prenom\n"
                  . "Lieu d’habitation : $lieu\n"
                  . "Matricule : $matricule\n"
                  . "Email : $email\n"
                  . "Nom d'utilisateur : $username\n\n" // Added username to the email body
                  . "Merci de rejoindre notre réseau de partenaires.\n\n"
                  . "Cordialement,\nL’équipe BKJA Électroménagers";

            // Send email
            mail($email, $subject, $body);

            // Redirect to a success page or display a success message
            echo "Partenaire ajouté avec succès et un email de confirmation a été envoyé.";
        } else {
            echo "Erreur lors de l'ajout du partenaire.";
        }
    }
} catch (PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
}

// Close the database connection (optional, as it will be closed when the script ends)
$conn = null;
?>

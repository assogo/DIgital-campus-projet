<?php
session_start();

// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "votre_mot_de_passe";
$dbname = "elevage_poisson_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Vérifier si le formulaire est soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $mot_de_passe = $_POST['mot_de_passe'];

    // Rechercher l'utilisateur par email
    $sql = "SELECT * FROM utilisateurs WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Vérifier si le mot de passe correspond
        if (password_verify($mot_de_passe, $row['mot_de_passe'])) {
            // Mot de passe correct, connecter l'utilisateur
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['user_name'] = $row['nom'];
            
            // Enregistrer les données de connexion
            $utilisateur_id = $row['id'];
            $adresse_ip = $_SERVER['REMOTE_ADDR'];
            $agent_utilisateur = $_SERVER['HTTP_USER_AGENT'];

            $stmt = $conn->prepare("INSERT INTO connexions_utilisateurs (utilisateur_id, adresse_ip, agent_utilisateur) VALUES (?, ?, ?)");
            $stmt->bind_param("iss", $utilisateur_id, $adresse_ip, $agent_utilisateur);

            if ($stmt->execute()) {
                echo "Connexion réussie ! Bienvenue " . $row['nom'];
            } else {
                echo "Erreur lors de l'enregistrement de la connexion : " . $stmt->error;
            }
            $stmt->close();
        } else {
            echo "Mot de passe incorrect.";
        }
    } else {
        echo "Aucun utilisateur trouvé avec cet e-mail.";
    }
}

$conn->close();
?>

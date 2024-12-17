<?php
// Exemple de code PHP pour insérer un utilisateur avec mot de passe haché

$nom = 'John Doe';
$email = 'johndoe@example.com';
$mot_de_passe = 'motdepasse123';

// Hachage du mot de passe
$mot_de_passe_hache = password_hash($mot_de_passe, PASSWORD_DEFAULT);

// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "votre_mot_de_passe";
$dbname = "elevage_poisson_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Insertion de l'utilisateur
$sql = "INSERT INTO utilisateurs (nom, email, mot_de_passe)
VALUES ('$nom', '$email', '$mot_de_passe_hache')";

if ($conn->query($sql) === TRUE) {
    echo "Nouvel utilisateur créé avec succès";
} else {
    echo "Erreur : " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>

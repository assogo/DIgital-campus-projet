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

// Récupérer l'ID de l'utilisateur connecté
$user_id = $_SESSION['user_id'];

// Rechercher les connexions de cet utilisateur
$sql = "SELECT * FROM connexions_utilisateurs WHERE utilisateur_id = $user_id ORDER BY date_connexion DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h3>Historique des connexions :</h3>";
    echo "<table border='1'>";
    echo "<tr><th>Date</th><th>Adresse IP</th><th>Agent utilisateur</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['date_connexion']}</td>
                <td>{$row['adresse_ip']}</td>
                <td>{$row['agent_utilisateur']}</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "Aucune connexion trouvée.";
}

$conn->close();
?>

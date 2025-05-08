<?php
// 1. Connexion à la base de données
$servername = "localhost";
$username = "root"; // à adapter si tu as un autre identifiant
$password = "root";     // à adapter si tu as mis un mot de passe
$dbname = "supercar";

// 2. Créer la connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// 3. Vérifier la connexion
if ($conn->connect_error) {
  die("Échec de la connexion : " . $conn->connect_error);
}

// 4. Requête SQL
$sql = "SELECT titre, paragraphe FROM bienvenu LIMIT 1";
$result = $conn->query($sql);

// 5. Afficher les résultats
if ($result->num_rows > 0) {
  // on récupère la première ligne
  $row = $result->fetch_assoc();
  echo "<h1>" . htmlspecialchars($row["titre"]) . "</h1>";
  echo "<p>" . nl2br(htmlspecialchars($row["paragraphe"])) . "</p>";
} else {
  echo "Aucun bienvenu trouvé.";
}

// 6. Fermer la connexion
$conn->close();
?>
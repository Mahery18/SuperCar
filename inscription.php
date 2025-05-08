<?php
session_start(); // <-- AJOUT ESSENTIEL
include 'connexion.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $numero = $_POST['numero'];
    $adresse = $_POST['adresse'];
    $email = $_POST['email'];
    $motdepasse = password_hash($_POST['motdepasse'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO utilisateurs (nom, prenom, numero, adresse, email, motdepasse) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $nom, $prenom, $numero, $adresse, $email, $motdepasse);

    if ($stmt->execute()) {
        $_SESSION['flash_message'] = " Vous êtes inscrit avec succès !";
        header("Location: accueilprincipal.php");
        exit;
    } else {
        echo "Erreur lors de l'inscription : " . $stmt->error;
    }

    $stmt->close();
}
$conn->close();
?>

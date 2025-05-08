<?php
// connexion.php

$host = "localhost";      // Adresse du serveur
$user = "root";           // Nom d'utilisateur (par défaut sur XAMPP/WAMP)
$pass = "root";               // Mot de passe (souvent vide en local)
$dbname = "supercar";     // Nom de ta base de données

// Connexion à MySQL
$conn = new mysqli($host, $user, $pass, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Échec de la connexion à la base de données : " . $conn->connect_error);
}
?>
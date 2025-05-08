<?php
session_start();
include 'connexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $motdepasse = $_POST['motdepasse'] ?? '';

    // Préparation de la requête SQL
    $stmt = $conn->prepare("SELECT id, email, motdepasse, nom, prenom FROM utilisateurs WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($id, $db_email, $db_password, $nom, $prenom);

    // Vérification des résultats
    if ($stmt->num_rows > 0) {
        $stmt->fetch();
        if (password_verify($motdepasse, $db_password)) {
            // Authentification réussie, on stocke l'utilisateur en session
            $_SESSION['flash_message'] = " Vous êtes connecté avec succès !";
            $_SESSION['user_id'] = $id;
            $_SESSION['user_email'] = $db_email;
            $_SESSION['user_nom'] = $nom;
            $_SESSION['user_prenom'] = $prenom;
            echo 'success';
            exit;
        } else {
            echo 'Mot de passe incorrect.';
            exit;
        }
    } else {
        echo 'Aucun compte trouvé avec cet email.';
        exit;
    }
     $stmt->close();
}

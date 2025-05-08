<?php
session_start();
include 'connexion.php';  // Assure-toi que ce fichier existe

header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST['email'];
    $motdepasse = $_POST['motdepasse'];

    // Ajoute le rôle dans la sélection SQL
    $stmt = $conn->prepare("SELECT id, nom, motdepasse, role FROM utilisateurs WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $nom, $hash, $role);  // Récupérer le rôle en plus
        $stmt->fetch();

        if (password_verify($motdepasse, $hash)) {
            // Ajout du rôle dans la session
            $_SESSION['utilisateur_id'] = $id;
            $_SESSION['user_role'] = $role;  // Le rôle récupéré de la base de données
            $_SESSION['utilisateur_nom'] = $nom;

            // ✅ Réponse JSON en cas de succès
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Mot de passe incorrect']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Aucun compte trouvé avec cet email']);
    }

    $stmt->close();
}
$conn->close();
?>

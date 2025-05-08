<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (isset($_SESSION['flash_message'])) {
    echo '<div style="background-color: #4CAF50; color: white; padding: 1rem; text-align: center;">' . 
         htmlspecialchars($_SESSION['flash_message']) . 
         '</div>';
    unset($_SESSION['flash_message']); // Supprimer après affichage
}
?>

<?php
if (session_status() === PHP_SESSION_NONE) session_start();
?>
<header>
  <nav>
    <a href="accueilprincipal.php" class="logo">SuperCar</a>
    <div class="nav-center">
      <ul class="menu">
        <li><a href="accueilsecondaire.php">Accueil</a></li>
        <li><a href="voiture.php">Voitures</a></li>
        <li><a href="demandedessai.php" id="lien-demande-essai">Demande d'essai</a></li>
        <li><a href="evenement.php">Evènements</a></li>
        <li><a href="contact.php">Contactez-nous</a></li>
      </ul>
    </div>
    <div class="se-connecter">
      <?php if (isset($_SESSION['user_id'])): ?>
        <span>👋 <?= htmlspecialchars($_SESSION['user_prenom']) ?> <?= htmlspecialchars($_SESSION['user_nom']) ?></span>
        <a href="logout.php" style="margin-left: 1rem;">Se déconnecter</a>
      <?php else: ?>
        <a href="#" id="openModal">Connexion</a>
      <?php endif; ?>
    </div>
  </nav>
</header>
<?php include 'flash.php'; ?>
<?php include 'modal_login.php'; ?>

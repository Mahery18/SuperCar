<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
$flashMessage = "";
if (isset($_SESSION['flash_message'])) {
    $flashMessage = $_SESSION['flash_message'];
    unset($_SESSION['flash_message']);
}
include 'connexion.php';

// Récupération le titre et le texte de l'introduction
$sql = "SELECT titre, paragraphe FROM bienvenu LIMIT 1";
$result = $conn->query($sql);

$titre = "Bienvenue chez SuperCar";
$paragraphe = "";

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $titre = $row['titre'];
    $paragraphe = $row['paragraphe'];
}

$marques = [];
$resultMarques = $conn->query("SELECT nom FROM marqueintro");
if ($resultMarques && $resultMarques->num_rows > 0) {
    while($row = $resultMarques->fetch_assoc()) {
        $marques[] = $row['nom'];
    }
}

$evenements = [];
$resultEvenements = $conn->query("SELECT nom FROM evenementintro");
if ($resultEvenements && $resultEvenements->num_rows > 0) {
    while($row = $resultEvenements->fetch_assoc()) {
        $evenements[] = $row['nom'];
    }
}

$loginMessage = "";
$showModal = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['email'], $_POST['motdepasse'])) {
    $email = $_POST['email'];
    $motdepasse = $_POST['motdepasse'];

    $stmt = $conn->prepare("SELECT id, email, motdepasse, nom, prenom FROM utilisateurs WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($id, $db_email, $db_password, $nom, $prenom);

    if ($stmt->num_rows > 0) {
        $stmt->fetch();
        if (password_verify($motdepasse, $db_password)) {
            $_SESSION['user_id'] = $id;
            $_SESSION['user_email'] = $db_email;
            $_SESSION['user_nom'] = $nom;
            $_SESSION['user_prenom'] = $prenom;
            echo "success"; // Important pour le JS
            exit;
        } else {
            $loginMessage = "Mot de passe incorrect.";
            $showModal = true;
        }
    } else {
        $loginMessage = "Aucun compte trouvé avec cet email.";
        $showModal = true;
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SuperCar - Vente de voitures</title>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
  <style>
    /* styles identiques à ta version, inchangés */
    /* ... [garde tout ton CSS ici] ... */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Roboto', sans-serif;
    }

    html, body {
      height: 100%;
      display: flex;
      flex-direction: column;
      background-color: #f5f5f5;
      color: #333;
    }

    header {
      position: sticky;
      top: 0;
      background-color: #fff;
      box-shadow: 0 2px 4px rgba(0,0,0,0.1);
      z-index: 1000;
    }

    nav {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 1rem 2rem;
    }

    .logo {
      font-size: 1.8rem;
      font-weight: 700;
      color: #d62828;
      text-decoration: none;
    }

    .nav-center {
      display: flex;
      justify-content: center;
      flex: 1;
      padding: 0 3rem;
    }

    .menu {
      list-style: none;
      display: flex;
      gap: 3rem;
    }

    .menu li a,
    .se-connecter a {
      text-decoration: none;
      color: #333;
      font-weight: 500;
    }

    .menu li a:hover,
    .se-connecter a:hover {
      color: #d62828;
    }

    .se-connecter {
      margin-left: auto;
    }

    .image-container {
      width: 100%;
      overflow: hidden;
      position: relative;
    }

    .image-container img {
      width: 100%;
      height: auto;
      object-fit: cover;
      display: block;
    }

    .intro {
      padding: 4rem 2rem;
      background-color: #ffffff;
      text-align: center;
    }

    .intro h1 {
      font-size: 2.5rem;
      color: #222;
      margin-bottom: 1rem;
    }

    .intro p {
      font-size: 1.2rem;
      max-width: 800px;
      margin: 0 auto 2rem;
    }

    .features {
      display: flex;
      justify-content: center;
      flex-wrap: wrap;
      gap: 2rem;
      margin-top: 2rem;
    }

    .feature {
      background-color: #eaf4fc;
      padding: 1.5rem;
      border-radius: 10px;
      min-width: 200px;
      box-shadow: 0 2px 4px rgba(0,0,0,0.1);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      border-left: 5px solid #0077b6;
    }

    .feature:hover {
      transform: scale(1.05);
      box-shadow: 0 4px 8px rgba(0,0,0,0.15);
    }

    footer {
      background-color: #222;
      color: #ccc;
      text-align: center;
      padding: 2rem 1rem;
      margin-top: auto;
    }

    footer a {
      color: #ccc;
      text-decoration: none;
    }

    footer a:hover {
      text-decoration: underline;
    }

    .modal {
      display: none;
      position: fixed;
      z-index: 1000;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0,0,0,0.7);
      justify-content: center;
      align-items: center;
    }

    .modal-content {
      background: #0e1a25;
      color: #fff;
      border-radius: 10px;
      padding: 2rem;
      width: 100%;
      max-width: 400px;
      box-shadow: 0 0 20px rgba(0,255,255,0.4);
      animation: fadeIn 0.3s ease-in-out;
      position: relative;
    }

    .modal-content h2 {
      text-align: center;
      margin-bottom: 1.5rem;
    }

    .modal-content input {
      width: 100%;
      padding: 0.8rem;
      margin-bottom: 1rem;
      border: none;
      border-radius: 5px;
      background: #1c2f40;
      color: #fff;
      font-size: 1rem;
    }

    .btn-group {
      display: flex;
      justify-content: space-between;
    }

    .primary, .secondary {
      padding: 0.7rem 1.2rem;
      border: none;
      border-radius: 5px;
      font-weight: bold;
      cursor: pointer;
      font-size: 1rem;
    }

    .primary {
      background: #00b4d8;
      color: #fff;
    }

    .primary:hover {
      background: #0077b6;
    }

    .secondary {
      background: transparent;
      border: 1px solid #00b4d8;
      color: #00b4d8;
    }

    .secondary:hover {
      background: #023e8a;
      color: #fff;
    }

    .close {
      position: absolute;
      top: 10px;
      right: 15px;
      font-size: 24px;
      cursor: pointer;
      color: #ccc;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: scale(0.9); }
      to { opacity: 1; transform: scale(1); }
    }

  </style>
</head>
<body>
  <header>
  <?php if (!empty($flashMessage)) : ?>
  <div style="background-color: #4CAF50; color: white; padding: 1rem; text-align: center; font-weight: bold; font-size: 1.1rem;">
    <?= htmlspecialchars($flashMessage) ?>
  </div>
<?php endif; ?>

    <?php if (!empty($loginMessage)) : ?>
      <div style="background-color: <?= strpos($loginMessage, 'réussie') !== false ? '#4CAF50' : '#f44336' ?>; color: white; padding: 1rem; text-align: center;">
        <?= htmlspecialchars($loginMessage) ?>
      </div>
    <?php endif; ?>
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
    <div class="image-container">
      <img src="phodéos/fondaccueil.webp" alt="Image de voiture de luxe">
    </div>
  </header>

  <section class="intro">
    <h1><?php echo htmlspecialchars($titre); ?></h1>
    <p><?php echo nl2br(htmlspecialchars($paragraphe)); ?></p>
    <div class="features">
      <div class="feature">
        <h3>Marques</h3>
        <p><?php echo implode(' | ', array_map('htmlspecialchars', $marques)); ?></p>
      </div>
      <div class="feature">
        <h3>Évènements</h3>
        <p><?php echo implode(' | ', array_map('htmlspecialchars', $evenements)); ?></p>
      </div>
    </div>
  </section>

  <footer>
    <p><a href="mentionlegale.html">Mentions légales</a> | <a href="politique.html">Politiques de confidentialité</a></p>
  </footer>

  <?php $conn->close(); ?>

  <!-- Modal -->
  <div id="authModal" class="modal">
    <div class="modal-content">
      <span class="close" id="closeModal">&times;</span>

      <div id="loginForm" class="form-section">
        <h2>Connexion</h2>
        <form id="login-form">
          <input type="email" name="email" placeholder="Email" required>
          <input type="password" name="motdepasse" placeholder="Mot de passe" required>
          <div class="btn-group">
            <button type="submit" class="primary">Connexion</button>
            <button type="button" class="secondary" id="showSignup">S'inscrire</button>
          </div>
        </form>
      </div>

      <div id="signupForm" class="form-section" style="display: none;">
        <h2>Inscription</h2>
        <form action="inscription.php" method="post">
          <input type="text" name="nom" placeholder="Nom" required>
          <input type="text" name="prenom" placeholder="Prénom" required>
          <input type="tel" name="numero" placeholder="Numéro" required>
          <input type="text" name="adresse" placeholder="Adresse" required>
          <input type="email" name="email" placeholder="Email" required>
          <input type="password" name="motdepasse" placeholder="Mot de passe" required>
          <div class="btn-group">
            <button type="submit" class="primary">S'inscrire</button>
            <button type="button" class="secondary" id="backToLogin">Retour</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script>
    const isConnected = <?= isset($_SESSION['user_id']) ? 'true' : 'false' ?>;

    document.addEventListener("DOMContentLoaded", function() {
      const modal = document.getElementById("authModal");
      const openBtn = document.getElementById("openModal");
      const closeBtn = document.getElementById("closeModal");
      const showSignup = document.getElementById("showSignup");
      const backToLogin = document.getElementById("backToLogin");
      const loginForm = document.getElementById("loginForm");
      const signupForm = document.getElementById("signupForm");

      <?php if ($showModal): ?>
        modal.style.display = "flex";
      <?php endif; ?>

      openBtn.onclick = () => modal.style.display = "flex";
      closeBtn.onclick = () => modal.style.display = "none";
      window.onclick = e => { if (e.target == modal) modal.style.display = "none"; }

      showSignup.onclick = () => {
        loginForm.style.display = "none";
        signupForm.style.display = "block";
      }

      backToLogin.onclick = () => {
        signupForm.style.display = "none";
        loginForm.style.display = "block";
      }

      // Redirection ou ouverture du pop-up à l'appui sur Demande d'essai
      const lienEssai = document.getElementById('lien-demande-essai');
      lienEssai.addEventListener('click', function (e) {
        if (!isConnected) {
          e.preventDefault();
          modal.style.display = 'flex';
        }
      });

      // AJAX Connexion
      document.getElementById('login-form').addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(this);

        fetch('login_handler.php', 
          {
          method: 'POST',
          body: formData
        })
        .then(res => res.text())
        .then(data => {
          if (data.trim() === 'success') {
            window.location.reload();
          } 
          else {
            alert("Échec de la connexion. Vérifie tes identifiants.");
          }
        })
        .catch(err => {
          console.error(err);
          alert('Erreur lors de la connexion.');
        });
      });
    });
  </script>
</body>
</html>

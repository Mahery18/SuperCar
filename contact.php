<?php
// Connexion à la base de données
$host = 'localhost';
$db = 'supercar';
$user = 'root'; // modifie si besoin
$pass = 'root'; // idem
$dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";

try {
  $pdo = new PDO($dsn, $user, $pass);
} catch (PDOException $e) {
  die("Erreur de connexion à la base : " . $e->getMessage());
}

// Traitement du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nom = $_POST['nom'] ?? '';
  $prenom = $_POST['prenom'] ?? '';
  $email = $_POST['email'] ?? '';
  $message = $_POST['message'] ?? '';

  // Préparer et exécuter la requête d'insertion
  $stmt = $pdo->prepare("INSERT INTO contacts (nom, prenom, email, message) VALUES (?, ?, ?, ?)");
  $stmt->execute([$nom, $prenom, $email, $message]);

  $confirmation = "Merci, votre message a bien été envoyé !";
}
?>
<?php include 'header.php'; ?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Contactez-nous</title>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
  <style>
    /* même style que ton code */
    body {
      margin: 0;
      font-family: 'Roboto', sans-serif;
      background-color: #f5f7fa;
      color: #2c3e50;
    }

    h1 {
      text-align: center;
      margin-top: 2rem;
      font-size: 2.5rem;
      color: #0a5275;
    }

    .intro-text {
      text-align: center;
      max-width: 800px;
      margin: 1rem auto 3rem auto;
      font-size: 1.1rem;
      color: #444;
      line-height: 1.6;
    }

    .contact-section {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 2rem;
      padding: 2rem;
      max-width: 1200px;
      margin: auto;
    }

    .contact-form {
      flex: 1;
      min-width: 320px;
      max-width: 500px;
      background-color: #fff;
      padding: 2rem;
      border-radius: 10px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }

    .contact-form label {
      display: block;
      margin-bottom: 0.5rem;
      font-weight: 500;
      color: #1c3d5a;
    }

    .contact-form input,
    .contact-form textarea {
      width: 100%;
      padding: 0.8rem;
      margin-bottom: 1.2rem;
      border: 1px solid #ccc;
      border-radius: 6px;
      font-size: 1rem;
    }

    .contact-form textarea {
      height: 120px;
      resize: none;
    }

    .contact-form button {
      background-color: #0a5275;
      color: white;
      border: none;
      padding: 0.9rem 1.5rem;
      font-size: 1rem;
      border-radius: 6px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .contact-form button:hover {
      background-color: #083d59;
    }

    .map-container {
      flex: 1;
      min-width: 320px;
      max-width: 500px;
      height: 400px;
      border-radius: 10px;
      overflow: hidden;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }

    iframe {
      width: 100%;
      height: 100%;
      border: none;
    }

    @media (max-width: 900px) {
      .contact-section {
        flex-direction: column;
        align-items: center;
      }
    }

    .retour-accueil {
      text-align: center;
      margin-top: 3rem;
    }

    .retour-accueil a {
      display: inline-block;
      background-color: #d62828;
      color: #fff;
      text-decoration: none;
      padding: 0.8rem 2rem;
      border-radius: 30px;
      font-weight: 500;
      transition: background-color 0.3s ease, transform 0.2s ease;
    }

    .retour-accueil a:hover {
      background-color: #b91d1d;
      transform: translateY(-2px);
    }

    .confirmation {
      text-align: center;
      color: green;
      font-weight: bold;
      margin-bottom: 1rem;
    }

    * {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: 'Roboto', sans-serif;
}

body {
  background-color: #f5f5f5;
  color: #333;
}

nav {
  background-color: #fff;
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 1rem 2rem;
  box-shadow: 0 2px 4px rgba(0,0,0,0.1);
  position: sticky;
  top: 0;
  z-index: 100;
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

.intro {
  padding: 4rem 2rem;
  text-align: center;
  background-color: #fff;
}

.intro h1 {
  font-size: 2.5rem;
  margin-bottom: 1rem;
}

.intro p {
  font-size: 1.2rem;
  max-width: 800px;
  margin: 0 auto;
}

footer {
  background-color: #222;
  color: #ccc;
  text-align: center;
  padding: 2rem 1rem;
  margin-top: 4rem;
}

footer a {
  color: #ccc;
  text-decoration: none;
}

footer a:hover {
  text-decoration: underline;
}

  </style>
</head>
<body>

<h1>Contactez-nous</h1>

<div class="intro-text">
  <p>Vous avez une question, une demande d’essai ou un projet automobile en tête ? Remplissez simplement le formulaire ci-dessous, notre équipe vous répondra dans les plus brefs délais.</p>
  <p>Notre showroom est situé au cœur de <strong>Port Louis</strong>, facilement accessible, afin de vous offrir un service de proximité et une expérience personnalisée.</p>
</div>

<div class="contact-section">
  <div class="contact-form">
    <?php if (!empty($confirmation)): ?>
      <p class="confirmation"><?= $confirmation ?></p>
    <?php endif; ?>

    <form method="post" action="">
      <label for="nom">Nom</label>
      <input type="text" id="nom" name="nom" required>

      <label for="prenom">Prénom</label>
      <input type="text" id="prenom" name="prenom" required>

      <label for="email">Email</label>
      <input type="email" id="email" name="email" required>

      <label for="message">Message</label>
      <textarea id="message" name="message" required></textarea>

      <button type="submit">Envoyer</button>
    </form>
  </div>

  <div class="map-container">
  <iframe 
  src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3770.1718599784595!2d57.49735737518864!3d-20.161895350829334!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x217c5d6c97fa8c9b%3A0xa1c3616350b84f13!2sCaudan%20Waterfront!5e0!3m2!1sfr!2smu!4v1713701912123!5m2!1sfr!2smu" 
  width="100%" 
  height="100%" 
  style="border:0;" 
  allowfullscreen="" 
  loading="lazy" 
  referrerpolicy="no-referrer-when-downgrade">
</iframe>

  </script>
</head>
<body>
  <div id="map" style="height: 450px; width: 600px;"></div>
</body>
</html>




  </div>
</div>

<div class="retour-accueil">
  <a href="accueilprincipal.php">← Retour à l'accueil</a>
</div>
<?php include 'footer.php'; ?>
<?php include 'modal_login.php'; ?>
</body>
</html>
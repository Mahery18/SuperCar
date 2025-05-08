<?php
// Connexion à la base de données
$host = 'localhost';
$db = 'supercar';
$user = 'root';
$pass = 'root';
$dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";

try {
    $pdo = new PDO($dsn, $user, $pass);
} catch (PDOException $e) {
    die("Erreur de connexion à la base : " . $e->getMessage());
}

// Récupération des événements
$stmt = $pdo->query("SELECT * FROM evenements ORDER BY date_ajout DESC");
$evenements = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Évènements - SuperCar</title>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@1,400&display=swap" rel="stylesheet">
  <style>
    body {
      margin: 0;
      font-family: 'Roboto', sans-serif;
      background-color: #f4f7fa;
      color: #2c3e50;
    }

    h1 {
      text-align: center;
      font-size: 2.5rem;
      margin: 2rem 1rem;
      color: #1f5c87;
    }

    .container {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 2rem;
      padding: 2rem;
      max-width: 1400px;
      margin: auto;
    }

    .event-box {
      background-color: #ffffff;
      border-top: 6px solid #1f5c87;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
      width: 300px;
      padding: 1.2rem;
      display: flex;
      flex-direction: column;
      align-items: center;
      text-align: center;
      font-style: italic;
      animation: fadeIn 0.8s ease-in-out both;
    }

    .event-box img {
      width: 100%;
      height: 160px;
      object-fit: cover;
      border-radius: 8px;
      margin-bottom: 1rem;
    }

    .event-content h2 {
      font-size: 1.4rem;
      color: #1f5c87;
      margin-bottom: 0.5rem;
      font-style: normal;
    }

    .event-content p {
      font-size: 1rem;
      line-height: 1.5;
    }

    @keyframes fadeIn {
      from {
        opacity: 0;
        transform: translateY(30px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    footer {
      text-align: center;
      padding: 2rem;
      margin-top: 3rem;
      background-color: #1f5c87;
      color: #ffffff;
    }

    /* Responsive */
    @media (max-width: 768px) {
      .event-box {
        width: 100%;
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
<?php include 'header.php'; ?>
  <h1>Nos Évènements</h1>
  <div class="container">
    <?php foreach ($evenements as $event): ?>
      <div class="event-box">
        <?php if (!empty($event['image'])): ?>
          <img src="<?= htmlspecialchars($event['image']) ?>" alt="<?= htmlspecialchars($event['titre']) ?>">
        <?php endif; ?>
        <div class="event-content">
          <h2><?= htmlspecialchars($event['titre']) ?></h2>
          <p><?= nl2br(htmlspecialchars($event['contenu'])) ?></p>
        </div>
      </div>
    <?php endforeach; ?>
  </div>

  <div class="retour-accueil">
    <a href="accueilprincipal.php">← Retour à l'accueil</a>
  </div>

  <?php include 'footer.php'; ?>
  <?php include 'modal_login.php'; ?>
</body>
</html>
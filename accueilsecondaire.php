<?php
// Connexion à la base de données
try {
  $pdo = new PDO("mysql:host=localhost;dbname=supercar;charset=utf8", "root", "root"); // adapte l'utilisateur/mot de passe si besoin
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  die("Erreur de connexion : " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Nos Marques - SuperCar</title>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Roboto', sans-serif;
      margin: 0;
      background-color: #f5f5f5;
      color: #333;
    }

    .marques-section {
      padding: 3rem 2rem;
      max-width: 1200px;
      margin: auto;
    }

    .marques-section h2 {
      text-align: center;
      font-size: 2.2rem;
      margin-bottom: 1rem;
      color: #222;
    }

    .marques-section p.intro {
      text-align: center;
      font-size: 1.1rem;
      margin-bottom: 3rem;
      max-width: 800px;
      margin-left: auto;
      margin-right: auto;
      color: #555;
    }

    .marque {
      display: flex;
      align-items: center;
      background-color: #fff;
      padding: 1.5rem;
      margin-bottom: 2rem;
      border-radius: 10px;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
      transition: transform 0.3s ease;
    }

    .marque:hover {
      transform: scale(1.02);
    }

    .marque img {
      width: 100px;
      height: auto;
      margin-right: 2rem;
    }

    .marque-description {
      flex: 1;
    }

    .marque-description h3 {
      margin: 0 0 0.5rem;
      color: #d62828;
    }

    @media (max-width: 768px) {
      .marque {
        flex-direction: column;
        align-items: flex-start;
      }

      .marque img {
        margin-bottom: 1rem;
        margin-right: 0;
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
  <section class="marques-section">
    <h2>Nos Marques</h2>
    <p class="intro">
      Chez SuperCar, nous collaborons avec les plus grandes marques automobiles pour vous garantir performance, élégance et fiabilité. Découvrez nos partenaires de renom qui façonnent le futur de la mobilité haut de gamme.
    </p>

    <?php
      $stmt = $pdo->query("SELECT * FROM marques");
      while ($marque = $stmt->fetch()) {
    ?>
      <div class="marque">
        <img src="<?= htmlspecialchars($marque['logo']) ?>" alt="Logo <?= htmlspecialchars($marque['nom']) ?>">
        <div class="marque-description">
          <h3><?= htmlspecialchars($marque['nom']) ?></h3>
          <p><?= htmlspecialchars($marque['description']) ?></p>
        </div>
      </div>
    <?php } ?>

    <div class="retour-accueil">
        <a href="accueilprincipal.php">← Retour à l'accueil</a>
    </div>
  </section>
  <?php include 'footer.php'; ?>
  <?php include 'modal_login.php'; ?>
</body>
</html>
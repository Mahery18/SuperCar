<?php
// Connexion
$host = 'localhost';
$user = 'root';
$pass = 'root';
$dbname = 'supercar';

try {
  $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  die("Erreur de connexion à la base de données : " . $e->getMessage());
}

// Récupération des marques
$query = "SELECT DISTINCT marque FROM voitures";
$stmt = $pdo->prepare($query);
$stmt->execute();
$marques = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Nos Voitures - SuperCar</title>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
  <style>
    /* Ton CSS reste inchangé */
    body { font-family: 'Roboto', sans-serif; background: #f9f9f9; margin: 0; padding: 0; color: #333; }
    h1 { text-align: center; padding: 2rem 1rem 1rem; font-size: 2.5rem; color: #222; }
    .container { max-width: 1200px; margin: 0 auto; padding: 2rem; }
    details { margin-bottom: 2rem; background: #fff; border: 1px solid #ddd; border-radius: 8px; padding: 1rem; box-shadow: 0 2px 4px rgba(0,0,0,0.05); }
    summary { font-size: 1.4rem; font-weight: bold; cursor: pointer; color: #d62828; padding: 0.5rem; }
    .car-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 3.5rem; margin-top: 1rem; justify-content: center; }
    .car-box { background: #fff; border-radius: 10px; box-shadow: 0 2px 6px rgba(0,0,0,0.1); overflow: hidden; text-align: center; padding-bottom: 1rem; }
    .car-box img { width: 100%; height: 160px; object-fit: cover; }
    .btn-group { margin-top: 1rem; }
    .car-box button, .essai-btn {
      background: #d62828; color: #fff; border: none; padding: 0.5rem 1rem;
      margin: 0.2rem; border-radius: 20px; font-weight: 500; cursor: pointer;
      transition: background-color 0.3s ease; text-decoration: none; display: inline-block;
    }
    .car-box button:hover, .essai-btn:hover { background: #b91d1d; }
    .retour-accueil { text-align: center; margin-top: 3rem; }
    .retour-accueil a {
      background: #d62828; color: #fff; padding: 0.8rem 2rem;
      border-radius: 30px; text-decoration: none; font-weight: 500;
      transition: background-color 0.3s ease, transform 0.2s ease;
    }
    .retour-accueil a:hover { background: #b91d1d; transform: translateY(-2px); }
    .popup-overlay {
      position: fixed; top: 0; left: 0; right: 0; bottom: 0;
      background-color: rgba(0,0,0,0.6); display: none;
      justify-content: center; align-items: center; z-index: 999;
    }
    .popup-content {
      background: #fff; padding: 2rem; width: 90%; max-width: 500px;
      border-radius: 12px; position: relative;
    }
    .close-btn { position: absolute; top: 10px; right: 15px; font-size: 22px; cursor: pointer; }
    .popup-content h3 { margin-top: 0; color: #d62828; }

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
<h1>Nos Voitures</h1>
<div class="container">
  <?php foreach ($marques as $marque): ?>
    <?php
      $marqueNom = $marque['marque'];
      $stmt = $pdo->prepare("SELECT * FROM voitures WHERE marque = :marque");
      $stmt->execute(['marque' => $marqueNom]);
      $cars = $stmt->fetchAll(PDO::FETCH_ASSOC);
    ?>
    <details>
      <summary><?= strtoupper(htmlspecialchars($marqueNom)) ?></summary>
      <p> </p>
      <div class="car-grid">
        <?php foreach ($cars as $index => $car): ?>
          <div class="car-box">
            <img src="<?= htmlspecialchars($car['image']) ?>" alt="<?= htmlspecialchars($car['modele']) ?>">
            <div class="btn-group">
              <button onclick="showSpecs('<?= htmlspecialchars($marqueNom) ?>', <?= $index ?>)">Caractéristiques</button>
              <a href="demandedessai.php?marque=<?= urlencode($marqueNom) ?>&modele=<?= urlencode($car['modele']) ?>" class="essai-btn">Essai</a>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </details>
  <?php endforeach; ?>
</div>

<!-- Popup -->
<div class="popup-overlay" id="popup">
  <div class="popup-content">
    <span class="close-btn" onclick="closePopup()">&times;</span>
    <div id="popup-info"></div>
  </div>
</div>

<div class="retour-accueil">
  <a href="accueilprincipal.php">← Retour à l'accueil</a>
</div>

<script>
  const specs = {
    <?php foreach ($marques as $marque): ?>
      <?= json_encode($marque['marque']) ?>: [
        <?php
          $stmt = $pdo->prepare("SELECT * FROM voitures WHERE marque = :marque");
          $stmt->execute(['marque' => $marque['marque']]);
          $cars = $stmt->fetchAll(PDO::FETCH_ASSOC);
          foreach ($cars as $car):
        ?>
        {
          prix: "<?= $car['prix'] ?>",
          km: "<?= $car['km'] ?>",
          boite: "<?= $car['boite'] ?>",
          vmax: "<?= $car['vmax'] ?>",
          moteur: "<?= $car['moteur'] ?>",
          transmission: "<?= $car['transmission'] ?>",
          puissance: "<?= $car['puissance'] ?>",
          acceleration: "<?= $car['acceleration'] ?>",
          carburant: "<?= $car['carburant'] ?>",
          cylindres: "<?= $car['cylindres'] ?>",
          couleur: "<?= $car['couleur'] ?>",
          portes: "<?= $car['portes'] ?>"
        },
        <?php endforeach; ?>
      ],
    <?php endforeach; ?>
  };

  function showSpecs(brand, index) {
    const car = specs[brand][index];
    const html = `<h3>Caractéristiques</h3><ul style="list-style:none; padding:0;">` +
      Object.entries(car).map(([k,v]) => `<li><strong>${k.charAt(0).toUpperCase()+k.slice(1)}:</strong> ${v}</li>`).join("") +
      `</ul>`;
    document.getElementById("popup-info").innerHTML = html;
    document.getElementById("popup").style.display = "flex";
  }

  function closePopup() {
    document.getElementById("popup").style.display = "none";
  }
</script>
<?php include 'footer.php'; ?>
<?php include 'modal_login.php'; ?>
</body>
</html>
<?php
// Connexion à la base de données
$host = 'localhost';
$db = 'supercar';
$user = 'root'; // à adapter selon ton serveur
$pass = 'root';     // idem
$dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";

try {
    $pdo = new PDO($dsn, $user, $pass);
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}

// Traitement du formulaire
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $stmt = $pdo->prepare("INSERT INTO demandes_essai (nom, prenom, adresse, contact, email, date_essai, heure_essai, marque, modele)
                           VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([
        $_POST['nom'],
        $_POST['prenom'],
        $_POST['adresse'],
        $_POST['contact'],
        $_POST['email'],
        $_POST['date'],
        $_POST['heure'],
        $_POST['marque'],
        $_POST['modele']
    ]);
    echo "<script>alert('Demande enregistrée avec succès !');</script>";
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Demande d'essai - SuperCar</title>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
  <style>
    /* ... même CSS que dans ton fichier initial ... */
    <style>
    body {
      font-family: 'Roboto', sans-serif;
      background-color: #f2f2f2;
      color: #333;
      margin: 0;
      padding: 0;
    }

    .container {
      max-width: 800px;
      margin: 3rem auto;
      background-color: #fff;
      padding: 2rem 3rem;
      border-radius: 12px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }

    h1 {
      text-align: center;
      color: #d62828;
      margin-bottom: 2rem;
      font-size: 2rem;
    }

    form {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 1.5rem;
    }

    .full-width {
      grid-column: 1 / 3;
    }

    label {
      display: block;
      margin-bottom: 0.5rem;
      font-weight: 500;
    }

    input, select {
      width: 100%;
      padding: 0.6rem;
      border: 1px solid #ccc;
      border-radius: 8px;
      font-size: 1rem;
    }

    button {
      grid-column: 1 / 3;
      padding: 0.8rem;
      font-size: 1rem;
      background-color: #d62828;
      color: white;
      border: none;
      border-radius: 30px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    button:hover {
      background-color: #b91d1d;
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
.retour-voiture {
    text-align: center;
     margin-top: 3rem;
}

    .retour-voiture a {
    display: inline-block;
    background-color: #d62828;
    color: #fff;
    text-decoration: none;
    padding: 0.8rem 2rem;
    border-radius: 30px;
    font-weight: 500;
    transition: background-color 0.3s ease, transform 0.2s ease;
}

.retour-voiture a:hover {
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
  <div class="container">
    <h1>Faites votre demande</h1>
    <form method="POST" action="">
      <div>
        <label for="nom">Nom</label>
        <input type="text" name="nom" 
      value="<?= isset($_SESSION['user_nom']) ? htmlspecialchars($_SESSION['user_nom']) : '' ?>" required>

      </div>

      <div>
        <label for="prenom">Prénom</label>
        <input type="text" name="prenom" 
      value="<?= isset($_SESSION['user_prenom']) ? htmlspecialchars($_SESSION['user_prenom']) : '' ?>" required>

      </div>

      <div class="full-width">
        <label for="adresse">Adresse</label>
        <input type="text" id="adresse" name="adresse" required>
      </div>

      <div>
        <label for="contact">Contact</label>
        <input type="tel" id="contact" name="contact" required>
      </div>

      <div>
        <label for="email">Email</label>
        <input type="email" name="email" 
      value="<?= isset($_SESSION['user_email']) ? htmlspecialchars($_SESSION['user_email']) : '' ?>" required>

      </div>

      <div>
        <label for="date">Date d'essai</label>
        <input type="date" id="date" name="date" required>
      </div>

      <div>
        <label for="heure">Heure d'essai</label>
        <input type="time" id="heure" name="heure" required>
      </div>

      <div>
        <label for="marque">Marque</label>
        <select id="marque" name="marque" required>
          <option value="">-- Choisir une marque --</option>
          <option value="bmw">BMW</option>
          <option value="mercedes">Mercedes</option>
          <option value="volkswagen">Volkswagen</option>
          <option value="ford">Ford</option>
        </select>
      </div>

      <div>
        <label for="modele">Modèle</label>
        <select id="modele" name="modele" required>
          <option value="">-- Choisir un modèle --</option>
        </select>
      </div>

      <button type="submit">Envoyer la demande</button>
    </form>
  </div>

  <script>
    const modeles = {
      bmw: ['M3 Competition', 'X6M', 'M5 V10', 'M2'],
      mercedes: ['Maybach', 'Class G', 'A 45 AMG', 'C 63 AMG'],
      volkswagen: ['Golf 7R', 'Golf 8R', 'Tiguan R-Line', 'Touareg S-Line'],
      ford: ['Ford Focus', 'Ford Explorer', 'Ford Fiesta', 'Ford Kuga']
    };

    document.addEventListener('DOMContentLoaded', function () {
      const marqueSelect = document.getElementById('marque');
      const modeleSelect = document.getElementById('modele');

      marqueSelect.addEventListener('change', function () {
        const marque = this.value;
        modeleSelect.innerHTML = '<option value="">-- Choisir un modèle --</option>';
        if (modeles[marque]) {
          modeles[marque].forEach(function (modele) {
            const option = document.createElement('option');
            option.value = modele;
            option.textContent = modele;
            modeleSelect.appendChild(option);
          });
        }
      });
    });
  </script>

  <div class="retour-accueil">
    <a href="accueilprincipal.php">← Retour à l'accueil</a>
  </div>
  <?php include 'footer.php'; ?>
  <?php include 'modal_login.php'; ?>
</body>
</html>
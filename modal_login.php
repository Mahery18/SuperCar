<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
?>
<!-- Modale de connexion/inscription -->
<div id="authModal" class="modal" style="display: none; position: fixed; z-index: 1000; left: 0; top: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.7); justify-content: center; align-items: center;">
  <div class="modal-content" style="background: #0e1a25; color: #fff; border-radius: 10px; padding: 2rem; width: 100%; max-width: 400px; box-shadow: 0 0 20px rgba(0,255,255,0.4); position: relative;">
    <span class="close" id="closeModal" style="position: absolute; top: 10px; right: 15px; font-size: 24px; cursor: pointer; color: #ccc;">&times;</span>

    <div id="loginForm" class="form-section">
      <h2 style="text-align: center; margin-bottom: 1.5rem;">Connexion</h2>
      <form id="login-form">
        <input type="email" name="email" placeholder="Email" required style="width: 100%; padding: 0.8rem; margin-bottom: 1rem; border: none; border-radius: 5px; background: #1c2f40; color: #fff;">
        <input type="password" name="motdepasse" placeholder="Mot de passe" required style="width: 100%; padding: 0.8rem; margin-bottom: 1rem; border: none; border-radius: 5px; background: #1c2f40; color: #fff;">
        <div class="btn-group" style="display: flex; justify-content: space-between;">
          <button type="submit" class="primary" style="padding: 0.7rem 1.2rem; border: none; border-radius: 5px; font-weight: bold; cursor: pointer; font-size: 1rem; background: #00b4d8; color: #fff;">Connexion</button>
          <button type="button" class="secondary" id="showSignup" style="padding: 0.7rem 1.2rem; border: 1px solid #00b4d8; border-radius: 5px; font-weight: bold; cursor: pointer; font-size: 1rem; background: transparent; color: #00b4d8;">S'inscrire</button>
        </div>
      </form>
    </div>

    <div id="signupForm" class="form-section" style="display: none;">
      <h2 style="text-align: center; margin-bottom: 1.5rem;">Inscription</h2>
      <form action="inscription.php" method="post">
        <input type="text" name="nom" placeholder="Nom" required style="width: 100%; padding: 0.8rem; margin-bottom: 1rem; border: none; border-radius: 5px; background: #1c2f40; color: #fff;">
        <input type="text" name="prenom" placeholder="Prénom" required required style="width: 100%; padding: 0.8rem; margin-bottom: 1rem; border: none; border-radius: 5px; background: #1c2f40; color: #fff;">
        <input type="tel" name="numero" placeholder="Numéro" required style="width: 100%; padding: 0.8rem; margin-bottom: 1rem; border: none; border-radius: 5px; background: #1c2f40; color: #fff;">
        <input type="text" name="adresse" placeholder="Adresse" required style="width: 100%; padding: 0.8rem; margin-bottom: 1rem; border: none; border-radius: 5px; background: #1c2f40; color: #fff;">
        <input type="email" name="email" placeholder="Email" required style="width: 100%; padding: 0.8rem; margin-bottom: 1rem; border: none; border-radius: 5px; background: #1c2f40; color: #fff;">
        <input type="password" name="motdepasse" placeholder="Mot de passe" required style="width: 100%; padding: 0.8rem; margin-bottom: 1rem; border: none; border-radius: 5px; background: #1c2f40; color: #fff;">
        <div class="btn-group">
          <button type="submit" class="primary" style="padding: 0.7rem 1.2rem; border: none; border-radius: 5px; font-weight: bold; cursor: pointer; font-size: 1rem; background: #00b4d8; color: #fff;">S'inscrire</button>
          <button type="button" class="secondary" id="backToLogin" style="padding: 0.7rem 1.2rem; border: 1px solid #00b4d8; border-radius: 5px; font-weight: bold; cursor: pointer; font-size: 1rem; background: transparent; color: #00b4d8;">Retour</button>
        </div>
      </form>
    </div>
  </div>
</div>


<script>
  const isConnected = <?= isset($_SESSION['user_id']) ? 'true' : 'false' ?>;

  document.addEventListener("DOMContentLoaded", function () {
    const modal = document.getElementById("authModal");
    const openBtn = document.getElementById("openModal");
    const closeBtn = document.getElementById("closeModal");
    const showSignup = document.getElementById("showSignup");
    const backToLogin = document.getElementById("backToLogin");
    const loginForm = document.getElementById("loginForm");
    const signupForm = document.getElementById("signupForm");

    if (openBtn) openBtn.onclick = () => modal.style.display = "flex";
    if (closeBtn) closeBtn.onclick = () => modal.style.display = "none";
    window.onclick = e => { if (e.target == modal) modal.style.display = "none"; }

    if (showSignup) showSignup.onclick = () => {
      loginForm.style.display = "none";
      signupForm.style.display = "block";
    }

    if (backToLogin) backToLogin.onclick = () => {
      signupForm.style.display = "none";
      loginForm.style.display = "block";
    }

    const lienEssai = document.getElementById('lien-demande-essai');
    if (lienEssai) {
      lienEssai.addEventListener('click', function (e) {
        if (!isConnected) {
          e.preventDefault();
          modal.style.display = 'flex';
        }
      });
    }

    const loginFormElement = document.getElementById('login-form');
    if (loginFormElement) {
      loginFormElement.addEventListener('submit', function (e) {
        e.preventDefault();
        const formData = new FormData(this);

        fetch('login_handler.php', {
  method: 'POST',
  body: formData,
})
.then(response => response.text()) // convertit la réponse en texte
.then(data => {
  console.log("Réponse du serveur :", data); 
  if (data.trim() === 'success') {
    window.location.reload();
  } else {
    alert("Échec de la connexion. Vérifie tes identifiants.");
  }
})
.catch(err => {
  console.error(err);
  alert('Erreur lors de la connexion.');
});

        });
    }
  });
</script>

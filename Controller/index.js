function showUpdateForm(userId) {
  const formContainer = document.getElementById(`update-form-${userId}`);

  if (formContainer.innerHTML !== "") {
    formContainer.innerHTML = "";
    return;
  }

  // Créer le formulaire pour l'utilisateur
  formContainer.innerHTML = `
    <form action="/Miniblog/Controller/index.php?action=updateUser&id=${userId}" method="POST" class="update-form">
    <h1 class="update-title">Mettre à Jour l'Utilisateur</h1>
    
    <label for="login-${userId}" class="update-label">Login :</label>
    <input type="text" name="login" id="login-${userId}" class="update-input" placeholder="Nouveau login" required><br>
    
    <label for="prenom-${userId}" class="update-label">Prénom :</label>
    <input type="text" name="prenom" id="prenom-${userId}" class="update-input" placeholder="Nouveau prénom" required><br>
    
    <label for="nom-${userId}" class="update-label">Nom :</label>
    <input type="text" name="nom" id="nom-${userId}" class="update-input" placeholder="Nouveau nom" required><br>
    
    <button type="submit" class="update-button">Enregistrer les modifications</button>
    <button type="button" class="update-cancel-button" onclick="hideUpdateForm(${userId})">Annuler</button>
</form>
    `;
}

function showPostUpdateForm(postId) {
  const formContainer = document.getElementById(`update-form-post-${postId}`);

  if (formContainer.innerHTML !== "") {
    formContainer.innerHTML = "";
    return;
  }

  // Créer le formulaire pour le billet
  formContainer.innerHTML = `
  <form action="/Miniblog/Controller/index.php?action=updatePost&id=${postId}" method="POST" class="update-form-post">
  <label for="titre-${postId}" class="update-label-post">Titre :</label>
  <input type="text" name="titre" id="titre-${postId}" class="update-input-post" placeholder="Nouveau titre" required><br>

  <label for="contenu-${postId}" class="update-label-post">Contenu :</label><br>
  <textarea name="contenu" id="contenu-${postId}" class="update-textarea-post" placeholder="Nouveau contenu" required></textarea><br>

  <button type="submit" class="update-button-post">Enregistrer les modifications</button>
  <button type="button" class="update-cancel-button-post" onclick="hidePostUpdateForm(${postId})">Annuler</button>
</form>
    `;
}

function hideUpdateForm(userId) {
  // Cacher le formulaire d'utilisateur en vidant le contenu de l'élément
  const formContainer = document.getElementById(`update-form-${userId}`);
  formContainer.innerHTML = "";
}

function hidePostUpdateForm(postId) {
  // Cacher le formulaire de billet en vidant le contenu de l'élément
  const formContainer = document.getElementById(`update-form-post-${postId}`);
  formContainer.innerHTML = "";
}

// Code pour limiter le nombre de char et cacher le surplus du post
// Limiter le nombre de caractères et masquer le reste
const textElements = document.querySelectorAll(".post-content");

textElements.forEach((text) => {
  if (text.textContent.length > 150) {
    const shortText = text.textContent.slice(0, 150) + "...";
    text.textContent = shortText;
  }
});

// Cacher les commentaires par défaut
const toggleBtn = document.getElementById("toggle-comments-btn");
const commentsSection = document.getElementById("comments-section");

toggleBtn.addEventListener("click", function () {
  if (commentsSection.style.display === "none") {
    commentsSection.style.display = "block";
    toggleBtn.textContent = "Masquer les commentaires";
    console.log("test");
  } else {
    commentsSection.style.display = "none";
    toggleBtn.textContent = "Voir les commentaires";
  }
});


// Gestion des erreurs :

document.querySelector("form.signup-form").addEventListener("submit", function (e) {
    let hasError = false;

    // Réinitialiser les messages d'erreur
    document.querySelectorAll(".error-message").forEach(msg => (msg.style.display = "none"));

    const login = document.getElementById("login").value.trim();
    const password = document.getElementById("mot_de_passe").value.trim();
    const confirmPassword = document.getElementById("confirm_mot_de_passe").value.trim();

    if (login.length < 3) {
        document.getElementById("error-login").style.display = "block";
        hasError = true;
    }

    if (password.length < 8) {
        document.getElementById("error-password").style.display = "block";
        hasError = true;
    }

    if (password !== confirmPassword) {
        document.getElementById("error-confirm-password").style.display = "block";
        hasError = true;
    }

    if (hasError) {
        e.preventDefault();
    }
});
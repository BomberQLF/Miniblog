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

function showFormComment(event) {
  event.preventDefault();
  const button = event.target;
  const commentItem = button.closest('.comments-item');
  const formComment = commentItem.querySelector('.updateComments');

  if (formComment) {
      formComment.style.display = "block";
  }
}

function hideCommentUpdateForm(event) {
  const button = event.target;
  const commentItem = button.closest('.comments-item');
  const formComment = commentItem.querySelector('.updateComments');

  if (formComment) {
      formComment.style.display = "none";
  }
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
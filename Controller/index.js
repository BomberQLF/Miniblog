function showUpdateForm(userId) {
  const formContainer = document.getElementById(`update-form-${userId}`);

  // Vérifier si le formulaire est déjà visible
  if (formContainer.style.display === "block") {
      // Si le formulaire est déjà visible, on le cache
      formContainer.style.display = "none";
  } else {
      // Sinon, on l'affiche
      formContainer.style.display = "block";
  }
}

function hideUpdateForm(userId) {
  const formContainer = document.getElementById(`update-form-${userId}`);
  formContainer.style.display = "none"; 
}

function showPostUpdateForm(postId) {
  const formContainer = document.getElementById(`update-form-post-${postId}`);

  if (formContainer.style.display === "block") {
      // Si le formulaire est déjà visible, on le cache
      formContainer.style.display = "none";
  } else {
      // Sinon, on l'affiche
      formContainer.style.display = "block";
  }
}

function hidePostUpdateForm(postId) {
  const formContainer = document.getElementById(`update-form-post-${postId}`);
  formContainer.style.display = "none"; // Cache le formulaire
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
  } else {
    commentsSection.style.display = "none";
    toggleBtn.textContent = "Voir les commentaires";
  }
});
function showUpdateForm(userId) {
    const formContainer = document.getElementById(`update-form-${userId}`);
    
    if (formContainer.innerHTML !== '') {
        formContainer.innerHTML = '';
        return;
    }

    // Créer le formulaire pour l'utilisateur
    formContainer.innerHTML = `
        <form action="/Miniblog/Controller/index.php?action=updateUser&id=${userId}" method="POST">
            <label for="login-${userId}">Login :</label>
            <input type="text" name="login" id="login-${userId}" placeholder="Nouveau login" required><br>
            
            <label for="prenom-${userId}">Prénom :</label>
            <input type="text" name="prenom" id="prenom-${userId}" placeholder="Nouveau prénom" required><br>
            
            <label for="nom-${userId}">Nom :</label>
            <input type="text" name="nom" id="nom-${userId}" placeholder="Nouveau nom" required><br>
            
            <button type="submit">Enregistrer les modifications</button>
            <button type="button" onclick="hideUpdateForm(${userId})">Annuler</button>
        </form>
    `;
}

function showPostUpdateForm(postId) {
    const formContainer = document.getElementById(`update-form-post-${postId}`);
    
    if (formContainer.innerHTML !== '') {
        formContainer.innerHTML = '';
        return;
    }

    // Créer le formulaire pour le billet
    formContainer.innerHTML = `
        <form action="/Miniblog/Controller/index.php?action=updatePost&id=${postId}" method="POST">
            <label for="titre-${postId}">Titre :</label>
            <input type="text" name="titre" id="titre-${postId}" placeholder="Nouveau titre" required><br>

            <label for="contenu-${postId}">Contenu :</label><br>
            <textarea name="contenu" id="contenu-${postId}" placeholder="Nouveau contenu" required></textarea><br>

            <button type="submit">Enregistrer les modifications</button>
            <button type="button" onclick="hidePostUpdateForm(${postId})">Annuler</button>
        </form>
    `;
}

function hideUpdateForm(userId) {
    // Cacher le formulaire d'utilisateur en vidant le contenu de l'élément
    const formContainer = document.getElementById(`update-form-${userId}`);
    formContainer.innerHTML = '';
}

function hidePostUpdateForm(postId) {
    // Cacher le formulaire de billet en vidant le contenu de l'élément
    const formContainer = document.getElementById(`update-form-post-${postId}`);
    formContainer.innerHTML = '';
}

// Code pour limiter le nombre de char et cacher le surplus du post
// Limiter le nombre de caractères et masquer le reste
const textElements = document.querySelectorAll('.post-content');

    textElements.forEach(text => {
        if (text.textContent.length > 150) {
            const shortText = text.textContent.slice(0, 150) + '...';
            text.textContent = shortText;
        }
});
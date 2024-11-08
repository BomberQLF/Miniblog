<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Style/style.css">
    <title>Inscription</title>
</head>
<body class="signup-body">
    <form method="POST" action="/Miniblog/Controller/index.php?action=inscription" class="signup-form">
        <h1 class="signup-title">Inscription</h1>

        <label for="login" class="signup-label">Login</label>
        <input type="text" name="login" id="login" placeholder="Nom d'utilisateur" class="signup-input" required>

        <label for="prenom" class="signup-label">Prénom</label>
        <input type="text" name="prenom" id="prenom" placeholder="Prénom" class="signup-input" required>

        <label for="nom" class="signup-label">Nom</label>
        <input type="text" name="nom" id="nom" placeholder="Nom" class="signup-input" required>

        <label for="mot_de_passe" class="signup-label">Mot de passe</label>
        <input type="password" name="mot_de_passe" id="mot_de_passe" class="signup-input" required>

        <label for="confirm_mot_de_passe" class="signup-label">Confirmer le mot de passe</label>
        <input type="password" name="confirm_mot_de_passe" id="confirm_mot_de_passe" class="signup-input" required>

        <input type="submit" value="S'inscrire" class="signup-button">
    </form>
</body>
</html>
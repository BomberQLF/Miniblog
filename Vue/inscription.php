<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
</head>
<body>
    <form method="POST" action="/Miniblog/Controller/index.php?action=inscription">
        <label for="login">Login</label><br>
        <input type="text" name="login" id="login" placeholder="Nom d'utilisateur" required><br>

        <label for="prenom">Prenom</label><br>
        <input type="text" name="prenom" id="prenom" placeholder="Prenom" required><br>

        <label for="nom">Nom</label><br>
        <input type="text" name="nom" id="nom" placeholder="Nom" required><br>

        <label for="mot_de_passe">Mot de passe</label><br>
        <input type="password" name="mot_de_passe" id="mot_de_passe" required><br>

        <label for="confirm_mot_de_passe">Confirmer le mot de passe</label><br>
        <input type="password" name="confirm_mot_de_passe" id="confirm_mot_de_passe" required><br>

        <input type="submit" value="S'inscrire">
    </form>
</body>
</html>
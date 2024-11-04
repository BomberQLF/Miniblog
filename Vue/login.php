<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <form method="POST" action="/Miniblog/Controller/index.php?action=login">
        <label for="login">Login</label><br>
        <input type="text" name="login" id="login" required><br>

        <label for="mot_de_passe">Mot de passe</label><br>
        <input type="password" name="mot_de_passe" id="mot_de_passe" required><br>

        <input type="submit" value="Se Connecter">
    </form>
</body>
</html>
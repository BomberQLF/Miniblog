<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Style/style.css">
    <title>Login</title>
</head>
<body class="login-body">
    <form method="POST" action="/Miniblog/Controller/index.php?action=login" class="login-form">
        <h1 class="login-title">Connexion</h1>

        <label for="login" class="login-label">Login</label>
        <input type="text" name="login" id="login" class="login-input" required>

        <label for="mot_de_passe" class="login-label">Mot de passe</label>
        <input type="password" name="mot_de_passe" id="mot_de_passe" class="login-input" required>

        <input type="submit" value="Se Connecter" class="login-button">
    </form>
</body>
</html>
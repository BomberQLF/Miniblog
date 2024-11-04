<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="/Miniblog/Controller/index.php?action=createPost" method="POST">
        <label for="titre">Titre</label><br>
        <input type="text" name="titre" id="titre"><br>

        <label for="contenu">Contenu</label><br>
        <input type="text" name="contenu" id="contenu">

        <input type="hidden" name="auteur_id" value="1">
        <button type="submit">Publier le billet</button>
    </form>
    
</body>
</html>
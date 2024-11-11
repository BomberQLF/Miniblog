<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Style/style.css">
    <title>Créer un Post</title>
</head>

<body class="create-post-body">

    <header>
        <?php if (isLoggedIn()): ?>
            <div class="logo">
                <img src="path-to-logo.png" alt="">
            </div>
        <?php endif; ?>
        <nav>
            <ul>
                <li><a href="/Miniblog/Controller/index.php?action=home">Home</a></li>
                <li><a href="/Miniblog/Controller/index.php?action=showArchives">Archives</a></li>

                <?php if (isAdmin()): ?>
                    <li><a href="/Miniblog/Controller/index.php?action=preCreatePost">Ajouter un Billet</a></li>
                    <li><a href="/Miniblog/Controller/index.php?action=administration">Administration</a></li>
                <?php endif; ?>
            </ul>
        </nav>

        <div class="right-nav">
            <ul>
                <?php if (isLoggedIn()): ?>
                    <li><a href="/Miniblog/Controller/index.php?action=profile">Mon Profil</a></li>
                <?php else: ?>
                    <li><a href="/Miniblog/Controller/index.php?action=login">Connexion</a></li>
                    <li><a href="/Miniblog/Controller/index.php?action=register">Inscription</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </header>
    <form action="/Miniblog/Controller/index.php?action=createPost" method="POST" class="create-post-form">
        <h1 class="create-post-title">Créer un nouveau billet</h1>

        <label for="titre" class="create-post-label">Titre</label>
        <input type="text" name="titre" id="titre" class="create-post-input" required>

        <label for="contenu" class="create-post-label">Contenu</label>
        <textarea name="contenu" id="contenu" class="create-post-textarea" rows="6" required></textarea>

        <input type="hidden" name="auteur_id" value="1">

        <button type="submit" class="create-post-button">Publier le billet</button>

        <?php if(isset($error)) {
           echo $error;
        }
        ?>
    </form>
</body>

</html>
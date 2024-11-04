<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Style/style.css">
    <title>Archives</title>
</head>

<body>
    <header>
        <div class="logo">
            <img src="path-to-logo.png" alt="Logo">
        </div>

        <nav>
            <ul>
                <li><a href="/Miniblog/Controller/index.php?action=home">Home</a></li>
                <li><a href="/Miniblog/Controller/index.php?action=showArchives">Archives</a></li>

                <!-- Afficher les liens supplémentaires si l'utilisateur est admin -->
                <?php if (isAdmin()): ?>
                    <li><a href="/Miniblog/Controller/index.php?action=preCreatePost">Ajouter un Billet</a></li>
                    <li><a href="/Miniblog/Controller/index.php?action=administration">Administration</a></li>
                <?php endif; ?>
            </ul>
        </nav>

        <!-- Profil et Déconnexion alignés à droite -->
        <div class="right-nav">
            <ul>
                <?php if (isLoggedIn()): ?>
                    <li><a href="/Miniblog/Controller/index.php?action=profile">Mon Profil</a></li>
                    <li><a href="/Miniblog/Controller/index.php?action=logout">Se Déconnecter</a></li>
                <?php else: ?>
                    <li><a href="/Miniblog/Controller/index.php?action=login">Connexion</a></li>
                    <li><a href="/Miniblog/Controller/index.php?action=register">Inscription</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </header>

    <h1>Liste des archives</h1>
    <?php $allPosts = showAllPost(); ?>
    <?php foreach ($allPosts as $totalPosts): ?>
        <h1><?= htmlspecialchars($totalPosts['titre']) ?></h1>
        <p><?= htmlspecialchars($totalPosts['contenu']) ?></p>
        <small><?= htmlspecialchars($totalPosts['date_post']) ?></small>
        <?php if (isAdmin()): ?>
            <a
                href="/Miniblog/Controller/index.php?action=deletePost&id=<?= htmlspecialchars($totalPosts['id_billets']) ?>">Supprimer</a>
        <?php endif ?>
    <?php endforeach ?>
</body>

</html>
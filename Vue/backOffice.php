<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Style/style.css">
    <script src="/Miniblog/Controller/index.js" defer></script>
    <title>Back Office</title>
</head>

<body>
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
    <h1 class="backoffice-title">BACKOFFICE</h1>
    <hr>
    <div class="backoffice-container">
        <div class="left-column">
            <h2 class="section-title">Liste des utilisateurs :</h2>
            <?php $allUsers = showUsers(); ?>
            <?php foreach ($allUsers as $allUser): ?>
                <div class="user-item">
                    <p class="user-info">ID: <?php echo $allUser['id_utilisateurs'] ?></p>
                    <p class="user-info">Login: <?php echo $allUser['login'] ?></p>
                    <p class="user-info">Prénom: <?php echo $allUser['prenom'] ?></p>
                    <p class="user-info">Nom: <?php echo $allUser['nom'] ?></p>
                    <a href="/Miniblog/Controller/index.php?action=deleteUser&id=<?php echo $allUser['id_utilisateurs']; ?>"
                        class="delete-user">Supprimer l'utilisateur</a>
                    <button class="edit-button"
                        onclick="showUpdateForm(<?php echo $allUser['id_utilisateurs']; ?>)">Modifier</button>
                    <div id="update-form-<?php echo $allUser['id_utilisateurs']; ?>" class="update-form"></div>
                </div>
                <hr>
            <?php endforeach ?>
        </div>

        <div class="right-column">
            <h2 class="section-title">Liste des billets :</h2>
            <?php $allPosts = showAllPost(); ?>
            <?php foreach ($allPosts as $totalPosts): ?>
                <div class="post-item">
                    <h3 class="post-title"><?= htmlspecialchars($totalPosts['titre']) ?></h3>
                    <p class="post-content"><?= htmlspecialchars($totalPosts['contenu']) ?></p>
                    <small class="post-date"><?= htmlspecialchars($totalPosts['date_post']) ?> - ID:
                        <?= htmlspecialchars($totalPosts['id_billets']) ?></small>
                    <?php if (isAdmin()): ?>
                        <a href="/Miniblog/Controller/index.php?action=deletePost&id=<?= htmlspecialchars($totalPosts['id_billets']) ?>"
                            class="delete-post">Supprimer</a>
                        <button class="edit-button"
                            onclick="showPostUpdateForm(<?php echo $totalPosts['id_billets']; ?>)">Modifier le billet</button>
                        <div id="update-form-post-<?php echo $totalPosts['id_billets']; ?>" class="update-form"></div>
                    <?php endif ?>
                </div>
                <hr>
            <?php endforeach ?>
        </div>
    </div>
</body>

</html>
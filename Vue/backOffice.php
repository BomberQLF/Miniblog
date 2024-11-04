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
    <h1>BACKOFFICE</h1>
    <hr>
    <div class="container">
        <div class="left-column">
            <h2>Liste des utilisateurs :</h2>
            <?php $allUsers = showUsers(); ?>
            <?php foreach ($allUsers as $allUser): ?>
                <div>
                    <p>ID: <?php echo $allUser['id_utilisateurs'] ?></p>
                    <p>Login: <?php echo $allUser['login'] ?></p>
                    <p>Prénom: <?php echo $allUser['prenom'] ?></p>
                    <p>Nom: <?php echo $allUser['nom'] ?></p>
                    <a
                        href="/Miniblog/Controller/index.php?action=deleteUser&id=<?php echo $allUser['id_utilisateurs']; ?>">Supprimer
                        l'utilisateur</a>
                    <button onclick="showUpdateForm(<?php echo $allUser['id_utilisateurs']; ?>)">Modifier</button>
                    <div id="update-form-<?php echo $allUser['id_utilisateurs']; ?>"></div>
                </div>
                <hr>
            <?php endforeach ?>
        </div>

        <div class="right-column">
            <h2>Liste des billets :</h2>
            <?php $allPosts = showAllPost(); ?>
            <?php foreach ($allPosts as $totalPosts): ?>
                <div>
                    <h3><?= htmlspecialchars($totalPosts['titre']) ?></h3>
                    <p><?= htmlspecialchars($totalPosts['contenu']) ?></p>
                    <small><?= htmlspecialchars($totalPosts['date_post']) ?> - ID:
                        <?= htmlspecialchars($totalPosts['id_billets']) ?></small>

                    <?php if (isAdmin()): ?>
                        <?php if (isAdmin()): ?>
                            <a href="/Miniblog/Controller/index.php?action=deletePost&id=<?= htmlspecialchars($totalPosts['id_billets']) ?>">Supprimer</a>
                            <button onclick="showPostUpdateForm(<?php echo $totalPosts['id_billets']; ?>)">Modifier le
                                billet</button>
                            <div id="update-form-post-<?php echo $totalPosts['id_billets']; ?>"></div>
                        <?php endif ?>
                    <?php endif ?>
                </div>
                <hr>
            <?php endforeach ?>
        </div>
    </div>
</body>

</html>
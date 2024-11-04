<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="/Miniblog/Controller/index.js" defer></script>
    <link rel="stylesheet" href="../Style/style.css">
    <title>Miniblog</title>
</head>

<body>
    <section class="hero_section">
        <header>
            <?php if (isLoggedIn()):?>
                <div class="logo">
                    <img src="path-to-logo.png" alt="Logo">
                </div>
            <?php endif;?>
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
    </section>

    <main>
        <?php
        // Afficher un message de bienvenue
        if (isLoggedIn()) {
            echo "<h1>Hello " . htmlspecialchars($_SESSION['user']) . " !</h1>";
            echo "<h2>Recent Blogs</h2>";
        } else {
            echo "<h1>Hello Guest !</h1>";
        }
        ?>

        <section class="blog_section">
            <?php $lastPosts = showThreePost(); ?>
            <?php foreach ($lastPosts as $post): ?>
                <a class="linkBlog"
                    href="/Miniblog/Controller/index.php?action=blogDetails&id=<?php echo $post['id_billets']; ?>">
                    <div class="post" id="<?php echo $post['id_billets']; ?>">
                        <h2><?= htmlspecialchars($post['titre']); ?></h2>
                        <p class="post-content"><?= htmlspecialchars($post['contenu']); ?></p>
                        <span>Voir plus</span>
                        <small>Posté le : <?= htmlspecialchars($post['date_post']); ?></small>
                    </div>
                </a>
            <?php endforeach; ?>
        </section>
        <div class="thanks"><em>Thanks for reading</em></div>
    </main>
</body>

</html>
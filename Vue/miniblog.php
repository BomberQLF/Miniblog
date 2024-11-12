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
            <?php if (isLoggedIn()): ?>
                <?php if(!empty($comments)): ?>
                    <div class="logo">
                        <img src="/Miniblog/uploads/<?= $comments['photo_profile']?>" alt="">
                    </div>
                <?php endif;?>
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
        <div class="hero_text_container">
            <div class="hero_title_container">
                <h1>Bee Blog</h1>
                <p>Ce mini-blog sur les abeilles est un projet universitaire réalisé dans le cadre de l’apprentissage du
                    développement web. Il permet d’explorer les bases du PHP et du MVC tout en mettant en avant un sujet
                    captivant.</p>
                <p style="margin-top: 2rem;"><em>Réalisé par Tom MURPHY</em></p>
            </div>
            <div class="hero_img_container">
                <img src="/Miniblog/assets/bee.png" alt="">
            </div>
        </div>
    </section>

    <main>
        <section class="recent_post">
            <div class="big_text">Mes <span>articles</span> récents sur les abeilles pour tout savoir sur les
                <span>ruches</span> et <span>l’apiculture</span></div>
            <div class="big_text">Découvertes autour du monde des abeilles et de la <span>pollinisation</span>
            </div>
        </section>

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
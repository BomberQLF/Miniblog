<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Style/blogDetails.css">
    <title>Blog Details</title>
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

    <main>
        <div class="introduction">
            <h1>Blog Details</h1>
            <p>Découvrez les détails de l'article ci-dessous. Explorez le contenu complet et laissez vos commentaires
                pour une discussion plus approfondie.</p>
        </div>

        <?php if (isset($_GET['id'])): ?>
            <?php
            $post = showPostById($_GET['id']);

            if ($post): ?>
                <div class="post-detail">
                    <h2><?php echo htmlspecialchars($post['titre']); ?></h2>
                    <p><?php echo htmlspecialchars($post['contenu']); ?></p>
                    <div class="post-meta">
                        <small>Date de publication : <?php echo htmlspecialchars($post['date_post']); ?></small>
                    </div>
                </div>
                <div class="comment_part">
                    <?php if (isLoggedIn()): ?>
                        <h2>Commentaires</h2>
                        <form action="/Miniblog/Controller/index.php?action=postComment&id=<?= $post['id_billets']; ?>"
                            method="POST">
                            <div>
                                <label for="commentContent">Votre commentaire :</label><br>
                                <textarea name="commentContent" id="commentContent" rows="5"
                                    placeholder="Écrivez votre commentaire ici..." required></textarea><br>
                            </div>
                            <div>
                                <button type="submit">Poster le commentaire</button>
                            </div>
                        </form>
                    <?php endif; ?>

                    <?php if (!empty($comments)): ?>
                        <div class="comments-section">
                            <?php foreach ($comments as $comment): ?>
                                <div class="comment">
                                    <?php if (!empty($comment['photo_profile'])): ?>
                                        <img src="<?php echo htmlspecialchars($comment['photo_profile']); ?>"
                                            alt="Photo de profil de <?php echo htmlspecialchars($comment['prenom']); ?>"
                                            class="profile-photo">
                                    <?php else: ?>
                                        <img src="/Miniblog/uploads/photo_default.png" alt="Photo de profil par défaut"
                                            class="profile-photo">
                                    <?php endif; ?>
                                    <p><?php echo htmlspecialchars($comment['contenu']); ?></p>
                                    <small>Posté par : <?php echo htmlspecialchars($comment['prenom'] . ' ' . $comment['nom']); ?> le
                                        <?php echo htmlspecialchars($comment['date_post']); ?></small>
                                    <!-- Lien pour supprimer le commentaire -->
                                    <a
                                        href="/Miniblog/Controller/index.php?action=deleteComment&id=<?php echo $comment['id_commentaires']; ?>">Supprimer</a>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <p>Aucun commentaire pour cet article.</p>
                    <?php endif; ?>
                </div>

            <?php else: ?>
                <p>Aucun post trouvé avec cet identifiant.</p>
            <?php endif; ?>
        <?php endif; ?>
    </main>
</body>

</html>
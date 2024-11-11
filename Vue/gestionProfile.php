<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Style/style.css">
    <title>Profile</title>
</head>

<body class="bodyProfile">
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
    <section class="profile-container">
        <div class="container-profile">
            <h1 class="profile-title">Informations Utilisateur</h1>

            <!-- PHOTO DE PROFIL -->

            <div class="profile-info">
                <p class="profile-detail"><span class="detail-label">Login :</span> <?php echo $_SESSION['user'] ?></p>
                <p class="profile-detail"><span class="detail-label">Prénom :</span> <?php echo $_SESSION['prenom'] ?>
                </p>
                <p class="profile-detail"><span class="detail-label">Nom :</span> <?php echo $_SESSION['nom'] ?></p>
            </div>

            <h2 class="profile-subtitle">Modifier la photo de profil</h2>
            <form action="/Miniblog/Controller/index.php?action=upload" method="POST" enctype="multipart/form-data"
                class="profile-form">
                <input type="file" name="photo_profile" accept="image/*" class="file-input" required><br>
                <button type="submit" class="upload-button">Ajouter la photo</button>
                <?php if (isset($error)) {
                    echo $error;
                }
                ?>
                <?php if (isset($volumineux)) {
                    echo $volumineux;
                }
                ?>
                <?php if (isset($format)) {
                    echo $format;
                }
                ?>
                <?php if (isset($erreurUpload)) {
                    echo $erreurUpload;
                }
                ?>
            </form>
            <a class="logout-link" href="/Miniblog/Controller/index.php?action=logout">Se Déconnecter</a>
        </div>
        <div class="profile_img">
            <img src="/Miniblog/uploads/<?php echo getCurrentProfilePicture($_SESSION['user_id']) ?>" alt="">
        </div>
    </section>
</body>

</html>
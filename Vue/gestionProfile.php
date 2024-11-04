<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Style/style.css">
    <title>Profile</title>
</head>
<body>
    <section class="gestionProfile">
        <h1>Informations Utilisateur</h1>

        <!-- PHOTO DE PROFIL -->

        <p class="profileDetails"></p><br>
        <span class="details">Login : <?php echo $_SESSION['user']?></span>

        <p class="profileDetails"></p><br>
        <span class="details">Prenom : <?php echo $_SESSION['prenom']?></span>

        <p class="profileDetails"></p><br>
        <span class="details">Nom : <?php echo $_SESSION['nom']?></span>

        <h2>Modifier la photo de profil</h2>
        <form action="gestionProfile.php?action=upload" method="POST" enctype="multipart/form-data">
            <input type="file" name="photo_profile" accept="image/*" required>
            <button type="submit">Télécharger</button>
        </form>        
    </section>
</body>
</html>
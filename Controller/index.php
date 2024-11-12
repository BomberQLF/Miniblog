<?php
session_start();

// Include le model
require_once('../Model/userModel.php');

// Retrouver l'action du formulaire depuis l'URL
$action = isset($_GET['action']) ? $_GET['action'] : '';

// Switch / Case system pour les conditions et choisir quoi afficher.
switch ($action) {
    case 'inscription':
        // Vérifiez si le formulaire a été soumis
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Vérification des mots de passe
            if ($_POST['mot_de_passe'] !== $_POST['confirm_mot_de_passe']) {
                $error = 'Les mots de passe ne correspondent pas.';
                include('../Vue/inscription.php');
                exit;
            } else {
                // Appel de safetyInscription
                if (safetyInscription() === true) {
                    handleInscription($_POST);
                    include('../Vue/login.php');
                    exit;
                }
            }
        }
        include('../Vue/inscription.php');
        break;

    case 'login':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $loginSuccessful = handleLogin($_POST);
            if ($loginSuccessful) {
                include('../Vue/miniblog.php');
            } else {
                $error = 'Identifiants invalides';
                include('../Vue/login.php');
            }
        } else {
            include('../Vue/login.php');
        }
        break;

    case 'register':
        include('../Vue/inscription.php');
        break;

    case 'logout':
        session_unset();
        session_destroy();
        include('../Vue/miniblog.php');
        break;

    case 'profile':
        if (isLoggedIn()) {
            include('../Vue/gestionProfile.php');
        }
        break;

    case 'miniblog':
        isLoggedIn() ? include('../Vue/miniblog.php') : include('../Vue/login.php');

    case 'home':
        include('../Vue/miniblog.php');
        break;

    case 'administration':
        isAdmin() ? include('../Vue/backOffice.php') : include('../Vue/login.php');
        break;

    case 'showArchives':
        include('../Vue/archives.php');
        break;

    case 'preCreatePost':
        isAdmin() ? include('../Vue/createPost.php') : include('../Vue/login.php');
        break;

    case 'createPost':
        if (isAdmin()) {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $auteurId = $_SESSION['user_id'];
                createPost($_POST['titre'], $_POST['contenu'], $auteurId);
                include('../Vue/miniblog.php');
            } else {
                include('../Vue/login.php');
                $error = "Une erreur est survenu lors de la création du billet";
            }
        }
        break;

    case 'deletePost':
        if (isAdmin()) {
            if (isset($_GET['id'])) {
                $id_billets = intval($_GET['id']);
                deletePost($id_billets);
            }
            include('../Vue/archives.php');
        } else {
            include('../Vue/login.php');
        }
        break;

    case 'deleteUser':
        if (isAdmin()) {
            if (isset($_GET['id'])) {
                $id_user = intval($_GET['id']);
                deleteUsers($id_user);
                var_dump($id_user);
            } else {
                include('../Vue/login.php');
            }
        }
        break;

    case 'updateUser':
        if (isAdmin()) {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                if (isset($_GET['id'])) {
                    $id_user = intval($_GET['id']);
                    $newData = [
                        'login' => $_POST['login'],
                        'prenom' => $_POST['prenom'],
                        'nom' => $_POST['nom']
                    ];
                    updateUser($id_user, $newData);
                    include('../Vue/backOffice.php');
                }
            }
        } else {
            include('../Vue/login.php');
        }
        break;

    case 'updatePost':
        if (isAdmin()) {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                if (isset($_GET['id'])) {
                    $id_billets = $_GET['id'];
                    $newData = [
                        'titre' => $_POST['titre'],
                        'contenu' => $_POST['contenu'],
                        'auteur_id' => $_POST['auteur_id']
                    ];
                    updatePost($id_billets, $newData);
                }
            }
        }
        break;

    case 'updateComment':
        if (isAdmin()) {
            if (isset($_GET['id'])) {
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $id_commentaires = intval($_GET['id']);
                    updateComment($id_commentaires, ['contenu' => $_POST['contenu']]);
                    include('../Vue/backOffice.php');
                }
            }
        }
        break;


    case 'blogDetails':
        $postId = $_GET['id'];
        $post = showPostById($postId);
        $comments = showComments($postId);
        include('../Vue/blogDetails.php');
        break;


    case 'postComment':
        if (isLoggedIn()) {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $postId = $_GET['id'];
                $commentContent = $_POST['commentContent'];
                $userId = $_SESSION['user_id'];

                if (!empty($postId) && !empty($userId) && !empty($commentContent)) {
                    if (postComment($postId, $userId, $commentContent)) {

                        $comments = showComments($postId);
                        $post = showPostById($postId);

                        include("../Vue/blogDetails.php");

                    } else {
                        $echecAjout = "Erreur : Échec de l'ajout du commentaire.";
                    }

                }
            }
        }
        break;

    case 'deleteComment':
        if (isAdmin()) {
            if (isset($_GET['id'])) {
                $id_comment = intval($_GET['id']);
                $commentaire = showCommentById($id_comment);
                deleteComment($id_comment);
                include('../Vue/messageDeleteComment.php');
            }
        } else {
            $error = "Vous n'avez pas les permissions.";
        }
        break;

    case 'upload':
        if (isLoggedIn()) {
            $target_dir = "/Applications/MAMP/htdocs/Miniblog/uploads/";
            $imageFileType = strtolower(pathinfo($_FILES["photo_profile"]["name"], PATHINFO_EXTENSION));
            $id_personne = $_SESSION['user_id'];

            // Créer un nom de fichier unique
            $uniqueFileName = $id_personne . "_" . time() . "." . $imageFileType;
            $target_file = $target_dir . $uniqueFileName;

            $uploadOk = 1;

            // Vérifiez les erreurs d'upload
            if ($_FILES["photo_profile"]["error"] != 0) {
                $error = "Erreur lors de l'upload du fichier.";
                $uploadOk = 0;
            }

            // Vérifiez la taille du fichier
            if ($_FILES["photo_profile"]["size"] > 500000) {
                $volumineux = "Désolé, votre fichier est trop volumineux.";
                $uploadOk = 0;
            }

            // Vérifiez les formats de fichier autorisés
            if (!in_array($imageFileType, ["jpg", "jpeg", "png", "gif"])) {
                $format = "Désolé, seuls les fichiers JPG, JPEG, PNG & GIF sont autorisés.";
                $uploadOk = 0;
            }

            // Si tout est bon, déplacer le fichier dans uploads
            if ($uploadOk == 1) {
                // Récupérer le nom actuel de la photo de profil dans la base de données
                $oldFileName = getCurrentProfilePicture($id_personne);

                if (move_uploaded_file($_FILES["photo_profile"]["tmp_name"], $target_file)) {
                    // Supprimez l'ancienne image, si elle existe
                    if ($oldFileName && file_exists($target_dir . $oldFileName)) {
                        unlink($target_dir . $oldFileName);
                    }

                    // Mettre à jour la base de données avec le nouveau nom de fichier
                    uploadProfilePicture($uniqueFileName, $id_personne);

                } else {
                    $erreurUpload = "Désolé, une erreur est survenue lors du téléchargement de votre fichier.";
                }
            }
        }
        include('../Vue/gestionProfile.php');
        break;


    default:
        include('../Vue/miniblog.php');
        break;
}
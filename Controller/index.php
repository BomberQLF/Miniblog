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
            // Appel de safetyInscription
            if (safetyInscription() === true) {
                handleInscription($_POST);
                // Redirection après inscription réussie
                include('../Vue/login.php');
                exit;
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
                }
            }
        }
        include('../Vue/login.php');
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
                        echo "Erreur : Échec de l'ajout du commentaire.";
                    }

                } else {
                    echo "Erreur : Les données ne sont pas valides.";
                    if (empty($postId))
                        echo " postId est vide.";
                    if (empty($userId))
                        echo " userId est vide.";
                    if (empty($commentContent))
                        echo " commentContent est vide.";
                }
            } else {
                echo "Erreur : Ce n'est pas une requête POST.";
            }
        } else {
            echo "Erreur : L'utilisateur n'est pas connecté.";
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
        }
        break;

    default:
        include('../Vue/miniblog.php');
        break;
}
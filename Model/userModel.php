<?php

function dbConnect()
{
    $db = new PDO('mysql:host=localhost;dbname=miniblog;port=8888', 'root', 'root');
    return $db;
}

function login_existe($login)
{
    $pdo = dbConnect();
    $query = $pdo->prepare("SELECT id_utilisateurs FROM utilisateurs WHERE login = ?");
    $query->execute([$login]);
    return $query->fetch() ? true : false;
}

function create_utilisateurs($login, $prenom, $nom, $mot_de_passe_hash)
{
    $pdo = dbConnect();
    $query = $pdo->prepare("INSERT INTO utilisateurs (login, prenom, nom, mot_de_passe, photo_profile) VALUES (:login, :prenom, :nom, :mot_de_passe, NULL)");
    $query->bindValue(':login', $login);
    $query->bindValue(':prenom', $prenom);
    $query->bindValue(':nom', $nom);
    $query->bindValue(':mot_de_passe', $mot_de_passe_hash);
    $query->execute();
}

function handleInscription($tab)
{
    // Récupérer les données du formulaire
    $login = htmlspecialchars($tab['login']);
    $prenom = htmlspecialchars($tab['prenom']);
    $nom = htmlspecialchars($tab['nom']);
    $mot_de_passe = $tab['mot_de_passe'];

    // Créer l'utilisateur
    $mot_de_passe_hash = password_hash($mot_de_passe, PASSWORD_DEFAULT);

    $pdo = dbConnect();
    $query = $pdo->prepare("INSERT INTO utilisateurs (login, prenom, nom, mot_de_passe) VALUES (:login, :prenom, :nom, :mot_de_passe)");
    $query->bindValue(':login', $login);
    $query->bindValue(':prenom', $prenom);
    $query->bindValue(':nom', $nom);
    $query->bindValue(':mot_de_passe', $mot_de_passe_hash);
    $query->execute();
}

function handleLogin($tab)
{
    $pdo = dbConnect();
    $query = $pdo->prepare("SELECT id_utilisateurs, login, mot_de_passe, prenom, nom FROM utilisateurs WHERE login = :login");

    $query->bindParam(':login', $tab['login'], PDO::PARAM_STR);
    $query->execute();

    $user = $query->fetch(PDO::FETCH_ASSOC);

    // Vérifier si un utilisateur est trouvé et comparer les mdp
    if ($user && password_verify($tab['mot_de_passe'], $user['mot_de_passe'])) {
        // Déclaration des variables de sessions utiles pour la suite
        $_SESSION['user'] = $user['login'];
        $_SESSION['prenom'] = $user['prenom'];
        $_SESSION['nom'] = $user['nom'];
        $_SESSION['user_id'] = $user['id_utilisateurs'];

        return true;
    } else {
        return false;
    }
}

function safetyInscription()
{
    if (isset($_SESSION['inscription_effectuee']) && $_SESSION['inscription_effectuee'] === true) {
        return false;
    }

    if (
        isset($_POST['login']) && !empty($_POST['login']) &&
        isset($_POST['prenom']) && !empty($_POST['prenom']) &&
        isset($_POST['nom']) && !empty($_POST['nom']) &&
        isset($_POST['mot_de_passe']) && !empty($_POST['mot_de_passe'])
    ) {

        $_SESSION['inscription_effectuee'] = true;
        return true;
    } else {
        return false;
    }
}

function isAdmin()
{
    return isset($_SESSION['user']) && $_SESSION['user'] === 'Admin94';
}

function isLoggedIn()
{
    return isset($_SESSION['user']);
}

function userExists($userId)
{
    $pdo = dbConnect();
    $query = $pdo->prepare("SELECT COUNT(*) FROM utilisateurs WHERE id_utilisateurs = :id");
    $query->bindValue(':id', $userId);
    $query->execute();

    return $query->fetchColumn() > 0;
}

function createPost($titre, $contenu, $auteurId)
{
    $pdo = dbConnect();
    $query = $pdo->prepare("INSERT INTO billets (id_billets, titre, contenu, date_post, auteur_id) VALUES (NULL ,:titre, :contenu, NOW(), :auteur_id)");
    $query->bindValue(':titre', $titre);
    $query->bindValue(':contenu', $contenu);
    $query->bindValue(':auteur_id', $auteurId);

    if ($query->execute()) {
        return "Billet créé avec succès";
    }
    return "Erreur lors de la création du billet";
}

function showThreePost()
{
    $pdo = dbConnect();
    $query = $pdo->prepare("SELECT id_billets, titre, contenu, date_post, auteur_id FROM billets ORDER BY date_post DESC LIMIT 3");
    $query->execute();
    $posts = $query->fetchAll(PDO::FETCH_ASSOC);

    return $posts;
}

function showPostById($id)
{
    $pdo = dbConnect();
    $query = $pdo->prepare("SELECT id_billets, titre, contenu, date_post, auteur_id FROM billets WHERE id_billets = :id");
    $query->bindParam(':id', $id, PDO::PARAM_INT);
    $query->execute();
    $post = $query->fetch(PDO::FETCH_ASSOC);

    return $post;
}

function showAllPost()
{
    $pdo = dbConnect();
    $query = $pdo->prepare("SELECT id_billets, titre, contenu, date_post, auteur_id FROM billets ORDER BY date_post ASC");
    $query->execute();
    $posts = $query->fetchAll(PDO::FETCH_ASSOC);

    return $posts;
}

function deletePost($id_billets)
{
    $pdo = dbConnect();
    $query = $pdo->prepare("DELETE FROM billets WHERE id_billets = :id_billets");
    $query->bindValue(':id_billets', $id_billets, PDO::PARAM_INT);
    $query->execute();
}

function showUsers()
{
    $pdo = dbConnect();
    $query = $pdo->prepare("SELECT * FROM utilisateurs");
    $query->execute();
    $allUsers = $query->fetchAll(PDO::FETCH_ASSOC);

    return $allUsers;
}

function deleteUsers($id_utilisateurs)
{
    $pdo = dbConnect();
    $query = $pdo->prepare("DELETE FROM utilisateurs WHERE id_utilisateurs = :id_utilisateurs");
    $query->bindValue(':id_utilisateurs', $id_utilisateurs);
    $query->execute();
}

function updateUser($id_utilisateurs, $newData)
{
    $pdo = dbConnect();
    $query = $pdo->prepare("UPDATE utilisateurs SET nom = :nom, prenom = :prenom, login = :login WHERE id_utilisateurs = :id_utilisateurs");

    $query->bindValue(':nom', $newData['nom']);
    $query->bindValue(':prenom', $newData['prenom']);
    $query->bindValue(':login', $newData['login']);
    $query->bindValue(':id_utilisateurs', $id_utilisateurs, PDO::PARAM_INT);
    $query->execute();
}

function updatePost($id_billets, $newData)
{
    $pdo = dbConnect();
    $query = $pdo->prepare("UPDATE billets SET titre = :titre, contenu = :contenu WHERE id_billets = :id_billets");
    $query->bindValue(':titre', $newData['titre']);
    $query->bindValue(':contenu', $newData['contenu']);
    $query->bindValue(':id_billets', $id_billets, PDO::PARAM_INT);
    $query->execute();
}

function postComment($postId, $userId, $commentContent)
{
    $pdo = dbConnect();

    $query = $pdo->prepare("INSERT INTO commentaires (id_commentaires, contenu, date_post, auteur_id, billet_id) VALUES (NULL, :contenu, NOW(), :auteur_id, :billet_id)");
    $query->bindValue(':billet_id', $postId, PDO::PARAM_INT);
    $query->bindValue(':auteur_id', $userId, PDO::PARAM_INT);
    $query->bindValue(':contenu', htmlspecialchars($commentContent), PDO::PARAM_STR);

    return $query->execute();
}


function showComments($postId)
{
    $pdo = dbConnect();

    $query = $pdo->prepare("
        SELECT c.id_commentaires, c.contenu, c.date_post, u.prenom, u.nom, u.photo_profile
        FROM commentaires c
        JOIN utilisateurs u ON c.auteur_id = u.id_utilisateurs
        WHERE c.billet_id = :postId
        ORDER BY c.date_post DESC
    ");
    $query->bindValue(':postId', $postId, PDO::PARAM_INT);
    $query->execute();

    return $query->fetchAll(PDO::FETCH_ASSOC);
}

function showAllComment()
{
    $db = dbConnect();
    $query = $db->prepare('SELECT * FROM commentaires');
    $query->execute();
    $listComments = $query->fetchAll(PDO::FETCH_ASSOC);

    return $listComments;
}

function updateComment($id_commentaires, $newData)
{
    $pdo = dbConnect();
    $query = $pdo->prepare("UPDATE commentaires SET contenu = :contenu WHERE id_commentaires = :id_commentaires");
    $query->bindValue(':contenu', $newData['contenu']);
    $query->bindValue(':id_commentaires', $id_commentaires, PDO::PARAM_STR);
    $query->execute();
}

function deleteComment($id_commentaires)
{
    $pdo = dbConnect();
    $query = $pdo->prepare("DELETE FROM commentaires WHERE id_commentaires = :id_commentaires");
    $query->bindValue(":id_commentaires", $id_commentaires);
    $query->execute();
}

function showCommentById($id_commentaires)
{
    $pdo = dbConnect();
    $query = $pdo->prepare("SELECT id_commentaires FROM commentaires WHERE id_commentaires = :id_commentaires");
    $query->bindParam(':id_commentaires', $id_commentaires, PDO::PARAM_INT);
    $query->execute();
    $comment = $query->fetch(PDO::FETCH_ASSOC);

    return $comment;
}

function getCurrentProfilePicture($id_utilisateurs)
{
    $pdo = dbConnect();
    $stmt = $pdo->prepare("SELECT photo_profile FROM utilisateurs WHERE id_utilisateurs = :id_utilisateurs");
    $stmt->bindParam(':id_utilisateurs', $id_utilisateurs, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return $result ? $result['photo_profile'] : '/Miniblog/uploads/photo_default.png';
}


function uploadProfilePicture($uniqueFileName, $id_utilisateurs)
{
    $pdo = dbConnect();
    $stmt = $pdo->prepare("UPDATE utilisateurs SET photo_profile = :photo_profile WHERE id_utilisateurs = :id_utilisateurs");
    $stmt->bindParam(':photo_profile', $uniqueFileName);
    $stmt->bindParam(':id_utilisateurs', $id_utilisateurs);
    $stmt->execute();
}
# Documentation du projet

## Comptes de test

### Compte Admin
- **Login** : `Admin94`
- **Mot de passe** : `Admin94`

### Compte Utilisateur
- **Login** : `Prof`
- **Mot de passe** : `Prof`

---

## Fonctionnalités

### Accueil
- Affichage des **3 derniers posts**.
- Options de **connexion** et **inscription**.
- Accès à l'archive pour consulter tous les posts.

### Archives
- Permet de **visualiser tous les posts** disponibles.

### Post
- Affichage des informations suivantes :
  - Auteur.
  - Date et heure de publication.
  - Contenu du post.
  - Image associé au post.
- Visualisation des commentaires :
  - Cliquer sur un bouton pour les afficher (commentaires cachés par défaut)
  - Les **derniers commentaires** en priorité.
  - Tous les commentaires associés au post.
- Si connecté :
  - Possibilité **d’ajouter un commentaire**.

### Écriture de Post
- Création et envoi d’un nouveau post.
- **Disparition automatique** du bouton d’écriture après soumission pour éviter les interférences.

### Logs
- Affichage de **messages d’information** en haut du site après certaines actions.

### Sécurité
- Toutes les requêtes utilisent **bindValue** pour prévenir les **injections SQL**.
- **Vérification des permissions** systématique pour les commandes administratives :
  - Empêche les utilisateurs non autorisés d’exécuter des commandes sensibles, même s’ils connaissent l’URL.

### Admin Panel
- **Gestion des utilisateurs** :
  - Modification.
  - Suppression.
- **Gestion des articles** :
  - Modification.
  - Suppression.
- **Gestion des commentaires** :
  - Modification.
  - Suppression.
- URL d’accès : `?action=administration`.

---

## Notes
Ce projet a été réalisé dans le cadre d’un **mini-projet universitaire** et a pour objectif d’apprendre à coder en **PHP en suivant l’architecture MVC**. Il illustre la mise en place d’un système de gestion de posts et d’administration avec des fonctionnalités sécurisées.
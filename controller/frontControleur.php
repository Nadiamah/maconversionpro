<?php
require_once 'model/Connexion.php';
require_once 'model/Posts.php';
require_once 'model/PostsMapper.php';
require_once 'model/CommentsMapper.php';
require_once 'model/Comments.php';
require_once 'model/Users.php';
require_once 'model/UsersMapper.php';



function afficherPageAccueil() {
    
    
    $loader = new \Twig\Loader\FilesystemLoader('view/');
    $twig = new \Twig\Environment($loader);
    $template = $twig->load('accueil.html');
    echo $template->render();   
}


function afficherPageContact() {
   
    $loader = new \Twig\Loader\FilesystemLoader('view/');
    $twig = new \Twig\Environment($loader);
    $template = $twig->load('contact.html');
    echo $template->render();
    
}

function afficherPagePosts() {
     // On appelle notre mapper pour récupérer notre liste de posts
     $postMapper = new PostsMapper();
     $listPosts  = $postMapper->getListPosts();

    
    $loader = new \Twig\Loader\FilesystemLoader('view/');
    $twig = new \Twig\Environment($loader);
    $template = $twig->load('posts.html');

    $tab = [
        'listPosts'    => $listPosts
    ];
    echo $template->render( $tab);
    //var_dump($listPosts); die;
}
function afficherPageInscription() {
    echo 'ok cest bon je suis à la page d\'inscription';
    $loader = new \Twig\Loader\FilesystemLoader('view/');
    $twig = new \Twig\Environment($loader);
    $template = $twig->load('inscription.html');
    echo $template->render();
}
function afficherPageFilms() {
    echo 'ok cest bon je suis à la page films';
    $loader = new \Twig\Loader\FilesystemLoader('view/');
    $twig = new \Twig\Environment($loader);
    $template = $twig->load('films.html');
    echo $template->render();
}
function afficherPageDetailsposts() {
   
    $id = $_GET['idPost'];
    $postMapper = new PostsMapper();
    $currentPost = $postMapper->getPost($id);
    // On appelle notre mapper pour récupérer notre liste de posts
    $listPosts  = $postMapper->getListPosts();
    

   
    $usersMapper= new UsersMapper();
    $currentUsers= $usersMapper->getUsers($id);
    $listUsers= $usersMapper->getListUsers();

    $commentsMapper= new CommentsMapper();
    $currentComments= $commentsMapper->getComments($id);
    $listComments= $commentsMapper->getListComments();

    $loader = new \Twig\Loader\FilesystemLoader('view/');
    $twig = new \Twig\Environment($loader);
    $template = $twig->load('detailsposts.html');

    $tab = [
        'post'  => $currentPost,
       'listPosts'    => $listPosts,

        'users'  => $currentUsers,
        'listUsers' => $listUsers,
        
        'comments' => $currentComments,
        'listComments' => $listComments,
        
        
    ]; //var_dump($listComments);die;
    echo $template->render($tab);
   
}


function dafficherPageAccueixxxxssssl() {
    echo 'ok cest bon';
}



























return;
// Chargement des classes
require_once('model/PostsManager.php');
require_once('model/CommentsManager.php');

/**
 * Liste des articles
 */
function listPosts() {
    $postManager = new PostsManager(); // Création d'un objet
    $posts = $postManager->getPosts(); // Appel d'une fonction de cet objet

    require('view/listPostsView.php');
}

/**
 * Affichage d'un article avec ses commentaires
 */
function post() {
    $postManager = new PostsManager();
    $commentManager = new CommentsManager();

    $post = $postManager->getPost($_GET['id']);
    $comments = $commentManager->getComments($_GET['id']);

    require('view/postView.php');
}

/**
 * Ajout d'un commentaire
 * @param int $postId
 * @param string $author
 * @param string $comment
 * @throws Exception
 */
function addComment($postId, $author, $comment) {
    $commentManager = new CommentsManager();

    $affectedLines = $commentManager->postComment($postId, $author, $comment);

    if ($affectedLines === false) {
        throw new Exception('Impossible d\'ajouter le commentaire !');
    } else {
        header('Location: index.php?action=post&id=' . $postId);
    }
}

/**
 * Signaler un commentaire
 * @throws Exception
 */
function alertComment() {
    $commentManager = new CommentsManager();
    $change = $commentManager->alertcomment($_GET['comment_id']);
    if ($change === false) {
        throw new Exception('Impossible de signaler le commentaire !');
    } else {
        header('Location: index.php?action=post&id=' . $_GET['id']);
    }
}

/**
 * Vers la page de connexion
 */
function connectView() {

    require('view/connectView.php');
}

/**
 * Vers la page 404
 */
function page_404() {

    require('view/page_404.php');
}

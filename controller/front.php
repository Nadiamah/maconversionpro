<?php
require_once 'model/comments.php';

function afficherPageAccueil2() {
    
    //echo 'page accueil2';
    $loader = new \Twig\Loader\FilesystemLoader('view/');
    $twig = new \Twig\Environment($loader);
    $template = $twig->load('accueil2.html');
    echo $template->render();   
}


function afficherPageContact2() {
    echo 'ok cest bon';
    $loader = new \Twig\Loader\FilesystemLoader('view/');
    $twig = new \Twig\Environment($loader);
    $template = $twig->load('contact2.html');
    echo $template->render();
    
}

function afficherPagePosts2() {
    echo 'ok cest bon je suis à la page du posts2';
    $loader = new \Twig\Loader\FilesystemLoader('view/');
    $twig = new \Twig\Environment($loader);
    $template = $twig->load('posts2.html');
    echo $template->render();
}
function afficherPageInscription2() {
    echo 'ok cest bon je suis à la page d\'inscription2';
    $loader = new \Twig\Loader\FilesystemLoader('view/');
    $twig = new \Twig\Environment($loader);
    $template = $twig->load('inscription2.html');
    echo $template->render();
}
function afficherPageFilms2() {
    echo 'ok cest bon je suis à la page films2';
    $loader = new \Twig\Loader\FilesystemLoader('view/');
    $twig = new \Twig\Environment($loader);
    $template = $twig->load('films2.html');
    echo $template->render();
}
function afficherPageDetailsposts2() {
    //$listComments= getListComments(); 
//var_dump($listComments); die;
    $variables=[
        'listComments'=>$listComments
        
    ];

//var_dump($variables); die;
    echo 'ok cest bon je suis à la page details blog post';
    $loader = new \Twig\Loader\FilesystemLoader('view/');
    $twig = new \Twig\Environment($loader);
    $template = $twig->load('detailsposts2.html');
    echo $template->render();
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

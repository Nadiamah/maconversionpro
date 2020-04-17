<?php

// Le fichier index.php est un routeur

require_once 'vendor/autoload.php';
require_once 'controller/front.php'; // Inclusion de notre controleur



if (isset($_GET['page'])) {

    // Selon le cas et la valeur de $_GET['page'], on va appeler la bonne fonction définie dans notre Controleur ( controleur/front.php )


    // Affichage de la page d'accueil
    if ( $_GET['page'] == 'accueil2' ) {
        afficherPageAccueil2();
    }
    elseif ( $_GET['page'] == 'contact2' ) {
        afficherPageContact2();
    }

    elseif ( $_GET['page'] == 'posts2' ) {

        afficherPagePosts2();

    }
    elseif ( $_GET['page'] == 'inscription2' ) {

        afficherPageInscription2();

    }
    elseif ( $_GET['page'] == 'aproposdemoi' ) {

        afficherPageAproposdemoi();

    }
    elseif ( $_GET['page'] == 'detailsposts2' ) {

        afficherPageDetailsposts2();

    }
    elseif ( $_GET['page'] == 'films2' ) {

        afficherPageFilms2();

    }else {

        echo 'je suis dans le else';


    }



}
else {

}









/***
session_start();
// Definition du path absolu

require('autoload.php');
require('controller/front.php');
ob_start();
try {
    if (isset($_GET['action'])) {
        switch($_GET['action']){
            
            case "listPosts": listPosts();break;
            case 'post':
                if (isset($_GET['id']) && $_GET['id'] > 0) {
                post();
            } else {
                throw new Exception('Aucun identifiant de billet envoy�');
            }
            break;
            case 'addComment':
                if (isset($_GET['id']) && $_GET['id'] > 0) {
                if (!empty($_POST['author']) && !empty($_POST['comment'])) {
                    addComment($_GET['id'], $_POST['author'], $_POST['comment']);
                } else {
                    throw new Exception('Tous les champs ne sont pas remplis !');
                }
            } else {
                throw new Exception('Aucun identifiant de billet envoy�');
            }
            break;
            case 'alertComment':
                if (isset($_GET['comment_id']) && $_GET['comment_id'] > 0) {
                alertComment();
            } else{
                throw new Exception('�a ne marche pas');
            }
            break;
            
            case 'connectView':
                connectView();break;
            case 'page_404':
               
                 page_404();break;
                
            
            default: listPosts(); break;
        } 
 
    }else{
        
        listPosts();
        
    }
    
    $content = ob_get_clean();
    require('view/template.php');
} catch (Exception $e) { // S'il y a eu une erreur, alors...
    echo 'Erreur : ' . $e->getMessage();
}

**/


	
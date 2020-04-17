<?php
function getConnexion() {

    try {
        $bdd = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', '');
    }catch(Exception $e){
        die('Erreur : '.$e->getMessage());
    
    } 
    return $bdd;
    }


function getListComments(){
$donnees = [];
$bdd= getConnexion();
$reponse = $bdd->query("SELECT publication_date FROM `comments` WHERE 1");
if ($reponse) {
    $donnees = $reponse->fetchALL(PDO::FETCH_ASSOC);
}

return $donnees;

//var_dump($donnees);die;


}












?>
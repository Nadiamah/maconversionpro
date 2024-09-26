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
$reponse = $bdd->query("SELECT * FROM `comments`");
if ($reponse) {
    $donnees = $reponse->fetchAll(PDO::FETCH_ASSOC);
}
return $donnees;


}












?>
<?php

class CommentsMapper extends Connexion {


    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Retourne un tableau de posts
     * @return array
     */
    public function getListComments ($id) {

        // 1°) Je prépare ma requete SQL
        $query = $this->getConnexion()->prepare("SELECT * FROM comments where id_posts=:id ");
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        $query->execute();
        //$list->bindParam(':offset', $offset, PDO::PARAM_INT);

        // 2°) On execute notre requete préparée
        

        // 3°) On recupère notre résultat mysql dans un tableau
        $resultDb = $query->fetchAll(PDO::FETCH_ASSOC);


        $listComment = array(); // Initialisation de notre tableau

        // 4°) Pour chaque résultat, on boucle sur chaque ligne
        foreach ($resultDb as $key => $dataRow) {

            // 4°) On instance notre objet avec la ligne de résultat
            $commentsObject = new Comments();
            $commentsObject->setIdComments($dataRow['id_comments']);
            $commentsObject->setDescription($dataRow['description']);
            $commentsObject->setCreatedDate($dataRow['created_date']);
            $commentsObject->setPublicationDate($dataRow['publication_date']);
            $commentsObject->setUpdateDate($dataRow['update_date']);
            $commentsObject->setStatus($dataRow['status']);
            $commentsObject->setIdUsers($dataRow['id_users']);
            $commentsObject->setIdPosts($dataRow['id_posts']);

            // 6°) On met l'objet dans notre tableau à retourner
            $listComment[] = $commentsObject;
            
        }
        //var_dump($listComment); die;
        // 7°) On retourne notre tableau d'objet
        return $listComment;
    }

    //Récupere un article en particulier
    public function getComments ($id) {
        $query = $this->getConnexion()->prepare("SELECT * FROM comments where id_posts=:id");
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        $query->execute();
        $comments = $query->fetch(PDO::FETCH_ASSOC);

        $result = null;

        if ( !empty($comments) ) {
            // On instance notre objet avec la ligne de résultat
            $commentsObject = new Comments();
            $commentsObject->setIdComments($comments['id_comments']);
            $commentsObject->setDescription($comments['description']);
            $commentsObject->setCreatedDate($comments['created_date']);
            $commentsObject->setPublicationDate($comments['publication_date']);
            $commentsObject->setUpdateDate($comments['update_date']);
            $commentsObject->setStatus($comments['status']);
            $commentsObject->setIdUsers($comments['id_users']);
            $commentsObject->setIdPosts($comments['id_posts']);
        
            $result = $commentsObject;
        } 
        return $result;

 //       $obj = new Post(
//            $article['id'],
//            $article['title'],
//            $article['chapo'],
//            $article['content'],
//            $article['nickname'],
//            $article['date_added'],
//            $article['last_updated'],
//            $nbcomments);
//        return $obj;
    }
    



    //Ajoute un article
    public function addArticle($title, $chapo, $content, $id) {
        $add = $this->db->prepare(
            "INSERT INTO posts(title, chapo, content, author, date_added) VALUES (':title', ':chapo', ':content', :id, CURRENT_TIMESTAMP)");
        $add->bindParam(':id', $id, PDO::PARAM_INT);
        $add->bindParam(':title', $title, PDO::PARAM_STR);
        $add->bindParam(':chapo', $chapo, PDO::PARAM_STR);
        $add->bindParam(':content', $content, PDO::PARAM_STR);
        $add->execute(array(':title' => $title, ':chapo' => $chapo, ':content' => $content));
        if ($add == false) {
            return false;
        } else {
            $last = $this->getList(1);
            return $last[0];
        }
    }

    //Supprime l'article
    public function deleteArticle($article) {
        $this->db->prepare("DELETE FROM posts WHERE id=?")->execute(array($id));
    }

    //MAJ l'article
    public function updateArticle($title, $chapo, $content, $id) {
        $maj = $this->db->prepare(
            "UPDATE posts SET title=':title', chapo=':chapo', content=':content', last_updated=CURRENT_TIMESTAMP WHERE id=:id"
        );
        $maj->bindParam(':id', $id, PDO::PARAM_INT);
        $maj->execute(array(':title' => $title, ':chapo' => $chapo, ':content' => $content));
    }

}
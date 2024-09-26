<?php

class PostsMapper extends Connexion {


    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Retourne un tableau de posts
     * @return array
     */
    public function getListPosts () {

        // 1°) Je prépare ma requete SQL
        $list = $this->getConnexion()->prepare("SELECT * FROM posts");
        //$list->bindParam(':offset', $offset, PDO::PARAM_INT);

        // 2°) On execute notre requete préparée
        $list->execute();

        // 3°) On recupère notre résultat mysql dans un tableau
        $resultDb = $list->fetchAll(PDO::FETCH_ASSOC);


        $listPost = array(); // Initialisation de notre tableau
        // 4°) Pour chaque résultat, on boucle sur chaque ligne
        foreach ($resultDb as $key => $dataRow) {

            // 4°) On instance notre objet avec la ligne de résultat
            $postObject = new Posts();
            $postObject->setIdPosts($dataRow['id_posts']);
            $postObject->setTitle($dataRow['title']);
            $postObject->setChapo($dataRow['chapo']);
            $postObject->setDescription($dataRow['description']);
            $postObject->setPublicationDate($dataRow['publication_date']);
            $postObject->setUpdateDate($dataRow['update_date']);
            $postObject->setIdUsers($dataRow['id_users']);
            $postObject->setCreatedDate($dataRow['created_date']);
            $postObject->setStatus($dataRow['status']);

            // 6°) On met l'objet dans notre tableau à retourner
            $listPost[] = $postObject;
            
        }

        // 7°) On retourne notre tableau d'objet
        return $listPost;
    }

    //Récupere un article en particulier
    public function getPost($id) {
        $query = $this->getConnexion()->prepare("SELECT * FROM posts WHERE id_posts = :id");
        //$query = $this->getConnexion()->prepare("SELECT * FROM posts");
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        $query->execute();
        $post = $query->fetch(PDO::FETCH_ASSOC);

        $result = null;
        if ( !empty($post) ) {
            // On instance notre objet avec la ligne de résultat
            $postObject = new Posts();
            $postObject->setIdPosts($post['id_posts']);
            $postObject->setTitle($post['title']);
            $postObject->setChapo($post['chapo']);
            $postObject->setDescription($post['description']);
            $postObject->setPublicationDate($post['publication_date']);
            $postObject->setUpdateDate($post['update_date']);
            $postObject->setIdUsers($post['id_users']);
            $postObject->setCreatedDate($post['created_date']);
            $postObject->setStatus($post['status']);
            $result = $postObject;
        }      
        
        return $result; 
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
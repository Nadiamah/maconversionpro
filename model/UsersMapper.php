<?php

class UsersMapper extends Connexion {


    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Retourne un tableau de posts
     * @return array
     */
    public function getListUsers () {

        // 1°) Je prépare ma requete SQL
        $list = $this->getConnexion()->prepare("SELECT * FROM users");
        //$list->bindParam(':offset', $offset, PDO::PARAM_INT);

        // 2°) On execute notre requete préparée
        $list->execute();

        // 3°) On recupère notre résultat mysql dans un tableau
        $resultDb = $list->fetchAll(PDO::FETCH_ASSOC);


        $listUsers = array(); // Initialisation de notre tableau

        // 4°) Pour chaque résultat, on boucle sur chaque ligne
        foreach ($resultDb as $key => $dataRow) {

            // 4°) On instance notre objet avec la ligne de résultat
            $usersObject = new Users();
            $usersObject->setIdUsers($dataRow['id_users']);
            $usersObject->setName($dataRow['name']);
            $usersObject->setLastname($dataRow['lastname']);
            $usersObject->setLogin($dataRow['login']);
            $usersObject->setPassword($dataRow['password']);
            $usersObject->setEmail($dataRow['email']);
            $usersObject->setStatus($dataRow['status']);
            $usersObject->setRole($dataRow['role']);

            // 6°) On met l'objet dans notre tableau à retourner
            $listUsers[] = $usersObject;
        }

        // 7°) On retourne notre tableau d'objet
        return $listUsers;
    }

    //Récupere un article en particulier
    public function getUsers($id) {
        $query = $this->getConnexion()->prepare("SELECT * FROM users ");
        $query->bindParam(':id', $id, PDO::PARAM_INT); 
        $query->execute();
        $users = $query->fetch(PDO::FETCH_ASSOC);

        $result = null;

        if ( !empty($users) ) {
            // On instance notre objet avec la ligne de résultat
            $usersObject = new Users();
            $usersObject->setIdUsers($users['id_users']);
            $usersObject->setName($users['name']);
            $usersObject->setLastname($users['lastname']);
            $usersObject->setLogin($users['login']);
            $usersObject->setPassword($users['password']);
            $usersObject->setEmail($users['email']);
            $usersObject->setStatus($users['status']);
            $usersObject->setRole($users['role']);
        
            $result = $usersObject;
        }        
        
        return $result;
   // public function getArticle ($id) {
     //   $query = $this->getConnexion()->prepare(
       //     "SELECT users.id, users.name, users.lastname, users.login, users.password, users.email, users.status, users.role,
    //        FROM users JOIN users ON users.author = users.id WHERE users.id = :id");
      //  $query->bindParam(':id', $id, PDO::PARAM_INT);
     //   $query->execute();
     //   $article = $query->fetch();
     //   $commentMapper = new CommentManager;
     //   $nbcomments = $commentMapper->getNbComments($id);
     //   $obj = new Users(
     //       $article['id'],
     //       $article['name'],
     //       $article['lastname'],
     //       $article['login'],
     //       $article['password'],
     //       $article['email'],
     //       $article['status'],
     //       $article['role'],
     //       $nbcomments);
     //   return $obj;
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
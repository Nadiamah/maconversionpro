<?php

/**
 * Class DetailsPosts
 */
class Comments {

    private $id_comments;
    private $description;
    private $created_date;
    private $publication_date;
    private $update_date;
    private $status;
    private $id_users;
    private $id_posts;
    
   



    public function __construct()
    {

    }


    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getPublicationDate()
    {
        return $this->publication_date;
    }

    /**
     * @param mixed $publication_date
     */
    public function setPublicationDate($publication_date)
    {
        $this->publication_date = $publication_date;
    }

    /**
     * @return mixed
     */
    public function getUpdateDate()
    {
        return $this->update_date;
    }

    /**
     * @param mixed $update_date
     */
    public function setUpdateDate($update_date)
    {
        $this->update_date = $update_date;
    }

    /**
     * @return mixed
     */
    public function getIdPosts()
    {
        return $this->id_posts;
    }

    /**
     * @param mixed $id_posts
     */
    public function setIdPosts($id_posts)
    {
        $this->id_posts = $id_posts;
    }

    /**
     * @return mixed
     */
    public function getIdComments()
    {
        return $this->id_comments;
    }

    /**
     * @param mixed $comments
     */
    public function setIdComments($id_comments)
    {
        $this->id_comments = $id_comments;
    }
 /**
     * @return mixed
     */
    public function getIdUsers()
    {
        return $this->id_users;
    }

    /**
     * @param mixed $id_users
     */
    public function setIdUsers($id_users)
    {
        $this->id_users = $id_users;
    }
    /**
     * @return mixed
     */
    public function getCreatedDate()
    {
        return $this->created_date;
    }

    /**
     * @param mixed $created_date
     */
    public function setCreatedDate($created_date)
    {
        $this->created_date = $created_date;
    }
/**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

}
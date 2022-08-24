<?php
class DB
{
    function __construct()
    {
        $host = 'localhost';
        $port = '3306';
        $name = 'inline';
        $user = 'root';
        $pass = '';
        $this->siteLink = 'http://inline';
        try {
            $this->db = new PDO(
                'mysql:' .
                'host=' . $host . ';' .
                'port=' . $port . ';' .
                'dbname=' . $name,
                $user,
                $pass
                );
        }
        catch (Exception $e) {
            print_r($e->getMessage());
            die();
        }
    }

    public function loadPosts($post_id, $userId, $title, $body)
    {
        $query = "INSERT INTO posts (`post_id`, `userId`, `title`, `body`)
                VALUES ($post_id, $userId, '$title', '$body')";
        $result = $this->db->query($query);
        if ($result->rowCount() == 0)
            return false;
        return true;
    }

    public function loadComments($id, $postId, $name, $email, $body)
    {
        $query = "INSERT INTO `comments`(`comment_id`,`postId`, `name`, `email`, `body`)
                VALUES ($id, '$postId','$name','$email','$body')";
        $result = $this->db->query($query);
        if ($result->rowCount() == 0)
            return false;
        return true;
    }

    public function deleteAll()
    {
        $query = "DELETE FROM posts;
                DELETE FROM comments";
        $result = $this->db->query($query);
        if ($result->rowCount() == 0)
            return false;
        return true;
    }

    public function findComment($str)
    {
        $query = "SELECT DISTINCT posts.id, posts.title, comments.body 
                FROM posts, comments WHERE comments.body LIKE '%$str%'
                AND posts.post_id = comments.postId";
        return $this->db->query($query)
            ->fetchAll(PDO::FETCH_ASSOC);
    }
}
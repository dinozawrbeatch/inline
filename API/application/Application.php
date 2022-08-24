<?php
require_once('db/DB.php');

class Application
{
    public function __construct()
    {
        $db = new DB();
        $this->db = $db;
    }

    public function loadPosts($params){
        $post_id = $params['post_id'];
        $userId = $params['userId'];
        $title = $params['title'];
        $body = $params['body'];
        if($post_id && $userId && $title && $body){
            return $this->db->loadPosts($post_id, $userId, $title, $body);
        }
    }

    public function loadComments($params){
        $id = $params['id'];
        $postId = $params['postId'];
        $name = $params['name'];
        $email = $params['email'];
        $body = $params['body'];
        if($postId && $name && $email && $body){
            return $this->db->loadComments($id, $postId, $name, $email, $body);
        }
    }

    public function deleteAll(){
        return $this->db->deleteAll();
    }

    public function findComment($params){
        $str = $params['str'];
        if(strlen($str) >= 3 && $str){
            return $this->db->findComment($str);
        }
    }
}

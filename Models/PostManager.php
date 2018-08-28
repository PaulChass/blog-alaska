<?php
namespace Blog\Model;

class PostManager
{
    public function getPosts()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT id, title, content, DATE_FORMAT(updateDate, \'%d/%m/%Y\') AS updateDate_fr FROM post ORDER BY updateDate ASC LIMIT 0, 10');
        return $req;
    }

    public function getPost($postId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, title, content, DATE_FORMAT(updateDate, \'%d/%m/%Y\') AS updateDate_fr FROM post WHERE id = ?');
        $req->execute(array($postId));
        $post = $req->fetch();

        return $post;
    }


    private function dbConnect()
    {
        $db = new \PDO('mysql:host=localhost;dbname=p3;charset=utf8', 'root', '');
        return $db;
    }
}
/*
$postManager = new PostManager();
$post = $postManager->getPost(1);
echo $post['content'];*/
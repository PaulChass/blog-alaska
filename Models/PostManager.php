<?php
namespace Blog\Model;

class PostManager
{
    public function getPosts()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT id, title, content, DATE_FORMAT(updateDate, \'%d/%m/%Y\') AS updateDate_fr FROM post WHERE deleteDate IS NULL ORDER BY updateDate' ); // Where delete date = none?
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

    public function deletePost($id)
    {
        $db = $this->dbConnect();
        $posts = $db->prepare('UPDATE `post` SET deleteDate = now() WHERE id=:id');
        $deletedLines = $posts -> execute(array('id' => $id ));
        return $deletedLines;    
    }


    public function insertPost($title,$content)
    {
    $db = $this->dbConnect();
    $posts = $db->prepare('INSERT INTO post(title, content, updateDate) VALUES(:title, :content, now())');
    $affectedLines=$posts->execute(array(
    'title' => $title,
    'content' => $content
    ));
    return $affectedLines;
    }
    

    private function dbConnect()
    {
        $db = new \PDO('mysql:host=localhost;dbname=p3;charset=utf8', 'root', '');
        return $db;
    }

   
}

<?php
namespace Blog\Model;

class PostManager
{
    /**
     * Récupère tous les posts publiés sur le site
     * 
     * @return <array> chaque ligne contient l'id , le titre , le contenu et la date de creation d'un post 
     */
    public function getPosts()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT id, title, content, DATE_FORMAT(createDate, \'%d/%m/%Y\') AS createDate_fr FROM post WHERE deleteDate IS NULL ORDER BY createDate' ); 
        return $req;
    }

    /**
     * Recupère les informations d'un post en particulier
     * @param <int> $postID Id du post que l'on veut récupérer
     * 
     * @return <array> contient l'id le titre le contenu et la date d'un seul post
     */
    public function getPost($postId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, title, content, DATE_FORMAT(createDate, \'%d/%m/%Y\') AS createDate_fr FROM post WHERE id = ? ORDER BY createDate');
        $req->execute(array($postId));
        $post = $req->fetch();
        return $post;
    }

    /**
     * Supprime un post publié
     * @param <int> $id id du post à supprimer
     * 
     * @return <bool> TRUE : Le post a été supprimé / FALSE : Une erreur à eu lieu     
     */
    public function deletePost($id)
    {
        $db = $this->dbConnect();
        $posts = $db->prepare('UPDATE `post` SET deleteDate = now() WHERE id=:id');
        $deletedLines = $posts -> execute(array('id' => $id ));
        return $deletedLines;    
    }

    /**
     * Publie un nouveau post 
     * @param <String> $title  Titre du nouveau post
     * @param <String> $content Contenu de nouveau post
     * 
     * @return <bool> TRUE : Le post est ajouté / FALSE : Une erreur a eu lieu
     */
    public function insertPost($title,$content)
    {
        $db = $this->dbConnect();
        $posts = $db->prepare('INSERT INTO post(title, content, createDate) VALUES(:title, :content, now())');
        $affectedLines=$posts->execute(array(
            'title' => $title,
            'content' => $content
        ));
        return $affectedLines;
    }

/**
 * Modifie un post dans la base de donnée 
 * 
 * @param <String> $title Titre que l'on veut affecté au post
 * @param <String> $content Contenu que l'on veut afffecté .
 * @param <date> $date Date de création du post d'origine
 * 
 * @return <bool> TRUE : Le post a bien été modifié / FALSE : Une erreur a eu lieu 
 */
    public function updatePost($title,$content,$date){
        $db = $this->dbConnect();
        $posts = $db->prepare('INSERT INTO post(`title`, `content`, `createDate`) VALUES(:title, :content, :createDate)');
        $affectedLines=$posts->execute(array(
            'title' => $title,
            'content' => $content,
            'createDate' => $date
        )); 
        return $affectedLines;
    }
    
/**
 * Compte les post publiés sur le site
 * 
 * @return <int> Nombre de post publiés
 * */
    public function countPosts()
    {
        $db = $this -> dbConnect();
        $req = $db->query('SELECT count(*) FROM `post` WHERE deleteDate IS NULL');
        $count = $req->fetch();
        return $count['count(*)'];
    }
/**
 * Récupère la date de création d'un post en particulier
 * 
 * @param <int> id du post
 * 
 * @return <date> date de creation du post
 */
    public function getCreateDate($postId)
    {
        $db = $this -> dbConnect();
        $req = $db->prepare('SELECT createDate FROM `post` WHERE id=?');
        $req->execute(array($postId));
        $post = $req->fetch();
        return $post['createDate'];
    }

/**
* Recupère le dernier identifiant d'un poste depuis sa date de création 
*
* @param <date> date de creation 
*
* @return <int> id du post 
*/
    public function getPostId($createDate)
    {
        $db = $this -> dbConnect();
        $req = $db->prepare('SELECT id FROM `post` WHERE createDate=? ORDER BY id DESC');
        $req->execute(array($createDate));
        $post = $req->fetch();
        return $post['id'];
    }

/**
 * Connecte à la base de donnnées
 * 
 * @return <PDO> autorisation de connexion a la base de donné 
 */
    private function dbConnect()
    {
        $db = new \PDO('mysql:host=localhost;dbname=p3;charset=utf8', 'root', '');
        return $db;
    }
}

<?php
namespace Blog\Model;

class CommentManager
{
/**
 * Récupère les commentaires d'un post d'id fourni.
 *
 * @param <int> $postId Id du post
 * 
 * @return <array> $comments Renvoi un tableau ou chaque ligne contient Nom d'utilisateur, le contenu , l'id de commentaire et l'id de post d'un commentaire*/
	public function getComments($postId)
    {
        $db = $this->dbConnect();

        $comments = $db->prepare('SELECT comment.id,userId,postId, username, content, DATE_FORMAT(publishDate, \'%d/%m/%Y\') AS publishDate_fr FROM `comment` 

        INNER JOIN user on comment.userID=user.id WHERE :postId' );
        $comments->execute(array('postId'=>$postId));
        return $comments;
    }

/**
 * Ajoute un commentaire dans la base de données.
 *
 * @param <int> $postId Id du post
 * @param <String> $userId Id de l'utilisateur
 * @param <String> $content contenu du message 
 * 
 * @return <boolean> TRUE : Commentaire ajouté / FALSE : Une erreur a eu lieu*/
    public function insertComment($postId,$userId, $content)
    {
    	$db = $this->dbConnect();
        $comments = $db->prepare('INSERT INTO comment(postId, userId, content, publishDate) VALUES(:postId, :userId, :content, now())');
    $affectedLines=$comments->execute(array(
            'postId' => $postId,
            'userId' => $userId,
            'content' => $content));
	return $affectedLines;
    }
	
    
/**
 * Signal un commentaire.
 * 
 * @param <int> $comentId Id du commentaire
 * @param <int> $userId Id de l'utilisateur
 * 
 * @return <boolean> TRUE: Commentaire signalé / FALSE : Une erreur a eu lieu
 */
    public function signalComment($commentId,$userId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('INSERT INTO signaledcomment(commentId, userId) VALUES(:commentId, :userId)');
        $signaledComment=$req->execute(array('commentId'=>$commentId,
        'userId'=>$userId));
        return $signaledComment;
    }

/**
 * "Like" un commentaire.
 * 
 * @param <int> $comentId Id du commentaire
 * @param <int> $userId Id de l'utilisateur
 * 
 * @return <boolean> TRUE: Commentaire "liké" / FALSE : Une erreur a eu lieu
 */
    public function likeComment($commentId,$userId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('INSERT INTO likedcomment(commentId, userId) VALUES(:commentId, :userId)');
        $likedComment=$req->execute(array('commentId'=>$commentId,
        'userId'=>$userId));
        return $likedComment;
    }

/**
 * Supprime un commentaire
 * 
 * @param <int> $id Id du commentaire à supprimer
 * 
 * @return <boolean> TRUE : Commentaire supprimé / FALSE : une erreur à eu lieu
*/
    public function deleteComment($id)
    {
        $db = $this->dbConnect();
        $req = $db ->prepare('DELETE FROM `comment` WHERE id=?');
        $reqLiked = $db ->prepare('DELETE FROM `likedcomment` WHERE commentId=?');
        $reqSignaled = $db ->prepare('DELETE FROM `signaledcomment` WHERE commentId=?');
        $deletedComment = $req->execute(array($id));
        $deletedSignaledComment = $reqSignaled->execute(array($id));
        $deletedLikedComment = $reqLiked->execute(array($id));
        return $deletedComment;
       
    }
    
/**
 * Supprime tous les commentaires d'un post
 * 
 * @param <int> $id Id du post
 * 
 * @return <boolean> TRUE : commentaire(s) supprimer / FALSE : une erreur a eu lieu
 */
    public function deletePostComments($id)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id FROM comment  WHERE postId=?');
        $req-> execute(array($id));
        while ($deleteComment=$req ->fetch())
        {
            deleteComment($deleteComment['id']);
        }
        $req->closeCursor();
        return $deleteComment;
    }

/**
 * Modifie l'identifiant de post de tous les commentaires d'un postId donné.
 * 
 * @param <int> $postID id que l'on souhaite modifier
 * @param <int> $id valeur d'id que l'on souhaite affectée.
 * 
 * @return <boolean> TRUE : La modification de postId a eu lieu / FALSE : Une erreur a eu lieu  
 */
    public function changePostId($postId,$id)
    {
        $db = $this->dbConnect();
        $req =$db ->prepare('UPDATE `comment` SET `postId`= :id WHERE postId= :postId');
        $changed = $req -> execute( array(
            'id' => $id ,
            'postId' => $postId
        ));
        return $changed;
    }

/**
 * Recupère l'id d'un post depuis l'id d'un commentaire
 * 
 * @param <int> $id id du commentaire
 * 
 * @return <int> id du post
 */
    public function getId($id)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('SELECT postId FROM comment  WHERE id=?');
        $comments->execute(array($id));
        while ($comment=$comments->fetch()) 
        {
            return $comment['postId']; 
        }
        $comments->closeCursor();
        
        die;
    }


/**
 * Compte les commentaires publiés sur le site
 * 
 * @return <int> Nombre de commentairespubliés
 */
    public function countComments()
    {
        $db = $this -> dbConnect();
        $req = $db->query('SELECT count(*) FROM `comment` ');
        $count = $req->fetch();
        return $count['count(*)'];
    }

/**
 * Compte les commentaires "likés" sur le site
 * 
 * @return <int> Nombre de commentaires "likés"
 */
    public function countLikedComments()
    {
        $db = $this -> dbConnect();
        $req = $db->query('SELECT COUNT( DISTINCT `userId`,`commentId`) AS count FROM `likedcomment` ');
        $count = $req->fetch();
        return $count['count'];
    }

/**
 * Compte les commentaires signalés sur le site
 * 
 * @return <int> Nombre de commentaires signalés
 */
    public function countSignaledComments()
    {
        $db = $this -> dbConnect();
        $req = $db->query('SELECT COUNT( DISTINCT `userId`,`commentId`) AS count FROM `signaledcomment` ');
        $count = $req->fetch();
        return $count['count'];
    }

/**
 * Liste les commentaires "likés" du site
 * 
 * @return <array> chaque ligne contient l'id d'utilisateur,l'id de post, le message et l'id du commentaire.
 */
    public function listlikedComments()
    {
        $db = $this -> dbConnect();
        $likedComments = $db->query('SELECT DISTINCT(comment.id), title ,comment.postId, comment.content
        FROM likedcomment 
        INNER JOIN comment ON likedcomment.commentId=comment.id 
        INNER JOIN post on comment.postId=post.id
        ORDER BY postId');
        return $likedComments;
    }

/**
 * Liste les commentaires signalés du site
 * 
 * @return <array> chaque ligne contient l'id d'utilisateur,l'id de post, le message et l'id du commentaire.
 */
    public function listSignaledComments()
    {
        $db = $this -> dbConnect();
        $signaledComments = $db->query('SELECT DISTINCT(comment.id), title ,comment.postId, comment.content
        FROM signaledcomment 
        INNER JOIN comment ON signaledcomment.commentId=comment.id 
        INNER JOIN post on comment.postId=post.id
        ORDER BY postId');
        return $signaledComments;
    }

/**
 * Connecte à la base de donné
 * 
 * <PDO> renvoi l'autorisation d'accès à la base de donné.
 */
    private function dbConnect()
    {
        $db = new \PDO('mysql:host=localhost;dbname=p3;charset=utf8', 'root', '');
        return $db;
    }
}
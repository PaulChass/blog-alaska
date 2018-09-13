<?php
namespace Blog\Model;

class CommentManager
{

	public function getComments($postId)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('SELECT id,userId, content, DATE_FORMAT(publishDate, \'%d/%m/%Y\') AS publishDate_fr FROM comment WHERE postId=:postId');
        $comments->execute(array('postId'=>$postId));
        return $comments;
    }

    public function insertComment($postId,$userId, $content)
    {
    	$db = $this->dbConnect();
    	$comments = $db->prepare('INSERT INTO comment(postId, userId, content, publishDate) VALUES(:postId, :userId, :content, now())');
    	$affectedLines=$comments->execute(array(
	'postId' => $postId,
	'userId' => $userId,
	'content' => $content
	));
	return $affectedLines;
    }
	
	
    public function signalComment($commentId,$userId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('INSERT INTO signaledcomment(commentId, userId) VALUES(:commentId, :userId)');
        $signaledComment=$req->execute(array('commentId'=>$commentId,
        'userId'=>$userId));
        return $signaledComment;
    }

    public function likeComment($commentId,$userId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('INSERT INTO likedcomment(commentId, userId) VALUES(:commentId, :userId)');
        $likedComment=$req->execute(array('commentId'=>$commentId,
        'userId'=>$userId));
        return $likedComment;
    }

    public function deleteComment($id)
    {
        $db = $this->dbConnect();
        $req = $db ->prepare('DELETE FROM `comment` WHERE id=?');
        $deletedComment = $req->execute(array($id));
        return $deletedComment;
    }

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

    private function dbConnect()
    {
        $db = new \PDO('mysql:host=localhost;dbname=p3;charset=utf8', 'root', '');
        return $db;
    }
}
<?php
namespace Blog\Model;

class CommentManager
{

	public function getComments($postId)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('SELECT comment.id,userId, username, content, DATE_FORMAT(publishDate, \'%d/%m/%Y\') AS publishDate_fr FROM `comment` 
        INNER JOIN user on comment.userID=user.id WHERE :postId' );
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
            'content' => $content));
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
        $reqLiked = $db ->prepare('DELETE FROM `likedcomment` WHERE commentId=?');
        $reqSignaled = $db ->prepare('DELETE FROM `signaledcomment` WHERE commentId=?');
        $deletedComment = $req->execute(array($id));
        $deletedSignaledComment = $reqSignaled->execute(array($id));
        $deletedLikedComment = $reqLiked->execute(array($id));
        return $deletedComment;
       
    }
    
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

    public function countComments()
    {
        $db = $this -> dbConnect();
        $req = $db->query('SELECT count(*) FROM `comment` ');
        $count = $req->fetch();
        return $count['count(*)'];
    }

    public function countLikedComments()
    {
        $db = $this -> dbConnect();
        $req = $db->query('SELECT COUNT( DISTINCT `userId`,`commentId`) AS count FROM `likedcomment` ');
        $count = $req->fetch();
        return $count['count'];
    }

    public function countSignaledComments()
    {
        $db = $this -> dbConnect();
        $req = $db->query('SELECT COUNT( DISTINCT `userId`,`commentId`) AS count FROM `signaledcomment` ');
        $count = $req->fetch();
        return $count['count'];
    }

    

    private function dbConnect()
    {
        $db = new \PDO('mysql:host=localhost;dbname=p3;charset=utf8', 'root', '');
        return $db;
    }
}
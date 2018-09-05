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

    private function dbConnect()
    {
        $db = new \PDO('mysql:host=localhost;dbname=p3;charset=utf8', 'root', '');
        return $db;
    }
}
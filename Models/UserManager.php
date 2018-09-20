<?php
namespace Blog\Model;

class UserManager
{

    public function addUser($mail, $password, $username)
    {
        $db = $this->dbConnect();
        $cryptedPassword = crypt($password,'165!.64sfhfhusbs2224-MonPetitGraindeSEL');
        $cryptedMail = crypt($mail,'165!.64sfhfhusbs2224-MonPetitGraindeSEL');
        $user = $db->prepare('INSERT INTO user(emailAddress, password, username, registrationDate) VALUES(:mail, :password, :username, now())');
        $affectedLines=$user->execute(array(
        'mail' => $cryptedMail,
        'password' => $cryptedPassword,
        'username' => $username
        ));
        return $affectedLines;
    }

    public function signIn($mail,$password)
    {
        $db = $this->dbConnect();
        $cryptedPassword =  crypt($password,'165!.64sfhfhusbs2224-MonPetitGraindeSEL');
        $cryptedMail = crypt($mail,'165!.64sfhfhusbs2224-MonPetitGraindeSEL');
        $req = $db->prepare('SELECT `password`FROM `user` WHERE `emailAddress`=?');
        $req->execute(array($cryptedMail));
        $user = $req->fetch();
        if ($cryptedPassword !== $user['password']){
            $signIn = FALSE;
        }
        else{
            $signIn = TRUE;
        }
        return $signIn;
    }

    public function getUser($mail)
    {
        $db = $this->dbConnect();
        $cryptedMail = crypt($mail,'165!.64sfhfhusbs2224-MonPetitGraindeSEL');
        $req = $db->prepare('SELECT username, userType,id FROM `user` WHERE `emailAddress`=?');
        $req->execute(array($cryptedMail));
        $user = $req->fetch();
        return $user;
    }


    private function dbConnect()
    {
        $db = new \PDO('mysql:host=localhost;dbname=p3;charset=utf8', 'root', '');
        return $db;
    }
}
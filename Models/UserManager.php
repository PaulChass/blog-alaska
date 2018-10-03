<?php
namespace Blog\Model;

class UserManager
{
/**
 * Ajoute un nouvel compte utilisateur dans la base de données.
 * 
 * @param <String> $mail addresse mail du nouvel utilisateur
 * @param <String> $password mot de passe du nouvel utilisateur
 * @param <String> $username Pseudonyme du nouvel utilisateur 
 * 
 * @return <bool> TRUE : Le compte a été crée / FALSE : Une erreur a eu lieu
 */
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

/**
 * Verifie les identifiants de connexion de l'utilisateur .
 *
 * @param <String> $mail Addresse mail saisie par l'utilisateur 
 * @param <String> $password Mot de passe saisi par l'utilisateur
 * 
 * @return <bool> TRUE : L'authentification est réussie / FALSE : Une erreur a eu lieu
 */
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

/**
 * Renvoi les informations d'un utilisateur
 *
 * @param <String> $mail addresse email de l'utilisateur
 * 
 * @return <array> contenant le nom d'utilisateur,son identifiant et sont type  
 */
    public function getUser($mail)
    {
        $db = $this->dbConnect();
        $cryptedMail = crypt($mail,'165!.64sfhfhusbs2224-MonPetitGraindeSEL');
        $req = $db->prepare('SELECT username, userType,id FROM `user` WHERE `emailAddress`=?');
        $req->execute(array($cryptedMail));
        $user = $req->fetch();
        return $user;
    }

/**
 * Verifie si l'email n'est pas déja utilisé
 * 
 * @param <String> $mail addresse mail saisi par l'utilisateur
 * 
 * @return <bool> TRUE : L'addresse email n'est pas déja utilisé / FALSE : Addresse email déja utilisé
 */
    public function checkEmail($mail)
    {
        $db = $this -> dbConnect();
        $cryptedMail = crypt($mail,'165!.64sfhfhusbs2224-MonPetitGraindeSEL');
        $req = $db -> prepare('SELECT id FROM user WHERE `emailAddress`=? ');
        $req->execute(array($cryptedMail));
        $user = $req -> fetch();
        if ($user['id']==NULL){
            $checkEmail = TRUE;
        }
        else{
            $checkEmail=FALSE;
        }
        return $checkEmail;
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
<?php
require_once('dao/UserDaoMysql.php');
session_start();

Class Auth{
    private $pdo;
    private $base;
    private $dao;

    function __construct(PDO $pdo, $base){
        $this->pdo = $pdo;
        $this->base=$base;
        $this->dao=new UserDaoMysql($this->pdo);

    }
    function checkToken(){
        $token = $_SESSION['token'];
        // se der erro nega esse token
        if($token){
           
            $user = $this->dao->findByToken($token);
            if($user){
                return $user;
            }

            

        }
        header("Location: $this->base/login.php");
        exit;

    }
    public function validateLogin($email, $password ){
       
        $user = $this->dao->findByEmail($email);

        if($user){
          
          
            if(password_verify($password, $user->password)){
               
                $token = md5(time().rand(0, 9999));
                $_SESSION['token'] = $token;
                $user->token = $token;
                $this->dao->update($user);

                return true;

            }

        }
        return false;
    }
    public function emailExists($email){
        
       return $this->dao->findByEmail($email) ? true : false;
        
    }
    public function registerUser($name, $email, $password, $birthdate){
       
        $newUser = new User();

        $hash = password_hash($password, PASSWORD_DEFAULT);

        $token = md5(time().rand(0, 9999));

        
        $newUser->name = $name;
        $newUser->email = $email;
        $newUser->password = $hash;
        $newUser->birthdate = $birthdate;
        $newUser->token = $token;
        $newUser->avatar ='default.jpg';


        $this->dao->insert($newUser);

        $_SESSION['token'] = $token;


    }
}

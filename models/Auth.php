<?php
require_once('dao/UserDaoMysql.php');
Class Auth{
    private $pdo;
    private $base;

    function __construct(PDO $pdo, $base){
        $this->pdo = $pdo;
        $this->base=$base;

    }
    function checkToken(){
        $token = $_SESSION['token'];
        // se der erro nega esse token
        if($token){
            $userDao = new UserDaoMysql($this->pdo);
            $user = $userDao->findByToken($token);
            if($user){
                return $user;
            }

            

        }
        header("Location: $this->base/login.php");
        exit;

    }
}

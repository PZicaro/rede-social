<?php
require('./models/User.php');

Class UserDaoMysql implements UserDao{
    private $pdo;

    public function __construct (PDO $driver){
        $this->pdo = $driver;

    }
public function findByToken($token){
    
}
}
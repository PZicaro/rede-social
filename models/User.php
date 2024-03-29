<?php 
Class User{
    public $id;
    public $email;
    public $password;
    public $name;
    public $birthdate;
    public $city;
    public $work;
    public $avatar;
    public $cover;
    public $token;

}
Interface UserDao {
    public function findByToken($token);
    public function findByEmail($email);
    public function update( User $u);

    
};
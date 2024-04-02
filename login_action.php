<?php
require ('./config.php');
require('./models/Auth.php');
session_start();


$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$password = filter_input(INPUT_POST, 'password');

if($email && $password){
    $auth = new Auth($pdo, $base);
    if($auth->validateLogin($email, $password)){
        header('Location:'.$base);
        exit;
    } else {
        $_SESSION["flash"]= 'Email e/ou Senha estão errados';
        header('Location:'.$base.'/login.php');
        exit;
    }
}
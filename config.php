<?php
$base = 'http://localhost/devsbook';
//atualizar url base no computador de casa
$db_name = 'devsbook';
$db_host = 'localhost';
$db_user ='root';
$db_pass = '';

try {
    $pdo = new PDO("mysql:dbname=$db_name;host=$db_host", $db_user, $db_pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Erro de conexão: ' . $e->getMessage();
    exit;
}

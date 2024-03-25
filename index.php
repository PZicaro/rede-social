<?php
require('./config.php');
require('./models/Auth');
$auth = new Auth($pdo, $base);
$auth->checkToken();
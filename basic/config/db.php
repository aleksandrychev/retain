<?php

$db = [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=pdf2html',
    'username' => 'root',
    'password' => '111111',
    'charset' => 'utf8',
];

@include_once("db-local.php");


return $db;
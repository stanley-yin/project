<?php 

$db_host = 'localhost';     //主機名稱
$db_name = 'project';        //資料庫名稱
$db_user = 'stanley';
$db_pass = 'stanley61409';


// data source name
$dsn = "mysql:host={$db_host};dbname={$db_name};charset=utf8";  //一定要雙引號

// PDO(PHP Data Object) 連線設定
$pdo_options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // 此fetch跟以前學到的不一樣
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
];

$pdo = new PDO($dsn, $db_user, $db_pass, $pdo_options);
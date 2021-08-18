<?php
include __DIR__ . '/partials/init.php';

$sid = $_GET['sid'];
$num = $_GET['num'];

if( isset($_SESSION['shoplist'][$sid])){
    unset($_SESSION['shoplist'][$sid]);
    $_SESSION['total']--;
}

header('Location:cart-check.php');

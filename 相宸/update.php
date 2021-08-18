<?php
include __DIR__ . '/partials/init.php';

$sid = $_GET['sid'];
$num = $_GET['num'];

$_SESSION['shoplist'][$sid]['num'] += $num;
if ($_SESSION['shoplist'][$sid]['num'] < 1) {
    $_SESSION['shoplist'][$sid]['num'] = 1;
}

header('Location:cart-check.php');

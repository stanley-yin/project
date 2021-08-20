<?php 

include __DIR__ . '/partials/init.php';


$sql = "SELECT * FROM `products` WHERE `sid`= {$_GET['sid']}";
$result = $pdo->query($sql)->fetch();

$shop = $result;
$shop['num'] =1;
if( isset($_SESSION['shoplist'][$shop['sid']])){
    $_SESSION['shoplist'][$shop['sid']]['num']++;
}else{
    $_SESSION['shoplist'][$shop['sid']] = $shop;
    $_SESSION['total']+=1;
}

// unset($_SESSION['shoplist']);
// unset($_SESSION['total']);
// unset($_SESSION);

// print_r($_SESSION);

header('Location:data-list.php');

?>

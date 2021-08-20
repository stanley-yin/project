<?php include __DIR__ . '/partials/init.php'; ?>

<?php

$sid = isset($_GET['sid']) ? intval($_GET['sid']) : '0';

if (!empty($sid)) {
    // 刪除order_list資料表的訂單
    $sql = "DELETE FROM `order_list` WHERE `order_list`.`sid`=$sid";
    $stmt = $pdo->query($sql);
    // 刪除order_details資料表的訂單
    $sql2 = "DELETE FROM `order_details` WHERE `order_details`.`order_sid`=$sid";
    $stmt2 = $pdo->query($sql2);
}


// 回到跳轉前的頁面
if(isset($_SERVER['HTTP_REFERER'])){
    header("Location:".$_SERVER['HTTP_REFERER']);
}else{
    header('Location: order-list.php');     
}
?>
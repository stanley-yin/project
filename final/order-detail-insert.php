<?php 
include __DIR__ . '/partials/init.php';
header('Content-Type: application/json');

// 查詢母訂單的編號 (搜尋最新一筆資料)
$sqls = "SELECT * FROM `order_list` ORDER BY `sid` DESC limit 1";
$row = $pdo->query($sqls)->fetch();


// 寫入order_details資料表
$sql = "INSERT INTO `order_details`(			 				
    `order_sid`, `product_sid`, `quantity`, 
    `unit_price`, `subtotal` 
    ) VALUES (
        ?, ?, ?,
        ?, ?
    )";

$stmt = $pdo->prepare($sql);
foreach($_SESSION['shoplist'] as $s){
$p = $s['special_offer'] == '暫無' ? $s['price'] : $s['special_offer'];
    $stmt->execute([
        $row['sid'],
        $s['sid'],
        $s['num'],
        $p,
        $p*$s['num'],
]);
}

// 成功寫入，清空購物車並回到購物車頁面
if($stmt->rowCount()==1){
    unset($_SESSION['shoplist']);
    unset($_SESSION['total']);
    header('Location:cart-check.php');
}
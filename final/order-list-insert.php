<?php 
include __DIR__ . '/partials/init.php';

header('Content-Type: application/json');
// 日期格式設定為台北
date_default_timezone_set("Asia/Taipei");

$output = [
    'success' => false,
    'rowCount' =>0,
    'postData' => $_POST,
];

//資料寫入order_list
$sql = "INSERT INTO `order_list`(
        `member_id`, `amount`, 
        `payment`, `delivery`, `addressee_name`, 
        `mobile`, `address`, `status`,
        `order_date`
        ) VALUES (
            ?, ?, ?,
            ?, ?, ?,
            ?, ?, ?
        )";
$stmt = $pdo->prepare($sql);
$stmt->execute([
    $_SESSION['user']['sid'],   // 麻煩梓庭串接會員api      
    $_POST['total'],
    $_POST['payment'],
    $_POST['delivery'],
    $_POST['addressee_name'],
    $_POST['mobile'],
    $_POST['address'],
    '未處理',       //預設為未處理
    date( "Y-m-d H:i:s"),
 ]);

 if($stmt->rowCount()==1){
    $output['success'] = true;
}

echo json_encode($output);










<?php 
include __DIR__ . '/partials/init.php';

header('Content-Type: application/json');

$output = [
    'success' => false,
    'error' =>'',
    'code' => 0,
    'rowCount' =>0,
    'postData' => $_POST,
];

//資料寫入order_list
$sql = "INSERT INTO `order_list`(
        `member_id`, `amount`, 
        `payment`, `delivery`, `addressee_name`, 
        `mobile`, `address`, 
        `order_date`
        ) VALUES (
            ?, ?, ?,
            ?, ?, ?,
            ?, Now()
        )";
$stmt = $pdo->prepare($sql);
$stmt->execute([
    $_SESSION['user']['account'],
    $_POST['total'],
    $_POST['payment'],
    $_POST['delivery'],
    $_POST['addressee_name'],
    $_POST['mobile'],
    $_POST['address'],
 ]);

 if($stmt->rowCount()==1){
    $output['success'] = true;
}

echo json_encode($output);










<?php
include __DIR__ . './partials/init.php';

header('Content-Type: application/json');

$output = [
    'success' => false,
    'error' => '請確認資料是否完整輸入',
    'code' => 0,
    'rowCount' => 0,
    'postData' => $_POST,
];

// 避免直接拜訪時的錯誤訊息
if (
    empty($_POST['payment']) or
    empty($_POST['delivery']) or
    empty($_POST['addressee_name']) or
    empty($_POST['mobile']) or
    empty($_POST['address']) or
    empty($_POST['status'])
) {
    echo json_encode($output);
    exit;
}

// '\[value-\d\]' 一次查詢全部[value]

$sql = "UPDATE `order_list` SET 
                    `payment`=?,
                    `delivery`=?,
                    `addressee_name`=?,
                    `mobile`=?,
                    `address`=?,
                    `status`=?
                    WHERE `sid`=?";

$stmt = $pdo->prepare($sql);
$stmt->execute([
    $_POST['payment'],
    $_POST['delivery'],
    $_POST['addressee_name'],
    $_POST['mobile'],
    $_POST['address'],
    $_POST['status'],
    $_POST['sid'],
]);

$output['rowCount'] = $stmt->rowCount(); // 修改的筆數
if ($stmt->rowCount() == 1) {
    $output['success'] = true;
    $output['error'] = '';
} else {
    $output['error'] = '資料沒有修改';
}

echo json_encode($output);
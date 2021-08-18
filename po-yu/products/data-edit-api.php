<?php
include __DIR__ . './partials/init.php';

// 直接打開API來看，會有NOTICE之類的錯誤，因為此時不是透過AJAX發送資料
// 因此不要直接拜訪API

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
    empty($_POST['sid']) or
    empty($_POST['N']) or
    empty($_POST['cs']) or
    empty($_POST['img']) or
    empty($_POST['L']) or
    empty($_POST['n']) or
    empty($_POST['c']) or
    empty($_POST['q']) or
    empty($_POST['p']) or
    empty($_POST['sp']) or
    empty($_POST['EM']) or
    empty($_POST['po']) or
    empty($_POST['EXP']) or
    empty($_POST['MFD'])
) {
    echo json_encode($output);
    exit;
}

// '\[value-\d\]' 一次查詢全部[value]

$sql = "UPDATE `products` SET 
                    `Name`=?,
                    `categories_sid`=?,
                    `image`=?,
                    `Location`=?,
                    `nutrient`=?,
                    `brand_company`=?,
                    `quantity`=?,
                    `price`=?,
                    `special offer`=?,
                    `Edible_Method`=?,
                    `place_origin`=?,
                    `EXP`=?,
                    `MFD`=?
                    WHERE `sid`=?";

$stmt = $pdo->prepare($sql);
$stmt->execute([
    $_POST['N'],
    $_POST['cs'],
    $_POST['img'],
    $_POST['L'],
    $_POST['n'],
    $_POST['c'],
    $_POST['q'],
    $_POST['p'],
    $_POST['sp'],
    $_POST['EM'],
    $_POST['po'],
    $_POST['EXP'],
    $_POST['MFD'],
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
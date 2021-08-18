<?php
// 連接數據庫
include __DIR__ . "/partials/database.php";

header('Content-Type: application');

$output = [
    'success' => false,
    'error' => '請確認資料是否完整輸入',
    'code' => 0,
    'rowCount' => 0,
    'postData' => $_POST,
];

// 避免直接拜訪時的錯誤訊息

if (
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

// // 判斷有無帳號資料或密碼
// if (!isset($_POST['N']) or !isset($_POST['cs'])) {
//     $output['error'] = '請確認資料是否完整填寫';
//     $output['code'] = 400;
//     echo json_encode($output);
//     // echo json_encode($output, JSON_UNESCAPED_UNICODE);
//     exit;
// }

// if (mb_strlen($_POST['N']) <= 0) {
//     $output['error'] = '請填入商品名稱';
//     $output['code'] = 410;
//     echo json_encode($output);
//     exit;
// }
// if (mb_strlen($_POST['cs']) <= 0) {
//     $output['error'] = '請填入商品類別編號';
//     $output['code'] = 410;
//     echo json_encode($output);
//     exit;
// }
// if (mb_strlen($_POST['img']) <= 0) {
//     $output['error'] = '請填入圖片路徑';
//     $output['code'] = 410;
//     echo json_encode($output);
//     exit;
// }
// if (mb_strlen($_POST['L']) <= 0) {
//     $output['error'] = '請填入對應的身體部位';
//     $output['code'] = 410;
//     echo json_encode($output);
//     exit;
// }
// if (mb_strlen($_POST['n']) <= 0) {
//     $output['error'] = '請填入商品成分 / 商品材質';
//     $output['code'] = 410;
//     echo json_encode($output);
//     exit;
// }
// if (mb_strlen($_POST['c']) <= 0) {
//     $output['error'] = '請填入製造公司';
//     $output['code'] = 410;
//     echo json_encode($output);
//     exit;
// }
// if (mb_strlen($_POST['q']) <= 0) {
//     $output['error'] = '請填入內容量 / 規格';
//     $output['code'] = 410;
//     echo json_encode($output);
//     exit;
// }
// if (mb_strlen($_POST['p']) <= 0) {
//     $output['error'] = '請填入商品價格';
//     $output['code'] = 410;
//     echo json_encode($output);
//     exit;
// }
// if (mb_strlen($_POST['EM']) <= 0) {
//     $output['error'] = '請填入使用方法';
//     $output['code'] = 410;
//     echo json_encode($output);
//     exit;
// }
// if (mb_strlen($_POST['po']) <= 0) {
//     $output['error'] = '請填入產地';
//     $output['code'] = 410;
//     echo json_encode($output);
//     exit;
// }
// if (mb_strlen($_POST['EXP']) <= 0) {
//     $output['error'] = '請填入保存期限';
//     $output['code'] = 410;
//     echo json_encode($output);
//     exit;
// }
// if (mb_strlen($_POST['MFD']) <= 0) {
//     $output['error'] = '請填入製造日期';
//     $output['code'] = 410;
//     echo json_encode($output);
//     exit;
// }


// 插入語句
// 前面是``  後面是''

// $sql = "INSERT INTO `products` (`sid`, `Name`, `categories_sid`,`image`, `Location`, `nutrient`, `company`, `quantity`, `price`, `Edible_Method`, `place_origin`, `EXP`, `MFD`) VALUES (NULL, '$N', '$cs','$img', '$L', '$n', '$c', '$q', '$p', '$EM', '$po', '$EXP', '$MFD');";

$sql = "INSERT INTO `products`(
               `Name`, `categories_sid`, `image`,
               `Location`, `nutrient`, `brand_company`, `quantity`, `price`, `special offer`, `Edible_Method`, `place_origin`, `EXP`, `MFD`, `create_at`
               ) VALUES (
                    ?, ?, ?,
                    ?, ?, ?,
                    ?, ?, ?,
                    ?, ?, ?, ?, NOW()
               )";

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
]);


$output['rowCount'] = $stmt->rowCount(); // 新增的筆數
if ($stmt->rowCount() == 1) {
    $output['success'] = true;
}

echo json_encode($output);

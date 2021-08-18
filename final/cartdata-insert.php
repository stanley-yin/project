<?php 
include __DIR__ . '/partials/init.php';

header('Content-Type: application/json');


$arr = $_SESSION['shoplist'];
// foreach($arr as $a => $v){      //a = sid ; v=值
//     print_r($a);
//     // echo '<br>';
// }
// var_dump($arr);

//資料寫入order_list
$sql = "INSERT INTO `order_list`(
        `sid`, `member_id`, `amount`, 
        `payment`, `delivery`, `addressee_name`, 
        `mobile`, `address`, `status`, 
        `order_date`
        ) VALUES (
            ?, ?, ?,
            ?, ?, ?,
            ?, ?, ?,
            ?, Now()
        )";

$stmt = $pdo->prepare($sql);
foreach($arr as $a => $v){
    $stmt->execute([
        $v['sid'],
        $v['name'],
        $v['email'],
        $v['mobile'],
        $v['num'],
     ]);
}


// 資料寫入 order_details

// $output['rowCount'] = $stmt->rowCount();    // 新增的筆數
if($stmt->rowCount()==1){
    echo "結帳成功";
    unset($_SESSION['shoplist']);
    unset($_SESSION['total']);
    header('Location:cart-check.php');
}

// echo json_encode($output);



// $output = [
//     'success' => false,
//     'error' =>'',
//     'code' => 0,
//     'rowCount' =>0,
//     'postData' => $_POST,
// ];
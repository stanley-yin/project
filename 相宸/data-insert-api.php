<?php 
include __DIR__ . '/partials/init.php';

header('Content-Type: application/json');

// 要分別寫入不同的資料表

$arr = $_SESSION['shoplist'];
// foreach($arr as $a => $v){      //a = sid ; v=值
//     print_r($a);
//     // echo '<br>';
// }
// var_dump($arr);


$sql = "INSERT INTO `order_list`(
        `sid`,`name`, `email`, `mobile`,`num` 
        ) VALUES (
            ?, ?, ?,
            ?, ?
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



// $output['rowCount'] = $stmt->rowCount();    // 新增的筆數
if($stmt->rowCount()==1){
    echo "結帳成功";
    unset($_SESSION['shoplist']);
    unset($_SESSION['total']);
}

// echo json_encode($output);



// $output = [
//     'success' => false,
//     'error' =>'',
//     'code' => 0,
//     'rowCount' =>0,
//     'postData' => $_POST,
// ];
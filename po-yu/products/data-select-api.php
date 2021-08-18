<?php

// 連接數據庫
include "./partials/database.php";

// 暫時先註解掉sid和price 
// 商品編號
// $i = $_POST["i"];

// 預防直接拜訪API時顯示錯誤訊息
// if (!isset($_POST['N']) or !isset($_POST['cs'])
// ) {
//     $output['error'] = '未發現商品名稱或商品標號';
//     $output['code'] = 400;
//     echo json_encode($output,
//         JSON_UNESCAPED_UNICODE
//     );
//     exit; // 直接離開 (中斷) 程式
//     // die(); // 和 exit 功能相同
// }

// 名稱
$N = $_POST["N"];
// 類別編號
// $cs = $_POST["cs"];
// // 對應身體部位
// $L = $_POST["L"];
// // 商品成分 / 商品材質	
// $n = $_POST["n"];
// // 品牌 / 製造公司
// $c = $_POST["c"];
// // 	內容量 / 規格
// $q = $_POST["q"];

// // 暫時先註解掉sid和price 
// // 商品價格
// // $p = $_POST["p"];

// // 使用方法
// $EM = $_POST["EM"];
// // 產地
// $po = $_POST["po"];
// // 保存期限
// $EXP = $_POST["EXP"];

?>


<?php
// 查詢所有數據的sql語句
// $sql = "SELECT * FROM `products` WHERE 
//      `sid` LIKE '%$i%' AND `Name` LIKE '%$N%' AND `categories_sid` LIKE '%$cs%' AND `Location` LIKE '%$L%' AND `nutrient` LIKE '%$n%' AND `company` LIKE '%$c%' AND `quantity` LIKE '%$q%' AND `price` LIKE '%$p%' AND `Edible_Method` LIKE '%$EM%' AND `place_origin` LIKE '%$po%' AND `EXP` LIKE '%$EXP%'";

// 暫時先刪除掉sid和price 
// $sql = "SELECT * FROM `products` WHERE 
//      `Name` LIKE '%$N%' AND `categories_sid` LIKE '%$cs%' AND `Location` LIKE '%$L%' AND `nutrient` LIKE '%$n%' AND `brand_company` LIKE '%$c%' AND `quantity` LIKE '%$q%' AND `Edible_Method` LIKE '%$EM%' AND `place_origin` LIKE '%$po%' AND `EXP` LIKE '%$EXP%'";
$sql = "SELECT * FROM `products` WHERE 
     `Name` LIKE '%$N%'";



// 取得資料筆數
// $totalRows = $pdo->query("SELECT count(1) FROM products WHERE 
//      `Name` LIKE '%$N%' AND `categories_sid` LIKE '%$cs%' AND `Location` LIKE '%$L%' AND `nutrient` LIKE '%$n%' AND `brand_company` LIKE '%$c%' AND `quantity` LIKE '%$q%' AND `Edible_Method` LIKE '%$EM%' AND `place_origin` LIKE '%$po%' AND `EXP` LIKE '%$EXP%'")
//     ->fetch(PDO::FETCH_NUM)[0];
$totalRows = $pdo->query("SELECT count(1) FROM products WHERE 
     `Name` LIKE '%$N%'")
    ->fetch(PDO::FETCH_NUM)[0];

$rows = $pdo->query($sql)->fetchAll();

?>

<?php include "./partials/html-head.php"; ?>


<style>
    h1 {
        text-align: center;
        margin: 30px;
        font-weight: 700;
    }

    table {
        width: 100%;
        table-layout: fixed
    }

    thead tr th {
        position: sticky;
        top: -1px;
    }

    th,
    td {
        text-align: center;
        max-width: 30px;
    }

    td img {
        max-width: 130px;
        max-height: 130px;
    }
</style>

<h1>查詢結果</h1>
<p align="center" class="total">查詢到的商品總數：<?php echo $totalRows; ?></p>
<?php
include __DIR__ . './partials/table.php'
?>



<?php include "./partials/script.php" ?>
<?php include "./partials/html-foot.php" ?>
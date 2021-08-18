<?php
include __DIR__ . "./partials/database.php";

// 取得資料筆數
// $totalRows = $pdo->query("SELECT count(1) FROM products WHERE `categories_sid` = 1 ORDER BY `sid` ASC;")
//     ->fetch(PDO::FETCH_NUM)[0];

// // 查詢所有商品類別為1數據的sql語句
// $sql = "SELECT *  FROM `products` WHERE `categories_sid` = 1 ORDER BY `sid` ASC;";


// $rows = $pdo->query($sql)->fetchAll();
?>
<?php

// 固定每一頁最多幾筆
$perPage = 10;

// 用戶決定查看第幾頁，預設值為 1
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;

// 總共有幾筆 (主要修改位置)
$totalRows = $pdo->query("SELECT count(1) FROM products WHERE `Location` = '手' ORDER BY `sid` ASC;")
    ->fetch(PDO::FETCH_NUM)[0];

// 總共有幾頁, 才能生出分頁按鈕
$totalPages = ceil($totalRows / $perPage); // 正數是無條件進位

// 讓page值在安全的範圍內 (用戶在網址輸入 ?page= 也不會跳到安全值外)
if ($page < 1) {
    header('Location: ?page=1');
    exit;
}
if ($page > $totalPages) {
    header('Location: ?page=' . $totalPages);
    exit;
}

// LIMIT後面如果有兩個數，第一個是開始的數(索引號從0開始)，第二個是展示的數量 (主要修改位置)
$sql = sprintf(
    "SELECT * FROM `products`  WHERE `Location` = '手' ORDER BY `sid` DESC LIMIT %s, %s",
    ($page - 1) * $perPage,
    $perPage
);

$rows = $pdo->query($sql)->fetchAll();

?>

<?php include __DIR__ . "./partials/html-head.php"; ?>
<style>
    h1 {
        text-align: center;
        margin: 30px 0 5px 0;
        font-weight: 700;
        font-size: 50px;
    }

    p {
        margin-bottom: 0;
    }

    .search a,
    .add a {
        font-size: 25px;
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

    .total {
        text-align: right;
        margin: 0 185px 20px 0;
    }

    td img {
        max-width: 130px;
        max-height: 130px;
    }
</style>

<h1>手</h1>
<p align="center" class="total">目前商品總數：<?php echo $totalRows; ?></p>
<?php
include __DIR__ . './partials/table.php'
?>

<div class="container my-5">
    <div class="row">
        <div class="col">
            <!-- 按鈕 -->
            <nav aria-label="Page navigation example">
                <ul class="pagination d-flex justify-content-end">
                    <li class="page-item <?= $page <= 1 ? 'disabled' : '' ?>">
                        <a class="page-link" href="?page=<?= $page - 1 ?>">
                            Previous
                        </a>
                    </li>

                    <?php for ($i = $page - 5; $i <= $page + 5; $i++) :
                        if ($i >= 1 and $i <= $totalPages) : ?>
                            <!-- active 讓當前頁面按鈕變色 -->
                            <li class="page-item <?= $i == $page ? 'active' : '' ?>"><a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a></li>
                    <?php endif;
                    endfor ?>

                    <li class="page-item <?= $page >= $totalPages ? 'disabled' : '' ?>">
                        <a class="page-link" href="?page=<?= $page + 1 ?>">
                            NEXT
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>


<?php include __DIR__ . "./partials/script.php"; ?>
<?php include __DIR__ . "./partials/html-foot.php"; ?>
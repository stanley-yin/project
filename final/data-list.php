<?php
include __DIR__ . "./partials/database.php";
include __DIR__. "./partials/init.php";
// 固定每一頁最多幾筆
$perPage = 10;

// 搜尋按鈕
// query string parameters
$qs = [];

// 關鍵字查詢
$keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';

// 用戶決定查看第幾頁，預設值為 1
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;

// 裡面的前後空白一定要寫
$where = ' WHERE 1 ';
// 一個條件
if (!empty($keyword)) {
    // $where .= " AND `name` LIKE '%{$keyword}%' "; // sql injection 漏洞
    $where .= sprintf(" AND `Name` LIKE %s ", $pdo->quote('%' . $keyword . '%'));

    $qs['keyword'] = $keyword;
}
// 第二個條件另外一個if


// 總共有幾筆
$totalRows = $pdo->query("SELECT count(1) FROM products $where")
    ->fetch(PDO::FETCH_NUM)[0];
$totalPages = ceil($totalRows / $perPage); // 正數是無條件進位

$rows = [];
// 要有資料才讀取該頁的資料
if ($totalRows != 0) {
    // 總共有幾頁, 才能生出分頁按鈕
    // 讓page值在安全的範圍內 (用戶在網址輸入 ?page= 也不會跳到安全值外)
    if ($page < 1) {
        header('Location: ?page=1');
        exit;
    }
    if ($page > $totalPages) {
        header('Location: ?page=' . $totalPages);
        exit;
    }

    // LIMIT後面如果有兩個數，第一個是開始的數(索引號從0開始)，第二個是展示的數量
    $sql = sprintf(
        "SELECT * FROM products %s ORDER BY sid DESC LIMIT %s, %s",
        $where,
        ($page - 1) * $perPage,
        $perPage
    );

    $rows = $pdo->query($sql)->fetchAll();
}

?>
<?php include __DIR__.'./partials/navbar.php' ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./bootstrap4/css/bootstrap.css">
    <link rel="stylesheet" href="./fontawesome-free-5.15.3-web/css/all.css">
    <title>data-list</title>
    <style>
        h1 {
            text-align: center;
            margin: 30px;
            font-weight: 700;
            font-size: 50px;
        }

        h1 a {
            color: #000;
        }

        h1 a:hover {
            color: #000;
            text-decoration-line: none;
        }

        p {
            margin-bottom: 0;
        }

        .btn-outline-success {
            color: #000;
            border-color: #000;
        }

        .btn-outline-success:hover {
            color: #000;
            border-color: #000;
            background-color: #ccc;
        }

        @media (min-width: 576px) {

            .mr-sm-2,
            .mx-sm-2 {
                margin-right: 3px !important;
            }
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
            width: 100%;
            text-align: center;
        }

        .top {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .add-select {
            width: 33.333%;
            display: flex;
            justify-content: center;
            margin: 10px 0;
            text-align: center;

        }

        .add a {
            color: #000;
        }

        .total {
            align-self: flex-end;
            width: 33.333%;
        }

        .categories {
            width: 33.333%;
            position: relative;
            display: flex;
            justify-content: flex-start;
            padding-left: 10%;
        }

        .categories .title {
            font-size: 25px;
        }

        .body-cate {
            display: flex;
            width: fit-content;
            position: absolute;
            top: -20px;
            left: 65%;
            z-index: 10;
        }

        .body-area {
            width: fit-content;
            margin-left: 18px;
        }

        .big-cate {
            position: absolute;
            top: -20px;
            left: 45%;
            width: 150px;
            margin: 0 0 0 40px;
            padding: 0 5px;
        }

        ul li {
            list-style: none;
            padding: 2px 0;
        }

        ul li a {
            color: #000;
            font-size: 16px;
        }

        td img {
            max-width: 130px;
            max-height: 130px;
        }
    </style>

</head>

<body>

    <h1><a href="data-list.php">商品資料庫</a></h1>


    <!-- 搜索框 -->
    <form action="data-list.php" class="form-inline mb-lg-4 d-flex justify-content-center">
        <input class="form-control mr-sm-2" type="search" name="keyword" placeholder="請輸入商品名稱" value="<?= htmlentities($keyword) ?>" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">查詢</button>
    </form>

    <div class="top">
        <div class="categories">
            <div class="title">
                商品類別
            </div>
            <ul class="big-cate">
                <li><a href="categories1.php">(1) 保健食品</a></li>
                <li><a href="categories2.php">(2) 生活用品</a></li>
                <li><a href="categories3.php">(3) 醫療器材</a></li>
            </ul>
            <ul class="body-cate">
                <div class="body-area">
                    <li><a href="categories-head.php">頭部</a></li>
                    <li><a href="categories-face.php">臉部</a></li>
                    <li><a href="categories-eye.php">眼睛</a></li>
                </div>
                <div class="body-area">
                    <li><a href="categories-oral-cavity.php">口腔</a></li>
                    <li><a href="categories-body.php">身體</a></li>
                    <li><a href="categories-lung.php">肺</a></li>
                </div>
                <div class="body-area">
                    <li><a href="categories-stomach.php">腸胃</a></li>
                    <li><a href="categories-skin.php">皮膚</a></li>
                    <li><a href="categories-bone.php">骨骼</a></li>
                </div>
                <div class="body-area">
                    <li><a href="categories-hand.php">手</a></li>
                    <li><a href="categories-foot.php">足</a></li>
                    <li><a href="categories-blood.php">血液</a></li>
                </div>
                <div class="body-area">
                    <li><a href="categories-sleep.php">睡眠</a></li>
                    <li><a href="categories-other.php">其他</a></li>
                </div>
            </ul>
        </div>
        <div class="add-select">
            <!-- <div class="text-center search">
                    <a href="data-select.php">查詢商品</a>
                </div> -->
            <div class="text-center add">
                <a href="data-insert.php">新增商品</a>
            </div>
        </div>
        <p align="center" class="total">目前商品總數：<?php echo $totalRows; ?></p>
    </div>
    <?php
    include __DIR__ . './partials/table.php'
    ?>

    <!-- 按鈕 -->
    <nav aria-label="Page navigation example">
        <ul class="pagination d-flex justify-content-center">
            <li class="page-item <?= $page <= 1 ? 'disabled' : '' ?>">
                <a class="page-link" href="?<?php $qs['page'] = $page - 1;
                                            echo http_build_query($qs); ?>">
                    <i class="fas fa-arrow-circle-left"></i>
                </a>
            </li>
            <!-- 分頁按鈕限制數量 -->
            <?php for ($i = $page - 5; $i <= $page + 5; $i++) :
                if ($i >= 1 and $i <= $totalPages) :
                    $qs['page'] = $i;
            ?>
                    <!-- active 讓當前頁面按鈕變色 -->
                    <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                        <a class="page-link" href="?<?= http_build_query($qs) ?>"><?= $i ?></a>
                    </li>
            <?php endif;
            endfor; ?>
            <li class="page-item <?= $page >= $totalPages ? 'disabled' : '' ?>">
                <a class="page-link" href="?<?php $qs['page'] = $page + 1;
                                            echo http_build_query($qs); ?>">
                    <i class="fas fa-arrow-circle-right"></i>
                </a>
            </li>
        </ul>
    </nav>






    <script src="./jquery-3.6.0/jquery-3.6.0.js"></script>
    <script src="./bootstrap4/js/bootstrap.js"></script>
</body>

</html>
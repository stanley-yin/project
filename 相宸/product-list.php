<?php
include __DIR__ . '/partials/init.php';
$title = '商品列表';

//  ====== 資料處理區 =========

// 用戶所在頁面
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$perPage = 5;


$totalRows = $pdo->query("SELECT COUNT(1) FROM `products` WHERE 1")->fetch(PDO::FETCH_NUM)[0];

$totalPages = ceil($totalRows / $perPage);

if ($page < 1) {
    header('Location:?page=1');
    exit();
}
if ($page > $totalPages) {
    header('Location:?page=1');
    exit();
}

// ===== 要放入網頁表格的資料 ===== 
$sql = sprintf("SELECT * FROM `products` ORDER By sid DESC LIMIT %s, %s", ($page - 1) * $perPage, $perPage);
$row = $pdo->query($sql)->fetchAll();

?>

<?php include __DIR__ . '/partials/html-head.php' ?>
<?php include __DIR__ . '/partials/navbar.php' ?>

<style>
    /* .card {
        position: relative;
    }

    .outerbox {
        position: absolute;
        /* bottom: 10px; 
    } */
</style>
<div class="container">
    <div class="row">
        <?php foreach ($row as $r) : ?>
            <div class="card col" style="width: 18rem;">
                <img src="<?= $r['img'] ?>" class="card-img-top" alt="...">
                <div class="card-body ">
                    <h5 class="card-title h-50"><?= $r['name'] ?></h5>
                    <div class="row mt-5">
                        <div class="col-4 jus">
                            <p class="card-text"><?= $r['price'] ?>元 </p>
                        </div>
                        <div class="col-8"><a href="addcart.php?sid=<?= $r['sid'] ?>" class="btn btn-primary addcart">加入購物車</a></div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>


<div class="container">
    <div class="row">

        <!-- 分頁按鈕 -->
        <div class="container">
            <div class="row ">
                <nav aria-label="Page navigation example">
                    <ul class="pagination d-flex justify-content-end">
                        <?php ?>
                        <li class="page-item <?= $page <= 1 ? 'disabled' : '' ?>">
                            <a class="page-link" href="?page=<?= $page - 1 ?>">Previous</a>
                        </li>

                        <?php for ($i = $page - 2; $i <= $page + 2; $i++) :
                            if ($i >= 1 and $i <= $totalPages) :
                        ?>
                                <li class="page-item <?= $i == $Pages ? 'active' : '' ?>"><a class="page-link" href="?page=<?= $i ?>"><?= $i ?> </a></li>
                        <?php endif;
                        endfor; ?>

                        <li class="page-item  <?= $page >= $totalPages ? 'disabled' : '' ?>"><a class="page-link" href="?page=<?= $page + 1 ?>">Next</a></li>
                    </ul>
                </nav>
            </div>
        </div>

    </div>
</div>



<?php include __DIR__ . '/partials/script.php' ?>
<?php include __DIR__ . '/partials/html-foot.php' ?>
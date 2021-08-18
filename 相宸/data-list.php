<?php
include __DIR__ . '/partials/init.php';
$title = '資料列表';

//  ====== 資料處理區 =====

// 用戶所在頁面
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$perPage = 5;


$totalRows = $pdo->query("SELECT COUNT(1) FROM `address_book` WHERE 1")->fetch(PDO::FETCH_NUM)[0];

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
$sql = sprintf("SELECT * FROM `address_book` ORDER By sid DESC LIMIT %s, %s", ($page - 1) * $perPage, $perPage);
$row = $pdo->query($sql)->fetchAll();

?>

<?php include __DIR__ . '/partials/html-head.php' ?>
<?php include __DIR__ . '/partials/navbar.php' ?>

<div class="container">
    <div class="row">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">
                        <i class="fas fa-cart-plus"></i>
                    </th>
                    <th scope="col">sid</th>
                    <th scope="col">name</th>
                    <th scope="col">email</th>
                    <th scope="col">mobile</th>
                    <th scope="col">birthday</th>
                    <th scope="col">address</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($row as $r) : ?>
                    <tr>
                        <td>
                            <a href="addcart.php?sid=<?= $r['sid'] ?>">
                                <i class="fas fa-cart-plus"></i>

                            </a>
                        </td>
                        <td> <?= $r['sid'] ?> </td>
                        <td> <?= $r['name'] ?> </td>
                        <td> <?= $r['email'] ?> </td>
                        <td> <?= $r['mobile'] ?> </td>
                        <td> <?= $r['birthday'] ?> </td>
                        <td> <?= $r['address'] ?> </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
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
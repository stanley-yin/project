<?php include __DIR__ . '/partials/init.php'; ?>

<?php include __DIR__ . '/partials/html-head.php' ?>
<?php include __DIR__ . '/partials/navbar.php' ?>

<?php

// 搜尋列表
$keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';
$where = 'WHERE 1 ';            
if (!empty($keyword)) {
    $where .= sprintf(" AND `sid` LIKE %s ", $pdo->quote('%'. $keyword. '%'));
    $qs['keyword'] = $keyword;
}



// 查詢資料庫中所有訂單資訊
$sql = sprintf("SELECT * FROM `order_list` %s ORDER BY `order_list`.`sid` DESC",$where);
$rows = $pdo->query($sql)->fetchAll();



?>
<style>
    th,
    td {
        text-align: center;
    }
</style>

<div class="container">
    <div class="row justify-content-center pt-3">
        <form action="order-list.php" class="form-inline my-2 my-lg-0 d-flex justify-content-end">
            <input class="form-control mr-sm-2" type="search" name="keyword" placeholder="輸入訂單編號" + value="<?= htmlentities($keyword) ?>" + aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
    </div>
</div>
<div class="list">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">訂單編號</th>
                <th scope="col">會員編號</th>
                <th scope="col">訂單總金額</th>
                <th scope="col">付款方式</th>
                <th scope="col">送貨方式</th>
                <th scope="col">收件人姓名</th>
                <th scope="col">收件人電話</th>
                <th scope="col">收件人地址</th>
                <th scope="col">訂單狀態</th>
                <th scope="col">訂單日期</th>
                <th scope="col">查看詳細內容</th>
                <th scope="col">修改訂單資訊</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rows as $r) : ?>
                <tr>
                    <td> <?= $r['sid'] ?> </td>
                    <td> <?= $r['member_id'] ?> </td>
                    <td> $<?= $r['amount'] ?> </td>
                    <td> <?= $r['payment'] ?> </td>
                    <td> <?= $r['delivery'] ?> </td>
                    <td> <?= $r['addressee_name'] ?> </td>
                    <td> <?= $r['mobile'] ?> </td>
                    <td> <?= $r['address'] ?> </td>
                    <td> <?= $r['status'] ?> </td>
                    <td> <?= $r['order_date'] ?> </td>
                    <td> <a href="order-details.php?sid=<?= $r['sid'] ?>">詳細內容</a> </td>
                    <td>
                        <a href="order-edit.php?sid=<?= $r['sid'] ?>"><i class="fas fa-edit"></i></a>
                        <span>&nbsp; / &nbsp;</span>

                        <!-- onclick 刪除前二次確認 -->
                        <a href="order-delete.php?sid=<?php echo $r['sid'] ?>" onclick="return confirm('確定要刪除編號為 <?= $r['sid'] ?> 的資料嗎?')"><i class="fas fa-trash-alt"></i></a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
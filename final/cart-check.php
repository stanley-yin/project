<?php
include __DIR__ . '/partials/init.php';


?>

<?php include __DIR__ . '/partials/html-head.php' ?>
<?php include __DIR__ . '/partials/navbar.php' ?>


<?php
if (!isset($_SESSION['shoplist'])) {
    echo "購物車沒有商品";
    exit;
}

// 計算總金額
$total = 0;
foreach ($_SESSION['shoplist'] as $s) {
    if ($s['special_offer'] == '暫無') {
        $total += $s['price'] * $s['num'];
    } else {
        $total += $s['special_offer'] * $s['num'];
    }
}
?>
<style>
    img {
        width: 100px;
        height: 100px;
    }
</style>
<!-- 購物狀態列 -->
<!-- 商品購物清單 -->
<div class="container">
    <div class="row">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">商品編號</th>
                    <th scope="col">商品圖片</th>
                    <th scope="col">商品名稱 </th>
                    <th scope="col">單件價格</th>
                    <th scope="col">商品數量</th>
                    <th scope="col">小計</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($_SESSION['shoplist'] as $s) : ?>
                    <?php $p = $s['special_offer'] == '暫無' ? $s['price'] : $s['special_offer'] ?>
                    <tr>
                        <td> <?= $s['sid'] ?> </td>
                        <td> <img src="<?= $s['image'] ?> " alt=""></td>
                        <td> <?= $s['Name'] ?> </td>
                        <td> $<?= $p ?> </td>
                        <td>
                            <a href="update.php?sid=<?= $s['sid'] ?>&num=-1"><i class="fas fa-minus"></i></a>
                            <?= $s['num'] ?>
                            <a href="update.php?sid=<?= $s['sid'] ?>&num=1"><i class="fas fa-plus"></i></a>
                        </td>
                        <td> $<?= $s['num'] * $p ?> </td>
                        <td><a href="item-delete.php?sid=<?= $s['sid'] ?>"><i class="fas fa-times"></i></a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <!-- 總total金額列 -->
            <tbody>
                <tr>
                    <td>Total</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>$<?= $total ?></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>


<!-- 送貨方式、付款方式 -->
<div class="container">
    <div class="row">
        <div class="col">
            <div class="row">
                <label for="">送貨方式</label>
                <select class="form-select" aria-label="Default select example">
                    <option selected>自取</option>
                    <option>宅配</option>
                </select>
            </div>
            <div class="row">
                <label for="">付款方式</label>
                <select class="form-select" aria-label="Default select example">
                    <option selected>信用卡</option>
                    <option>銀行轉帳</option>
                </select>
            </div>
        </div>
        <div class="col">
             <h5 class="card-title">送貨資料</h5>
            <form name="form1" onsubmit="checkForm(); return false;">
                <div class="form-group">
                    <label for="name">收件人姓名</label>
                    <input type="text" class="form-control" id="name" name="name" require>
                    <small class="form-text"></small>
                    <!-- 必填 = require -->
                </div>
                <div class="form-group">
                    <label for="email">收件人電話</label>
                    <input type="text" class="form-control" id="email" name="email" require>
                    <small class="form-text"></small>
                </div>
                <div class="form-group">
                    <label for="email">收件人地址</label>
                    <input type="text" class="form-control" id="email" name="email" require>
                    <small class="form-text"></small>
                </div>
        </div>
        <!-- 按鈕 -->
        <div class="col">
            <div class="row">
                <a href="data-list.php">
                    <button>返回商品列表</button>
                </a>
                <a href="cartdata-insert.php"><button>確認送出訂單</button></a>
            </div>
        </div>
    </div>
</div>




<?php include __DIR__ . '/partials/script.php' ?>
<?php include __DIR__ . '/partials/html-foot.php' ?>
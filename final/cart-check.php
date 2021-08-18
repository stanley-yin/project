<?php
include __DIR__ . '/partials/init.php';


?>

<?php include __DIR__ . '/partials/html-head.php' ?>
<?php include __DIR__ . '/partials/navbar.php' ?>


<?php 
 if(! isset($_SESSION['shoplist'])){
     echo "購物車沒有商品";
     exit;
 }

?>
<style>
    img{
        width: 100px;
        height: 100px;
    }
</style>

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
                    <?php $p = $s['special_offer']=='暫無'?$s['price']:$s['special_offer']?>
                    <tr>
                        <td> <?= $s['sid'] ?> </td>
                        <td> <img src="<?= $s['image']?> " alt=""></td>
                        <td> <?= $s['Name'] ?> </td>
                        <td> <?= $p ?> </td>
                        <td>
                            <a href="update.php?sid=<?= $s['sid'] ?>&num=-1"><i class="fas fa-minus"></i></a>
                            <?= $s['num'] ?>
                            <a href="update.php?sid=<?= $s['sid'] ?>&num=1"><i class="fas fa-plus"></i></a>
                        </td>
                        <td> <?= $s['num']*$p ?> </td>
                        <td><a href="delete.php?sid=<?= $s['sid']?>"><i class="fas fa-times"></i></a></td>

                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<div class="container">
    <a href="data-list.php">
        <button>返回商品列表</button>
    </a>
    <a href="cartdata-insert.php"><button>確認送出訂單</button></a>
    
</div>


<?php include __DIR__ . '/partials/script.php' ?>
<?php include __DIR__ . '/partials/html-foot.php' ?>
<?php
include __DIR__ . '/partials/init.php';


?>

<?php include __DIR__ . '/partials/html-head.php' ?>
<?php include __DIR__ . '/partials/navbar.php' ?>

<!-- 
    商品數量增減 V
    商品刪除 V
    返回上一頁按鈕 V
    確認送出串接 V
 -->
<?php 
 if(! isset($_SESSION['shoplist'])){
     echo "購物車沒有商品";
     exit;
 }

?>


<div class="container">
    <div class="row">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">name</th>
                    <th scope="col">name</th>
                    <th scope="col">email</th>
                    <th scope="col">mobile</th>
                    <th scope="col">num</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($_SESSION['shoplist'] as $s) : ?>
                    <tr>
                        <td> <?= $s['sid'] ?> </td>
                        <td> <?= $s['name'] ?> </td>
                        <td> <?= $s['email'] ?> </td>
                        <td> <?= $s['mobile'] ?> </td>
                        <td>
                            <a href="update.php?sid=<?= $s['sid'] ?>&num=-1"><i class="fas fa-minus"></i></a>
                            <?= $s['num'] ?>
                            <a href="update.php?sid=<?= $s['sid'] ?>&num=1"><i class="fas fa-plus"></i></a>
                        </td>
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
<!-- <script>
    function plus(){
        $_SESSION['shoplist'][]
    }
</script> -->
<?php include __DIR__ . '/partials/html-foot.php' ?>
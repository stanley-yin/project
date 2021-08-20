<?php  include __DIR__ . '/partials/init.php';?>

<?php include __DIR__ . '/partials/html-head.php' ?>
<?php include __DIR__ . '/partials/navbar.php' ?>

<?php 

$sql = sprintf("SELECT od.*, p.`Name`,`image` FROM `order_details` od LEFT JOIN `products` p ON od.`product_sid` = p.`sid` WHERE od.`order_sid` = %s", $_GET['sid']);
$rows = $pdo->query($sql)->fetchAll();


?>
<style>
    th,td{
        text-align: center;
    }
    img{
        width: 100px;
        height: 100px;
    }
</style>	
	
    <div class="list">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">sid</th>
                    <th scope="col">訂單編號</th>
                    <th scope="col">產品編號 </th>
                    <th scope="col">姓名 </th>
                    <th scope="col">圖片 </th>
                    <th scope="col">數量</th>
                    <th scope="col">單價</th>
                    <th scope="col">小計</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($rows as $r):?>
                    <tr>
                        <td> <?=$r['sid'] ?> </td>
                        <td> <?=$r['order_sid'] ?> </td>
                        <td> <?=$r['product_sid'] ?> </td>
                        <td> <?=$r['Name'] ?> </td>
                        <td> <img src="<?=$r['image'] ?>" alt=""></td>
                        <td> <?=$r['quantity'] ?> </td>
                        <td> <?=$r['unit_price'] ?> </td>
                        <td> <?=$r['subtotal'] ?> </td>
                    </tr>
                <?php endforeach;?>
            </tbody>
        </table>
    </div>



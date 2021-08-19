<?php  include __DIR__ . '/partials/init.php';?>

<?php include __DIR__ . '/partials/html-head.php' ?>
<?php include __DIR__ . '/partials/navbar.php' ?>

<?php 

$sql = "SELECT * FROM `order_list` ORDER BY `order_list`.`sid` DESC ";
$rows = $pdo->query($sql)->fetchAll();

?>
<style>
    th,td{
        text-align: center;
    }
</style>	
	
    <div class="list">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">sid</th>
                    <th scope="col">member_id</th>
                    <th scope="col">amount </th>
                    <th scope="col">payment</th>
                    <th scope="col">delivery</th>
                    <th scope="col">addressee_name</th>
                    <th scope="col">mobile</th>
                    <th scope="col">address</th>
                    <th scope="col">status</th>
                    <th scope="col">order_date</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($rows as $r):?>
                    <tr>
                        <td> <?=$r['sid'] ?> </td>
                        <td> <?=$r['member_id'] ?> </td>
                        <td> <?=$r['amount'] ?> </td>
                        <td> <?=$r['payment'] ?> </td>
                        <td> <?=$r['delivery'] ?> </td>
                        <td> <?=$r['addressee_name'] ?> </td>
                        <td> <?=$r['mobile'] ?> </td>
                        <td> <?=$r['address'] ?> </td>
                        <td> <?=$r['status'] ?> </td>
                        <td> <?=$r['order_date'] ?> </td>
                    </tr>
                <?php endforeach;?>
            </tbody>
        </table>
    </div>
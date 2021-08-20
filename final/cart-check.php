<?php include __DIR__ . '/partials/init.php'; ?>


<?php include __DIR__ . '/partials/html-head.php' ?>
<?php include __DIR__ . '/partials/navbar.php' ?>

<!-- 購物車沒有物品時顯現 -->
<?php if (!isset($_SESSION['shoplist']) or $_SESSION['shoplist']==[]) : ?>
    <div class="container text-center pt-5">
        <h3>購物車沒有商品</h3>
    </div>
    <?php exit; ?>
<?php endif; ?>

<?php

// 計算總金額 total
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
            <h5 class="card-title">送貨資料</h5>
            <form name="form1" onsubmit="checkForm(); return false;">
                <div class="form-group">
                    <label for="delivery">送貨方式</label>
                    <select class="form-control" aria-label="Default select example" id="delivery" name="delivery">
                        <option selected value="自取">自取</option>
                        <option value="宅配">宅配</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="payment">付款方式</label>
                    <select class="form-control" aria-label="Default select example" id="payment" name="payment">
                        <option selected value="信用卡">信用卡</option>
                        <option value="銀行轉帳">銀行轉帳</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="addressee_name">收件人姓名</label>
                    <input type="text" class="form-control" id="addressee_name" name="addressee_name">
                    <small class="form-text"></small>
                </div>
                <div class="form-group">
                    <label for="mobile">收件人電話</label>
                    <input type="text" class="form-control" id="mobile" name="mobile">
                    <small class="form-text"></small>
                </div>
                <div class="form-group">
                    <label for="address">收件人地址</label>
                    <input type="text" class="form-control" id="address" name="address">
                    <small class="form-text"></small>
                </div>
                <input type="hidden" name="total" value="<?= $total ?>">
                <button type="submit" class="btn btn-primary">送出訂單</button>
            </form>
        </div>



        <?php include __DIR__ . '/partials/script.php' ?>
        <script>
            const mobile_re = /^09\d{2}-?\d{3}-?\d{3}$/;

            const name = document.querySelector('#addressee_name');
            const mobile = document.querySelector('#mobile');

            function checkForm() {

                name.nextElementSibling.innerHTML = '';
                name.style.border = '1px solid #cccccc';
                mobile.nextElementSibling.innerHTML = '';
                mobile.style.border = '1px solid #cccccc';

                let isPass = true;
                if (name.value.length < 2) {
                    isPass = false;
                    name.nextElementSibling.innerHTML = '請填寫正確的姓名'
                    name.style.border = '1px solid red';
                }
                if (!mobile_re.test(mobile.value)) { //test() 方法执行一个检索，用来查看正则表达式与指定的字符串是否匹配。返回 true 或 false。
                    isPass = false;
                    mobile.nextElementSibling.innerHTML = '請填寫正確的手機格式'
                    mobile.style.border = '1px solid red';
                }

                if (isPass) {
                    const fd = new FormData(document.form1);
                    fetch('order-list-insert.php', {
                            method: 'POST',
                            body: fd
                        })
                        .then(r => r.json())
                        .then(obj => {
                            console.log(obj);
                            if (obj.success) {
                                alert('訂單成功送出')
                                window.location = "order-detail-insert.php";
                            } else {
                                alert(obj.error);
                            }
                        })
                        .catch(error => {
                            console.log('error', error);
                        })
                }

            }
        </script>
        <?php include __DIR__ . '/partials/html-foot.php' ?>
<?php include __DIR__ . '/partials/init.php';?>


<?php

$sql = sprintf("SELECT * FROM `order_list` WHERE `sid` = %s", $_GET['sid']);
$r = $pdo->query($sql)->fetch();

// 避免直接拜訪
if(empty($r)){
    header('Location: order-list.php');
    exit;
};
?>

<?php include __DIR__ . '/partials/html-head.php' ?>
<?php include __DIR__ . '/partials/navbar.php' ?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <div class="card-body">
                    <form class="d-flex flex-column" name="form1" onsubmit="checkForm(); return false;">
                        <div class="form-group">
                            <input type="hidden" id="sid" name="sid" value="<?=$r['sid']?>">
                            <!-- disabled 不可做變更的資料 -->
                            <div class="row">
                                <div class="col">
                                    <label for="sid">訂單編號</label>
                                    <input type="text" class="form-control" id="sid" name="sid" placeholder="<?= $r['sid'] ?>" value="<?= $r['sid'] ?>"disabled>
                                    <small class=" form-text "></small>
                                </div>
                                <div class="col">
                                    <label for="member_id">會員編號</label>
                                    <input type="text" class="form-control" id="member_id" name="member_id" placeholder="<?= $r['member_id'] ?>" disabled>
                                    <small class=" form-text "></small>
                                </div>
                                <div class="col">
                                    <label for="amount">訂單總金額</label>
                                    <input type="text" class="form-control" id="amount" name="amount" placeholder="<?= $r['amount'] ?>" disabled>
                                    <small class=" form-text "></small>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="payment">付款方式</label>
                                <select class="form-control" name="payment" id="payment">
                                    <option value="信用卡">信用卡</option>
                                    <option value="銀行轉帳">銀行轉帳</option>
                                </select>
                                <small class=" form-text "></small>
                            </div>
                            <div class="form-group">
                                <label for="delivery">送貨方式</label>
                                <select class="form-control" name="delivery" id="delivery">
                                    <option value="宅配">宅配</option>
                                    <option value="自取">自取</option>
                                </select>
                                <small class=" form-text "></small>
                            </div>
                            <div class="form-group">
                                <label for="addressee_name">收件人姓名</label>
                                <input type="text" class="form-control" id="addressee_name" name="addressee_name" value="<?= htmlentities($r['addressee_name']) ?>">
                                <small class=" form-text "></small>
                            </div>
                            <div class="form-group">
                                <label for="mobile">收件人電話</label>
                                <input type="text" class="form-control" id="mobile" name="mobile" value="<?= htmlentities($r['mobile']) ?>">
                                <small class=" form-text "></small>
                            </div>
                            <div class="form-group">
                                <label for="address">收件人地址</label>
                                <input type="text" class="form-control" id="address" name="address" value="<?= htmlentities($r['address']) ?>">
                                <small class=" form-text "></small>
                            </div>
                            <div class="form-group">
                                <label for="status">訂單狀態</label>
                                <select class="form-control" name="status" id="status">
                                    <option value="未處理">未處理</option>
                                    <option value="安排出貨">安排出貨</option>
                                    <option value="已完成">已完成</option>
                                </select>
                                <small class=" form-text "></small>
                            </div>
                            <button type="submit" class="btn btn-primary">更新</button>                          
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include __DIR__ . './partials/script.php'; ?>
<script>
    const mobile_re = /^09\d{2}-?\d{3}-?\d{3}$/;


    const an = document.querySelector('#addressee_name');
    const m = document.querySelector('#mobile');
    const a = document.querySelector('#address');

    function checkForm() {
        // // 欄位的外觀要回復原來的狀態
        an.nextElementSibling.innerHTML = '';
        an.style.border = '1px #CCCCCC solid';
        m.nextElementSibling.innerHTML = '';
        m.style.border = '1px #CCCCCC solid';
        a.nextElementSibling.innerHTML = '';
        a.style.border = '1px #CCCCCC solid';

        let isPass = true;
        if (an.value.length == '') {
            isPass = false;
            an.nextElementSibling.innerHTML = '請填寫收件人姓名';
            an.style.border = '1px red solid';
        }
        if (m.value.length == '') {
            isPass = false;
            m.nextElementSibling.innerHTML = '請填寫收件人電話';
            m.style.border = '1px red solid';
        }
        if (!mobile_re.test(m.value)) {
            isPass = false;
            m.nextElementSibling.innerHTML = '請填正確電話格式';
            m.style.border = '1px red solid';
        }
        if (a.value.length == '') {
            isPass = false;
            a.nextElementSibling.innerHTML = '請填寫送貨地址';
            a.style.border = '1px red solid';
        }

        if (isPass) {
            const fd = new FormData(document.form1);
            fetch('order-edit-api.php', {
                    method: 'POST',
                    body: fd
                })
                .then(r => r.json())
                .then(obj => {
                    console.log(obj);
                    if (obj.success) {
                        alert('修改成功');
                        location.href = 'order-list.php';
                    } else {
                        alert(obj.error);
                    }
                })
                .catch(error => {
                    console.log('error:', error);
                });
        }
    }
</script>
<?php include __DIR__ . './partials/html-foot.php'; ?>
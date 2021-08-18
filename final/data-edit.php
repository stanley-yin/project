<?php
include __DIR__ . "./partials/database.php";

$sid = isset($_GET['sid']) ? intval($_GET['sid']) : 0;


// 根據sid查到當前商品是哪一個
$sql = "SELECT * FROM `products` WHERE `sid` = $sid";


$r = $pdo->query($sql)->fetch();

// 如果資料為空，就轉到列表頁
if (empty($r)) {
    header('Location: data-list.php');
    exit;
}

?>

<?php
include __DIR__ . './partials/html-head.php';
?>

<style>
    form {
        width: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    h2 {
        text-align: center;
        margin: 20px 0;
        font-weight: 900;
    }

    .form-group {
        width: 80%;
    }
</style>
<h2>更新商品訊息</h2>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">

            <div class="card">
                <div class="card-body">
                    <form class="d-flex flex-column" name="form1" onsubmit="checkForm(); return false;">
                        <div class="form-group">
                            <label for="sid">商品編號</label>
                            <input type="text" class="form-control" id="sid" name="sid" value="<?php echo htmlentities($r['sid']); ?>" placeholder="商品編號">
                            <small class=" form-text "></small>
                        </div>
                        <div class="form-group">
                            <label for="N">商品名稱</label>
                            <input type="text" class="form-control" id="N" name="N" value="<?php echo htmlentities($r['Name']); ?>" placeholder="商品名稱">
                            <small class=" form-text "></small>
                        </div>
                        <div class=" form-group">
                            <label for="cs">商品類別編號</label>
                            <input type="text" class="form-control" id="cs" name="cs" value="<?php echo htmlentities($r['categories_sid']); ?>" placeholder="商品類別編號">
                            <small class="form-text "></small>
                        </div>
                        <div class="form-group">
                            <label for="img">商品圖片</label>
                            <input type="text" class="form-control" id="img" name="img" value="<?php echo htmlentities($r['image']); ?>" placeholder="商品圖片">
                            <small class="form-text "></small>
                        </div>
                        <div class="form-group">
                            <label for="L">對應的身體部位</label>
                            <input type="text" class="form-control" id="L" name="L" value="<?php echo htmlentities($r['Location']); ?>" placeholder="對應的身體部位">
                            <small class="form-text "></small>
                        </div>
                        <div class="form-group">
                            <label for="n">商品成分 / 商品材質</label>
                            <input type="text" class="form-control" id="n" name="n" value="<?php echo htmlentities($r['nutrient']); ?>" placeholder="商品成分 / 商品材質">
                            <small class="form-text "></small>
                        </div>
                        <div class="form-group">
                            <label for="c">品牌 / 製造公司</label>
                            <input type="text" class="form-control" id="c" name="c" value="<?php echo htmlentities($r['brand_company']); ?>" placeholder="品牌 / 製造公司">
                            <small class="form-text "></small>
                        </div>
                        <div class="form-group">
                            <label for="q">內容量 / 規格</label>
                            <input type="text" class="form-control" id="q" name="q" value="<?php echo htmlentities($r['quantity']); ?>" placeholder="內容量 / 規格">
                            <small class="form-text "></small>
                        </div>
                        <div class="form-group">
                            <label for="p">商品價格</label>
                            <input type="text" class="form-control" id="p" name="p" value="<?php echo htmlentities($r['price']); ?>" placeholder="商品價格">
                            <small class="form-text "></small>
                        </div>
                        <div class="form-group">
                            <label for="sp">特惠價</label>
                            <input type="text" class="form-control" id="sp" name="sp" value="<?php echo htmlentities($r['special offer']); ?>" placeholder="特惠價">
                            <small class="form-text "></small>
                        </div>
                        <div class="form-group">
                            <label for="EM">使用方法</label>
                            <input type="text" class="form-control" id="EM" name="EM" value="<?php echo htmlentities($r['Edible_Method']); ?>" placeholder="使用方法">
                            <small class="form-text "></small>
                        </div>
                        <div class="form-group">
                            <label for="po">產地</label>
                            <input type="text" class="form-control" id="po" name="po" value="<?php echo htmlentities($r['place_origin']); ?>" placeholder="產地">
                            <small class="form-text "></small>
                        </div>
                        <div class="form-group">
                            <label for="EXP">保存期限</label>
                            <input type="text" class="form-control" id="EXP" name="EXP" value="<?php echo htmlentities($r['EXP']); ?>" placeholder="保存期限">
                            <small class="form-text "></small>
                        </div>
                        <div class="form-group">
                            <label for="MFD">製造日期</label>
                            <input type="text" class="form-control" id="MFD" name="MFD" value="<?php echo htmlentities($r['MFD']); ?>">
                            <small class="form-text "></small>
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
    const N = document.querySelector('#N');
    const cs = document.querySelector('#cs');

    function checkForm() {
        // 欄位的外觀要回復原來的狀態
        N.nextElementSibling.innerHTML = '';
        N.style.border = '1px #CCCCCC solid';
        cs.nextElementSibling.innerHTML = '';
        cs.style.border = '1px #CCCCCC solid';

        let isPass = true;
        if (N.value.length == '') {
            isPass = false;
            N.nextElementSibling.innerHTML = '請填寫商品名稱';
            N.style.border = '1px red solid';
        }
        if (cs.value.length == '') {
            isPass = false;
            cs.nextElementSibling.innerHTML = '請填寫商品類別編號';
            cs.style.border = '1px red solid';
        }

        if (isPass) {
            const fd = new FormData(document.form1);
            fetch('data-edit-api.php', {
                    method: 'POST',
                    body: fd
                })
                .then(r => r.json())
                .then(obj => {
                    console.log(obj);
                    if (obj.success) {
                        alert('修改成功');
                        location.href = 'data-list.php';
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
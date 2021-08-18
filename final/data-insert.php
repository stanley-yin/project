<?php
include __DIR__ . './partials/init.php';
?>

<?php
include __DIR__ . './partials/html-head.php';
?>
<style>
    h2 {
        text-align: center;
        margin: 20px 0;
        font-weight: 900;
    }

    form {
        width: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    .form-group {
        width: 80%;
    }

    form .form-group small {
        color: red;
    }
</style>

<h2>新增商品</h2>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <div class="card-body">
                    <form class="d-flex flex-column" name="form1" onsubmit="checkForm(); return false;">
                        <div class="form-group">
                            <label for="N">商品名稱</label>
                            <input type="text" class="form-control" id="N" name="N">
                            <small class="form-text "></small>
                        </div>
                        <div class="form-group">
                            <label for="cs">商品類別編號</label>
                            <input type="text" class="form-control" id="cs" name="cs">
                            <small class="form-text "></small>
                        </div>
                        <div class="form-group">
                            <label for="img">商品圖片</label>
                            <input type="text" class="form-control" id="img" name="img">
                            <small class="form-text "></small>
                        </div>
                        <div class="form-group">
                            <label for="L">對應的身體部位</label>
                            <input type="text" class="form-control" id="L" name="L">
                            <small class="form-text "></small>
                        </div>
                        <div class="form-group">
                            <label for="n">商品成分 / 商品材質</label>
                            <input type="text" class="form-control" id="n" name="n">
                            <small class="form-text "></small>
                        </div>
                        <div class="form-group">
                            <label for="c">品牌 / 製造公司</label>
                            <input type="text" class="form-control" id="c" name="c">
                            <small class="form-text "></small>
                        </div>
                        <div class="form-group">
                            <label for="q">內容量 / 規格</label>
                            <input type="text" class="form-control" id="q" name="q">
                            <small class="form-text "></small>
                        </div>
                        <div class="form-group">
                            <label for="p">商品價格</label>
                            <input type="text" class="form-control" id="p" name="p">
                            <small class="form-text "></small>
                        </div>
                        <div class="form-group">
                            <label for="sp">特惠價</label>
                            <input type="text" class="form-control" id="sp" name="sp" value="$">
                            <small class="form-text "></small>
                        </div>
                        <div class="form-group">
                            <label for="EM">使用方法</label>
                            <input type="text" class="form-control" id="EM" name="EM">
                            <small class="form-text "></small>
                        </div>
                        <div class="form-group">
                            <label for="po">產地</label>
                            <input type="text" class="form-control" id="po" name="po">
                            <small class="form-text "></small>
                        </div>
                        <div class="form-group">
                            <label for="EXP">保存期限</label>
                            <input type="text" class="form-control" id="EXP" name="EXP">
                            <small class="form-text "></small>
                        </div>
                        <div class="form-group">
                            <label for="MFD">製造日期</label>
                            <input type="text" class="form-control" id="MFD" name="MFD">
                            <small class="form-text "></small>
                        </div>

                        <button type="submit" class="btn btn-primary">新增</button>
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
            fetch('data-insert-api.php', {
                    method: 'POST',
                    body: fd
                })
                .then(r => r.json())
                .then(obj => {
                    console.log(obj);
                    if (obj.success) {
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
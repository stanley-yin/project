<?php include __DIR__ . "./partials/html-head.php"; ?>

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

<h2>查詢商品</h2>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">

            <div class="card">
                <div class="card-body">
                    <form action="data-select-api.php" method="post" class="d-flex flex-column" name="form1;">
                        <div class="form-group">
                            <label for="N">請輸入商品名稱</label>
                            <input type="text" class="form-control" id="N" name="N">
                            <small class="form-text "></small>
                        </div>
                        <!-- <div class="form-group">
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
                        </div> -->

                        <button type="submit" class="btn btn-primary">查詢</button>
                    </form>


                </div>
            </div>
        </div>
    </div>
</div>


<?php include __DIR__ . "./partials/script.php"; ?>

<?php include __DIR__ . "./partials/html-foot.php"; ?>
<style>
    i.fas.fa-trash-alt {
        color: rgba(240, 52, 52, 1);
    }

    .instruction {
        color: #000;
    }

    .special-offer {
        color: red;
        font-size: 20px;
        font-weight: 700;
    }
</style>
<table class="table" cellspacing="0" width="800px">
    <thead class="thead-dark">
        <tr>
            <th scope="col">
                <i class="fas fa-cart-plus"></i>
            </th>
            <th>sid<br>(商品編號)</th>
            <th>Name<br>(商品名稱)</th>
            <th>categories_sid<br>(商品類別編號)</th>
            <th>image<br>(商品圖片)</th>
            <th>Location<br>(對應的身體部位)</th>
            <th>nutrient<br>(商品成分 / 商品材質)</th>
            <th>brand_company<br>(品牌 / 製造公司)</th>
            <th>quantity<br>(內容量 / 規格)</th>
            <th>price<br>(商品價格)</th>
            <th>special offer<br>(特惠價)</th>
            <th>Edible_Method <br>(使用方法)</th>
            <th>place_origin<br>(產地)</th>
            <th>EXP<br>(保存期限)</th>
            <th>MFD<br>(製造日期)</th>
            <th>ship / return<br>(運送 / 退貨)</th>
            <th>edit&nbsp;/&nbsp;delete<br>(編輯&nbsp;/&nbsp;刪除)</th>
        </tr>
    </thead>
    <tbody>

        <?php foreach ($rows as $r) : ?>
            <tr>              
                <!-- 加入購物車的按鈕 -->
                <td>
                    <a href="addcart.php?sid=<?= $r['sid'] ?>">
                        <i class="fas fa-cart-plus"></i>
                    </a>
                </td>
                <td><?php echo $r["sid"]; ?> </td>
                <td><?php echo $r["Name"]; ?> </td>
                <td><?php echo $r["categories_sid"]; ?> </td>
                <td><img src="<?php echo $r["image"]; ?> " alt=""></td>
                <td><?php echo $r["Location"]; ?></td>
                <td><?php echo $r["nutrient"]; ?></td>
                <td><?php echo $r["brand_company"]; ?></td>
                <td><?php echo $r["quantity"]; ?></td>
                <td><?php echo '$' . $r["price"]; ?></td>
                <td class="special-offer"><?php echo  $r["special_offer"]; ?></td>
                <td><?php echo $r["Edible_Method"]; ?></td>
                <td><?php echo $r["place_origin"]; ?></td>
                <td><?php echo $r["EXP"]; ?></td>
                <td><?php echo $r["MFD"]; ?></td>
                <td><?php echo '<a href="ship-return.html" class="instruction">請參照此處</a>'; ?></td>
                <td>
                    <a href="data-edit.php?sid=<?php echo $r["sid"] ?>"><i class="fas fa-edit"></i></a>
                    <span>&nbsp; / &nbsp;</span>

                    <!-- onclick 刪除前二次確認 -->
                    <a href="data-delete.php?sid=<?php echo $r['sid'] ?>" onclick="return confirm('確定要刪除編號為 <?= $r['sid'] ?> 的資料嗎?')"><i class="fas fa-trash-alt"></i></a>
                </td>
            </tr>
            <!-- 循環的結束位置放在商品下面 -->
        <?php endforeach; ?>
    </tbody>
</table>


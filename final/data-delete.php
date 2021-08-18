<?php

include __DIR__ . '/partials/init.php';

// 判斷是否有給sid，沒給就是0，不做
$sid = isset($_GET['sid']) ? intval($_GET['sid']) : 0;
// empty — 檢查一個變量是否為空
if (!empty($sid)) {
    $sql = "DELETE FROM `products` WHERE sid=$sid";
    $stmt = $pdo->query($sql);
}

// 刪除檔案後，會馬上再跳回該分頁
// $_SERVER['HTTP_REFERER'] 從哪個頁面傳過來的
// 不一定有資料
if (isset($_SERVER['HTTP_REFERER'])) {
    header('Location: ' . $_SERVER['HTTP_REFERER']);
} else {
    header('Location: data-list.php');
}

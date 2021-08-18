<?php 
session_start();

$users = [
    'stanley' => [
        'pw' => '123',
        'nickname' => '丹利'
    ],
    'puhsin' => [
        'pw' => '456',
        'nickname' => '璞',
    ],
];

$output = [
    'success' => false,
    'error' => '',
    'code' => 0,
];


if (! isset($users[$_POST['account']])){
    $output['error'] = '帳號錯誤';
    $output['code'] = 401;
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}
$userData = $users[$_POST['account']];
if($_POST['password'] !== $userData['pw']){
    $output['error'] = '密碼錯誤';
    $output['code'] = 405;
}else{
    $output['success'] = true;
    $output['code'] = 200;

    $_SESSION['user'] = [
        'account' => $_POST['account'],
        'nickname' => $userData['nickname'],
    ];
};

echo json_encode($output, JSON_UNESCAPED_UNICODE);




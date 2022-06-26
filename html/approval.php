<?php
//パスワード認証
if (isset($_POST['pw'])){
    $password = $_POST['pw'];
}
if($password != '1050'){
    header('Content-Type: text/plain; charset=UTF-8', true);
    exit("このページへのアクセス権限がありません\n$password");
}

if (isset($_GET['id'])){
    $id = $_GET['id'];
}else{
    header('Content-Type: text/plain; charset=UTF-8', true, 500);
    exit("URLの異常です");
}

try {
    //PDOオブジェクトの生成
    $pdo = new PDO('mysql:dbname=s2111609;host=localhost;charset=utf8mb4', 's2111609', 'hogehoge', [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

    $sql = "UPDATE seminar SET approval=1 WHERE id=?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
}catch (PDOException $e) {
    header('Content-Type: text/plain; charset=UTF-8', true, 500);
    exit($e->getMessage());
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>送信</title>
    </head>
    <body>
        <h1>送信に成功しました。</h1>
        <h2>正常に承認されました</h2>
        <a href="index.html">トップへ戻る</a>
    </body>
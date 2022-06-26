<?php
if (isset($_GET['id'])){
    $id = $_GET['id'];
}else{
    header('Content-Type: text/plain; charset=UTF-8', true, 500);
    exit("URLの異常です");
}

try{
    //PDOオブジェクトの生成
    $pdo = new PDO('mysql:dbname=s2111609;host=localhost;charset=utf8mb4', 's2111609', 'hogehoge', [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

    $sql = "DELETE FROM seminar WHERE id=?";
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
        <h2>正常に削除されました</h2>
        <a href="index.html">トップへ戻る</a>
    </body>
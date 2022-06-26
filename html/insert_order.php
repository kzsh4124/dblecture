<?php

try{
    if(isset($_POST['title'])){
        $title = $_POST['title'];
    }
    if(isset($_POST['subject'])){
        $subject = $_POST['subject'];
    }
    if(isset($_POST['status'])){
        $status = $_POST['status'];

    }
    if(isset($_POST['day'])){
        $day = $_POST['day'];
    }
    if(isset($_POST['time'])){
        $time = $_POST['time'];
    }else{
        $time=NULL;
    }
    if($time == ''){
        $time = NULL;
    }
    if(isset($_POST['content'])){
        $content = $_POST['content'];
    }else{
        $content = '';
    }
    $values = [$title, $subject, $status, $day, $time, $content];

    $pdo = new PDO('mysql:dbname=s2111609;host=localhost;charset=utf8mb4', 's2111609', 'hogehoge', [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $sql = "INSERT INTO seminar (name, subject, status, day, start_time, content, approval) values (?,?,?,?,?,?,0)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute($values);

}catch(PDOException $e){
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
        <h2>承認されるまでしばらくお待ち下さい</h2>
    </body>
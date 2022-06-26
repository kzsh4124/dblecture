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
?>




<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>ゼミ更新フォーム</title>
    </head>
    <body>
        <h1>ゼミ更新フォーム</h1>
        <form method="post" action="<?= 'update.php?id=',$id ?>">
            <div>
                タイトル <input type="text" name="title" required> ※必須
            </div>
            <div>
                教科
                <select name="subject" placeholder="選択してください" required>
                    <option value="">選択してください</option>
                    <option value="0">情報科学</option>
                    <option value="1">文学</option>
                    <option value="2">言語学</option>
                    <option value="3">社会学</option>
                    <option value="4">数学</option>
                    <option value="5">天文学</option>
                    <option value="6">物理学</option>
                    <option value="7">地学</option>
                    <option value="8">化学</option>
                    <option value="9">工学</option>
                    <option value="10">生物学</option>
                    <option value="11">医学</option>
                    <option value="12">獣医学</option>
                    <option value="13">音楽</option>
                    <option value="14">その他</option>
                </select>
                ※必須
            <div>
                開催状況
                <select name="status" required>
                    <option value="">選択してください</option>
                    <option value="0">準備中</option>
                    <option value="1">開催中</option>
                    <option value="2">休止中</option>
                    <option value="3">終了</option>
                </select>
                ※必須
            </div>
            <div>
                曜日
                <select name="day">
                    <option value="">選択してください</option>
                    <option value="月曜日">月曜日</option>
                    <option value="火曜日">火曜日</option>
                    <option value="水曜日">水曜日</option>
                    <option value="木曜日">木曜日</option>
                    <option value="金曜日">金曜日</option>
                    <option value="土曜日">土曜日</option>
                    <option value="日曜日">日曜日</option>
                </select>
            <div>
                開始時刻
                <input type="time" name="time" placeholder="hh:mm">
            </div>
            <div>
                <label for="content">説明</label><br>
                <textarea id="content" name="content" rows="3" cols="40" placeholder="ゼミの概要を簡単に記述"></textarea>
            </div>
            <input type="hidden" name="pw" value="<?= $password ?>">
            <input type="submit" name="submit">
        </form>
    </body>
</html>
<?php
//ログイン認証
$password = $_POST['pw'];

if($password != '1050'){
    header('Content-Type: text/plain; charset=UTF-8', true);
    exit("このページへのアクセス権限がありません\n$password");
}

try{

    //PDOオブジェクトの生成
    $pdo = new PDO('mysql:dbname=s2111609;host=localhost;charset=utf8mb4', 's2111609', 'hogehoge', [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

    //selecterの生成
    $selecter =<<<"EOT"
    SELECT
    se.id AS se_id,
    se.name AS se_name,
    se.difficulty AS se_diff,
    se.day AS se_day,
    se.start_time AS se_time,
    se.content AS se_content,
    st.name AS st_name,
    ty.name AS ty_name,
    su.name AS su_name
    FROM seminar AS se
    LEFT JOIN status AS st ON se.status = st.status_id
    LEFT JOIN type AS ty ON se.type = ty.type_id
    LEFT JOIN subject AS su ON se.subject = su.subject_id
    LEFT JOIN keyword AS kw ON se.id = kw.seminar_id
    EOT;


    //承認システム select ... from  ... where approval = 0
    //承認待ちを表示$rows_waitに入れる
    $sql=$selecter.' WHERE approval = 0';
    $stmt = $pdo->query($sql);
    $rows_wait = $stmt->fetchAll();



    //変更システム
    //全件取得
    $sql = $selecter;
    $stmt = $pdo->query($sql);
    $rows_all = $stmt->fetchAll();

}catch (PDOException $e) {
    header('Content-Type: text/plain; charset=UTF-8', true, 500);
    exit($e->getMessage());
}
?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8">
        <title>管理者画面</title>
    </head>
    <body>
        <h1>管理者画面</h1>
        <h2>承認待ち</h2>
        <table border="1">
            <tr>
                <td>id</td>
                <td>ゼミ名</td>
                <td>曜日</td>
                <td>時間</td>
                <td>開催状況</td>
                <td>教科</td>
                <td>概要</td>
                <td>承認ボタン</td>
            </tr>
<?php foreach ($rows_wait as $row): ?>
            <tr>
                <td><?=h($row['se_id'])?></td>
                <td><?=h($row['se_name'])?></td>
                <td><?=h($row['se_day'])?> </td>
                <td><?=h($row['se_time'])?> </td>
                <td><?=h($row['st_name'])?> </td>
                <td><?=h($row['su_name'])?> </td>
                <td><?=h($row['se_content']) ?></td>
                <td><a href="<?='approval.php?id=',$row['se_id']?>">承認</a></td>
            </tr>
<?php endforeach; ?>
        <h2>変更、削除</h2>
        <tr>
                <td>id</td>
                <td>ゼミ名</td>
                <td>曜日</td>
                <td>時間</td>
                <td>開催状況</td>
                <td>教科</td>
                <td>概要</td>
                <td>変更</td>
            </tr>
<?php foreach ($rows_all as $row): ?>
            <tr>
                <td><?=h($row['se_id'])?></td>
                <td><?=h($row['se_name'])?></td>
                <td><?=h($row['se_day'])?> </td>
                <td><?=h($row['se_time'])?> </td>
                <td><?=h($row['st_name'])?> </td>
                <td><?=h($row['su_name'])?> </td>
                <td><?=h($row['se_content']) ?></td>
                <td><a href="<?='update.php?id=',$row['se_id']?>">変更</a></td>
                <td><a href="<?='delete.php?id=',$row['se_id']?>">削除</a></td>
<?php endforeach; ?>
        </table>
    </body>
</html>

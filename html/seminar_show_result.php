<?php



try {
    //POSTの変数をチェックして受け取り
    // キーワードを入力(任意の文字列)
    if(isset($_POST['word'])){
        $word = $_POST['word'];
    }
    //曜日を入力(月曜日~日曜日という文字列または空文字列)
    if(isset($_POST['day'])){
        $day = $_POST['day'];
    }
    // subjectを入力(0~14という文字列または空文字列)
    if(isset($_POST['subject'])){
        $subject = $_POST['subject'];
    }
    // rangeを入力(keyword)
    if(isset($_POST['range']) && is_array($_POST['range']) ){
        $range = $_POST['range'];
    }
    //PDOオブジェクトの生成
    $pdo = new PDO('mysql:dbname=s2111609;host=localhost;charset=utf8mb4', 's2111609', 'hogehoge', [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    //プレースホルダの動的な生成
    //select列と結合の設定
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
    
    // where句の動的生成

    // $holders: 条件式のプレースホルダ $values: ?にセットする値

    // 承認されているか
    $holders[] = 'se.approval = 1';
    // ワード検索
    if($word != ''){
        $word_querry = 'se.name LIKE ?';
        $values[] = '%'. addcslashes($word, '\_%') .'%';
        if(in_array('keyword', $range, true)){
            $word_querry.= ' OR kw.keyword LIKE ?';
            $values[] = '%'. addcslashes($word, '\_%') .'%';
        }
        $word_querry = "( $word_querry )";
        $holders[]= $word_querry;
    }

    //曜日検索
    if($day !=''){
        $holders[] = 'se.day = ?';
        $values[] = $day;
    }

    //教科検索
    if($subject != ''){
        $holders[] = 'se.subject = ?';
        $values[] = (int) $subject;
    }

    // 連結
    if($holders){
        $sql = $selecter . ' WHERE (' . implode(' AND ', $holders) . ')';
    }else{
        $sql = $selecter;
    }
    $sql.= 'GROUP BY se.id';

    // クエリの実行
    $stmt = $pdo->prepare($sql);
    $stmt->execute($values);
    $rows = $stmt->fetchAll();

    //例外処理
} catch (PDOException $e) {
    header('Content-Type: text/plain; charset=UTF-8', true, 500);
    exit($e->getMessage());
}

function h($str)
{
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

header('Content-Type: text/html; charset=utf-8');
?>


<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8">
        <title>Example</title>
    </head>
    <body>
        <h1>検索結果</h1>
        <table border="1">
            <tr>
                <td>id</td>
                <td>ゼミ名</td>
                <td>曜日</td>
                <td>時間</td>
                <td>開催状況</td>
                <td>教科</td>
                <td>概要</td>
            </tr>
<?php foreach ($rows as $row): ?>
            <tr>
                <td><?=h($row['se_id'])?></td>
                <td><?=h($row['se_name'])?></td>
                <td><?=h($row['se_day'])?> </td>
                <td><?=h($row['se_time'])?> </td>
                <td><?=h($row['st_name'])?> </td>
                <td><?=h($row['ty_name'])?> </td>
                <td><?=h($row['su_name'])?> </td>
                <td><?=h($row['se_content']) ?></td>
            </tr>
<?php endforeach; ?>
        </table>
    </body>
</html>

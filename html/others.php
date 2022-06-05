<html>
    <head><title>others.php</title></head>
    <body>
        <?php
        // サーバー接続
        $mysqli = new mysqli('localhost', 's2111609', 'hogehoge', 's2111609');
        if ($mysqli->connect_error) {
            echo $mysqli->connect_error;
            exit();
        } else {
            $mysqli->set_charset("utf8");
        }
        //table status
        echo '<table border="1">';
        $sql = "SELECT * FROM status";
        $res = $mysqli->query($sql);
        print("<tr>");
        for( $i = 0; $i < $res->field_count; $i++ ){
            print( "<td>".$res->fetch_field_direct($i)->name."</td>" );
        }
        print("</tr>");
        while($row = $res->fetch_array()) {
            print("<tr>");
            for( $i = 0; $i < $res->field_count; $i++ ){
            print( "<td>".$row[$i]."</td>" );
        }
        print("</tr>");
        }
        echo "</table>";

        //table type
        echo '<table border="1">';
        $sql = "SELECT * FROM type";
        $res = $mysqli->query($sql);
        print("<tr>");
        for( $i = 0; $i < $res->field_count; $i++ ){
            print( "<td>".$res->fetch_field_direct($i)->name."</td>" );
        }
        print("</tr>");
        while($row = $res->fetch_array()) {
            print("<tr>");
            for( $i = 0; $i < $res->field_count; $i++ ){
            print( "<td>".$row[$i]."</td>" );
        }
        print("</tr>");
        }
        echo "</table>";

        //table subject
        echo '<table border="1">';
        $sql = "SELECT * FROM subject";
        $res = $mysqli->query($sql);
        print("<tr>");
        for( $i = 0; $i < $res->field_count; $i++ ){
            print( "<td>".$res->fetch_field_direct($i)->name."</td>" );
        }
        print("</tr>");
        while($row = $res->fetch_array()) {
            print("<tr>");
            for( $i = 0; $i < $res->field_count; $i++ ){
            print( "<td>".$row[$i]."</td>" );
        }
        print("</tr>");
        }
        echo "</table>";
        $mysqli->close();
        ?>
    <br>
    keyword: 未実装(実装するかは要検討)
    <br>
    member, belong: 実装予定なし(理由: 実用的にはdiscordでのOAuth認証が必要なので授業内では実装しない)
    <a href="index.html">トップへ戻る</a>
    </body>
</html>

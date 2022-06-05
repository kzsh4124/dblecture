<html>
    <head><title>seminar.php</title></head>
    <body>
    <table border="1">
        <?php
        $mysqli = new mysqli('localhost', 's2111609', 'hogehoge', 's2111609');
        if ($mysqli->connect_error) {
            echo $mysqli->connect_error;
            exit();
        } else {
            $mysqli->set_charset("utf8");
        }
        $sql = "SELECT * FROM seminar";
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
        exit();
        ?>
    </table>
    <br>
    <a href="index.html">トップへ戻る</a>
    </body>
</html>

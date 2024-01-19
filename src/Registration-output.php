<?php require 'db-connect.php'?>
<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
    <button onclick="location.href='index.php'">TOPへ戻る</button>
<?php
    $pdo=new PDO($connect,USER,PASS);
    $sql=$pdo->prepare('insert into Book values(?,?,?,?)');
    if(empty($_POST['sname'])){
        echo '書籍名を入力して下さい。';
    }
    else if(empty($_POST['tname'])){
        echo '著者名を入力して下さい。';
    }
    else if(empty($_POST['tname'])){
        echo '著者名を入力して下さい。';
    }
    else if(empty($_POST['sid'])){
        echo '書籍IDを入力して下さい。';
    }
    else if($sql->execute([$_POST['sid'],$_POST['sname'],$_POST['tname'],$_POST['genre']])){
        echo '<font color="">追加に成功しました。</font>';
    }
    else{
        echo '<font color="">追加に失敗しました。</font>';
    }
?>
    <br><hr><br>
    <table>
    <tr><th>書籍ID</th><th>書籍名</th><th>ジャンル名</th><th>著者名</th></tr>
<?php
    foreach($pdo->query('select * from Book as b inner join Category as c on b.genreID = c.genreID') as $row){
        echo '<tr>';
        echo '<td>', $row['bookID'], '</td>';
        echo '<td>', $row['bookName'], '</td>';
        echo '<td>', $row['genreName'], '</td>';
        echo '<td>', $row['authorName'], '</td>';
        echo '</tr>';
        echo "\n";
    }
?>
</table>
    </body>
</html>
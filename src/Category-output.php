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
    $sql=$pdo->prepare('insert into Category values(?,?)');
    if(empty($_POST['gname'])){
        echo 'ジャンル名を入力して下さい。';
    }
    else if(empty($_POST['gid'])){
        echo 'ジャンルIDを入力して下さい。';
    }
    else if($sql->execute([$_POST['gid'],$_POST['gname']])){
        echo '<font color="">追加に成功しました。</font>';
    }
    else{
        echo '<font color="">追加に失敗しました。</font>';
    }
?>
    <br><hr><br>
    <table>
    <tr><th>ジャンルID</th><th>ジャンル名</th></tr>
<?php
    foreach($pdo->query('select * from Category') as $row){
        echo '<tr>';
        echo '<td>', $row['genreID'], '</td>';
        echo '<td>', $row['genreName'], '</td>';
        echo '</tr>';
        echo "\n";
    }
?>
    </table>
    </body>
</html>
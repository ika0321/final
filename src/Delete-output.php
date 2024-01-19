<?php require 'db-connect.php'?>

<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="UTF-8">
		<title>delete</title>
	</head>
	<body>
<?php
    $pdo=new PDO($connect, USER, PASS);
    $sql=$pdo->prepare('delete from Book where bookID=?');
    if($sql->execute([$_POST['sid']])){
        echo '削除に成功しました。';
    }
    else{
        echo '削除に失敗しました。';
    }
?>
    <br><hr><br>
	<table>
    <tr><th>書籍ID</th><th>書籍名</th><th>ジャンル名</th><th>著者名</th></tr>
<?php
    foreach ($pdo->query('select * from Book as b inner join Category as c on b.genreID = c.genreID') as $row) {
        echo '<tr>';
        echo '<td>', $row['bookID'], '</td>';
        echo '<td>', $row['bookName'], '</td>';
        echo '<td>', $row['genreName'], '</td>';
        echo '<td>', $row['authorName'], '</td>';
        echo '<td>';
        echo '</tr>';
        echo "\n";
    }
?> 
    </table>
        <button onclick="location.href='index.php'">TOPへ戻る</button>
    </body>
</html>
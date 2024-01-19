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
    $pdo=new PDO($connect, USER, PASS);
    $sql=$pdo->prepare('update Book set bookName=?,authorName=?,genreID=? where BookID=?');
    if (empty($_POST['sname'])) {
        echo '書籍名を入力してください。';
    } 
    if (empty($_POST['aname'])) {
        echo '著者名を入力してください。';
    }
    
    if($sql->execute([htmlspecialchars($_POST['sname']),$_POST['aname'],$_POST['genre'],$_POST['sid']])){
        echo '更新に成功しました。';
    }
    else{
        echo '更新に失敗しました。';
    }
    
?>
        <hr>
        <table>
        <tr><th>書籍ID</th><th>書籍名</th><th>ジャンル名</th><th>著者名</th></tr>

<?php
foreach ($pdo->query('select * from Book as b inner join Category as c on b.genreID = c.genreID') as $row) {
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
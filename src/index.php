<?php require 'db-connect.php'?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>書籍管理システム</title>
    <link rel="stylesheet" href="css/index.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.9.0/css/bulma.min.css"/>
  </head>
  <body>
    <div id="app" class="container">
      <div class="columns is-mobile is-centered">
        <div class="column is-half">
          <h1 class="title is-3">書籍管理</h1>

          <div class="tabs is-centered">
            <ul>
              <li :class="{'is-active':acitiveRegistration}">
                <a @click="changeTab(1)">新規登録</a>
              </li>
              <li :class="{'is-active':acitiveUpdate}">
                <a @click="changeTab(2)">更新</a>
              </li>
              <li :class="{'is-active':acitiveDelete}">
                <a @click="changeTab(3)">削除</a>
              </li>
              <li :class="{'is-active':acitiveCategory}">
                <a @click="changeTab(4)">カテゴリ登録</a>
              </li>
            </ul>
          </div>

          <div v-if="acitiveRegistration" class="field">
          <form action="Registration-output.php" method="post">
          <?php
          echo '<p>';
          echo '書籍ID：<input type="number" name="sid"><br>';
          echo '書籍名：<input type="text" name="sname"><br>';
          echo '著者名：<input type="text" name="tname"><br>';
          $pdo=new PDO($connect, USER, PASS);
	        $sql=$pdo->prepare('select * from Book as b inner join Category as c on b.genreID = c.genreID');
          $sql->execute();
          echo 'ジャンル名：';
          echo '<select name="genre">';
          foreach ($sql as $row){
          echo '<option value = "',$row['genreID'],'">',$row['genreName'],'</option>';
          }
          echo '</select>','<br>';
          echo '<input type="submit" value="登録">','<br>';
          echo '</p>';
          ?>
          </form>
          <?php
          $pdo=new PDO($connect, USER, PASS);
	        $sql=$pdo->prepare('select * from Book as b inner join Category as c on b.genreID = c.genreID');
          $sql->execute();
          if($sql->rowCount()>0){
            echo '<table>';
            echo '<tr><th>書籍ID</th><th>書籍名</th><th>ジャンル名</th><th>著者名</th></tr>';
            foreach($sql as $row){
                echo '<tr>';
                echo '<td>',$row['bookID'],'</td>';
                echo '<td>',$row['bookName'],'</td>';
                echo '<td>',$row['genreName'],'</td>';
                echo '<td>',$row['authorName'],'</td>';
                echo '</tr>';
                echo "\n";
            }
            echo '</table>';
          }
          else{
            echo '<p>登録されているデータがありません。</p>';
          }
          ?>
          </div>

          <div v-if="acitiveUpdate" class="field">
          <form action="index.php" method="post">
          <?php
          echo '<p>','ID：','<input type="number" name="sid">','</p>','<br>';
          ?>
          </form>
          <form action="Update-output.php" method="post">
          <?php
          if(isset($_POST['sid'])){
          $pdo=new PDO($connect, USER, PASS);
	        $sql=$pdo->prepare('select * from Book as b inner join Category as c on b.genreID = c.genreID where bookID=?');
	        $sql->execute([$_POST['sid']]);
	        foreach ($sql as $row){
          echo '<p>';
          echo '書籍ID：','<input type="number" name="sid" value="',$row['bookID'],'">','<br>';
		      echo '書籍名：','<input type="text" name="sname" value="', $row['bookName'], '">','<br>';
          echo '著者名：','<input type="text" name="aname" value="', $row['authorName'], '">','<br>';
          echo 'ジャンル名：';
		      echo '<select name="genre">';
          echo '<option value = "',$row['genreID'],'">',$row['genreName'],'</option>';
	          }
          echo '</select>','<br>';
          echo '<input type="submit" value="更新">','<br>';
          echo '</p>';
          }
          ?>
          </form>
          <?php
          $pdo=new PDO($connect, USER, PASS);
	        $sql=$pdo->prepare('select * from Book as b inner join Category as c on b.genreID = c.genreID');
          $sql->execute();
          if($sql->rowCount()>0){
            echo '<table>';
            echo '<tr><th>書籍ID</th><th>書籍名</th><th>ジャンル名</th><th>著者名</th></tr>';
            foreach($sql as $row){
                echo '<tr>';
                echo '<td>',$row['bookID'],'</td>';
                echo '<td>',$row['bookName'],'</td>';
                echo '<td>',$row['genreName'],'</td>';
                echo '<td>',$row['authorName'],'</td>';
                echo '</tr>';
                echo "\n";
            }
            echo '</table>';
          }
          else{
            echo '<p>登録されているデータがありません。</p>';
          }
          ?>
          </div>

          <div v-if="acitiveDelete" class="field">
          <form action="Delete-output.php" method="post">
            書籍ID：<input type="number" name="sid"><br>
          <button type="submit">削除</button>
          </form>
          <?php
          $pdo=new PDO($connect, USER, PASS);
	        $sql=$pdo->prepare('select * from Book as b inner join Category as c on b.genreID = c.genreID');
          $sql->execute();
          if($sql->rowCount()>0){
            echo '<table>';
            echo '<tr><th>書籍ID</th><th>書籍名</th><th>ジャンル名</th><th>著者名</th></tr>';
            foreach($sql as $row){
                echo '<tr>';
                echo '<td>',$row['bookID'],'</td>';
                echo '<td>',$row['bookName'],'</td>';
                echo '<td>',$row['genreName'],'</td>';
                echo '<td>',$row['authorName'],'</td>';
                echo '</tr>';
                echo "\n";
            }
            echo '</table>';
          }
          else{
            echo '<p>登録されているデータがありません。</p>';
          }
          ?>
          </div>

          <div v-if="acitiveCategory" class="field">
          <form action="Category-output.php" method="post">
            ジャンルID：<input type="number" name="gid"><br>
            ジャンル名：<input type="text" name="gname"><br>
          <button type="submit">登録</button>
          </form>
          <?php
          $pdo=new PDO($connect, USER, PASS);
	        $sql=$pdo->prepare('select * from Category');
          $sql->execute();
          if($sql->rowCount()>0){
            echo '<table>';
            echo '<tr><th>ジャンルID</th><th>ジャンル名</th></tr>';
            foreach($sql as $row){
                echo '<tr>';
                echo '<td>',$row['genreID'],'</td>';
                echo '<td>',$row['genreName'],'</td>';
                echo '</tr>';
                echo "\n";
            }
            echo '</table>';
          }
          else{
            echo '<p>登録されているデータがありません。</p>';
          }
          ?>
          </div>
          </div>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.min.js"></script>
    <script src="script/app.js"></script>
  </body>
</html>
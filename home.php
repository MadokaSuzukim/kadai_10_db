<?php
// 最初にSESSIONを開始！！
session_start();
error_reporting(E_ALL); 
ini_set('display_errors', '1');

// echo '<pre>';
// var_dump($_SESSION['name']);
// echo '</pre>';
include("funcs.php");
ini_set('display_errors', 1);
// データベース接続
$pdo = db_conn();
$sql = "SELECT * FROM children";
$stmt = $pdo->prepare($sql);
$status = $stmt->execute();

//３．データ表示
$values = "";
if($status==false) {
  sql_error($stmt);
}
//全データ取得
$values = $stmt->fetchAll(PDO::FETCH_ASSOC);
$json = json_encode($values, JSON_UNESCAPED_UNICODE);

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>ホームページ</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

  <style>div{padding: 10px;font-size:16px;}</style>
  <style>
    body {
      font-family: 'Arial', sans-serif;
      background-color: #f8f9fa;
      margin: 0;
      padding: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }
    header {
      text-align: center;
      margin-bottom: 20px;
    }
    .container {
      background-color: white;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      padding: 20px;
      width: 300px;
    }
    fieldset {
      border: none;
    }
    legend {
      text-align: center;
      font-size: 24px;
      margin-bottom: 20px;
    }
    label {
      display: block;
      margin-bottom: 10px;
    }
    input[type="text"], input[type="password"] {
      width: 100%;
      padding: 8px;
      border-radius: 4px;
      border: 1px solid #ccc;
    }
    input[type="submit"] {
      width: 100%;
      padding: 10px;
      border-radius: 4px;
      background-color: #007bff;
      color: white;
      border: none;
      cursor: pointer;
    }
    input[type="submit"]:hover {
      background-color: #0056b3;
    }
  </style>
</head>
<body>
<header>
</header>
<main>
  <div class="container">
  <?php
    if (isset($_SESSION['name'])) {
        $name = $_SESSION['name'];
    } else {
        $name = 'ゲスト';
    }
    echo $name . 'さん、こんにちは！<br>';
    echo "こちらはホーム画面です。<br>";
    echo "何か新しいことを始めましょう。";
    include("menu.php");
    ?> 
    <h2>登録キッズ一覧</h2>
    <!-- <?php foreach($values as $v){ ?>
        <tr>
          <td><?=h($v["id"])?></td>
          <td><?=h($v["name"])?></td>
          <td><?=h($v["nickname"])?></td>
          <td><?=h($v["birthdate"])?></td>
          <td><?=h($v["gender"])?></td>
          <td><?=h($v["likes"])?></td>
          <td><a href="detail.php?id=<?=h($v["id"])?>">更新</a></td>
          <td><a href="delete.php?id=<?=h($v["id"])?>">削除</a></td>
        </tr>
      <?php } ?> -->
    <a class="navbar-brand" href="index.php">新規キッズデータ登録</a>
      </div>
    </div>
  </nav>
</header>
<!-- Head[End] -->


<!-- Main[Start] -->
<div>
    <div class="container jumbotron">

      </table>
    <!-- <a class="navbar-brand" href="index.php">データ登録画面へ</a> -->
    <a class="navbar-brand" href="dialy.php">キッズ別記録記載画面</a>
    <div class="navbar-header"><a class="navbar-brand" href="count.php">お子様登録データ分布参照</a></div>
    <!-- <div><?= $view ?></div> -->
  </div>
</main>
</body>
</html>

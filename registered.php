<?php
session_start();
error_reporting(E_ALL); 
ini_set('display_errors', '1');
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>登録完了</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>div{padding: 10px;font-size:16px;}</style>
  <style>
    .navbar .container-fluid {
      display: flex;
      justify-content: center;
    }
    .navbar-header {
      float: none;
    }
    /* ここから追加のスタイル */
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 20px;
      background-color: #f8f9fa;
    }
    h1 {
      text-align: center;
    }
    .container {
      background-color: white;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
      padding: 20px;
      max-width: 600px;
      margin: 20px auto;
    }
    .navbar-brand {
      margin: 0 auto;
    }
    .nav-link {
      margin-right: 10px;
    }
  </style>
</head>
<body>
<header>
  <!-- ヘッダーコンテンツ -->
</header>

<main>
  <h1>登録が完了しました！</h1>
 
  <div class="container">
  <?php
    if (isset($_SESSION['name'])) {
        $name = $_SESSION['name'];
    }
    echo $name . 'さん、こんにちは！';
    ?> <br>

    <?= $nickname['nickname'] ?>ちゃんの情報を登録しました。<br>

    <a href="home.php" class="navbar-brand">ホームへ戻る</a>
  </div>
</main>
</body>
</html>

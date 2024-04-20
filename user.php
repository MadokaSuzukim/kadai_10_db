<?php
session_start();
include "funcs.php";
$pdo = db_conn();
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  

  <title>USERデータ登録</title>
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

<!-- <header>
    <?php echo $_SESSION["name"]; ?>さん　 -->
<!-- </header> --> 

<!-- Main[Start] -->
<form method="post" action="user_insert.php">
  <div class="jumbotron">
   <fieldset>
    <legend>ユーザー登録</legend>
    <?php
    if (isset($_SESSION['name'])) {
        $name = $_SESSION['name'];
    } else {
        $name = 'ゲスト';
    }
    echo $name . 'さん、こんにちは！<br>こちらからご登録をお願いいたします';
    ?>
     <label>名前<input type="text" name="name" required></label><br>
     <label>ユーザーID: メールアドレスを入力<input type="email" name="username" required></label><br>
     <label>パスワード: 6桁以上の英数字<input type="password" name="password" minlength="6" required></label><br>
     <label>登録区分：
      無料<input type="radio" name="kanri_flg" value="0" required>　
      有料<input type="radio" name="kanri_flg" value="1" required>
    </label><br>
     <!-- <label>退会FLG：<input type="text" name="life_flg"></label><br> -->
     <input type="submit" value="送信">
    </fieldset>
  </div>
</form>



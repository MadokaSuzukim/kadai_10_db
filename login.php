<?php
session_start();
error_reporting(E_ALL); 
ini_set('display_errors', '1');

//※htdocsと同じ階層に「includes」を作成してfuncs.phpを入れましょう！
//include "../../includes/funcs.php";
include "funcs.php"
?>

<!DOCTYPE html>
<head>
<meta charset="UTF-8">
<html lang="ja">
<meta name="viewport" content="width=device-width">
<!-- <link rel="stylesheet" href="css/main.css" /> -->
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
<!-- <title>ログイン</title> -->

</head>
<body>

<!-- lLOGINogin_act.php は認証処理用のPHPです。 -->
<form name="form1" action="login_act.php" method="post">

<legend>ログイン画面</legend>
<?php
    if (isset($_SESSION['name'])) {
        $name = $_SESSION['name'];
    } else {
        $name = 'ゲスト';
    }
    echo $name . 'さん、こんにちは！';
    ?> <br>
    <nav class="navbar navbar-default">登録したユーザーID,パスワードを入力してください。</nav>

ユーザーID:<input type="email" name="username">
パスワード:<input type="password" name="password">
<input type="submit" value="ログイン">
</form>

</body>
</html>
<?php


?>

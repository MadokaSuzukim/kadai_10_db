<!-- login.php -->
<?php
error_reporting(E_ALL); 
ini_set('display_errors', '1');

session_start();

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
<style>div{padding: 10px;font-size:16px;}</style>
<title>ログイン</title>
</head>
<body>
<header>
    <?php echo $_SESSION["name"]; ?>さん、こんにちは！
    <nav class="navbar navbar-default">LOGINログイン</nav>
    <!-- <?php include("menu.php"); ?> -->
</header>
    <h2>ログイン</h2>
    <!-- <form action="login_act.php" method="POST">
        ユーザー名: <input type="text" name="username" required><br>
        パスワード: <input type="password" name="password" required><br>
        <input type="submit" value="ログイン">
    </form>
</body>
</html> -->
<!-- lLOGINogin_act.php は認証処理用のPHPです。 -->
<form name="form1" action="login_act.php" method="post">
ユーザー名（ID）:<input type="text" name="username">
パスワード（PW）:<input type="password" name="password">
<input type="submit" value="ログイン">
</form>

</body>
</html>
<?php


?>

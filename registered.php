<?php
session_start();
error_reporting(E_ALL); 
ini_set('display_errors', '1');

// データベースに接続
include("funcs.php");
$pdo = db_conn();

// フォームから送られてきたデータを受け取る
//1. POSTデータ取得
$name   = $_POST["name"];
$nickname = $_POST["nickname"];
$birthdate  = $_POST["birthdate"];
$gender    = $_POST["gender"];
$likes = $_POST["likes"];
$parent_id = $_POST['parent_id'];


//3．データ登録SQL作成
// SQL文を準備
$sql = "INSERT INTO children (name,nickname, birthdate,gender, likes,parent_id,indate) VALUES (:name,:nickname, :birthdate,:gender, :likes,:parent_id,sysdate())";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':name',  $name,  PDO::PARAM_STR );
$stmt->bindValue(':nickname', $nickname, PDO::PARAM_STR);
$stmt->bindValue(':birthdate', $birthdate,    PDO::PARAM_STR );
$stmt->bindValue(':gender', $gender, PDO::PARAM_STR);
$stmt->bindValue(':likes', $likes, PDO::PARAM_STR);
$stmt->bindValue(':parent_id', $parent_id, PDO::PARAM_INT);
// SQLを実行
$status = $stmt->execute();

// 登録が成功したかどうかで処理を分岐
// 登録が成功した場合
if ($status == false) {
  $error = $stmt->errorInfo();
  exit("SQL_ERROR:" . $error[2]);
} else {
  // 登録完了ページへリダイレクト
  header("Location: registered.php"); // 登録成功時は適切なページにリダイレクトする
  // エラー処理など
  exit("Error: 登録に失敗しました。");
}

// // ユーザー情報の取得
// $id = $_SESSION['id'];
// $stmt = $pdo->prepare("SELECT * FROM users WHERE id = :id");
// $stmt->bindValue(':id', $user_id, PDO::PARAM_INT);
// $stmt->execute();
// $user_info = $stmt->fetch(PDO::FETCH_ASSOC);

// // お子様情報の取得
// // お子様情報の取得
// $child_id = $_SESSION['child_id']; // セッションから child_id を取得する
// $stmt = $pdo->prepare("SELECT * FROM children WHERE id = :id");
// $stmt->bindValue(':id', $child_id, PDO::PARAM_INT);
// $stmt->execute();
// $child_info = $stmt->fetch(PDO::FETCH_ASSOC);
// ?>

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

    <?= $user_info['name'] ?>さん、こんにちは！<br>
    <?= $child_info['name'] ?>ちゃんの情報を登録しました。<br>

    <a href="home.php" class="navbar-brand">ホームへ戻る</a>
  </div>
</main>
</body>
</html>

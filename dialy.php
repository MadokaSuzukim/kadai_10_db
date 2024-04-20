<?php
session_start();
include("funcs.php");
$pdo = db_conn();

// // ユーザー情報の取得
// $user_id = $_SESSION['id'];
// $stmt = $pdo->prepare("SELECT * FROM users WHERE id = :id");
// $stmt->bindValue(':id', $user_id, PDO::PARAM_INT);
// $stmt->execute();
// $user_info = $stmt->fetch(PDO::FETCH_ASSOC);

// // お子様情報の取得
// $child_id = $_SESSION['child_id'];
// $stmt = $pdo->prepare("SELECT * FROM children WHERE id = :id");
// $stmt->bindValue(':id', $child_id, PDO::PARAM_INT);
// $stmt->execute();
// $child_info = $stmt->fetch(PDO::FETCH_ASSOC);
// ?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>育児日記の入力</title>
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
    form {
      display: flex;
      flex-direction: column;
    }
    input[type="date"],
    input[type="time"],
    input[type="file"],
    textarea,
    input[type="submit"] {
      margin: 10px 0;
    }
    label {
      margin-top: 20px;
      margin-bottom: 5px;
      font-weight: bold;
    }
    input[type="submit"] {
      background-color: #007bff;
      color: white;
      border: none;
      padding: 10px;
      cursor: pointer;
      border-radius: 5px;
    }
    input[type="submit"]:hover {
      background-color: #0056b3;
    }
  </style>
</head>
<body>

<header>
  <!-- ヘッダーコンテンツ -->
</header>

<main>
  <h1>今日も育児お疲れ様！</h1>

  <div class="container">
    <?= $child_info['name'] ?>ちゃんは、今日どんな様子だった？<br>

    <form method="POST" action="dialy.php" enctype="multipart/form-data">
      <input type="hidden" name="child_id" value="<?= $child_id ?>">
      <label>日付：<input type="date" name="entry_date" required></label><br>
      <label>今日の様子：<textarea name="content" rows="4" cols="40" required></textarea></label><br>
      <input type="submit" value="送信">
    </form>
  </div>
</main>
</body>
</html>

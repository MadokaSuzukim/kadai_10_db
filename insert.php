<?php
session_start();
include("funcs.php");
$pdo = db_conn();

//1. POSTデータ取得
$name   = $_POST["name"];
$nickname = $_POST["nickname"];
$birthdate  = $_POST["birthdate"];
$gender    = $_POST["gender"];
$likes = $_POST["likes"];

//3．データ登録SQL作成
$sql = "INSERT INTO children (name,nickname, birthdate,gender, likes,indate) VALUES (:name,:nickname, :birthdate,:gender, :likes,sysdate())";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':name',  $name,  PDO::PARAM_STR );
$stmt->bindValue(':nickname', $nickname, PDO::PARAM_STR);
$stmt->bindValue(':birthdate', $birthdate,    PDO::PARAM_STR );
$stmt->bindValue(':gender', $gender, PDO::PARAM_STR);
$stmt->bindValue(':likes', $likes, PDO::PARAM_STR);
$status = $stmt->execute();

// 登録が成功した場合
if($status==true){
  // 登録完了ページへリダイレクト
  header("Location: registered.php");
  exit;
}else{
  // エラー処理など
  exit("Error: 登録に失敗しました。");
}
?>

<?php
session_start();
error_reporting(E_ALL); 
ini_set('display_errors', '1');


if (!isset($_SESSION['parent_id'])) {
  echo "エラー: 親のIDが見つかりません。もう一度ログインしてください。";
  exit;
}



// フォームから送られてきたデータを受け取る
//1. POSTデータ取得
$name   = $_POST["name"];
$nickname = $_POST["nickname"];
$birthdate  = $_POST["birthdate"];
$gender    = $_POST["gender"];
$likes = $_POST["likes"];
$parent_id = $_POST['parent_id'];

// 2.データベースに接続
include("funcs.php");
$pdo = db_conn();

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
?>
<?php
// 最初にSESSIONを開始！！
session_start();
echo '<pre>';
var_dump($_SESSION['id']);
echo '</pre>';

// データベース接続
include("funcs.php");
$pdo = db_conn();

// ログインしているユーザーIDに基づいてchildrenテーブルからデータを取得する
// $view = "ログインしていません。"; // 初期状態では「ログインしていません」と表示
if(isset($_SESSION['id'])) {
    $stmt = $pdo->prepare("SELECT * FROM children WHERE id = :id");
    $stmt->bindValue(':id', $_SESSION['id'], PDO::PARAM_INT);
    $status = $stmt->execute();

    if($status==false) {
        // SQL実行時にエラーがある場合
        $error = $stmt->errorInfo();
        exit("SQL ERROR:".$error[2]);
    } else {
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (empty($results)) {
            // データが存在しない場合の処理
            $view = '<p>登録されているこどもの情報がありません。</p>';
            $view .= '<a href="index.php" class="btn btn-primary">こどもの情報を登録</a>';
        } else {
            // データが存在する場合の処理
            foreach($results as $result){
                $view .= '<p>';
                $view .= '名前：'.h($result['name']).' ';
                $view .= 'ニックネーム：'.h($result['nickname']).' ';
                $view .= '生年月日：'.h($result['birthdate']).' ';
                $view .= '性別：'.h($result['gender']).' ';
                $view .= '好きなこと：'.h($result['likes']);
                $view .= '</p>';
            }
        }
    }
} else {
    $view = "ログインしていません。";
}

// HTMLエスケープ関数
function h($str) {
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>登録データ一覧</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.php">データ登録画面へ</a>
    </div>
  </nav>
</header>
<main>
  <div class="container">
    <h2>登録データ一覧</h2>
    <a class="navbar-brand" href="index.php">データ登録画面へ</a>
    <a class="navbar-brand" href="dialy.php">日記記載画面へ</a>

    <div><?= $view ?></div>
  </div>
</main>
</body>
</html>

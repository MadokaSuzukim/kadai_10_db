<!-- 1 初回登録画面 -->
<?php
//最初にSESSIONを開始！！ココ大事！！
session_start();
error_reporting(E_ALL); 
ini_set('display_errors', '1');

// ログイン成功時
$_SESSION['userID'] = $fetchedid; // ログイン処理中に取得したユーザーのID
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>データ登録</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>div{padding: 10px;font-size:16px;}</style>
  <style>
  .navbar .container-fluid {
    display: flex;
    justify-content: center;
  }
  .navbar-header {
    float: none;
    text-align: center;
}
  
</style>
<nav class="navbar navbar-default">
</head>
<body>
<!-- Head[Start] -->
<header>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- <div class="navbar-header"> -->
      <a class="navbar-brand" href="select.php">こども登録フォーム</a>
    </div>
  </div>
</nav>

<!-- Head[End] -->

<!-- Main[Start] -->
<main>
  <div class="container">
  <?php
    if (isset($_SESSION['name'])) {
        $name = $_SESSION['name'];
    } else {
        $name = 'ゲスト';
    }
    echo $name . 'さん、こんにちは！<br>';
    echo "こちらはお子様情報登録画面です。<br>";
    echo "既にお子様情報を登録されている場合は、登録キッズ一覧よりお進みください。";
    ?>
    <h2>お子様の情報を登録してください</h2>
    <p>以下のフォームにお子様の情報を入力してください。</p>
    <form method="POST" action="registered.php">
      <div class="mb-3">
        <label for="name" class="form-label">名前：</label>
        <input type="text" class="form-control" id="name" name="name" required>
      </div>
      <div class="mb-3">
        <label for="nickname" class="form-label">ニックネーム：</label>
        <input type="text" class="form-control" id="nickname" name="nickname" required>
      </div>
      <div class="mb-3">
        <label for="birthdate" class="form-label">生年月日：</label>
        <input type="date" class="form-control" id="birthdate" name="birthdate" required>
      </div>
      <div class="mb-3">
        <label for="gender" class="form-label">性別：</label>
        <select class="form-select" id="gender" name="gender">
          <option value="male">男性</option>
          <option value="female">女性</option>
          <option value="other">その他</option>
        </select>
      </div>
      <div class="mb-3">
        <label for="likes" class="form-label">好きなこと：</label>
        <textarea class="form-control" id="likes" name="likes" rows="4"></textarea>
        <!-- 以下は親のユーザーIDをセッションから取得する例です -->
    <input type="hidden" name="parent_id" value="<?= $_SESSION['id'] ?>">
      </div>
      <button type="submit" class="btn btn-primary">送信</button>
    </form>
  </div>
</main>

<!-- Main[End] -->
<!-- 
<div class="navbar-header"><a class="navbar-brand" href="count.php">登録データ分布参照</a></div>
<div class="navbar-header"><a class="navbar-brand" href="select.php">登録データ一覧参照</a></div> -->

</body>
</html>

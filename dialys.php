<!-- 日記登録画面 -->
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start(); // セッションを開始

$uploadsDir = '/Applications/XAMPP/xamppfiles/htdocs/php/kadai_08_db/uploads';
if (!is_dir($uploadsDir)) {
    mkdir($uploadsDir, 0777, true);
}


// 1.POSTデータ取得
$date = $_POST['entry_date'];
$content = $_POST['content'];
// $photo = $_FILES['photo_path'];
// if (is_uploaded_file($_FILES['pic']['tmp_name'])) {
//     $originalName = basename($_FILES['pic']['name']); // 画像ファイルの元の名前を取得
//     $extension = pathinfo($originalName, PATHINFO_EXTENSION); // 画像ファイルの拡張子を取得
//     $uniqueName = time() . "." . $extension; // 一意のファイル名を生成（ここではタイムスタンプを使用
//     $pic = 'uploads/' . $uniqueName; // 保存先のパスを生成
//     move_uploaded_file($_FILES['pic']['tmp_name'], $pic); // 画像ファイルを指定したパスに移動
// }
// $child_id = $_POST["child_id"];
$entry_date = $_POST["entry_date"];
$content = $_POST["content"];
// $photo_path = $_POST["photo_path"];



// 2.データベース接続
include("funcs.php");
$pdo = db_conn();



// // 写真のアップロード処理（例として、写真を "uploads" ディレクトリに保存）
// $uploadDir = 'uploads/';
// $uploadFile = $uploadDir . uniqid() . "_" . basename($photo['name']); // 一意性を持たせたファイル名

// if (move_uploaded_file($photo['tmp_name'], $uploadFile)) {
//     echo "ファイルは正常にアップロードされました。\n";
// } else {
//     echo "ファイルのアップロードに失敗しました。\n";
//     exit; // 追加
// }



// セッションから子どものIDを取得し、存在しない場合は適切に処理
if (isset($_SESSION['child_id'])) {
    $id = $_SESSION['child_id'];
} else {
    // child_idが未設定の場合の処理。エラーメッセージ表示やデフォルト値の設定など
    exit('Session error: child_id is not set.');
}

// 3 データ登録SQL作成
$sql = "INSERT INTO diary_entries (child_id, date, content) VALUES (:child_id, :date, :content)";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':child_id', $id, PDO::PARAM_INT); // 修正
$stmt->bindValue(':date', $date);
$stmt->bindValue(':content', $content);
// $stmt->bindValue(':photo_path', $uploadFile);
$status = $stmt->execute();

// 4.データ登録処理後
if ($status == false) {
    $error = $stmt->errorInfo();
    exit("SQL_ERROR:" . $error[2]);
} else {
    header("Location: diary_list.php"); // 日記一覧ページへリダイレクト
}

// // 写真のアップロード処理を改善
// if ($_FILES['photo_path']['error'] === UPLOAD_ERR_OK) {
//     $uploadFile = $uploadDir . uniqid() . "_" . basename($photo['name']); // 一意性を持たせたファイル名
//     if (move_uploaded_file($photo['tmp_name'], $uploadFile)) {
//         echo "ファイルは正常にアップロードされました。\n";
//     } else {
//         exit("ファイルのアップロードに失敗しました。\n");
//     }
// } else {
//     // アップロードエラーの処理
//     exit("ファイルアップロードエラーが発生しました。\n");
// }

?>
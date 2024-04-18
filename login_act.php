<?php
error_reporting(E_ALL); 
ini_set('display_errors', '1');
//最初にSESSIONを開始！！ココ大事！！
session_start();
echo $_SESSION["username"];
echo $_SESSION["password"];

//POST値 //受け取り
$username = $_POST["username"]; //lid
$password = $_POST["password"]; //lpw

//1.  DB接続します
include("funcs.php");
$pdo = db_conn();

//2. データ登録SQL作成
//* PasswordがHash化→条件はlidのみ！！
$stmt = $pdo->prepare("SELECT * FROM gs_user_table WHERE username=:username AND life_flg=0"); 
$stmt->bindValue(':username', $username, PDO::PARAM_STR);
$status = $stmt->execute();

//3. SQL実行時にエラーがある場合STOP
if($status==false){
    sql_error($stmt);
}

//4. 抽出データ数を取得
$val = $stmt->fetch();         //1レコードだけ取得する方法
//$count = $stmt->fetchColumn(); //SELECT COUNT(*)で使用可能()


//5.該当１レコードがあればSESSIONに値を代入
//入力したPasswordと暗号化されたPasswordを比較！[戻り値：true,false]
$pw = password_verify($password, $val["password"]); //$lpw = password_hash($lpw, PASSWORD_DEFAULT);   //パスワードハッシュ化
if($pw){ 
  //Login成功時
  $_SESSION["chk_ssid"]  = session_id();
  $_SESSION["kanri_flg"] = $val['kanri_flg'];
  $_SESSION["name"]      = $val['name'];

  //Login成功時（select.phpへ）
  header("Location: registerd.php");

}else{
  //Login失敗時(login.phpへ)
  header("Location: login.php");
}

exit();



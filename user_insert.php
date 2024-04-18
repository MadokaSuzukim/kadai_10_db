<?php
//$_SESSION使うよ！
session_start();

//※htdocsと同じ階層に「includes」を作成してfuncs.phpを入れましょう！
//include "../../includes/funco.php";
include "funco.php";
$pdo = db_conn();
// sschk();

//1. POSTデータ取得
$name      = filter_input( INPUT_POST, "name" );
$username       = filter_input( INPUT_POST, "username" );
$password      = filter_input( INPUT_POST, "password" );
$kanri_flg = filter_input( INPUT_POST, "kanri_flg" );
$password      = password_hash($password, PASSWORD_DEFAULT);   //パスワードハッシュ化

//2. DB接続します
include("funcs.php");
$pdo = db_conn();

//３．データ登録SQL作成
$sql = "INSERT INTO gs_user_table(name,username,password,kanri_flg,life_flg)VALUES(:name,:username,:password,:kanri_flg,0)";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':name', $name, PDO::PARAM_STR); //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':username', $username, PDO::PARAM_STR); //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':password', $password, PDO::PARAM_STR); //Integer（数値の場合 PDO::PARAM_INT)::PARAM_STR); //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':kanri_flg', $kanri_flg, PDO::PARAM_INT); //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();

//４．データ登録処理後
if ($status == false) {
    sql_error($stmt);
} else {
    header("Location: login.php");//
    exit;
}


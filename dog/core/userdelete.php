<?php
session_start();

//DB連携
include("db_ini.php");
if(!$Link = mysqli_connect($host,$user,$pass)){
  exit("MySQL：DB接続失敗："
  .mysqli_connect_error());
}
//  文字コードの指定（クエリー送信）
if(!mysqli_query($Link,"set names 'utf8'")){
  exit("MySQL：クエリー送信失敗");
}

//  使用するDB指定
if(!mysqli_select_db($Link,$db_name)){
  exit("MySQL：DB指定失敗");
}

//ユーザのフォロー・フォロワー削除
$SQL = "delete
        from users
        where user_id = ?
         " ;

/* プリペアドステートメントを作成します */
if ($stmt = mysqli_prepare($Link,$SQL)) {

//社員コード$sid
//$sid=$_POST["shainid"];
$userid = $_GET['userid'];
/* マーカにパラメータをバインドします */
 mysqli_stmt_bind_param($stmt,"s",$userid);
//s：String、i：integer

/* クエリを実行します */
 mysqli_stmt_execute($stmt);

/* ステートメントを閉じます */
 mysqli_stmt_close($stmt);
}

//ユーザのお気に入り店舗削除
$SQL = "delete
        from users
        where user_id = ?
         " ;

/* プリペアドステートメントを作成します */
if ($stmt = mysqli_prepare($Link,$SQL)) {

//社員コード$sid
//$sid=$_POST["shainid"];
$userid = $_GET['userid'];
/* マーカにパラメータをバインドします */
 mysqli_stmt_bind_param($stmt,"s",$userid);
//s：String、i：integer

/* クエリを実行します */
 mysqli_stmt_execute($stmt);

/* ステートメントを閉じます */
 mysqli_stmt_close($stmt);
}

//ユーザテーブルの情報削除
$SQL = "delete
        from users
        where user_id = ?
         " ;

/* プリペアドステートメントを作成します */
if ($stmt = mysqli_prepare($Link,$SQL)) {

//社員コード$sid
//$sid=$_POST["shainid"];
$userid = $_GET['userid'];
/* マーカにパラメータをバインドします */
 mysqli_stmt_bind_param($stmt,"s",$userid);
//s：String、i：integer

/* クエリを実行します */
 mysqli_stmt_execute($stmt);

/* ステートメントを閉じます */
 mysqli_stmt_close($stmt);
}

//  MySQLの切断
if(!mysqli_close($Link)){
  exit("MySQL：DB切断失敗");
}
//セッション削除
session_unset();
//クッキー情報削除
if (isset($_COOKIE['email'])){
setcookie('email', '', time()-60*60*24*14*2);
setcookie('password', '',time()-60*60*24*14*2);
}
header('Location: ../');
exit();
?>

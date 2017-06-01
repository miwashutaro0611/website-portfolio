<?php
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
//チャットする相手の情報を取得
$SQL = "
SELECT user_first_name,user_second_name,pet_id
FROM users
WHERE user_id = ?
";
/* プリペアドステートメントを作成します */
if ($stmt = mysqli_prepare($Link,$SQL)) {

//部署コード$bid

/* マーカにパラメータをバインドします */

 mysqli_stmt_bind_param($stmt, "s", $friendid);

//s：String、i：integer

/* クエリを実行します */
 mysqli_stmt_execute($stmt);

/* 結果変数をバインドします */
 mysqli_stmt_bind_result($stmt,$friend_first_name,$friend_second_name,$pet_id);

/* クライアントのバッファに
結果セットを保存 */
 mysqli_stmt_store_result($stmt);

/* 値を取得します */
while(mysqli_stmt_fetch($stmt));

/* ステートメントを閉じます */
 mysqli_stmt_close($stmt);
}
//自分の情報を取得
$SQL = "
SELECT user_first_name,user_second_name
FROM users
WHERE user_id = ?
";
/* プリペアドステートメントを作成します */
if ($stmt = mysqli_prepare($Link,$SQL)) {

//部署コード$bid

/* マーカにパラメータをバインドします */

 mysqli_stmt_bind_param($stmt, "s", $myid);

//s：String、i：integer

/* クエリを実行します */
 mysqli_stmt_execute($stmt);

/* 結果変数をバインドします */
 mysqli_stmt_bind_result($stmt,$my_first_name,$my_second_name);

/* クライアントのバッファに
結果セットを保存 */
 mysqli_stmt_store_result($stmt);

/* 値を取得します */
while(mysqli_stmt_fetch($stmt));

/* ステートメントを閉じます */
 mysqli_stmt_close($stmt);
}
//チャットする友人の画像を取得する
$SQL = "
SELECT pet_image01
FROM pets
WHERE pet_id = ?
";
/* プリペアドステートメントを作成します */
if ($stmt = mysqli_prepare($Link,$SQL)) {

//部署コード$bid

/* マーカにパラメータをバインドします */

 mysqli_stmt_bind_param($stmt, "s", $pet_id);

//s：String、i：integer

/* クエリを実行します */
 mysqli_stmt_execute($stmt);

/* 結果変数をバインドします */
 mysqli_stmt_bind_result($stmt,$image);

/* クライアントのバッファに
結果セットを保存 */
 mysqli_stmt_store_result($stmt);

/* 値を取得します */
while(mysqli_stmt_fetch($stmt));

/* ステートメントを閉じます */
 mysqli_stmt_close($stmt);
}
if($image == ""){
  $image = "noimage.jpg";
}
//  MySQLの切断
if(!mysqli_close($Link)){
  exit("MySQL：DB切断失敗");
}
?>

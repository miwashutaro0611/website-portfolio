<?php
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

$SQL = "
SELECT store_janru_id,store_name,store_title,address1,address2,store_tel,store_kana,store_url,thusha
FROM stores
WHERE store_id = ?
";
/* プリペアドステートメントを作成します */
if ($stmt = mysqli_prepare($Link,$SQL)) {

//部署コード$bid
$store_id=$_GET["store"];

/* マーカにパラメータをバインドします */

 mysqli_stmt_bind_param($stmt, "s", $store_id);

//s：String、i：integer

/* クエリを実行します */
 mysqli_stmt_execute($stmt);

/* 結果変数をバインドします */
 mysqli_stmt_bind_result($stmt,
 	$store_janru_id,
 	$store_name,
 	$store_title,
 	$address01,
 	$address02,
 	$store_tel,
 	$store_kana,
 	$store_url,
 	$thusha
 	);

/* クライアントのバッファに
結果セットを保存 */
 mysqli_stmt_store_result($stmt);

/* 値を取得します */
mysqli_stmt_fetch($stmt);

/* ステートメントを閉じます */
 mysqli_stmt_close($stmt);
}

$SQL2 = "
SELECT store_janru_name
FROM store_janru
WHERE store_janru_id = ?
";
/* プリペアドステートメントを作成します */
if ($stmt = mysqli_prepare($Link,$SQL2)) {

/* マーカにパラメータをバインドします */

 mysqli_stmt_bind_param($stmt, "s", $store_janru_id);

//s：String、i：integer

/* クエリを実行します */
 mysqli_stmt_execute($stmt);

/* 結果変数をバインドします */
 mysqli_stmt_bind_result($stmt,
 	$store_janru_name
 	);

/* クライアントのバッファに
結果セットを保存 */
 mysqli_stmt_store_result($stmt);

/* 値を取得します */
mysqli_stmt_fetch($stmt);

/* ステートメントを閉じます */
 mysqli_stmt_close($stmt);
}

//  MySQLの切断
if(!mysqli_close($Link)){
  exit("MySQL：DB切断失敗");
}
?>
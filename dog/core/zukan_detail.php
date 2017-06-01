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
SELECT dog_janru_id,
	   dog_name,
	   dog_yurai,
	   dog_history,
	   dog_weight,
	   dog_height,
	   dog_life,
	   dog_coat,
	   dog_color,
	   dog_char,
	   dog_point,
	   dog_disease,
	   dog_pointtext
FROM dog_books
WHERE dog_book_id = ?
";
/* プリペアドステートメントを作成します */
if ($stmt = mysqli_prepare($Link,$SQL)) {

//部署コード$bid
$dog_id=$_GET["dog"];

/* マーカにパラメータをバインドします */

 mysqli_stmt_bind_param($stmt, "s", $dog_id);

//s：String、i：integer

/* クエリを実行します */
 mysqli_stmt_execute($stmt);

/* 結果変数をバインドします */
 mysqli_stmt_bind_result($stmt,
 	$dog_janru_id,
 	$dog_name,
 	$dog_yurai,
 	$dog_history,
 	$dog_weight,
 	$dog_height,
 	$dog_life,
 	$dog_coat,
 	$dog_color,
 	$dog_char,
 	$dog_point,
 	$dog_disease,
 	$dog_pointotext
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
SELECT dog_janru_name
FROM dog_janru
WHERE dog_janru_id = ?
";
/* プリペアドステートメントを作成します */
if ($stmt = mysqli_prepare($Link,$SQL2)) {

/* マーカにパラメータをバインドします */

 mysqli_stmt_bind_param($stmt, "s", $dog_janru_id);

//s：String、i：integer

/* クエリを実行します */
 mysqli_stmt_execute($stmt);

/* 結果変数をバインドします */
 mysqli_stmt_bind_result($stmt,
 	$dog_janru_name
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
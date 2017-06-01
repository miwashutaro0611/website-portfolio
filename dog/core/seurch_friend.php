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

$ken_result = "";
$size_result = "";
$janru_result = "";
//ken=0&store_janru=0
if(isset($_POST["friend_seurch"])){

	if($_POST["ken"] != 0){
		$kenSQL = "
		SELECT prefecture_name
		FROM prefectures
		WHERE prefecture_id = ?
		";
		/* プリペアドステートメントを作成します */
		if ($stmt = mysqli_prepare($Link,$kenSQL)) {

		//部署コード$bid
		$seurch_ken = $_POST["ken"];
		/* マーカにパラメータをバインドします */

		 mysqli_stmt_bind_param($stmt, "s", $seurch_ken);

		//s：String、i：integer

		/* クエリを実行します */
		 mysqli_stmt_execute($stmt);

		/* 結果変数をバインドします */
		 mysqli_stmt_bind_result($stmt,$ken_result);

		/* クライアントのバッファに
		結果セットを保存 */
		 mysqli_stmt_store_result($stmt);

		/* 値を取得します */
		while(mysqli_stmt_fetch($stmt));

		/* ステートメントを閉じます */
		 mysqli_stmt_close($stmt);
		}
	}

	if($_POST["dog_size"] != 0){
		$dogSQL = "
		SELECT dog_janru_name
		FROM dog_janru
		WHERE dog_janru_id = ?
		";
		/* プリペアドステートメントを作成します */
		if ($stmt = mysqli_prepare($Link,$dogSQL)) {

		$seurch_size = $_POST["dog_size"];
		 mysqli_stmt_bind_param($stmt, "s", $seurch_size);
		//s：String、i：integer

		/* クエリを実行します */
		 mysqli_stmt_execute($stmt);

		/* 結果変数をバインドします */
		 mysqli_stmt_bind_result($stmt,$size_result);

		/* クライアントのバッファに
		結果セットを保存 */
		 mysqli_stmt_store_result($stmt);

		/* 値を取得します */
		while(mysqli_stmt_fetch($stmt));

		/* ステートメントを閉じます */
		 mysqli_stmt_close($stmt);
		}
	}

	if($_POST["dog_janru"] != 0){
		$dog2SQL = "
		SELECT dog_name
		FROM dog_books
		WHERE dog_book_id = ?
		";
		/* プリペアドステートメントを作成します */
		if ($stmt = mysqli_prepare($Link,$dog2SQL)) {

		$seurch_janru = $_POST["dog_janru"];
		 mysqli_stmt_bind_param($stmt, "s", $seurch_janru);
		//s：String、i：integer

		/* クエリを実行します */
		 mysqli_stmt_execute($stmt);

		/* 結果変数をバインドします */
		 mysqli_stmt_bind_result($stmt,$janru_result);

		/* クライアントのバッファに
		結果セットを保存 */
		 mysqli_stmt_store_result($stmt);

		/* 値を取得します */
		while(mysqli_stmt_fetch($stmt));

		/* ステートメントを閉じます */
		 mysqli_stmt_close($stmt);
		}
	}
}

if($ken_result == "" && $size_result == "" && $janru_result == ""){
	$ken_result = "全国";
}

//  MySQLの切断
if(!mysqli_close($Link)){
  exit("MySQL：DB切断失敗");
}
?>
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
$store_result = "";

if(isset($_GET["store_seurch"]) || isset($_GET["ken"]) || isset($_GET["store_janru"])){

	if(isset($_GET["ken"]) && $_GET["ken"] != 0){
		$kenSQL = "
		SELECT prefecture_name
		FROM prefectures
		WHERE prefecture_id = ?
		";
		/* プリペアドステートメントを作成します */
		if ($stmt = mysqli_prepare($Link,$kenSQL)) {

		//部署コード$bid
		$seurch_ken = $_GET["ken"];
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

	if(isset($_GET["store_janru"]) && $_GET["store_janru"] != 0){
		$dogSQL = "
		SELECT store_janru_name
		FROM store_janru
		WHERE store_janru_id = ?
		";
		/* プリペアドステートメントを作成します */
		if ($stmt = mysqli_prepare($Link,$dogSQL)) {

		$seurch_store = $_GET["store_janru"];
		 mysqli_stmt_bind_param($stmt, "s", $seurch_store);
		//s：String、i：integer

		/* クエリを実行します */
		 mysqli_stmt_execute($stmt);

		/* 結果変数をバインドします */
		 mysqli_stmt_bind_result($stmt,$store_result);

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

if($ken_result == "" && $store_result == ""){
	$ken_result = "全国";
}

//  MySQLの切断
if(!mysqli_close($Link)){
  exit("MySQL：DB切断失敗");
 }
?>
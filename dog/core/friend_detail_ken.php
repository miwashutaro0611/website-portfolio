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
if($dogken != 0){
	$SQL = "
	SELECT prefecture_name
	FROM prefectures
	WHERE prefecture_id = ?
	";
	/* プリペアドステートメントを作成します */
	if ($stmt = mysqli_prepare($Link,$SQL)) {

	/* マーカにパラメータをバインドします */

	 mysqli_stmt_bind_param($stmt, "s", $dogken);

	//s：String、i：integer

	/* クエリを実行します */
	 mysqli_stmt_execute($stmt);

	/* 結果変数をバインドします */
	 mysqli_stmt_bind_result($stmt,$kenname);

	/* クライアントのバッファに
	結果セットを保存 */
	 mysqli_stmt_store_result($stmt);

	/* 値を取得します */
	mysqli_stmt_fetch($stmt);

	/* ステートメントを閉じます */
	 mysqli_stmt_close($stmt);
	}
}else{
	$kenname = "未入力";
}
//  MySQLの切断
if(!mysqli_close($Link)){
  exit("MySQL：DB切断失敗");
}
?>
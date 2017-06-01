<?php
//処理限定のphp
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
		//sql2
		$SQL = "
		SELECT md_name
		FROM mail_domain
		";

		/* プリペアドステートメントを作成します */
		if ($stmt = mysqli_prepare($Link,$SQL)) {
		 mysqli_stmt_execute($stmt);

		/* 結果変数をバインドします */
		 mysqli_stmt_bind_result($stmt,
		 	$mail_domain
		 	);

		/* クライアントのバッファに
		結果セットを保存 */
		 mysqli_stmt_store_result($stmt);

		/* 値を取得します */
		while(mysqli_stmt_fetch($stmt)){
		  $MAIL_DOMAIN[] = $mail_domain;
		//$dbbuid,$dbbunameにデータが抜き出される
		}
		/* ステートメントを閉じます */
		 mysqli_stmt_close($stmt);
		}

//  MySQLの切断
if(!mysqli_close($Link)){
  exit("MySQL：DB切断失敗");
}


///////////////////////////////////////
//日付取得
///////////////////////////////////////

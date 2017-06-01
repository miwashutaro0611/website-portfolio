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

//ニュース情報獲得sql
$SQL1 = "
SELECT news_janru_id,news_janru_name
FROM news_janru
";
/* プリペアドステートメントを作成します */
if ($stmt = mysqli_prepare($Link,$SQL1)) {

/* クエリを実行します */
 mysqli_stmt_execute($stmt);

/* 結果変数をバインドします */
 mysqli_stmt_bind_result($stmt,
 	$news_janru_id,
 	$news_jnaru_name
 	);

/* クライアントのバッファに
結果セットを保存 */
 mysqli_stmt_store_result($stmt);

/* 値を取得します */
while(mysqli_stmt_fetch($stmt)){
  $JANRUID[] = $news_janru_id;
  $JANRUNAME[] = $news_jnaru_name;
//$dbbuid,$dbbunameにデータが抜き出される
}
//$dbbuid,$dbbunameにデータが抜き出される
/* ステートメントを閉じます */
 mysqli_stmt_close($stmt);
}
if(isset($_GET["id"])){
	//ニュース情報獲得sql(パンくず)
	$SQL1 = "
	SELECT news_janru_name
	FROM news_janru
	WHERE news_janru_id = ?
	";
	/* プリペアドステートメントを作成します */
	if ($stmt = mysqli_prepare($Link,$SQL1)) {

	 mysqli_stmt_bind_param($stmt, "s", $_GET["id"]);

	/* クエリを実行します */
	 mysqli_stmt_execute($stmt);

	/* 結果変数をバインドします */
	 mysqli_stmt_bind_result($stmt,
	 	$pan_name
	 	);

	/* クライアントのバッファに
	結果セットを保存 */
	 mysqli_stmt_store_result($stmt);

	/* 値を取得します */
	mysqli_stmt_fetch($stmt);
	//$dbbuid,$dbbunameにデータが抜き出される
	/* ステートメントを閉じます */
	 mysqli_stmt_close($stmt);
	}
}


//  MySQLの切断
if(!mysqli_close($Link)){
  exit("MySQL：DB切断失敗");
}


///////////////////////////////////////
//日付取得
///////////////////////////////////////

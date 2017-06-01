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
if(isset($_GET['janru'])){
$janru = $_GET['janru'];
$zukan1SQL = "
	SELECT dog_book_id,dog_janru_id,dog_name
	FROM dog_books
	WHERE dog_janru_id = ?
	ORDER BY dog_name
	";
	/* プリペアドステートメントを作成します */
	if ($stmt = mysqli_prepare($Link,$zukan1SQL)) {
	/* マーカにパラメータをバインドします */
 	mysqli_stmt_bind_param($stmt, "s", $janru);
	/* クエリを実行します */
	mysqli_stmt_execute($stmt);
	/* 結果変数をバインドします */
	mysqli_stmt_bind_result($stmt,
		$dog_book_id,
		$dog_janru_id,
		$dog_book_name
		);
	/* クライアントのバッファに結果セットを保存 */
	mysqli_stmt_store_result($stmt);

	/* 値を取得します */
	while(mysqli_stmt_fetch($stmt)){
		$DOG_BOOK_ID[] = $dog_book_id;
		$DOG_JANRU_ID[] = $dog_janru_id;
		$DOG_BOOK_NAME[] = $dog_book_name;
	//$dbbuid,$dbbunameにデータが抜き出される
	}
	/* ステートメントを閉じます */
	mysqli_stmt_close($stmt);
	}

}else{

$zukan1SQL = "
	SELECT dog_book_id,dog_janru_id,dog_name
	FROM dog_books
	ORDER BY dog_name
	";
	/* プリペアドステートメントを作成します */
	if ($stmt = mysqli_prepare($Link,$zukan1SQL)) {
	/* クエリを実行します */
	mysqli_stmt_execute($stmt);
	/* 結果変数をバインドします */
	mysqli_stmt_bind_result($stmt,
		$dog_book_id,
		$dog_janru_id,
		$dog_book_name
		);
	/* クライアントのバッファに結果セットを保存 */
	mysqli_stmt_store_result($stmt);

	/* 値を取得します */
	while(mysqli_stmt_fetch($stmt)){
		$DOG_BOOK_ID[] = $dog_book_id;
		$DOG_JANRU_ID[] = $dog_janru_id;
		$DOG_BOOK_NAME[] = $dog_book_name;
	//$dbbuid,$dbbunameにデータが抜き出される
	}
	/* ステートメントを閉じます */
	mysqli_stmt_close($stmt);
	}
}
for($i=0;$i<count($DOG_JANRU_ID);$i++){
		$zukan2SQL = "
		SELECT dog_janru_name
		FROM dog_janru
		WHERE dog_janru_id = ?
		";
		/* プリペアドステートメントを作成します */
		if ($stmt = mysqli_prepare($Link,$zukan2SQL)) {

		//マーカにパラメータをバインドします
		 mysqli_stmt_bind_param($stmt, "s", $DOG_JANRU_ID[$i]);

		/* クエリを実行します */
		mysqli_stmt_execute($stmt);
		/* 結果変数をバインドします */
		mysqli_stmt_bind_result($stmt,
			$dog_janru_name
			);
		/* クライアントのバッファに結果セットを保存 */
		mysqli_stmt_store_result($stmt);

		/* 値を取得します */
		while(mysqli_stmt_fetch($stmt)){
			$DOG_JANRU_NAME[] = $dog_janru_name;
		//$dbbuid,$dbbunameにデータが抜き出される
		}
		/* ステートメントを閉じます */
		mysqli_stmt_close($stmt);
		}
}
//  MySQLの切断
if(!mysqli_close($Link)){
  exit("MySQL：DB切断失敗");
 }
?>
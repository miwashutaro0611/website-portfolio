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
if(isset($_GET["id"])){
	//ユーザ情報獲得sql
	$SQL1 = "
	SELECT news_id,
		   news_janru_id,
		   news_title,
		   news_text
	FROM news
	WHERE news_janru_id = ?
	ORDER BY news_id desc
	";
	/* プリペアドステートメントを作成します */
	if ($stmt = mysqli_prepare($Link,$SQL1)) {

	mysqli_stmt_bind_param($stmt, "s", $_GET["id"]);

	/* クエリを実行します */
	 mysqli_stmt_execute($stmt);

	/* 結果変数をバインドします */
	 mysqli_stmt_bind_result($stmt,
	 	$newsid,
	 	$janruid,
	 	$title,
	 	$text
	 	);

	/* クライアントのバッファに
	結果セットを保存 */
	 mysqli_stmt_store_result($stmt);

	/* 値を取得します */
	while(mysqli_stmt_fetch($stmt)){
	  $NEWSID2[] = $newsid;
	  $JANRUID2[] = $janruid;
	  $TITLE2[] = $title;
	  $TEXT2[] = $text;
	//$dbbuid,$dbbunameにデータが抜き出される
	}
	//$dbbuid,$dbbunameにデータが抜き出される
	/* ステートメントを閉じます */
	 mysqli_stmt_close($stmt);
	}
}else{
	//ユーザ情報獲得sql
	$SQL1 = "
	SELECT news_id,
		   news_janru_id,
		   news_title,
		   news_text
	FROM news
	ORDER BY news_id desc
	";
	/* プリペアドステートメントを作成します */
	if ($stmt = mysqli_prepare($Link,$SQL1)) {

	/* クエリを実行します */
	 mysqli_stmt_execute($stmt);

	/* 結果変数をバインドします */
	 mysqli_stmt_bind_result($stmt,
	 	$newsid,
	 	$janruid,
	 	$title,
	 	$text
	 	);

	/* クライアントのバッファに
	結果セットを保存 */
	 mysqli_stmt_store_result($stmt);

	/* 値を取得します */
	while(mysqli_stmt_fetch($stmt)){
	  $NEWSID2[] = $newsid;
	  $JANRUID2[] = $janruid;
	  $TITLE2[] = $title;
	  $TEXT2[] = $text;
	//$dbbuid,$dbbunameにデータが抜き出される
	}
	//$dbbuid,$dbbunameにデータが抜き出される
	/* ステートメントを閉じます */
	 mysqli_stmt_close($stmt);
	}
}
if(isset($JANRUID2)){
	for($i=0;$i<count($JANRUID2);$i++){
		//sql2
		$SQL2 = "
		SELECT news_janru_name
		FROM news_janru
		WHERE news_janru_id = ?
		";

		/* プリペアドステートメントを作成します */
		if ($stmt = mysqli_prepare($Link,$SQL2)) {
		//ユーザ番号$id
		//$_SESSION['id'] = 2;
		//マーカにパラメータをバインドします
		 mysqli_stmt_bind_param($stmt, "s", $JANRUID2[$i]);
		//s：String、i：integer
		/* クエリを実行します */
		 mysqli_stmt_execute($stmt);

		/* 結果変数をバインドします */
		 mysqli_stmt_bind_result($stmt,
		 	$news_janru_name
		 	);

		/* クライアントのバッファに
		結果セットを保存 */
		 mysqli_stmt_store_result($stmt);

		/* 値を取得します */
		if(mysqli_stmt_fetch($stmt)){
		  $NEWS_JARNU_NAME2[] = $news_janru_name;
		//$dbbuid,$dbbunameにデータが抜き出される
		}
		/* ステートメントを閉じます */
		 mysqli_stmt_close($stmt);
		}
	}
}


//  MySQLの切断
if(!mysqli_close($Link)){
  exit("MySQL：DB切断失敗");
}


///////////////////////////////////////
//日付取得
///////////////////////////////////////

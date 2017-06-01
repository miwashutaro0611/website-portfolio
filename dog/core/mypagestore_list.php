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

//ユーザ情報獲得sql
$SQL1 = "
SELECT user_id,
	   store_id
FROM favo_store
WHERE user_id = ?
";
/* プリペアドステートメントを作成します */
if ($stmt = mysqli_prepare($Link,$SQL1)) {
//ユーザ番号$id
//$_SESSION['id'] = 2;
$id = $_SESSION['id'];
/* マーカにパラメータをバインドします */
 mysqli_stmt_bind_param($stmt, "s", $id);
//s：String、i：integer
/* クエリを実行します */
 mysqli_stmt_execute($stmt);

/* 結果変数をバインドします */
 mysqli_stmt_bind_result($stmt,
 	$favoid,
 	$storeid
 	);

/* クライアントのバッファに
結果セットを保存 */
 mysqli_stmt_store_result($stmt);

/* 値を取得します */
while(mysqli_stmt_fetch($stmt)){
  $FAVOID[] = $favoid;
  $STOREID[] = $storeid;
//$dbbuid,$dbbunameにデータが抜き出される
}
//$dbbuid,$dbbunameにデータが抜き出される
/* ステートメントを閉じます */
 mysqli_stmt_close($stmt);
}

if(isset($FAVOID)){
	for($i=0;$i<count($FAVOID);$i++){
		//sql2
		$SQL2 = "
		SELECT store_janru_id,
			   store_name,
			   prefecture_id,
			   address1
		FROM stores
		WHERE store_id = ?
		";

		/* プリペアドステートメントを作成します */
		if ($stmt = mysqli_prepare($Link,$SQL2)) {
		//ユーザ番号$id
		//$_SESSION['id'] = 2;
		//マーカにパラメータをバインドします
		 mysqli_stmt_bind_param($stmt, "s", $STOREID[$i]);
		//s：String、i：integer
		/* クエリを実行します */
		 mysqli_stmt_execute($stmt);

		/* 結果変数をバインドします */
		 mysqli_stmt_bind_result($stmt,
		 	$store_janru_id,
		 	$store_name,
		 	$prefecture_id,
		 	$store_address
		 	);

		/* クライアントのバッファに
		結果セットを保存 */
		 mysqli_stmt_store_result($stmt);

		/* 値を取得します */
		if(mysqli_stmt_fetch($stmt)){
		  $STORE_JANRU_ID[] = $store_janru_id;
		  $STORE_NAME[] = $store_name;
		  $STORE_KEN[] = $prefecture_id;
		  $STORE_ADRESS[] = $store_address;
		//$dbbuid,$dbbunameにデータが抜き出される
		}
		/* ステートメントを閉じます */
		 mysqli_stmt_close($stmt);
		}

		//sql3
		$SQL3 = "
		SELECT store_janru_name
		FROM store_janru
		WHERE store_janru_id = ?
		";

		/* プリペアドステートメントを作成します */
		if ($stmt = mysqli_prepare($Link,$SQL3)) {
		//ユーザ番号$id
		//$_SESSION['id'] = 2;
		/* マーカにパラメータをバインドします */
		 mysqli_stmt_bind_param($stmt, "s", $STORE_JANRU_ID[$i]);
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
		if(mysqli_stmt_fetch($stmt)){
		  $STORE_JANRU_NAME[] = $store_janru_name;
		//$dbbuid,$dbbunameにデータが抜き出される
		}
		if(@$STORE_JANRU_NAME[$i] == ""){
			$STORE_JANRU_NAME[$i] = "未入力"; 
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

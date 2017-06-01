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

if(isset($_POST["store_seurch"]) || isset($_POST["ken"]) || isset($_POST["store_janru"])){
  if(isset($_POST["ken"]) && $_POST["ken"] != 0 && isset($_POST["store_janru"]) && $_POST["store_janru"] != 0 ){
    $kenSQL = "
    SELECT store_id,store_name,prefecture_id,store_janru_id,address1,store_tel,store_title
    FROM stores
    WHERE prefecture_id = ? AND store_janru_id = ?
    ";
    /* プリペアドステートメントを作成します */
    if ($stmt = mysqli_prepare($Link,$kenSQL)) {

    //部署コード$bid
    $seurch_ken_list = $_POST["ken"];
    $seurch_janru_list = $_POST["store_janru"];
    /* マーカにパラメータをバインドします */

     mysqli_stmt_bind_param($stmt, "ss", $seurch_ken_list,$seurch_janru_list);

    //s：String、i：integer

    /* クエリを実行します */
     mysqli_stmt_execute($stmt);

    /* 結果変数をバインドします */
     mysqli_stmt_bind_result($stmt,
      $store_id_list,
      $store_name_list,
      $prefecture_id_list,
      $store_janru_id_list,
      $store_address_list,
      $store_tel_list,
      $store_title_list
      );

    /* クライアントのバッファに
    結果セットを保存 */
     mysqli_stmt_store_result($stmt);

    /* 値を取得します */
    while(mysqli_stmt_fetch($stmt)){
      $STORE_ID_LIST[] = $store_id_list;
      $STORE_NAME_LIST[] = $store_name_list;
      $PREFECTURE_ID_LIST[] = $prefecture_id_list;
      $STORE_JANRU_ID_LIST[] = $store_janru_id_list;
      $STORE_ADDRESS_LIST[] = $store_address_list;
      $STORE_TEL_LIST[] = $store_tel_list;
      $STORE_TITLE_LIST[] = $store_title_list;
    //$dbbuid,$dbbunameにデータが抜き出される
    }

    /* ステートメントを閉じます */
     mysqli_stmt_close($stmt);
    }
  }
	else if(isset($_POST["ken"]) && $_POST["ken"] != 0){
		$kenSQL = "
		SELECT store_id,store_name,prefecture_id,store_janru_id,address1,store_tel,store_title
		FROM stores
		WHERE prefecture_id = ?
		";
		/* プリペアドステートメントを作成します */
		if ($stmt = mysqli_prepare($Link,$kenSQL)) {

		//部署コード$bid
		$seurch_ken_list = $_POST["ken"];
		/* マーカにパラメータをバインドします */

		 mysqli_stmt_bind_param($stmt, "s", $seurch_ken_list);

		//s：String、i：integer

		/* クエリを実行します */
		 mysqli_stmt_execute($stmt);

		/* 結果変数をバインドします */
		 mysqli_stmt_bind_result($stmt,
		 	$store_id_list,
		 	$store_name_list,
		 	$prefecture_id_list,
		 	$store_janru_id_list,
		 	$store_address_list,
		 	$store_tel_list,
		 	$store_title_list
		 	);

		/* クライアントのバッファに
		結果セットを保存 */
		 mysqli_stmt_store_result($stmt);

		/* 値を取得します */
		while(mysqli_stmt_fetch($stmt)){
		  $STORE_ID_LIST[] = $store_id_list;
		  $STORE_NAME_LIST[] = $store_name_list;
		  $PREFECTURE_ID_LIST[] = $prefecture_id_list;
		  $STORE_JANRU_ID_LIST[] = $store_janru_id_list;
		  $STORE_ADDRESS_LIST[] = $store_address_list;
		  $STORE_TEL_LIST[] = $store_tel_list;
		  $STORE_TITLE_LIST[] = $store_title_list;
		//$dbbuid,$dbbunameにデータが抜き出される
		}

		/* ステートメントを閉じます */
		 mysqli_stmt_close($stmt);
		}
	}

	else if(isset($_POST["store_janru"]) && $_POST["store_janru"] != 0){
		$janruSQL = "
		SELECT store_id,store_name,prefecture_id,store_janru_id,address1,store_tel,store_title
		FROM stores
		WHERE store_janru_id = ?
		";
		/* プリペアドステートメントを作成します */
		if ($stmt = mysqli_prepare($Link,$janruSQL)) {

		//部署コード$bid
		$seurch_janru_list = $_POST["store_janru"];
		/* マーカにパラメータをバインドします */

		 mysqli_stmt_bind_param($stmt, "s", $seurch_janru_list);

		//s：String、i：integer

		/* クエリを実行します */
		 mysqli_stmt_execute($stmt);

		/* 結果変数をバインドします */
		 mysqli_stmt_bind_result($stmt,
		 	$store_id_list,
		 	$store_name_list,
		 	$prefecture_id_list,
		 	$store_janru_id_list,
		 	$store_address_list,
		 	$store_tel_list,
		 	$store_title_list
		 	);

		/* クライアントのバッファに
		結果セットを保存 */
		 mysqli_stmt_store_result($stmt);

		/* 値を取得します */
		while(mysqli_stmt_fetch($stmt)){
		  $STORE_ID_LIST[] = $store_id_list;
		  $STORE_NAME_LIST[] = $store_name_list;
		  $PREFECTURE_ID_LIST[] = $prefecture_id_list;
		  $STORE_JANRU_ID_LIST[] = $store_janru_id_list;
		  $STORE_ADDRESS_LIST[] = $store_address_list;
		  $STORE_TEL_LIST[] = $store_tel_list;
		  $STORE_TITLE_LIST[] = $store_title_list;
		//$dbbuid,$dbbunameにデータが抜き出される
		}

		/* ステートメントを閉じます */
		 mysqli_stmt_close($stmt);
		}
	}

	else{
	$allSQL = "
	SELECT store_id,store_name,prefecture_id,store_janru_id,address1,store_tel,store_title
	FROM stores
	";
	/* プリペアドステートメントを作成します */
	if ($stmt = mysqli_prepare($Link,$allSQL)) {

	//s：String、i：integer

	/* クエリを実行します */
	 mysqli_stmt_execute($stmt);

	/* 結果変数をバインドします */
		 mysqli_stmt_bind_result($stmt,
		 	$store_id_list,
		 	$store_name_list,
		 	$prefecture_id_list,
		 	$store_janru_id_list,
		 	$store_address_list,
		 	$store_tel_list,
		 	$store_title_list
		 	);

		/* クライアントのバッファに
		結果セットを保存 */
		 mysqli_stmt_store_result($stmt);

		/* 値を取得します */
		while(mysqli_stmt_fetch($stmt)){
		  $STORE_ID_LIST[] = $store_id_list;
		  $STORE_NAME_LIST[] = $store_name_list;
		  $PREFECTURE_ID_LIST[] = $prefecture_id_list;
		  $STORE_JANRU_ID_LIST[] = $store_janru_id_list;
		  $STORE_ADDRESS_LIST[] = $store_address_list;
		  $STORE_TEL_LIST[] = $store_tel_list;
		  $STORE_TITLE_LIST[] = $store_title_list;
		//$dbbuid,$dbbunameにデータが抜き出される
		}

		/* ステートメントを閉じます */
		 mysqli_stmt_close($stmt);
		}
	}
}else{
	$allSQL = "
	SELECT store_id,store_name,prefecture_id,store_janru_id,address1,store_tel,store_title
	FROM stores
	";
	/* プリペアドステートメントを作成します */
	if ($stmt = mysqli_prepare($Link,$allSQL)) {

	//s：String、i：integer

	/* クエリを実行します */
	 mysqli_stmt_execute($stmt);

	/* 結果変数をバインドします */
	 mysqli_stmt_bind_result($stmt,
	 	$store_id_list,
	 	$store_name_list,
	 	$prefecture_id_list,
	 	$store_janru_id_list,
	 	$store_address_list,
	 	$store_tel_list,
	 	$store_title_list
	 	);
	/* クライアントのバッファに結果セットを保存 */
	mysqli_stmt_store_result($stmt);

	/* 値を取得します */
	while(mysqli_stmt_fetch($stmt)){
		  $STORE_ID_LIST[] = $store_id_list;
		  $STORE_NAME_LIST[] = $store_name_list;
		  $PREFECTURE_ID_LIST[] = $prefecture_id_list;
		  $STORE_JANRU_ID_LIST[] = $store_janru_id_list;
		  $STORE_ADDRESS_LIST[] = $store_address_list;
		  $STORE_TEL_LIST[] = $store_tel_list;
		  $STORE_TITLE_LIST[] = $store_title_list;
		//$dbbuid,$dbbunameにデータが抜き出される
	}

		/* ステートメントを閉じます */
		 mysqli_stmt_close($stmt);
		}
}
if(isset($STORE_ID_LIST)){
	for($i=0;$i<count($STORE_ID_LIST);$i++){
	$allSQL = "
		SELECT store_janru_name
		FROM store_janru
		WHERE store_janru_id = ?
		";
		/* プリペアドステートメントを作成します */
		if ($stmt = mysqli_prepare($Link,$allSQL)) {

		//部署コード$bid
		$seurch_janru_name_list = $STORE_JANRU_ID_LIST[$i];
		/* マーカにパラメータをバインドします */
		 mysqli_stmt_bind_param($stmt, "s", $seurch_janru_name_list);

		//s：String、i：integer

		/* クエリを実行します */
		 mysqli_stmt_execute($stmt);

		/* 結果変数をバインドします */
		 mysqli_stmt_bind_result($stmt,
		 	$store_janru_name_list
		 	);
		/* クライアントのバッファに結果セットを保存 */
		mysqli_stmt_store_result($stmt);

		/* 値を取得します */
		while(mysqli_stmt_fetch($stmt)){
			$STORE_JANRU_NAME_LIST[] = $store_janru_name_list;
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
?>

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
SELECT userid,
	   friendid
FROM friends
WHERE friendid = ?
LIMIT 3
";
/* プリペアドステートメントを作成します */
if ($stmt = mysqli_prepare($Link,$SQL1)) {
//ユーザ番号$id
//$_SESSION['id'] = 2;
$id2 = $_SESSION['id'];
/* マーカにパラメータをバインドします */
 mysqli_stmt_bind_param($stmt, "s", $id2);
//s：String、i：integer
/* クエリを実行します */
 mysqli_stmt_execute($stmt);

/* 結果変数をバインドします */
 mysqli_stmt_bind_result($stmt,
 	$myid2,
 	$friendid2
 	);

/* クライアントのバッファに
結果セットを保存 */
 mysqli_stmt_store_result($stmt);

/* 値を取得します */
while(mysqli_stmt_fetch($stmt)){
  $MYIDBACK[] = $myid2;
  $FRIENDBACK[] = $friendid2;
//$dbbuid,$dbbunameにデータが抜き出される
}
//$dbbuid,$dbbunameにデータが抜き出される
/* ステートメントを閉じます */
 mysqli_stmt_close($stmt);
}

if(isset($MYIDBACK)){
	for($i=0;$i<count($MYIDBACK);$i++){
		//sql2
		$SQL2 = "
		SELECT user_first_name,
			   user_second_name,
			   user_first_kana,
			   user_second_name,
			   pet_id
		FROM users
		WHERE user_id = ?
		";

		/* プリペアドステートメントを作成します */
		if ($stmt = mysqli_prepare($Link,$SQL2)) {
		//ユーザ番号$id
		//$_SESSION['id'] = 2;
		//マーカにパラメータをバインドします
		 mysqli_stmt_bind_param($stmt, "s", $MYIDBACK[$i]);
		//s：String、i：integer
		/* クエリを実行します */
		 mysqli_stmt_execute($stmt);

		/* 結果変数をバインドします */
		 mysqli_stmt_bind_result($stmt,
		 	$friend_first_name2,
		 	$friend_second_name2,
		 	$friend_first_kana2,
		 	$friend_second_kana2,
		 	$friend_pet_id2
		 	);

		/* クライアントのバッファに
		結果セットを保存 */
		 mysqli_stmt_store_result($stmt);

		/* 値を取得します */
		if(mysqli_stmt_fetch($stmt)){
		  $PET_LIST_FNAME2[] = $friend_first_name2;
		  $PET_LIST_SNAME2[] = $friend_second_name2;
		  $PET_LIST_KFNAME2[] = $friend_first_kana2;
		  $PET_LIST_KSNAME2[] = $friend_second_kana2;
		  $PET_LIST_ID2[] = $friend_pet_id2;
		//$dbbuid,$dbbunameにデータが抜き出される
		}
		/* ステートメントを閉じます */
		 mysqli_stmt_close($stmt);
		}

		//sql3
		$SQL3 = "
		SELECT pet_name,
			   pet_image01
		FROM pets
		WHERE pet_id = ?
		";

		/* プリペアドステートメントを作成します */
		if ($stmt = mysqli_prepare($Link,$SQL3)) {
		//ユーザ番号$id
		//$_SESSION['id'] = 2;
		/* マーカにパラメータをバインドします */
		 mysqli_stmt_bind_param($stmt, "s", $PET_LIST_ID2[$i]);
		//s：String、i：integer
		/* クエリを実行します */
		 mysqli_stmt_execute($stmt);

		/* 結果変数をバインドします */
		 mysqli_stmt_bind_result($stmt,
		 	$friend_pet_name2,
		 	$friend_pet_image2
		 	);
		/* クライアントのバッファに
		結果セットを保存 */
		 mysqli_stmt_store_result($stmt);

		/* 値を取得します */
		if(mysqli_stmt_fetch($stmt)){
		  $PET_FRIEND_NAME2[] = $friend_pet_name2;
		  $PET_FRIEND_IMAGE2[] = $friend_pet_image2;
		//$dbbuid,$dbbunameにデータが抜き出される
		}
		if(@$PET_FRIEND_NAME2[$i] == ""){
			$PET_FRIEND_NAME2[$i] = "未入力"; 
		}
		if(@$PET_FRIEND_IMAGE2[$i] == ""){
			$PET_FRIEND_IMAGE2[$i] = "noimage.jpg"; 
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

<?php
//処理限定のphp
header("Content-Type:text/html; charset=UTF-8");
print "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\r\n";
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
$userSQL = "
SELECT user_first_name,
	   user_second_name,
	   user_first_kana,
	   user_second_kana,
	   sex_id,
	   adr_1,
	   adr_2,
	   address,
	   umare,
	   tel,
	   mail,
	   pass,
	   pet_id
FROM users
WHERE user_id = ?
";
/* プリペアドステートメントを作成します */
if ($stmt = mysqli_prepare($Link,$userSQL)) {
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
 	$user_first_name,
 	$user_second_name,
 	$user_first_kana,
 	$user_second_kana,
 	$sex,
 	$adr1,
 	$adr2,
 	$address,
 	$date,
 	$tel,
 	$mail,
 	$pass,
 	$pet_id
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

//ユーザペット情報取得sql
$petSQL = "
SELECT pet_name,
	   dog_book_id,
	   pet_umare,
	   pet_weight,
	   pet_color,
	   prefecture_id,
	   pet_image01,
	   pet_text,
	   question01,
	   question02,
	   question03,
	   question04,
	   question05,
	   question06,
	   question07,
	   question08,
	   question09,
	   question10,
	   question11,
	   question12,
	   question13,
	   question14,
	   question15
FROM pets
WHERE pet_id = ?
";

/* プリペアドステートメントを作成します */
if ($stmt = mysqli_prepare($Link,$petSQL)) {
//ユーザ番号$id
//$_SESSION['id'] = 2;
/* マーカにパラメータをバインドします */
 mysqli_stmt_bind_param($stmt, "s", $pet_id);
//s：String、i：integer
/* クエリを実行します */
 mysqli_stmt_execute($stmt);

/* 結果変数をバインドします */
 mysqli_stmt_bind_result($stmt,
 	$pet_name,
 	$pet_book_id,
 	$pet_umare,
 	$pet_weight,
 	$pet_color,
 	$ken,
 	$image,
 	$pet_text,
 	$question01,
 	$question02,
 	$question03,
 	$question04,
 	$question05,
 	$question06,
 	$question07,
 	$question08,
 	$question09,
 	$question10,
 	$question11,
 	$question12,
 	$question13,
 	$question14,
 	$question15
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

if($image == ""){
	$image = "noimage.jpg";
}

if($pet_name == ""){
	$pet_name = "未登録";
}

//ペット犬種取得sql
$petSQL = "
SELECT dog_name
FROM dog_books
WHERE dog_book_id = ?
";

/* プリペアドステートメントを作成します */
if ($stmt = mysqli_prepare($Link,$petSQL)) {
//ユーザ番号$id
//$_SESSION['id'] = 2;
/* マーカにパラメータをバインドします */
 mysqli_stmt_bind_param($stmt, "s", $pet_book_id);
//s：String、i：integer
/* クエリを実行します */
 mysqli_stmt_execute($stmt);

/* 結果変数をバインドします */
 mysqli_stmt_bind_result($stmt,$dog_name);

/* クライアントのバッファに
結果セットを保存 */
 mysqli_stmt_store_result($stmt);

/* 値を取得します */
 mysqli_stmt_fetch($stmt);
//$dbbuid,$dbbunameにデータが抜き出される
/* ステートメントを閉じます */
 mysqli_stmt_close($stmt);
}

if($dog_name == ""){
	$dog_link = "未登録";
}else{
	$dog_link = "<a href=".$level."zukan/detail.php?dog=".$pet_book_id.">".$dog_name."</a>";
}


//ユーザペット情報取得sql
$petlistSQL = "
SELECT
	   pet_id,
	   pet_name,
	   dog_book_id,
	   pet_umare,
	   pet_weight,
	   pet_color,
	   prefecture_id,
	   pet_image01,
	   pet_text,
	   question01,
	   question02,
	   question03,
	   question04,
	   question05,
	   question06,
	   question07,
	   question08,
	   question09,
	   question10,
	   question11,
	   question12,
	   question13,
	   question14,
	   question15
FROM pets
WHERE user_id = ?
LIMIT 3
";



/* プリペアドステートメントを作成します */
if ($stmt = mysqli_prepare($Link,$petlistSQL)) {
//ユーザ番号$id
//$_SESSION['id'] = 2;
/* マーカにパラメータをバインドします */
 mysqli_stmt_bind_param($stmt, "s", $id);
//s：String、i：integer
/* クエリを実行します */
 mysqli_stmt_execute($stmt);

/* 結果変数をバインドします */
 mysqli_stmt_bind_result($stmt,
 	$pet_id2,
 	$pet_name2,
 	$pet_book_id2,
 	$pet_umare2,
 	$pet_weight2,
 	$pet_color2,
 	$ken2,
 	$image2,
 	$pet_text2,
 	$question012,
 	$question022,
 	$question032,
 	$question042,
 	$question052,
 	$question062,
 	$question072,
 	$question082,
 	$question092,
 	$question102,
 	$question112,
 	$question122,
 	$question132,
 	$question142,
 	$question152
 	);

/* クライアントのバッファに
結果セットを保存 */
 mysqli_stmt_store_result($stmt);


/* 値を取得します */
while(mysqli_stmt_fetch($stmt)){
  $PET_ID[] = $pet_id2;
  $PET_NAME[] = $pet_name2;
  $BOOK_ID[] = $pet_book_id2;
  $PET_UMARE[] = $pet_umare2;
  $WEIGHT[] = $pet_weight2;
  $COLOR[] = $pet_color2;
  $KEN[] = $ken2;
  $IMAGE[] = $image2;
  $PET_TEXT[] = $pet_text2;
  $Q01[] = $question012;
  $Q02[] = $question022;
  $Q03[] = $question032;
  $Q04[] = $question042;
  $Q05[] = $question052;
  $Q06[] = $question062;
  $Q07[] = $question072;
  $Q08[] = $question082;
  $Q09[] = $question092;
  $Q10[] = $question102;
  $Q11[] = $question112;
  $Q12[] = $question122;
  $Q13[] = $question132;
  $Q14[] = $question142;
  $Q15[] = $question152;
//$dbbuid,$dbbunameにデータが抜き出される
}
//$dbbuid,$dbbunameにデータが抜き出される
/* ステートメントを閉じます */
 mysqli_stmt_close($stmt);
}
if(isset($PET_NAME)){
	for($i=0;$i<count($PET_NAME);$i++){
		//ペット犬種取得sql
		$petlistSQL = "
		SELECT dog_name
		FROM dog_books
		WHERE dog_book_id = ?
		";

		/* プリペアドステートメントを作成します */
		if ($stmt = mysqli_prepare($Link,$petlistSQL)) {
		//ユーザ番号$id
		//$_SESSION['id'] = 2;
		/* マーカにパラメータをバインドします */
		 mysqli_stmt_bind_param($stmt, "s", $BOOK_ID[$i]);
		//s：String、i：integer
		/* クエリを実行します */
		 mysqli_stmt_execute($stmt);

		/* 結果変数をバインドします */
		 mysqli_stmt_bind_result($stmt,$dog_list_name);

		/* クライアントのバッファに
		結果セットを保存 */
		 mysqli_stmt_store_result($stmt);

		/* 値を取得します */
		if(mysqli_stmt_fetch($stmt)){
		  $PET_LIST_NAME[] = $dog_list_name;
		//$dbbuid,$dbbunameにデータが抜き出される
		}else{
		  $PET_LIST_NAME[] = "";
		}
		//$dbbuid,$dbbunameにデータが抜き出される
		/* ステートメントを閉じます */
		 mysqli_stmt_close($stmt);
		}
		if($IMAGE[$i] == ""){
			$IMAGE[$i] = "noimage.jpg";
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

//ユーザ生年月日
list($user_year, $user_month, $user_day) = explode('-', $date);
$user_month = ltrim($user_month, '0');
$user_day = ltrim($user_day, '0');

//ペット生年月日
if(isset($pet_umare)){
	list($pet_year, $pet_month, $pet_day) = explode('-', $pet_umare);
	$pet_month = ltrim($pet_month, '0');
	$pet_day = ltrim($pet_day, '0');
}

<?php

//3桁ごとにカンマを入れる
//$a = 10000000;
//$a = number_format($a);
//echo $a;

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

$SQL = "
	select pet_id
	from users
	where user_id = ?
";
/* プリペアドステートメントを作成します */
if ($stmt = mysqli_prepare($Link,$SQL)) {

/* マーカにパラメータをバインドします */

//部署コード$bid
$friend_id=$_GET["id"];

 mysqli_stmt_bind_param($stmt, "s",$friend_id);

//s：String、i：integer

/* クエリを実行します */
 mysqli_stmt_execute($stmt);

/* 結果変数をバインドします */
	mysqli_stmt_bind_result($stmt,
						$hantei
						);

/* クライアントのバッファに
結果セットを保存 */
 mysqli_stmt_store_result($stmt);

/* 値を取得します */
mysqli_stmt_fetch($stmt);

/* ステートメントを閉じます */
 mysqli_stmt_close($stmt);
}



if($hantei != 0){
$SQL = "
	select users.user_first_name,
		   users.user_second_name,
		   users.user_first_kana,
		   users.user_second_kana,
		   users.sex_id,
		   users.address,
		   users.pet_id,
		   pets.pet_name,
		   pets.dog_book_id,
		   pets.psex,
		   pets.pet_umare,
		   pets.pet_weight,
		   pets.pet_color,
		   pets.prefecture_id,
		   pets.pet_image01,
		   pets.pet_text,
		   pets.question01,
		   pets.question02,
		   pets.question03,
		   pets.question04,
		   pets.question05,
		   pets.question06,
		   pets.question07,
		   pets.question08,
		   pets.question09,
		   pets.question10,
		   pets.question11,
		   pets.question12,
		   pets.question13,
		   pets.question14,
		   pets.question15
    from users
    inner join pets
    on users.pet_id = pets.pet_id
    WHERE users.user_id =?
";
/* プリペアドステートメントを作成します */
if ($stmt = mysqli_prepare($Link,$SQL)) {

/* マーカにパラメータをバインドします */

 mysqli_stmt_bind_param($stmt, "s", $friend_id);

//s：String、i：integer

/* クエリを実行します */
 mysqli_stmt_execute($stmt);

/* 結果変数をバインドします */
	mysqli_stmt_bind_result($stmt,
						$user_first_name,
						$user_second_name,
						$user_first_kana,
						$user_second_kana,
						$user_sex,
						$address,
						$pet_id,
						$pet_name,
						$pet_janru,
						$pet_sex,
						$pet_umare,
						$pet_weight,
						$pet_color,
						$pet_ken,
						$image,
						$pet_textarea,
						$q1,
						$q2,
						$q3,
						$q4,
						$q5,
						$q6,
						$q7,
						$q8,
						$q9,
						$q10,
						$q11,
						$q12,
						$q13,
						$q14,
						$q15
						);

/* クライアントのバッファに
結果セットを保存 */
 mysqli_stmt_store_result($stmt);

/* 値を取得します */
mysqli_stmt_fetch($stmt);

/* ステートメントを閉じます */
 mysqli_stmt_close($stmt);
}

$SQL = "
	select dog_name
    from dog_books
    WHERE dog_book_id =?
";
/* プリペアドステートメントを作成します */
if ($stmt = mysqli_prepare($Link,$SQL)) {

/* マーカにパラメータをバインドします */

 mysqli_stmt_bind_param($stmt, "s", $pet_janru);

//s：String、i：integer

/* クエリを実行します */
 mysqli_stmt_execute($stmt);

/* 結果変数をバインドします */
	mysqli_stmt_bind_result($stmt,
						$janru_name
						);

/* クライアントのバッファに
結果セットを保存 */
 mysqli_stmt_store_result($stmt);

/* 値を取得します */
mysqli_stmt_fetch($stmt);

/* ステートメントを閉じます */
 mysqli_stmt_close($stmt);
}

}else{
$SQL = "
	select user_first_name,
		   user_second_name,
		   user_first_kana,
		   user_second_kana,
		   sex_id,
		   address
    from users
    WHERE user_id =?
";

/* プリペアドステートメントを作成します */
if ($stmt = mysqli_prepare($Link,$SQL)) {

/* マーカにパラメータをバインドします */

 mysqli_stmt_bind_param($stmt, "s", $friend_id);

//s：String、i：integer

/* クエリを実行します */
 mysqli_stmt_execute($stmt);

/* 結果変数をバインドします */
	mysqli_stmt_bind_result($stmt,
						$user_first_name,
						$user_second_name,
						$user_first_kana,
						$user_second_kana,
						$user_sex,
						$address
						);

/* クライアントのバッファに
結果セットを保存 */
 mysqli_stmt_store_result($stmt);

/* 値を取得します */
mysqli_stmt_fetch($stmt);

/* ステートメントを閉じます */
 mysqli_stmt_close($stmt);
}
}


//  MySQLの切断
if(!mysqli_close($Link)){
  exit("MySQL：DB切断失敗");
}

//性別チェック

if($user_sex == 1){
	$user_sex = "男性";
}else if($user_sex == 2){
	$user_sex = "女性";
}
if(isset($pet_sex)){
	if($pet_sex == 1){
		$pet_sex = "オス";
	}else if($pet_sex == 2){
		$pet_sex = "メス";
	}else{
		$pet_sex = "未登録";
	}
}else{
	$pet_sex = "未登録";
}

//病気質問チェック
if(isset($q8)){
	if($q8 == 1){
		$q8 = "はい";
	}else if($q8 == 2){
		$q8 = "いいえ";
	}else{
		$q8 = "わからない";
	}
	if($q9 == 1){
		$q9 = "はい";
	}else if($q9 == 2){
		$q9 = "いいえ";
	}else{
		$q9 = "わからない";
	}
	if($q10 == 1){
		$q10 = "はい";
	}else if($q10 == 2){
		$q10 = "いいえ";
	}else{
		$q10 = "わからない";
	}
	if($q11 == 1){
		$q11 = "はい";
	}else if($q11 == 2){
		$q11 = "いいえ";
	}else{
		$q11 = "わからない";
	}
}else{
	$q8 = "わからない";
	$q9 = "わからない";
	$q10 = "わからない";
	$q11 = "わからない";
}
//画像チェック
if(!isset($image) || $image == ""){
	$image = "noimage.jpg";
}
if(isset($pet_umare)){
//ユーザ生まれ年月日
	list($pet_year, $pet_month, $pet_day) = explode('-', $pet_umare);
	$pet_year = ltrim($pet_year, '0');
	$pet_month = ltrim($pet_month, '0');
	$pet_day = ltrim($pet_day, '0');
}else{
	$pet_year = "";
	$pet_month = "";
	$pet_day = "";
}
//未設定の場合

//犬種
if(!isset($pet_name) || $pet_name == ""){
	$pet_name = "未設定";
}

//犬種
if(!isset($janru_name) || $janru_name == ""){
	$janru_name = "未設定";
}

//毛色
if(!isset($pet_color) || $pet_color == ""){
	$pet_color = "未設定";
}

//ペット体重
if(!isset($pet_weight)){
	$pet_weight = 0;
}

//テキストエリア
if(!isset($pet_textarea) || $pet_textarea == ""){
	$pet_textarea = "未設定";
}

//テキストエリア
if(!isset($q1) || $q1 == ""){
	$q1 = "未設定";
}

//テキストエリア
if(!isset($q2) || $q2 == ""){
	$q2 = "未設定";
}

//テキストエリア
if(!isset($q3) || $q3 == ""){
	$q3 = "未設定";
}

//テキストエリア
if(!isset($q4) || $q4 == ""){
	$q4 = "未設定";
}

//テキストエリア
if(!isset($q5) || $q5 == ""){
	$q5 = "未設定";
}

//テキストエリア
if(!isset($q6) || $q6 == ""){
	$q6 = "未設定";
}

//テキストエリア
if(!isset($q7) || $q7 == ""){
	$q7 = "未設定";
}

//テキストエリア
if(!isset($q12) || $q12 == ""){
	$q12 = "未設定";
}

//テキストエリア
if(!isset($q13) || $q13 == ""){
	$q13 = "未設定";
}

//テキストエリア
if(!isset($q14) || $q14 == ""){
	$q14 = "未設定";
}

//テキストエリア
if(!isset($q15) || $q15 == ""){
	$q15 = "未設定";
}

?>
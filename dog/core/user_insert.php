<?php
//  HTTPヘッダーで文字コードを指定
header("Content-Type:text/html; charset=UTF-8");
print "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\r\n";
//ペット情報が格納されているかチェック
//$flg = 0なら情報は何も入っていいない
$flg = 0;
//情報格納
//ユーザ情報
$first_name = htmlspecialchars($_POST["fname"]);
$second_name = htmlspecialchars($_POST["sname"]);
$first_kana = htmlspecialchars($_POST["kfname"]);
$second_kana = htmlspecialchars($_POST["ksname"]);
$sex = htmlspecialchars($_POST["sex"]);
$adr1 = htmlspecialchars($_POST["zip1"]);
$adr2 = htmlspecialchars($_POST["zip2"]);
$address = htmlspecialchars($_POST["addressku"]);
$user_date = htmlspecialchars($_POST["date"]);
$telephone = htmlspecialchars($_POST["cal"]);
$mail_text = htmlspecialchars($_POST["mail"]);
$domain = htmlspecialchars($_POST["domain"]);
$mail_add = $mail_text."@".$domain;
$password = sha1(htmlspecialchars($_POST["pass"]));

//犬基本情報
if($_POST["k1"] != ""){
  $pet_name = htmlspecialchars($_POST["k1"]);
  $flg = 9;
}else{
  $pet_name = "";
}
if($_POST["k21"] != ""){
  $pet_janru1 = htmlspecialchars($_POST["k21"]);
  $flg = 9;
}else{
  $pet_janru1 = 0;
}
if($_POST["k22"] != ""){
  $pet_janru2 = htmlspecialchars($_POST["k22"]);
  $flg = 9;
}else{
  $pet_janru2 = 0;
}
if($_POST["pet_date"] != 0){
  $pet_date = htmlspecialchars($_POST["pet_date"]);
  $flg = 9;
}else{
  $pet_date = "0000-00-00";
}
if($_POST["psex"] != 0){
  $psex = htmlspecialchars($_POST["psex"]);
  $flg = 9;
}else{
  $psex = 0;
}
if($_POST["k4"] != ""){
  $weight = htmlspecialchars($_POST["k4"]);
  $flg = 9;
}else{
  $weight = 0;
}
if($_POST["k5"] != ""){
  $keiro = htmlspecialchars($_POST["k5"]);
  $flg = 9;
}else{
  $keiro = "";
}
if($_POST["k6"] != ""){
  $ken = htmlspecialchars($_POST["k6"]);
  $flg = 9;
}else{
  $ken ="0";
}
if($_POST["k7"] != ""){
  $image = htmlspecialchars($_POST["k7"]);
  $flg = 9;
}else{
  $image = "";
}
if($_POST["k8"] != ""){
  $hitokoto = htmlspecialchars($_POST["k8"]);
  $flg = 9;
}else{
  $hitokoto = "";
}

//ペットの特徴
if($_POST["t1"] != ""){
  $seikaku = htmlspecialchars($_POST["t1"]);
  $flg = 9;
}else{
  $seikaku = "";
}
if($_POST["t2"] != ""){
  $tokugi = htmlspecialchars($_POST["t2"]);
  $flg = 9;
}else{
  $tokugi = "";
}
if($_POST["t3"] != ""){
  $like_food = htmlspecialchars($_POST["t3"]);
  $flg = 9;
}else{
  $like_food = "";
}
if($_POST["t4"] != ""){
  $like_oyatu = htmlspecialchars($_POST["t4"]);
  $flg = 9;
}else{
  $like_oyatu = "";
}
if($_POST["t5"] != ""){
  $iyasi = htmlspecialchars($_POST["t5"]);
  $flg = 9;
}else{
  $iyasi = "";
}
if($_POST["t6"] != ""){
  $yokuiku = htmlspecialchars($_POST["t6"]);
  $flg = 9;
}else{
  $yokuiku = "";
}
if($_POST["t7"] != ""){
  $komarigoto = htmlspecialchars($_POST["t7"]);
  $flg = 9;
}else{
  $komarigoto = "";
}

//医療について
if(isset($_POST["i1"])){
  $i1 = htmlspecialchars($_POST["i1"]);
  $flg = 9;
}else{
  $i1 = 0;
}
if(isset($_POST["i2"])){
  $i2 = htmlspecialchars($_POST["i2"]);
  $flg = 9;
}else{
  $i2 = 0;
}
if(isset($_POST["i3"])){
  $i3 = htmlspecialchars($_POST["i3"]);
  $flg = 9;
}else{
  $i3 = 0;
}
if(isset($_POST["i4"])){
  $i4 = htmlspecialchars($_POST["i4"]);
  $flg = 9;
}else{
  $i4 = 0;
}
if($_POST["i5"] != ""){
  $i5 = htmlspecialchars($_POST["i5"]);
  $flg = 9;
}else{
  $i5 = "";
}
if($_POST["i6"] != ""){
  $i6 = htmlspecialchars($_POST["i6"]);
  $flg = 9;
}else{
  $i6 = "";
}
if($_POST["i7"] != ""){
  $i7 = htmlspecialchars($_POST["i7"]);
  $flg = 9;
}else{
  $i7 = "";
}
if($_POST["i8"] != ""){
  $i8 = htmlspecialchars($_POST["i8"]);
  $flg = 9;
}else{
  $i8 = "";
}
//DB連携
include("db_ini.php");

///////////////////////////////////
//ユーザ情報 insert文　開始
///////////////////////////////////

// $umare = $nen.'-'.sprintf("%02d",$tuki).'-'.sprintf("%02d",$hi);

if(!$Link = mysqli_connect
($host,$user,$pass)){
  exit("MySQL：DB接続失敗："
  .mysqli_connect_error());
}

//  文字コードの指定（クエリー送信）
if(!mysqli_query($Link,'set names utf8')){
  exit("MySQL：クエリー送信失敗");
}

//  使用するDB指定
if(!mysqli_select_db($Link,$db_name)){
  exit("MySQL：DB指定失敗");
}
$SQL = "insert into users(
        user_first_name,
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
        )
        values(
        '$first_name',
        '$second_name',
        '$first_kana',
        '$second_kana',
        $sex,
        '$adr1',
        '$adr2',
        '$address',
        '$user_date',
        '$telephone',
        '$mail_add',
        '$password'
        ,0
        )"
        ;
//insert into tokuten(col1, col2, col5) values(val1, val2, val5);
$query_add = mysqli_query($Link,$SQL);

$SQL2 = "
        select user_id
        from users
        order by user_id desc
        limit 0,1
        ";

//  MySQLの切断
/*
if(!mysqli_close($Link)){
  exit("MySQL：DB切断失敗");
}

*/

// プリペアドステートメントを作成します
  if ($stmt = mysqli_prepare($Link,$SQL2)) {

  //社員コード$sid
  //$sid=$_POST["shainid"];

   //クエリを実行します
   mysqli_stmt_execute($stmt);

   /* 結果変数をバインドします */
	 mysqli_stmt_bind_result($stmt,$uid);

	/* クライアントのバッファに
	結果セットを保存 */
	 mysqli_stmt_store_result($stmt);

	/* 値を取得します */
	mysqli_stmt_fetch($stmt);

   //ステートメントを閉じます
   mysqli_stmt_close($stmt);
  }

///////////////////////////////////
//ペット情報 insert文　開始
///////////////////////////////////

if($flg == 9){

  // $pet_umare = sprintf("%04d",$pet_nen).'-'.sprintf("%02d",$pet_tuki).'-'.sprintf("%02d",$pet_hi);
  /*
  if(!$Link = mysqli_connect
  ($host,$user,$pass)){
   exit("MySQL：DB接続失敗："
   .mysqli_connect_error());
  }

  //  文字コードの指定（クエリー送信）
  if(!mysqli_query($Link,'set names utf8')){
   exit("MySQL：クエリー送信失敗");
  }

  //  使用するDB指定
  if(!mysqli_select_db($Link,$db_name)){
    exit("MySQL：DB指定失敗");
  }
  */
  $petSQL = "insert into pets(
          user_id,
          pet_name,
          dog_size_id,
          dog_book_id,
          psex,
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
          )
          values(
          $uid,
          '$pet_name',
          $pet_janru1,
          $pet_janru2,
          $psex,
          '$pet_date',
          '$weight',
          '$keiro',
          $ken,
          '$image',
          '$hitokoto',
          '$seikaku',
          '$tokugi',
          '$like_food',
          '$like_oyatu',
          '$iyasi',
          '$yokuiku',
          '$komarigoto',
          $i1,
          $i2,
          $i3,
          $i4,
          '$i5',
          '$i6',
          '$i7',
          '$i8'
          )";
  //insert into tokuten(col1, col2, col5) values(val1, val2, val5);
  $query_add2 = mysqli_query($Link,$petSQL);

  $petSQL2 = "
        select pet_id
        from pets
        order by pet_id desc
        limit 0,1
        ";

  // プリペアドステートメントを作成します
  if ($stmt = mysqli_prepare($Link,$petSQL2)) {

  //社員コード$sid
  //$sid=$_POST["shainid"];

   //クエリを実行します
   mysqli_stmt_execute($stmt);

   /* 結果変数をバインドします */
	 mysqli_stmt_bind_result($stmt,$petid);

	/* クライアントのバッファに
	結果セットを保存 */
	 mysqli_stmt_store_result($stmt);

	/* 値を取得します */
	mysqli_stmt_fetch($stmt);

   //ステートメントを閉じます
   mysqli_stmt_close($stmt);
  }

  $user_up = "
            update users
            set pet_id = ?
            where user_id = ?
            ";

  // プリペアドステートメントを作成します
  if ($stmt = mysqli_prepare($Link,$user_up)) {

  //社員コード$sid
  //$sid=$_POST["shainid"];



   //マーカにパラメータをバインドします
   mysqli_stmt_bind_param($stmt,"ss",$petid,$uid);
  //s：String、i：integer

   //クエリを実行します
   mysqli_stmt_execute($stmt);

   //ステートメントを閉じます
   mysqli_stmt_close($stmt);
  }

  //  MySQLの切断
  if(!mysqli_close($Link)){
    exit("MySQL：DB切断失敗");
  }
}

/*

insert into pets(
          user_id,pet_name,dog_book_id,pet_umare,pet_weight,pet_color,prefecture_id,pet_image01,pet_text,queston01,queston02,queston03,queston04,queston05,queston06,queston07,queston08,queston09,queston10,queston11,queston12,queston13,queston14,queston15)
values(1,'',0,'',0,'',0,'','','','','','','','','',0,0,0,0,'','','','')

*/
?>

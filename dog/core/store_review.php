<?php

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
SELECT user_id,score,text,timestmp
FROM review
WHERE store_id = ?
ORDER BY timestmp desc
LIMIT 3
";
/* プリペアドステートメントを作成します */
if ($stmt = mysqli_prepare($Link,$SQL)) {

//部署コード$bid
$store_id=$_GET["store"];

/* マーカにパラメータをバインドします */

 mysqli_stmt_bind_param($stmt, "s", $store_id);

//s：String、i：integer

/* クエリを実行します */
 mysqli_stmt_execute($stmt);

/* 結果変数をバインドします */
 mysqli_stmt_bind_result($stmt,
    $review_user,
    $review_score,
    $review_text,
    $review_time
 	);

/* クライアントのバッファに
結果セットを保存 */
 mysqli_stmt_store_result($stmt);

 /* 値を取得します */
 while(mysqli_stmt_fetch($stmt)){
   $REVIEW_USER[] = $review_user;
   $REVIEW_SCORE[] = $review_score;
   $REVIEW_TEXT[] = $review_text;
   $REVIEW_TIME[] = $review_time;
   //$dbbuid,$dbbunameにデータが抜き出される
 }

/* ステートメントを閉じます */
 mysqli_stmt_close($stmt);
}
if(isset($REVIEW_USER)){
for($i=0;$i<count($REVIEW_USER);$i++){
  $SQL2 = "
  SELECT user_first_name,user_second_name,pet_id
  FROM users
  WHERE user_id = ?
  ";
  /* プリペアドステートメントを作成します */
  if ($stmt = mysqli_prepare($Link,$SQL2)) {

  /* マーカにパラメータをバインドします */

   mysqli_stmt_bind_param($stmt, "s", $REVIEW_USER[$i]);

  //s：String、i：integer

  /* クエリを実行します */
   mysqli_stmt_execute($stmt);

  /* 結果変数をバインドします */
   mysqli_stmt_bind_result($stmt,
    $user_first_name,
    $user_second_name,
   	$review_pet
   );


  /* クライアントのバッファに
  結果セットを保存 */
   mysqli_stmt_store_result($stmt);

   while(mysqli_stmt_fetch($stmt)){
     $REVIEW_FIRST_NAME[] = $user_first_name;
     $REVIEW_SECOND_NAME[] = $user_second_name;
     $REVIEW_PET[] = $review_pet;
 		//$dbbuid,$dbbunameにデータが抜き出される
 	}

  /* ステートメントを閉じます */
   mysqli_stmt_close($stmt);
  }

  $SQL3 = "
  SELECT pet_image01
  FROM pets
  WHERE pet_id = ?
  ";
  /* プリペアドステートメントを作成します */
  if ($stmt = mysqli_prepare($Link,$SQL3)) {

  /* マーカにパラメータをバインドします */

   mysqli_stmt_bind_param($stmt, "s", $REVIEW_PET[$i]);

  //s：String、i：integer

  /* クエリを実行します */
   mysqli_stmt_execute($stmt);

  /* 結果変数をバインドします */
   mysqli_stmt_bind_result($stmt,
   	$review_image
   );

   if($review_image == ""){
     $review_image = "noimage.jpg";
   }

  /* クライアントのバッファに
  結果セットを保存 */
   mysqli_stmt_store_result($stmt);

   while(mysqli_stmt_fetch($stmt)){
     $REVIEW_IMAGE[] = $review_image;
 		//$dbbuid,$dbbunameにデータが抜き出される
 	}

  /* ステートメントを閉じます */
   mysqli_stmt_close($stmt);
  }

  $timedata[$i] = date('Y年n月j日H:i:s', strtotime($REVIEW_TIME[$i]));

}
}
//  MySQLの切断
if(!mysqli_close($Link)){
  exit("MySQL：DB切断失敗");
}
?>

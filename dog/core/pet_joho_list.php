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
$dog2SQL = "
SELECT pet_id,
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
FROM pets
WHERE pet_id = ?
";
/* プリペアドステートメントを作成します */
if ($stmt = mysqli_prepare($Link,$dog2SQL)) {
//s：String、i：integer
if(isset($_GET["pet_id"])){
  $_SESSION["pet"] = $_GET["pet_id"];
}
$pet_id =  $_SESSION["pet"];

 mysqli_stmt_bind_param($stmt,"s",$pet_id);

/* クエリを実行します */
 mysqli_stmt_execute($stmt);

/* 結果変数をバインドします */
 mysqli_stmt_bind_result($stmt,
                    $petid,
                    $k1,
                    $k21,
                    $k22,
                    $psex,
                    $pet_date,
                    $k4,
                    $k5,
                    $k6,
                    $k7,
                    $k8,
                    $t1,
                    $t2,
                    $t3,
                    $t4,
                    $t5,
                    $t6,
                    $t7,
                    $i1,
                    $i2,
                    $i3,
                    $i4,
                    $i5,
                    $i6,
                    $i7,
                    $i8);
/* クライアントのバッファに
結果セットを保存 */
 mysqli_stmt_store_result($stmt);

/* 値を取得します */
mysqli_stmt_fetch($stmt);

/* ステートメントを閉じます */
 mysqli_stmt_close($stmt);
}

//  MySQLの切断
if(!mysqli_close($Link)){
  exit("MySQL：DB切断失敗");
}

//ペット生年月日
?>

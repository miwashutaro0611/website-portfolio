<?php

if($myid < $friendid){
  $room_before = sprintf("%05d",$myid);
  $room_after = sprintf("%05d",$friendid);
}else{
  $room_before = sprintf("%05d",$friendid);
  $room_after = sprintf("%05d",$myid);
}
$roomid = $room_before.$room_after;


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
//チャットする相手の情報を取得
$SQL = "
SELECT userid,chattext,timestmp
FROM chat
WHERE roomid = ?
";
/* プリペアドステートメントを作成します */
if ($stmt = mysqli_prepare($Link,$SQL)) {

//部署コード$bid

/* マーカにパラメータをバインドします */

 mysqli_stmt_bind_param($stmt, "s", $roomid);

//s：String、i：integer

/* クエリを実行します */
 mysqli_stmt_execute($stmt);

/* 結果変数をバインドします */
 mysqli_stmt_bind_result($stmt,$person,$chattext,$timestmp);

/* クライアントのバッファに
結果セットを保存 */
 mysqli_stmt_store_result($stmt);

 /* 値を取得します */
 while(mysqli_stmt_fetch($stmt)){
   if($person == $myid){
     $BALLOON[] = "myBalloon";
     $TIME[] = "mytime";
   }else{
     $BALLOON[] = "yourBalloon";
     $TIME[] = "yourtime";
   }
   $CHATTEXT[] = nl2br($chattext);
  //  $TIMESTMP[] = $timestmp;
   $TIMESTMP[] = date("Y/n/j G:i", strtotime($timestmp)); //「2015/03/07 10:00:00」
 //$dbbuid,$dbbunameにデータが抜き出される
 }

/* ステートメントを閉じます */
 mysqli_stmt_close($stmt);
}

//  MySQLの切断
if(!mysqli_close($Link)){
  exit("MySQL：DB切断失敗");
}
?>

<?php

//DB連携
include("db_ini_chat.php");
//送られてきたメッセージの値
$chattext = $_GET["msg"];
//送られてきた自分のid
$myid = $_GET["my"];
//送られてきた友達のid
$friendid = $_GET["you"];
//チャットルーム番号の作成
if($myid < $friendid){
  $room_before = sprintf("%05d",$myid);
  $room_after = sprintf("%05d",$friendid);
}else{
  $room_before = sprintf("%05d",$friendid);
  $room_after = sprintf("%05d",$myid);
}
$roomid = $room_before.$room_after;

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
//チャットの文章をデータベースに登録する
$SQL = "insert into chat(
        roomid,
        userid,
        chattext
        )
        values(
        '$roomid',
        $myid,
        '$chattext'
        )"
        ;
//insert文の実行
$query_add = mysqli_query($Link,$SQL);

//  MySQLの切断
if(!mysqli_close($Link)){
  exit("MySQL：DB切断失敗");
}

?>

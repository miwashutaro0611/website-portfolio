<?php

$user_id = $_GET["user"];
$store_id = $_GET["store"];

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
//$SQL = "insert into t_shain value('$shainnid','$shainname',$shainbusho)";
$SQL = "insert into favo_store(
		user_id,
		store_id
		)
		values(
		$user_id,
		$store_id
		)" 
		;

$query_add = mysqli_query($Link,$SQL);

//  MySQLの切断
if(!mysqli_close($Link)){
  exit("MySQL：DB切断失敗");
}
header('Location: ../mypage/store/');
exit();
?>

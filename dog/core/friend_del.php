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
//$SQL = "insert into t_shain value('$shainnid','$shainname',$shainbusho)";
$SQL = "delete
        from friends
        where userid = ? AND friendid = ?
         " ;

/* プリペアドステートメントを作成します */
if ($stmt = mysqli_prepare($Link,$SQL)) {

//社員コード$sid
//$sid=$_POST["shainid"];
$userid = $_GET['myid'];
$friendid = $_GET["frid"];
/* マーカにパラメータをバインドします */
 mysqli_stmt_bind_param($stmt,"ss",$userid,$friendid);
//s：String、i：integer

/* クエリを実行します */
 mysqli_stmt_execute($stmt);

/* ステートメントを閉じます */
 mysqli_stmt_close($stmt);
}

//  MySQLの切断
if(!mysqli_close($Link)){
  exit("MySQL：DB切断失敗");
}
header('Location: ../friend/detail.php?id='.$_GET["frid"].'');
exit();
?>

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

if(isset($_SESSION['id'])){

$SQL = "
	select userid,friendid
	from friends
	where userid = ? AND friendid = ?
";
/* プリペアドステートメントを作成します */
if ($stmt = mysqli_prepare($Link,$SQL)) {

/* マーカにパラメータをバインドします */

//部署コード$bid
$mid = $_SESSION['id'];
$fid = $_GET['id'];


 mysqli_stmt_bind_param($stmt, "ss",$mid,$fid);

//s：String、i：integer

/* クエリを実行します */
 mysqli_stmt_execute($stmt);

/* 結果変数をバインドします */
	mysqli_stmt_bind_result($stmt,
						$myid,
						$frid
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

?>
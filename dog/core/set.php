<?php
//処理限定のphp
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
$petcSQL = "
			update users
            set pet_id = ?
            where user_id = ?
			";
/* プリペアドステートメントを作成します */
if ($stmt = mysqli_prepare($Link,$petcSQL)) {
//ユーザ番号$id
//$_SESSION['id'] = 2;
$petid = $_GET['petid'];
$userid = $_GET['userid'];
/* マーカにパラメータをバインドします */
 mysqli_stmt_bind_param($stmt, "ss", $petid,$userid);

   //クエリを実行します
   mysqli_stmt_execute($stmt);

   //ステートメントを閉じます
   mysqli_stmt_close($stmt);
  }


//  MySQLの切断
if(!mysqli_close($Link)){
  exit("MySQL：DB切断失敗");
}


///////////////////////////////////////
//日付取得
///////////////////////////////////////
header('Location: ../mypage/');
exit();

?>

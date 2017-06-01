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
$nen = htmlspecialchars($_POST["umare1"]);
$tuki = htmlspecialchars($_POST["umare2"]);
$hi = htmlspecialchars($_POST["umare3"]);
$telephone = htmlspecialchars($_POST["tel"]);
$userid = $_POST["userid"];
//DB連携
include("db_ini.php");

///////////////////////////////////
//ユーザ情報 insert文　開始
///////////////////////////////////

$umare = $nen.'-'.sprintf("%02d",$tuki).'-'.sprintf("%02d",$hi);

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

//ユーザ情報獲得sql
$upSQL = "
      update users set
            user_first_name = ?,
            user_second_name = ?,
            user_first_kana = ?,
            user_second_kana = ?,
            sex_id = ?,
            adr_1 = ?,
            adr_2 = ?,
            address = ?,
            umare = ?,
            tel = ?
            where user_id = ?
      ";
/* プリペアドステートメントを作成します */
if ($stmt = mysqli_prepare($Link,$upSQL)) {
//ユーザ番号$id
//$_SESSION['id'] = 2;
/* マーカにパラメータをバインドします */
 mysqli_stmt_bind_param($stmt, "sssssssssss",
                        $first_name,
                        $second_name,
                        $first_kana,
                        $second_kana,
                        $sex,
                        $adr1,
                        $adr2,
                        $address,
                        $umare,
                        $telephone,
                        $userid
                        );

   //クエリを実行します
   mysqli_stmt_execute($stmt);

   //ステートメントを閉じます
   mysqli_stmt_close($stmt);
  }
  //  MySQLの切断
  if(!mysqli_close($Link)){
    exit("MySQL：DB切断失敗");
  }
/*

update users set
            user_first_name = '三輪',
            user_second_name = '俊太郎',
            user_first_kana = 'ミワ',
            user_second_kana = 'シュンタロウ',
            sex_id = 1,
            adr_1 = '453',
            adr_2 = '0851',
            address = '愛知県名古屋市中村区畑江通',
            umare = '1995-06-11',
            tel = '090-4237-6721'
            where user_id = 1
*/
?>

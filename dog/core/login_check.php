<?php

require_once("session_cookie.php");
//処理限定のphp
include("db_ini.php");

$state_message = "";
$flg = 0;

$db_link = mysqli_connect
            ($host,$user,$pass);

if($db_link == false){
    fnc_setData("session","state_message","接続に失敗しました。");
    $flg = 9;
    header("Location: ../login/");
}

$db_flg = mysqli_select_db($db_name,$db_link);

if($db_flg == false){
    fnc_setData("session","state_message","選択に失敗しました。");
    $flg = 9;
    header("Location: ../login/");
}

$db_result = mysqli_query("set names 'utf8'",$db_link);

//ログイン画面から受け取り
$strId   = $_POST['txtID'];
$strPass = $_POST['txtPass'];

//SQL文の作成
$strSQL  = " select user_id from users where mail_add = ? ";

//④SQL文を実行する。
//  mysql_query関数
//$db_result = mysqli_query($strSQL,$db_link);
$db_result = mysqli_prepare($db_link,$strSQL);

 mysqli_stmt_bind_param($db_result, "s", $strId);

 /* クエリを実行します */
 mysqli_stmt_execute($db_result);

/* 結果変数をバインドします */
 mysqli_stmt_bind_result($db_result,$db_row);

$db_cnt = count($db_row);

if(isset($db_row)){
  //データが無い場合
  $msg = "<font color=red>";
  $msg.= "入力されたユーザIDは存在しません。";
  $msg.= "<br />";
  $msg.= "ユーザID：".$strId;
  $msg.= "</font>";
  $flg = 9;
  fnc_setData("session","state_message",$msg);
}else{
  //データが有る場合

  //while($db_row = mysqli_fetch_array($db_result,MYSQLI_ASSOC)){
  while($db_row){

    if($strPass == $db_row["pass"]){
      $msg = $db_row["user_id"];
      fnc_setData("session","state_message",$msg);
      
      //クッキーにユーザ名を保存
      if(isset($_POST["chkSAVE"])){
        fnc_setData("cookie","user",$db_row["user_name"],30);
      }
    }else{
      $msg = "<font color=red>";
      $msg.= "入力されたパスワードが";
      $msg.= "違います！！！！！";
      $msg.= "</font>";
      $flg = 9;
      fnc_setData("session","state_message",$msg);
    }
  }
  
  mysqli_free_result($db_result);
}
mysqli_close($db_link);

if($flg==0){
  //ログイン成功
  fnc_setData("session","page","");

  header("Location: ../");
}else{
  //ログイン失敗
  fnc_setData("session","page","login_check.php");
  //$_SESSION["state_message"] = null;
  header("Location: ../login/");
}
?>

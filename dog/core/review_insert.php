<?php

//  HTTPヘッダーで文字コードを指定
header("Content-Type:text/html; charset=UTF-8");
print "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\r\n";
//ペット情報が格納されているかチェック
//$flg = 0なら情報は何も入っていいない
//情報格納

//DB連携
include("db_ini.php");

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

///////////////////////////////////
//ペット情報 insert文　開始
///////////////////////////////////
  $petSQL = "insert into review(
            user_id,
            store_id,
            score,
            text
          )
          values(
            $uid,
            $storeid,
            $score,
            '$text'
          )";
  //insert into tokuten(col1, col2, col5) values(val1, val2, val5);
  $query_add2 = mysqli_query($Link,$petSQL);

  //  MySQLの切断
  if(!mysqli_close($Link)){
    exit("MySQL：DB切断失敗");
  }
//テキストエリアからの内容
?>

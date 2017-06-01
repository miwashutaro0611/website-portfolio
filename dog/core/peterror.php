<?php
//////////////////////////////////////////
//フォーム内容確認
//////////////////////////////////////////
if(isset($_POST["submit01"])){    //入力ページから犬登録ページ

    $fname = htmlspecialchars($_POST["sei"]);
    $sname = htmlspecialchars($_POST["mei"]);
    $kfname = htmlspecialchars($_POST["ksei"]);
    $ksname = htmlspecialchars($_POST["kmei"]);
    $sex_num = @htmlspecialchars($_POST["radioprice"]);
    if($sex_num == 1){
      $sex = "男性";
    }else if($sex_num == 2){
      $sex = "女性";
    }else{
      $sex = "未入力";
    }
    $zip1 = htmlspecialchars($_POST["zip1"]);
    $zip2 = htmlspecialchars($_POST["zip2"]);
    $addressku = htmlspecialchars($_POST["addressku"]);
    $date = htmlspecialchars($_POST["date"]);
    $cal = htmlspecialchars($_POST["cal"]);
    $mail = htmlspecialchars($_POST["address"]);
    $domain = htmlspecialchars($_POST["mail_domain"]);
    $ps1 = htmlspecialchars($_POST["pass01"]);
    $ps2 = htmlspecialchars($_POST["pass02"]);
    //生年月日の分割
    list($user_year, $user_month, $user_day) = explode('-', $date);
  	$user_month = ltrim($user_month, '0');
  	$user_day = ltrim($user_day, '0');
}

if(isset($_POST["submit03"])){ //犬登録から入力ページ
    $nname = htmlspecialchars($_POST["1"]);
    $sname = htmlspecialchars($_POST["2"]);
    $knname = htmlspecialchars($_POST["3"]);
    $ksname = htmlspecialchars($_POST["4"]);
    $hsex = htmlspecialchars($_POST["5"]);
    $hzip1 = htmlspecialchars($_POST["zip1"]);
    $hzip2 = htmlspecialchars($_POST["zip2"]);
    $hadr = htmlspecialchars($_POST["addressku"]);
    $date = htmlspecialchars($_POST["date"]);
    $cal = htmlspecialchars($_POST["10"]);
    $mail = htmlspecialchars($_POST["11"]);
    $domain = htmlspecialchars($_POST["domain"]);
    $ps1 = htmlspecialchars($_POST["12"]);
    $ps2 = htmlspecialchars($_POST["12"]);
}

if(isset($_POST["submit02"])){ //犬登録ページから確認ページへ
    //犬名前
    if($_POST['dog_name'] != ""){
        $k1 = htmlspecialchars($_POST['dog_name']);
    }else{
        $k1 = "未入力";
    }
    //大きさ
    if(htmlspecialchars($_POST['dog_janru1'])==""){
        $k21 = "未入力";
    }else{
        $k21 = htmlspecialchars($_POST['dog_janru1']);
        require_once("cdog_book1.php");
    }
    //犬種類
    if(htmlspecialchars($_POST['dog_janru2'])==""){
        $k22 = "未入力";
    }else{
        $k22 = htmlspecialchars($_POST['dog_janru2']);
        require_once("cdog_book2.php");
    }
    //性別
    @$psex = htmlspecialchars($_POST['psex']);
    if(isset($psex) && $psex == 1){
        $psex = "男（オス）";
    }
    else if(isset($psex) && $psex == 2){
        $psex = "女（メス）";
    }else{
        $psex = "未入力";
    }
    //性別
    if(isset($_POST["psex"])){
    $psex = $_POST["psex"];
    }
    if(isset($psex) && $psex == 1){
        $psex = "オス";
    }
    else if(isset($psex) && $psex == 2){
        $psex = "メス";
    }else{
        $psex = "未入力";
    }
    //ペット生年月日
    if($_POST["pet_date"] != ""){
      $pet_date = htmlspecialchars($_POST["pet_date"]);
      //生年月日の分割
      list($pet_year, $pet_month, $pet_day) = explode('-', $pet_date);
      $pet_year = ltrim($pet_year, '0');
      $pet_month = ltrim($pet_month, '0');
    	$pet_day = ltrim($pet_day, '0');
    }else{
      $pet_date = "未入力";
    }
    //体重
    if($_POST['omosa']!=""){
        $k4 = htmlspecialchars($_POST['omosa']);
        $k4 .= "g";
    }else{
        $k4 = "未入力";
    }

    //毛色
    if($_POST['keiro']!=""){
        $k5 = htmlspecialchars($_POST['keiro']);
    }else{
        $k5 = "未入力";
    }

    //県
    if(htmlspecialchars($_POST["ken"])!=""){
        $k6 = htmlspecialchars($_POST["ken"]);
        require_once("cken.php");
    }else{
        $k6 = "未入力";
    }

    //一言
    if($_POST['textarea']!=""){
        $k8 = htmlspecialchars($_POST['textarea']);
    }else{
        $k8 = "未入力";
    }

    //性格
    if($_POST['toku1']!=""){
        $t1 = htmlspecialchars($_POST['toku1']);
    }else{
        $t1 = "未入力";
    }

    //特技
    if($_POST['toku2']!=""){
        $t2 = htmlspecialchars($_POST['toku2']);
    }else{
        $t2 = "未入力";
    }

    //好きな食べ物
    if($_POST['toku3']!=""){
        $t3 = htmlspecialchars($_POST['toku3']);
    }else{
        $t3 = "未入力";
    }

    //好きなおやつ
    if($_POST['toku4']!=""){
        $t4 = htmlspecialchars($_POST['toku4']);
    }else{
        $t4 = "未入力";
    }

    //癒される仕草
    if($_POST['toku5']!=""){
        $t5 = htmlspecialchars($_POST['toku5']);
    }else{
        $t5 = "未入力";
    }

    //よく行く場所
    if($_POST['toku6']!=""){
        $t6 = htmlspecialchars($_POST['toku6']);
    }else{
        $t6 = "未入力";
    }

    //困り事・悩み事
    if($_POST['toku7']!=""){
        $t7 = htmlspecialchars($_POST['toku7']);
    }else{
        $t7 = "未入力";
    }

    //去勢済みか
    if(isset($_POST['qa1'])){
        $i1 = htmlspecialchars($_POST['qa1']);
        if($i1 == 1){
            $i1 = "はい";
        }
        if($i1 == 2){
            $i1 = "いいえ";
        }
        if($i1 == 3){
            $i1 = "わからない";
        }
    }else{
        $i1 = "未入力";
    }

    //フェラリア済みか
    if(isset($_POST['qa2'])){
        $i2 = htmlspecialchars($_POST['qa2']);
        if($i2 == 1){
            $i2 = "はい";
        }
        if($i2 == 2){
            $i2 = "いいえ";
        }
        if($i2 == 3){
            $i2 = "わからない";
        }
    }else{
        $i2 = "未入力";
    }

    //ノミ・ダニ対策
    if(isset($_POST['qa3'])){
        $i3 = htmlspecialchars($_POST['qa3']);
        if($i3 == 1){
            $i3 = "はい";
        }
        if($i3 == 2){
            $i3 = "いいえ";
        }
        if($i3 == 3){
            $i3 = "わからない";
        }
    }else{
        $i3 = "未入力";
    }

    //狂犬病済みか
    if(isset($_POST['qa4'])){
        $i4 = htmlspecialchars($_POST['qa4']);
        if($i4 == 1){
            $i4 = "はい";
        }
        if($i4 == 2){
            $i4 = "いいえ";
        }
        if($i4 == 3){
            $i4 = "わからない";
        }
    }else{
        $i4 = "未入力";
    }

    //１回目ワクチン
    if($_POST["qa5"]!=""){
        $i5 = htmlspecialchars($_POST['qa5']);
    }else{
        $i5 = "未入力";
    }

    //２回目ワクチン
    if($_POST['qa6']!=""){
        $i6 = htmlspecialchars($_POST['qa6']);
    }else{
        $i6 = "未入力";
    }

    //３回目ワクチン
    if($_POST['qa7']!=""){
        $i7 = htmlspecialchars($_POST['qa7']);
    }else{
        $i7 = "未入力";
    }

    //その他病気
    if($_POST['qa8']!=""){
        $i8 = htmlspecialchars($_POST['qa8']);
    }else{
        $i8 = "未入力";
    }

}

if(isset($_POST["submit_prev"])){ //確認ページから犬登録ページ

    $k1 = htmlspecialchars($_POST['k1']);
    $k21 = htmlspecialchars($_POST['k21']);
    $k22 = htmlspecialchars($_POST['k22']);
    $psex = htmlspecialchars($_POST['psex']);
    $pet_date = htmlspecialchars($_POST['pet_date']);
    //生年月日の分割(ペット)
    if($pet_date != ""){
      list($pet_year, $pet_month, $pet_day) = explode('-', $pet_date);
    	$pet_month = ltrim($pet_month, '0');
    	$pet_day = ltrim($pet_day, '0');
    }
    $k4 = htmlspecialchars($_POST['k4']);
    $k5 = htmlspecialchars($_POST['k5']);
    $k6 = htmlspecialchars($_POST['k6']);
    $k7 = htmlspecialchars($_POST['k7']);
    $k8 = htmlspecialchars($_POST['k8']);
    $t1 = htmlspecialchars($_POST['t1']);
    $t2 = htmlspecialchars($_POST['t2']);
    $t3 = htmlspecialchars($_POST['t3']);
    $t4 = htmlspecialchars($_POST['t4']);
    $t5 = htmlspecialchars($_POST['t5']);
    $t6 = htmlspecialchars($_POST['t6']);
    $t7 = htmlspecialchars($_POST['t7']);
    $i1 = htmlspecialchars($_POST['i1']);
    $i2 = htmlspecialchars($_POST['i2']);
    $i3 = htmlspecialchars($_POST['i3']);
    $i4 = htmlspecialchars($_POST['i4']);
    $i5 = htmlspecialchars($_POST['i5']);
    $i6 = htmlspecialchars($_POST['i6']);
    $i7 = htmlspecialchars($_POST['i7']);
    $i8 = htmlspecialchars($_POST['i8']);
}
?>

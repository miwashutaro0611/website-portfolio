<?php

$flg = 0;

//////////////////////////////////////////
//フォーム内容確認
//////////////////////////////////////////
if(isset($_POST["submit01"])){    //入力ページから確認ページ
    if($_POST["sei"] != "" && $_POST["mei"] != ""){
    //苗字(漢字)
    $name = $_POST["sei"];
    //名前(漢字)
    $name .= $_POST["mei"];
    }else{
    $ername = "名前（漢字）を入力してください";
    $flg = 9;
    }
    if($_POST["ksei"] != "" && $_POST["kmei"] != ""){
	    //苗字(カナ)
	    $kname = $_POST["ksei"];
	    //名前(カナ)
	    $kname .= $_POST["kmei"]; 
	    if (mb_ereg("^[ア-ン゛゜ァ-ォャ-ョー「」、]+$", $kname)) {
	    }else{
	    	$erkname = "入力はカナのみとなっています";
    		$flg = 9;
	    }
    }else{
    $erkname = "名前(カナ)を入力してください";
    $flg = 9;
    }
    //性別
    $sex = @$_POST["radioprice"];
    if(isset($sex) && $sex == 1){
        $sex = "男";
    }
    else if(isset($sex) && $sex == 2){
        $sex = "女";
    }else{
        $ersex = "男性か女性か選択してください";
        $flg = 9;
    }
    /*
    //都道府県
    $ken = $_POST["ken"];
    if($ken == "選択されていません"){
    	$erken = "都道府県が選択されていません";
    	$flg = 9;
    }
    */
    $zip1 = $_POST["zip1"];
    $zip2 = $_POST["zip2"];
    $zip = $zip1;
    $zip .= "-";
    $zip .= $zip2;
    $eryu = 0;
    if($zip1 == "" || $zip2 == ""){
        $erzip = "郵便番号が入力されておりません";
        $flg = 9;
        $eryu = 9;
    }

    $adr = $_POST["addressku"];

    if($adr == "" && $eryu == 9){
        $erzip = "郵便番号・住所が入力されておりません";
        $flg = 9;
    }else if($adr == "" && $eryu == 0){
        $erzip = "住所が入力されておりません";
        $flg = 9;
    }else{

    }

    //生年月日(年) ex.2016
    $umare = $_POST["nen"];
    //生年月日(月) ex.06
    $umare .= $_POST["tuki"];
    //生年月日(日) ex.12
    $umare .= $_POST["hi"];

    //生年月日(年) ※表示用 ex.2016年
    $ump = $_POST["nen"];
    $ue = 0;
    if($ump == "-------"){
        $ump = "";
        $ue = 9;
    }
    if($ump != ""){
        $ump .= "年";
    }
    //生年月日(月) ※表示用 ex.06月
    $ump .= $_POST["tuki"];
    if($ump == "-------"){
        $ump = "";
        $ue = 9;
    }
    if($ump != ""){
        $ump .= "月";
    }
    //生年月日(日) ※表示用 ex.12日
    $ump .= $_POST["hi"];
    if($ump == "-------"){
        $ump = "";
        $ue = 9;
    }
    if($ump != ""){
        $ump .= "日";
    }
    if($ue == 9){
        $erhi = "年・月・日のいずれかが選択されていません。";
        $flg = 9;
    }
    //電話番号
    $cal = $_POST["cal"];
    if($cal == ""){
    	$ertel = "電話番号が入力されていません";
    	$flg = 9;
    }else if (preg_match('|^[0-9]{2,4}-[0-9]{2,4}-[0-9]{3,4}$|', $cal)) {
    	
	}else{
		$ertel = "電話番号の形式が適切ではありません";
    	$flg = 9;
	}
    if($flg == 9){
    $nname = htmlspecialchars($_POST["sei"]);
    $sname = htmlspecialchars($_POST["mei"]);
    $knname = htmlspecialchars($_POST["ksei"]);
    $ksname = htmlspecialchars($_POST["kmei"]);
    $hsex = @htmlspecialchars($_POST["radioprice"]);
    $hzip1 = htmlspecialchars($_POST["zip1"]);
    $hzip2 = htmlspecialchars($_POST["zip2"]);
    $hadr = htmlspecialchars($_POST["addressku"]);
    $nenn = htmlspecialchars($_POST["nen"]);
    $tuki = htmlspecialchars($_POST["tuki"]);
    $hi = htmlspecialchars($_POST["hi"]);
    $cal = htmlspecialchars($_POST["cal"]);
    }else{
    	header('Location: check.php?sei='.htmlspecialchars($_POST["sei"]).'&mei='.htmlspecialchars($_POST["mei"]).'&ksei='.htmlspecialchars($_POST["ksei"]).'&kmei='.htmlspecialchars($_POST["kmei"]).'&radioprice='.htmlspecialchars($_POST["radioprice"]).'&zip1='.htmlspecialchars($_POST["zip1"]).'&zip2='.htmlspecialchars($_POST["zip2"]).'&addressku='.htmlspecialchars($_POST["addressku"]).'&nen='.htmlspecialchars($_POST["nen"]).'&tuki='.htmlspecialchars($_POST["tuki"]).'&hi='.htmlspecialchars($_POST["hi"]).'&cal='.htmlspecialchars($_POST["cal"]));
        /*sample
        header('Location: dogs.php?
            sei='.htmlspecialchars($_POST["sei"].'
            &mei='.$_POST["mei"].'
            &ksei='.$_POST["ksei"].'
            &kmei='.$_POST["kmei"].'
            &radioprice='.$_POST["radioprice"].'
            &zip1='.$_POST["zip1"].'
            &zip2='.$_POST["zip2"].'
            &zip='.$zip.'
            &addressku='.$_POST["addressku"].'
            &nen='.$_POST["nen"].'
            &tuki='.$_POST["tuki"].'
            &hi='.$_POST["hi"].'
            &umarem='.$ump.'
            &cal='.$_POST["cal"].'
        ');
        */
    	exit();
    }
}
?>
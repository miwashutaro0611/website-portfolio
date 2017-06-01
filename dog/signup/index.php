<?php
//クッキー・セッションのphp
require_once("../core/session_cookie.php");

require_once("../core/mail_domain.php");


/////////////////////////////////////////
//エラーチェック
//////////////////////////////////////////

/*これはフォームの内容*/

$nname = "";
$sname = "";
$knname = "";
$ksname = "";
$hsex = "";
$hzip1 = "";
$hzip2 = "";
$hadr = "";
$date = "";
$cal = "";
$mail = "";
$domain = "";
$ps1 = "";
$ps2 = "";

//エラーチェックのphp
require_once("../core/error.php");

//  HTTPヘッダーで文字コードを指定
@header("Content-Type:text/html; charset=UTF-8");

//ヘッダー・フッター・キャプションの内容を入れる場所(public.php)
require_once("../view/public.php");


//////////////////////////////////////////
//head内の文章入力場所　開始
//////////////////////////////////////////


//ファイルの回想を記入
$level = '../';
//使用するcssを記入
$css = '
<link rel="stylesheet" href="../css/signup.css" type="text/css" />
<link rel="stylesheet" href="../css/calendar.css" type="text/css" />
<link rel="stylesheet" href="../css/validationEngine.jquery.css" type="text/css" />
';
//使用するjavascript(jQuery)を記入
$js = '
<script src="../js/calendar.js"></script>
<script src="../js/form/jquery.validationEngine.js"></script>
<script src="../js/form/jquery.validationEngine-ja.js"></script>
<script src="../js/form/form_chack.js"></script>
';
//サイトのタイトルを記入
$title = '新規登録-登録｜ワンコム';
//サイトのキーワードを記入(表示には関係ない・任意)
$keywords = '犬,里親,コミュニティ,飼い主';
//サイトの説明文を記入(表示には関係ない・任意)
$description = 'ワンコムマイページです。ワンコムを利用してさまざまな人と交流を持ちましょう！';
//サイトの製作者を記入(表示には関係ない・任意)
$author = '三輪俊太郎';

/////////////////////////////////////////
//ログインチェック
/////////////////////////////////////////
if(isset($_SESSION['id'])) {
$lcheck = '<p class="flL"><a href="'.$level.'mypage/">Myページ</a></p><p class="flL"><a href="'.$level.'core/logout.php">ログアウト</a></p>';
}else{
$lcheck = '<p class="flL"><a href="'.$level.'signup/">新規登録</a></p><p class="flL"><a href="'.$level.'login/">ログイン</a></p>';

}

///////////////////////////////////////
//database
///////////////////////////////////////




/////////////////////////////////////////
//ここからhtml
/////////////////////////////////////////
html_header();
html_nav();
?>
<div class="panlist">
    <ol class="cfx pankuzu">
    	<li class="flL"><a href="../">ワンコム</a></li>
    	<span class="flL">></span>
    	<li class="flL"><a href="../signup/">新規登録</a></li>
    </ol>
</div>
<!--ここからコンテントの内容始まる　-->
<section id="section_1">
  <div class="step">
            <ul class="cfx">
                <li class="flL step_item item_active"><span>STEP1:<br />ユーザー情報を入力</span></li>
                <li class="flL step_item"><span>STEP2:<br />ペット情報の入力</span></li>
                <li class="flL step_item"><span>STEP3:<br />ユーザー情報を確認</span></li>
                <li class="flL step_item"><span>STEP4:<br />登録完了</span></li>
            </ul>
        </div>
    </section>
<article>
        <section id="section_2">
            <h2>新規登録</h2>
            <div id="myForm" class="content">
                <form action="dogs.php" method="post" id="form">
                    <div id="form_main">
                            <!-- お名前　-->
                    <div class="form_box">
                        <h3 class="form_h3">お名前<span class="">（※必須項目）</span></h3>
                        <p class="form_item">
                            漢字：（姓） （名）
                        </p>
                            <input type="text" class="min-input validate[required]" id="" name="sei" maxlength="10" placeholder="例) 犬好" value="<?=$nname ?>" />
                            <input type="text" class="min-input validate[required]" id="" name="mei" maxlength="10" placeholder="例) 太郎" value="<?=$sname ?>" />

                        <p class="form_item">
                            フリガナ：（セイ） （メイ）
                        </p>
                            <input type="text" class="min-input validate[required,custom[katakana]]" id="" name="ksei" maxlength="10" placeholder="例) イヌスキ" value="<?=$knname ?>" />
                            <input type="text" class="min-input validate[required,custom[katakana]]" id="" name="kmei" maxlength="10" placeholder="例）タロウ" value="<?=$ksname ?>" />
                    </div>

                            <!-- 性別　-->
                    <div class="form_box">

                        <h3 class="form_h3">性別<span class="">（※必須項目）</span></h3>

                        <ul class="radio_area cfx">
                            <li class="flL">
                              <input type="radio" class="validate[required]" name="radioprice" value="1" id="radio01" <?php if ($hsex == 1) { print ' checked'; }; ?> />
                              <label for="radio01" class="radio">男性</label>
                            </li>
                            <li class="flL">
                              <input type="radio" class="validate[required]" name="radioprice" value="2" id="radio02" <?php if ($hsex == 2) { print ' checked'; }; ?> />
                              <label for="radio02" class="radio">女性</label>
                            </li>
                        </ul>
                    </div>
                            <!-- 住所　-->
                    <div class="form_box">
                        <h3 class="form_h3">郵便番号<span class="">（※必須項目）</span></h3>
                         <input class="adr validate[required,custom[number]]" type="text" id="zip1" name="zip1" maxlength="10" placeholder="例)123" value="<?=$hzip1 ?>" />
                         -
                         <input class="adr validate[required,custom[number]]" type="text" id="zip2" name="zip2" maxlength="10" placeholder="例)4567" value="<?=$hzip2 ?>" />
                         <input class="adrbtn" type="button" id="lookup" value="検索"><br>
                         <input class="adr_de validate[required]" type="text" id="addressku" name="addressku" maxlength="100" placeholder="ここに検索された住所が表示されます 例) 愛知県中村区名駅" value="<?=$hadr ?>" />
                         <p class="kome">※番地は未入力でOK</p>
                    </div>
                            <!-- 生年月日　-->
                    <div class="form_box">
                        <h3 class="form_h3">生年月日<span class="">（※必須項目）</span></h3>
                        <input type="text" id="cal" class="date validate[required,custom[date],past[NOW]]" name="date" placeholder="クリックするとカレンダーが表示されます" value="<?=$date?>">
                        <p class="kome">※テキストでの入力も可</p>
                    </div>

                    <!-- 電話番号　-->
                    <div class="form_box">
                        <h3 class="form_h3">電話番号<span class="">（※必須項目）</span></h3>
                        <p class="form_item">
                            半角数字<span>※ハイフン必須</span>
                        </p>
                            <input type="text" id="tel" class="validate[required,custom[phone]]" name="cal" maxlength="13" placeholder="例）090-1234-9876" value="<?=$cal ?>"  />
                    </div>

                            <!-- メールアドレス　-->
                    <div class="form_box">
                        <h3 class="form_h3">メールアドレス<span class="">（※必須項目）</span></h3>
                        <p class="form_item">
                            PC・スマートフォン<span>※登録後メールアドレスは変更できません。</span>
                        </p>
                            <input type="text" id="address" class="validate[required,custom[onlyLetterNumber]]" name="address" maxlength="100" placeholder="例）mailadd" value="<?=$mail ?>"  /><span class="add">@</span>
                            <div class="custom">
                              <select name="mail_domain" class="validate[required]" data-errormessage-value-missing="いずれかを選択してください">
                                <?=count($MAIL_DOMAIN)?>
                                <option value="">--------</option>
                                <?php for($domain_loop=0;$domain_loop<count($MAIL_DOMAIN);$domain_loop++){ ?>
                                <option value="<?=$MAIL_DOMAIN[$domain_loop]?>" <?php if ($domain == $MAIL_DOMAIN[$domain_loop]) { print ' selected'; }; ?>><?=$MAIL_DOMAIN[$domain_loop]?></option>
                                <?php } ?>
                              </select>
                            </div>

                    </div>

                            <!-- パスワード　-->
                    <div class="form_box">
                        <h3 class="form_h3">パスワード<span class="">（※必須項目）</span></h3>
                        <p class="form_item">
                            半角数字<span>※登録後パスワードは変更できません。</span>
                        </p>
                        <input type="password" id="password1" class="password validate[required,custom[passcheck],minSize[8]]" name="pass01" maxlength="100" placeholder="半角英数字 8文字以上" value="<?=$ps1 ?>" ><br />
                        <p class="form_item" >
                            確認のため、再入力してください。
                        </p>
                        <input type="password" class="password validate[required,equals[password1]]" name="pass02" maxlength="100" placeholder="半角英数字 8文字以上" value="<?=$ps2 ?>" >
                    </div>

                <div id="submit_box">
                    <input id="sub" type="submit" name="submit01" value="ペット情報入力へ">
                </div>
                </div>
                </form>
            </div>
        </section>
</article>
<!--ここまででコンテントの内容終わる　-->
<?php html_footer(); ?>
</div>	<!--wrap終了-->
</body>
</html>

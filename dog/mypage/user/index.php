<?php


//クッキー・セッションのphp
require_once("../../core/session_cookie.php");

//ログインチェック
//していない場合トップページに戻す
if(!isset($_SESSION['id'])){
	//絶対参照
	header("Location: ../../");
	exit();
}

require_once("../../core/usererror.php");

//ファイルの回想を記入
$level = '../../';

require_once("../../core/mypage.php");

//ヘッダー・フッター・キャプションの内容を入れる場所(public.php)
require_once("../../view/public.php");

//////////////////////////////////////////
//head内の文章入力場所　開始
//////////////////////////////////////////

//使用するcssを記入
$css = '<link rel="stylesheet" href="../../css/mypage/user.css" type="text/css" />';
//使用するjavascript(jQuery)を記入
$js = '';
//サイトのタイトルを記入
$title = 'ユーザ情報確認・変更｜ワンコム';
//サイトのキーワードを記入(表示には関係ない・任意)
$keywords = '犬,里親,コミュニティ,飼い主';
//サイトの説明文を記入(表示には関係ない・任意)
$description = 'ユーザ情報確認・変更ページです。ワンコムを利用してさまざまな人と交流を持ちましょう！';
//サイトの製作者を記入(表示には関係ない・任意)
$author = '三輪俊太郎';

/////////////////////////////////////////
//ログインチェック
/////////////////////////////////////////
if(isset($_SESSION['id'])) {
//$lcheck = '<p class="flL"><a href="#">新規登録</a></p><p class="flL"><a href="'.$level.'login/">ログイン</a></p>';
$lcheck = '<p class="flL"><a href="'.$level.'mypage/">Myページ</a></p><p class="flL"><a href="'.$level.'core/logout.php">ログアウト</a></p>';
}else{
//$lcheck = '<p class="flL"><a href="#">Myページ</a></p><p class="flL"><a href="'.$level.'core/logout.php">ログアウト</a></p>';
$lcheck = '<p class="flL"><a href="'.$level.'signup/">新規登録</a></p><p class="flL"><a href="'.$level.'login/">ログイン</a></p>';
}

///////////////////////////////////////
//database
///////////////////////////////////////
/*3桁ごとにカンマを入れる
$a = 10000000;
$a = number_format($a);
echo $a;
*/
/////////////////////////////////////////
//ここからhtml
/////////////////////////////////////////
html_header();
html_nav();
?>
<div class="panlist">
	<ol class="cfx pankuzu">
		<li class="flL"><a href="../../">ワンコム</a></li>
		<span class="flL">></span>
		<li class="flL"><a href="../../mypage/">マイページ</a></li>
		<span class="flL">></span>
		<li class="flL"><a href="../../mypage/user/">ユーザ情報確認・変更</a></li>
	</ol>
</div>
<!--ここからコンテントの内容始まる　-->
<article>
	<?php mypage_nav(); ?>
	<div class="flL">
		<section id="users">
			<h2>ユーザ情報確認・変更</h2>
			<section id="section_2">
            <div class="content">
                <form action="" method="post">
                    <div id="form_main">
                            <!-- お名前　-->
                    <div class="form_box">
                        <h3 class="form_h3">お名前<span class=""></span></h3>
                        <p class="form_item">
                            漢字：（姓） （名）
                        </p>
                            <input type="text" class="name" id="" name="sei" maxlength="10" placeholder="例) 犬好" value="<?php print $user_first_name ?>" />
                            <input type="text" class="name" id="" name="mei" maxlength="10" placeholder="例) 太郎" value="<?php print $user_second_name ?>" />

                        <?php if(isset($ername)){ ?>
                        <p class="error"><?=$ername?></p>
                        <?php } ?>

                        <p class="form_item">
                            フリガナ：（セイ） （メイ）
                        </p>
                            <input type="text" class="kname" id="" name="ksei" maxlength="10" placeholder="例) イヌスキ" value="<?php print $user_first_kana ?>" />
                            <input type="text" class="kname" id="" name="kmei" maxlength="10" placeholder="例）タロウ" value="<?php print $user_second_kana ?>" />

                        <?php if(isset($erkname)){ ?>
                        <p class="error"><?=$erkname?></p>
                        <?php } ?>
                    </div>

                            <!-- 性別　-->     
                    <div class="form_box">

                        <h3 class="form_h3">性別<span class=""></span></h3>

                        <ul class="cfx">
                            <li class="flL sex"><label><input type="radio" id="" name="radioprice" value="1"<?php if ($sex == 1) { print ' checked'; }; ?> /><span>男性</span></label></li>
                            <li class="flL sex"><label><input type="radio" id="" name="radioprice" value="2"<?php if ($sex == 2) { print ' checked'; }; ?> /><span>女性</span></label></li>
                        </ul>
                        <?php if(isset($ersex)){ ?>
                        <p class="error"><?=$ersex?></p>
                        <?php } ?>
                    </div>
                            <!-- 住所　-->
                    <div class="form_box">
                        <h3 class="form_h3">郵便番号<span class=""></span></h3>
                         <input class="adr" type="text" id="zip1" name="zip1" maxlength="10" placeholder="例)123" value="<?php print $adr1 ?>" />-<input class="adr" type="text" id="zip2" name="zip2" maxlength="10" placeholder="例)4567" value="<?php print $adr2 ?>" />
                         <input class="adrbtn" type="button" id="lookup" value="検索"><br>
                         <input class="adr_de" type="text" id="addressku" name="addressku" maxlength="100" placeholder="ここに検索された住所が表示されます 例) 愛知県中村区名駅" value="<?php print $address ?>" />
                         <p class="kome">※番地は未入力でOK</p>

                         <?php if(isset($erhi)){ ?>
                            <p class="error"><?php print $erzip; ?></p>
                            <?php } ?>
                    </div>
                            <!-- 生年月日　-->
                        <div class="form_box">
                            <h3 class="form_h3">生年月日<span class=""></span></h3>
                            <select id="nen" name="nen">
                                <option>-------</option>
                                <?php for($i=1900;$i<2017;$i++){ ?>
                                <option value="<?php print $i ?>"<?php if ($user_year == $i) { print ' selected'; }; ?>><?php print $i ?></option>
                                <?php } ?>
                            </select>年
                            <select id="tuki" name="tuki">
                                <option>-------</option>
                                <?php for($j=1;$j<13;$j++){ ?>
                                <option value="<?php print $j ?>"<?php if ($user_month == $j) { print ' selected'; }; ?>><?php print $j ?></option>
                                <?php } ?>
                            </select>月
                            <select id="hi" name="hi">
                                <option>-------</option>
                                <?php for($l=1;$l<32;$l++){ ?>
                                <option value="<?php print $l ?>"<?php if ($user_day == $l) { print ' selected'; }; ?>><?php print $l ?></option>
                                <?php } ?>
                            </select>日
                            <?php if(isset($erhi)){ ?>
                            <p class="error"><?=$erhi?></p>
                            <?php } ?>
                        </div>

                    <!-- 電話番号　-->
                    <div class="form_box">
                        <h3 class="form_h3">電話番号<span class=""></span></h3>
                        <p class="form_item">
                            半角数字
                        </p>
                            <input type="text" id="tel" name="cal" maxlength="13" placeholder="例）090-1234-9876" value="<?php print $tel ?>"  />
                        <?php if(isset($ertel)){ ?>
                        <p class="error"><?=$ertel?></p>
                        <?php } ?>
                    </div>

                            <!-- メールアドレス　-->
                    <div class="form_box">
                        <h3 class="form_h3">メールアドレス<span class=""></span></h3>
                        <p class="form_item">
                            <?=$mail?>
                        </p>
                    </div>

                            <!-- パスワード　-->
                    <div class="form_box">
                        <h3 class="form_h3">パスワード<span class=""></span></h3>
                        <p class="form_item">
                             ************************
                        </p>
                    </div>

                <div id="submit_box">
                    <input id="sub" type="submit" name="submit01" value="変更内容確認画面へ">
                </div>
                </form>
            </div>
        </section>
		</section>
	</div>
	</div><!--cfx閉じる-->
</article>
<!--ここまででコンテントの内容終わる　-->
<?php html_footer(); ?>
</div>	<!--wrap終了-->
</body>
</html>
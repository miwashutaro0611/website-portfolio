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
		<li class="flL"><a href="../../mypage/user/">ユーザ情報確認</a></li>
        <span class="flL">></span>
        <li class="flL">ユーザ情報変更内容確認</li>
	</ol>
</div>
<!--ここからコンテントの内容始まる　-->
<article>
	<?php mypage_nav(); ?>
	<div class="flL">
		<section id="users">
			<h2>ユーザ情報変更内容確認</h2>
			 <div id="cform">
                <form action="finish.php" method="post">
                        <div id="form_check" class="cfx">
                                    <!-- お名前　-->
                            <div class="form_box-min cfx">
                                <h3 class="form_h3-min">お名前</h3>
                                <p class="flL checktext"><?=$_GET["sei"]?><?=$_GET["mei"]?></p>
                                <input type="hidden" name="fname" value="<?=$_GET["sei"]?>"><!-- 苗字(漢字) -->
                                <input type="hidden" name="sname" value="<?=$_GET["mei"]?>"><!-- 名前(漢字) -->
                            </div>
                                    <!-- カナ　-->
                            <div class="form_box-min cfx">
                                <h3 class="form_h3-min">カナ</h3>
                                <p class="flL checktext"><?=$_GET["ksei"]?><?=$_GET["kmei"]?></p>
                                <input type="hidden" name="kfname" value="<?=$_GET["ksei"]?>"><!-- 苗字(カナ) -->
                                <input type="hidden" name="ksname" value="<?=$_GET["kmei"]?>"><!-- 名前(カナ) -->
                            </div>

                                    <!-- 性別　-->
                            <div class="form_box-min cfx">
                                <h3 class="form_h3-min">性別</h3>
																<?php
																	if($sex == 1){
																		$sex_print = "男性";
																	}else{
																		$sex_print = "女性";
																	}
																?>
                                <p class="flL checktext"><?=$sex_print?></p>
                                <input type="hidden" name="sex" value="<?=$sex?>"><!-- 性別 -->
                            </div>
                                    <!-- 郵便番号　-->
                            <div class="form_box-min cfx">
                                <h3 class="form_h3-min">郵便番号</h3>
                                <p class="flL checktext"><?=$_GET["zip1"]?>-<?=$_GET["zip2"]?></p>
                                <input type="hidden" name="zip1" value="<?=$_GET["zip1"]?>"><!-- 郵便番号１ -->
                                <input type="hidden" name="zip2" value="<?=$_GET["zip2"]?>"><!-- 郵便番号２ -->
                            </div>
                                    <!-- 住所　-->
                            <div class="form_box-min cfx">
                                <h3 class="form_h3-min">住所</h3>
                                <p class="flL checktext"><?=$_GET["addressku"] ?></p>
                                <input type="hidden" name="addressku" value="<?=$_GET["addressku"]?>"><!-- 住所 -->
                            </div>
                                    <!-- 生年月日　-->
                            <div class="form_box-min cfx">
                                <h3 class="form_h3-min">生年月日</h3>
                                <p class="flL checktext"><?=$_GET["nen"]?>年<?=$_GET["tuki"]?>月<?=$_GET["hi"]?>日</p>
                                <input type="hidden" name="umare1" value="<?=$_GET["nen"]?>"><!-- 年 -->
                                <input type="hidden" name="umare2" value="<?=$_GET["tuki"]?>"><!-- 月 -->
                                <input type="hidden" name="umare3" value="<?=$_GET["hi"]?>"><!-- 日 -->
                            </div>

                                    <!-- 電話番号　-->
                            <div class="form_box-min cfx">
                                <h3 class="form_h3-min">電話番号</h3>
                                <p class="flL checktext"><?=$_GET["cal"]?></p>
                                <input type="hidden" name="tel" value="<?=$_GET["cal"]?>"><!-- 電話番号 -->
                            </div>

                                    <!-- メールアドレス　-->
                            <div class="form_box-min cfx">
                                <h3 class="form_h3-min">メールアドレス</h3>
                                <p class="flL checktext"><?php print $mail; ?></p>
                            </div>

                                    <!-- パスワード　-->
                            <div class="form_box-min cfx">
                                <h3 class="form_h3-min">パスワード</h3>
                                <p class="flL checktext">***********************</p>
                            </div>
                    </div>
                    <p class="back flL txC"><a href="../user/">戻る</a></p>
                    <div class="btn flL">
                    <input type="submit" class="post" id="submit_button" name="submit_prev" value="変更する" >
                    </div>
                    <input type="hidden" name="userid" value="<?=$_SESSION['id']?>">
                </form>
	       </div>
        </section>
	</div><!--cfx閉じる-->
</article>
<!--ここまででコンテントの内容終わる　-->
<?php html_footer(); ?>
</div>	<!--wrap終了-->
</body>
</html>

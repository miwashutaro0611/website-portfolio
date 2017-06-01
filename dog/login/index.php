<?php
//クッキー・セッションのphp
require_once("../core/session_cookie.php");

//  ログインのphp
require_once("../core/login.php");

//ヘッダー・フッター・キャプションの内容を入れる場所(public.php)
require_once("../view/public.php");


//////////////////////////////////////////
//head内の文章入力場所　開始
//////////////////////////////////////////


//ファイルの回想を記入
$level = '../';
//使用するcssを記入
$css = '<link rel="stylesheet" href="../css/login.css" type="text/css" />';
//使用するjavascript(jQuery)を記入
$js = '';
//サイトのタイトルを記入
$title = 'ログイン｜ワンコム';
//サイトのキーワードを記入(表示には関係ない・任意)
$keywords = '犬,里親,コミュニティ,飼い主';
//サイトの説明文を記入(表示には関係ない・任意)
$description = 'ワンコムログインページです。ワンコムにログインするとさまざまな人とよりつながることができます。';
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
		<li class="flL"><a href="../login/">ログイン</a></li>
	</ol>
</div>
<!--ここからコンテントの内容始まる　-->
<article>
	<section id="login" class="cfx">
		<div class="log box flL">
			<div class="cfx login_title">
				<h2 class="flL">ログイン</h2>
				<p class="flL hosoku">ワンコム会員の方はコチラ</p>
			</div>
			<form action="" method="post">
				<h3>ログインID(メールアドレス)</h3>
				<input id="txt" type="text" name="email" size="35" maxlength="255" value="<?php echo @htmlspecialchars($_POST['email']); ?>" placeholder="mailaddress" />
			<h3>パスワード</h3>
			<input id="pass" type="password" name="password" size="35" maxlength="255" value="<?php echo @htmlspecialchars($_POST['password']); ?>" placeholder="password" /><br>
			<label class="label-checkbox">
				<input id="save" class="label-checkbox" type="checkbox" name="save" value="on">
				<span class="lever">ログイン情報を保持する</span>
			</label>

			<?php if($error['login'] == 'blank'){ ?>
			<div class="er">
				<p class="error">メールアドレスとパスワードをご記入ください</p>
			</div>
			<?php } ?>
			<?php if($error['login'] == 'failed'){ ?>
				<div class="er">
			<p class="error">ログインに失敗しました。正しくご記入ください。
			</p>
		</div>
			<?php } ?>

				<input id="btn" name="btn" type="submit" value="ログイン" />
			</form>
		</div>
		<div class="new box flL">
			<div class="cfx login_title">
				<h2 class="flL">新規登録</h2>
				<p class="flL hosoku">新規の方はコチラ</p>
			</div>
			<p class="img"><img src="../img/newlogin.jpg" width="335" height="100" alt="新規登録"/></p>
			<p class="newtext">ワンコムは登録料・利用料・年会費全て無料でご利用いただけるコミュニティサイトになっております。ワンコム会員に登録して犬友を作ろう！！</p>
			<a href="../signup/"><p class="botton">新規登録へ</p></a>
		</div>
	</section>
</article>
<!--ここまででコンテントの内容終わる　-->
<?php html_footer(); ?>
</div>	<!--wrap終了-->
</body>
</html>

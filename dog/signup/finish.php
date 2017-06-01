<?php
//クッキー・セッションのphp
require_once("../core/session_cookie.php");

//  HTTPヘッダーで文字コードを指定
header("Content-Type:text/html; charset=UTF-8");

//ヘッダー・フッター・キャプションの内容を入れる場所(public.php)
require_once("../core/user_insert.php");

//ヘッダー・フッター・キャプションの内容を入れる場所(public.php)
require_once("../view/public.php");


//////////////////////////////////////////
//head内の文章入力場所　開始
//////////////////////////////////////////


//ファイルの回想を記入
$level = '../';
//使用するcssを記入
$css = '<link rel="stylesheet" href="../css/signup.css" type="text/css" />';
//使用するjavascript(jQuery)を記入
$js = '';
//サイトのタイトルを記入
$title = '新規登録-完了｜ワンコム';
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
		<span class="flL">></span>
	    <li class="flL">ペット情報登録</li>
		<span class="flL">></span>
		<li class="flL">登録確認</li>
		<span class="flL">></span>
		<li class="flL">登録完了</li>
	</ol>
</div>
<!--ここからコンテントの内容始まる　-->
<section id="section_1">
  <div class="step">
            <ul class="cfx">
                <li class="flL step_item"><span>STEP1:<br />ユーザー情報を入力</span></li>
                <li class="flL step_item"><span>STEP2:<br />ペット情報の入力</span></li>
                <li class="flL step_item"><span>STEP3:<br />ユーザー情報を確認</span></li>
                <li class="flL step_item item_active"><span>STEP4:<br />登録完了</span></li>
            </ul>
        </div>
    </section>
<article>
<article>
        <section id="finish">
        <h2>ユーザ情報登録完了</h2>
	        <p class="text">ユーザ情報の登録が完了いたしました。<br>引き続きワンコムをお楽しみください。</p>
	        <p class="waku txC"><a href="../login/">ログインページへ</a><span>></span></p>
	        <p class="redtext txC">※ログインはまだ完了しておりません。ログインはログインページから行うことができます。</p>
        </section>
</article>
<!--ここまででコンテントの内容終わる　-->
<?php html_footer(); ?>
</div>	<!--wrap終了-->
</body>
</html>

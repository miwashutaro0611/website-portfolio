<?php

//クッキー・セッションのphp
require_once("../core/session_cookie.php");

//  HTTPヘッダーで文字コードを指定
header("Content-Type:text/html; charset=UTF-8");

// require_once("../core/news_janru.php");
//
// require_once("../core/news_list.php");
//ニュース取得api
require_once("../core/api_news_list.php");


//ヘッダー・フッター・キャプションの内容を入れる場所(public.php)
require_once("../view/public.php");

//////////////////////////////////////////
//head内の文章入力場所　開始
//////////////////////////////////////////

//ファイルの回想を記入
$level = '../';
//使用するcssを記入
$css = '<link rel="stylesheet" href="../css/news.css" type="text/css" />';
//使用するjavascript(jQuery)を記入
$js = '';
//サイトのタイトルを記入
$title = 'ニュースページ｜ワンコム';
//サイトのキーワードを記入(表示には関係ない・任意)
$keywords = '犬,里親,コミュニティ,飼い主';
//サイトの説明文を記入(表示には関係ない・任意)
$description = 'ワンコムニュースページです。ワンコムにログインするとさまざまな人とよりつながることができます。';
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
		<li class="flL"><a href="../news/">ニュース</a></li>
		<?php if(isset($_GET["id"])){ ?>
		<span class="flL">></span>
		<li class="flL"><a href="../news/?id=<?=$_GET["id"]?>"><?=$pan_name?></a></li>
		<?php } ?>
	</ol>
</div>
<!--ここからコンテントの内容始まる　-->
<article>
	<section id="newsmain">
		<img src="../img/newstop.jpg" alt="ニューストップ">
	</section>
	<section id="news_nav">
		<ul class="cfx">
			<li class="all txC flL color0"><a href="../news/">全て</a></li>
			<li class="list txC flL color1"><a href="../news/?id=1">犬について</a></li>
			<li class="list txC flL color2"><a href="../news/?id=2">ペット情報</a></li>
			<li class="list txC flL color3"><a href="../news/?id=3">ドッグラン情報</a></li>
			<li class="list txC flL color4"><a href="../news/?id=4">飼い方</a></li>
			<li class="list txC flL color5"><a href="../news/?id=5">犬との生活</a></li>
			<li class="list txC flL color6"><a href="../news/?id=6">イベントについて</a></li>
		</ul>
	</section>
	<section id="newsdetail">
	<div class="news_area">
		<p class="hosoku">※こちらは外部ページへ移動します。</p>
		<?php
		foreach ($rss_urls as $url) :
		$result = rss_get_contents($url);
		$rss = simplexml_load_string($result);
		;?>
				<?php outPutRss($rss,10);?>
		<?php endforeach;?>
		<!-- <dl class="cfx">
			<dt class="time">12/01 11:01:01</dt>
			<dt class="news_content">タイトルタイトルタイトルタイトルタイトルタイトルタイトルタイトルタイトルタイトルタイトルタイトルタイトルタイトルタイトルタイトルタイトル</dt>
		</dl>
		<dd class="text">内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容</dd>
		<dd class="link txR"><a href="#">このニュースを見る</a></dd>
		<dl class="cfx">
			<dt class="time">12/01 11:01:01</dt>
			<dt class="news_content">タイトル</dt>
		</dl>
		<dd class="text">内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容</dd>
		<dd class="link txR"><a href="#">このニュースを見る</a></dd> -->
	</div>
	</section>
</article>
<!--ここまででコンテントの内容終わる　-->
<?php html_footer(); ?>
</div>	<!--wrap終了-->
</body>
</html>

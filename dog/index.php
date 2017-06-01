<?php

//クッキー・セッションのphp
require_once("core/session_cookie.php");

//  HTTPヘッダーで文字コードを指定
header("Content-Type:text/html; charset=UTF-8");

// require_once("core/news.php");
//ニュース取得api
require_once("core/api_news.php");

//ヘッダー・フッター・キャプションの内容を入れる場所(public.php)
require_once("view/public.php");


//////////////////////////////////////////
//head内の文章入力場所　開始
//////////////////////////////////////////

//ファイルの回想を記入
$level = '';
//使用するcssを記入
$css = '<link rel="stylesheet" href="css/index.css" />
		<link rel="stylesheet" href="css/rhinoslider-1.05.css" />';
//使用するjavascript(jQuery)を記入
$js = '<script type="text/javascript" src="js/rhinoslider-1.05.min.js"></script>
		<script type="text/javascript" src="js/mousewheel.js"></script>
		<script type="text/javascript" src="js/index.js"></script>';
//サイトのタイトルを記入
$title = '犬と人との繋がりが生まれる新しいコミュニティサイト｜ワンコム';
//サイトのキーワードを記入(表示には関係ない・任意)
$keywords = '犬,里親,コミュニティ,飼い主';
//サイトの説明文を記入(表示には関係ない・任意)
$description = '犬と人との繋がりを生むことができる犬×人の新しいコミュニティサイト「ワンコム」。東京・大阪・名古屋・福岡・静岡など全国の人との繋がりを持つことができるサイトとなっております。';
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
<!--ここからコンテントの内容始まる　-->
<article>
	<section id="m_visual">
		<div id="main">
			<div id="page">
			<ul id="slider">
				<li><a href="friend/"><img src="img/main_1.jpg" alt="" /></a></li>
				<li><a href="store/"><img src="img/main_2.jpg" alt="" /></a></li>
				<li><a href="zukan/"><img src="img/main_3.jpg" alt="" /></a></li>
				<li><a href="news/"><img src="img/main_4.jpg" alt="" /></a></li>
			</ul>
		</div>
		</div>
		<div id="big_nav">
			<ul class="cfx">
				<li id="big1" class="flL"><a href="friend/"><span>友達検索</span></a></li>
				<li id="big2" class="flL"><a href="store/"><span>店舗検索</span></a></li>
				<li id="big3" class="flL"><a href="zukan/"><span>犬種一覧</span></a></li>
				<li id="big4" class="flL"><a href="news/"><span>ニュース</span></a></li>
			</ul>
		</div>
	</section>
	<section id="find">
		<h2>店舗を探す</h2>
		<div id="region">
			<h3>都道府県から探す</h3>
			<div class="shop cfx">
				<p id="touhoku" class="tihou flL">北海道・東北</p>
				<ul id="t1" class="cfx">
					<li class="flL"><a href="store/?ken=1">北海道</a></li>
					<li class="flL"><a href="store/?ken=2">青森</a></li>
					<li class="flL"><a href="store/?ken=3">岩手</a></li>
					<li class="flL"><a href="store/?ken=4">宮城</a></li>
					<li class="flL"><a href="store/?ken=5">秋田</a></li>
					<li class="flL"><a href="store/?ken=6">山形</a></li>
					<li class="flL"><a href="store/?ken=7">福島</a></li>
				</ul>
				<p id="hokuriku" class="tihou flL">北陸・甲信越</p>
				<ul id="t2" class="cfx">
					<li class="flL"><a href="store/?ken=19">山梨</a></li>
					<li class="flL"><a href="store/?ken=20">長野</a></li>
					<li class="flL"><a href="store/?ken=15">新潟</a></li>
					<li class="flL"><a href="store/?ken=16">富山</a></li>
					<li class="flL"><a href="store/?ken=17">石川</a></li>
					<li class="flL"><a href="store/?ken=18">福井</a></li>
				</ul>
				<p id="kantou" class="tihou flL">関東</p>
				<ul id="t3" class="cfx">
					<li class="flL"><a href="store/?ken=13">東京</a></li>
					<li class="flL"><a href="store/?ken=14">神奈川</a></li>
					<li class="flL"><a href="store/?ken=11">埼玉</a></li>
					<li class="flL"><a href="store/?ken=12">千葉</a></li>
					<li class="flL"><a href="store/?ken=8">茨城</a></li>
					<li class="flL"><a href="store/?ken=9">栃木</a></li>
					<li class="flL"><a href="store/?ken=10">群馬</a></li>
				</ul>
				<p id="tokai" class="tihou flL">東海</p>
				<ul id="t4" class="cfx">
					<li class="flL"><a href="store/?ken=23">愛知</a></li>
					<li class="flL"><a href="store/?ken=22">静岡</a></li>
					<li class="flL"><a href="store/?ken=21">岐阜</a></li>
					<li class="flL"><a href="store/?ken=24">三重</a></li>
				</ul>
				<p id="kansai" class="tihou flL">関西</p>
				<ul id="t7" class="cfx">
					<li class="flL"><a href="store/?ken=27">大阪</a></li>
					<li class="flL"><a href="store/?ken=28">兵庫</a></li>
					<li class="flL"><a href="store/?ken=26">京都</a></li>
					<li class="flL"><a href="store/?ken=25">滋賀</a></li>
					<li class="flL"><a href="store/?ken=29">奈良</a></li>
					<li class="flL"><a href="store/?ken=30">和歌山</a></li>
				</ul>
				<p id="tyugoku" class="tihou flL">四国・中国</p>
				<ul id="t5" class="cfx">
					<li class="flL"><a href="store/?ken=31">鳥取</a></li>
					<li class="flL"><a href="store/?ken=32">島根</a></li>
					<li class="flL"><a href="store/?ken=33">岡山</a></li>
					<li class="flL"><a href="store/?ken=34">広島</a></li>
					<li class="flL"><a href="store/?ken=35">山口</a></li>
					<li class="flL"><a href="store/?ken=36">徳島</a></li>
					<li class="flL"><a href="store/?ken=37">香川</a></li>
					<li class="flL"><a href="store/?ken=38">愛媛</a></li>
					<li class="flL"><a href="store/?ken=39">高知</a></li>
				</ul>
				<p id="kyusyu" class="tihou flL">九州・沖縄</p>
				<ul id="t6" class="cfx">
					<li class="flL"><a href="store/?ken=40">福岡</a></li>
					<li class="flL"><a href="store/?ken=41">佐賀</a></li>
					<li class="flL"><a href="store/?ken=42">長崎</a></li>
					<li class="flL"><a href="store/?ken=43">熊本</a></li>
					<li class="flL"><a href="store/?ken=44">大分</a></li>
					<li class="flL"><a href="store/?ken=45">宮崎</a></li>
					<li class="flL"><a href="store/?ken=46">鹿児島</a></li>
					<li class="flL"><a href="store/?ken=47">沖縄</a></li>
				</ul>
			</div>
		</div>
		<div id="facility">
			<h3>施設から探す</h3>
			<ul class="cfx">
				<li class="flL"><a href="store/?store_janru=1">ペットホテル</a></li>
				<li class="flL"><a href="store/?store_janru=2">ペットトリミング</a></li>
				<li class="flL"><a href="store/?store_janru=3">ドッグラン</a></li>
				<li class="flL"><a href="store/?store_janru=4">ペットOKカフェレストラン</a></li>
				<li class="flL"><a href="store/?store_janru=5">ペットしつけ教室</a></li>
				<li class="flL"><a href="store/?store_janru=6">ペットシッター</a></li>
				<li class="flL"><a href="store/?store_janru=7">ペットと泊まれる宿</a></li>
				<li class="flL"><a href="store/?store_janru=8">ペットショップ</a></li>
				<li class="flL"><a href="store/?store_janru=9">グッズショップ</a></li>
				<li class="flL"><a href="store/?store_janru=10">ペット専門学校、スクール</a></li>
				<li class="flL"><a href="store/?store_janru=11">火葬場・霊園</a></li>
				<li class="flL"><a href="store/?store_janru=12">動物病院</a></li>
				<li class="flL"><a href="store/?store_janru=13">ブリーダー</a></li>
				<li class="flL"><a href="store/?store_janru=14">ペット関連(その他)</a></li>
			</ul>
		</div>
	</section>
	<section id="news">
		<h2>ニュース</h2>
		<div class="news_area">
			<p class="hosoku">※ニュースタイトルをクリックすると外部ページへ飛びます。</p>
			<?php
			foreach ($rss_urls as $url) :
			$result = rss_get_contents($url);
			$rss = simplexml_load_string($result);
			;?>
					<?php outPutRss($rss,6);?>
			<?php endforeach;?>
			<p class="more txR"><a href="news/">>もっと見る</p>
		</div>
	</section>
</article>
<!--ここまででコンテントの内容終わる　-->
<?php html_footer(); ?>
</div>	<!--wrap終了-->
</body>
</html>

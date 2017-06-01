<?php
//クッキー・セッションのphp
require_once("../core/session_cookie.php");

require_once("../core/store_detail_ken.php");

require_once("../core/store_detail_name.php");

$uid=$_SESSION['id'];
$storeid = $_GET["store"];
$ken = $_GET["ken"];
$score = $_POST["score"];
$text = $_POST["textarea"];

require_once("../core/review_check.php");

require_once("../core/review_insert.php");

//ヘッダー・フッター・キャプションの内容を入れる場所(public.php)
require_once("../view/public.php");


//////////////////////////////////////////
//head内の文章入力場所　開始
//////////////////////////////////////////


//ファイルの回想を記入
$level = '../';
//使用するcssを記入
$css = '<link rel="stylesheet" href="../css/store.css" type="text/css" />';
//使用するjavascript(jQuery)を記入
$js = '';

//サイトのタイトルを記入
$title = '店舗詳細｜ワンコム';
//サイトのキーワードを記入(表示には関係ない・任意)
$keywords = '犬,里親,コミュニティ,飼い主';
//サイトの説明文を記入(表示には関係ない・任意)
$description = 'ワンコム店舗詳細ページです。ワンコムを利用してさまざまな人と交流を持ちましょう！';
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
		<li class="flL"><a href="../store/">店舗検索</a></li>
		<span class="flL">></span>
		<li class="flL"><a href="../store/?ken=<?=$_GET['ken']?>"><?=$detailken?>のお店</a></li>
		<span class="flL">></span>
		<li class="flL"><a href="../store/detail.php?store=<?=$_GET['store']?>&amp;ken=<?=$_GET['ken']?>"><?=$store_name?></a></li>
		<span class="flL">></span>
		<li class="flL"><a href="../store/review.php?store=<?=$_GET['store']?>&amp;ken=<?=$_GET['ken']?>"><?=$store_name?>の口コミ</a></li>
		<span class="flL">></span>
		<li class="flL">口コミ内容確認</li>
		<span class="flL">></span>
		<li class="flL">口コミ投稿完了</li>
	</ol>
</div>
<!--ここからコンテントの内容始まる　-->
<article>
	<section id="end">
		<h2>投稿完了</h2>
		<p class="text">
			<?=$store_name?>の口コミにご登録いただきありがとうございます。<br>
			引き続きワンコムをお楽しみください！！
		</p>
		<p class="btn txC"><a href="detail.php?store=<?=$_GET['store']?>&amp;ken=<?=$_GET['ken']?>">店舗ページへ行く</a></p>
	</section>
</article>
<!--ここまででコンテントの内容終わる　-->
<?php html_footer(); ?>
</div>	<!--wrap終了-->
</body>
</html>

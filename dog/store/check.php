<?php
//クッキー・セッションのphp
require_once("../core/session_cookie.php");

require_once("../core/store_detail_ken.php");

require_once("../core/store_detail_name.php");

require_once("../core/favo_seurch.php");



//ヘッダー・フッター・キャプションの内容を入れる場所(public.php)
require_once("../view/public.php");

//////////////////////////////////////////
//受け取った情報を取得
//////////////////////////////////////////
$star = $_POST["score"];
$text_area = $_POST["textarea"];

//////////////////////////////////////////
//head内の文章入力場所　開始
//////////////////////////////////////////


//ファイルの回想を記入
$level = '../';
//使用するcssを記入
$css = '<link rel="stylesheet" href="../css/store.css" type="text/css" /><link rel="stylesheet" href="../css/jquery.raty.css">';
//使用するjavascript(jQuery)を記入
$js = '<script src="../js/jquery.raty.js"></script><script src="../js/store_detail_form.js"></script>';

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
	</ol>
</div>
<!--ここからコンテントの内容始まる　-->
<article>
	<section id="review_check">
	<form action="end.php?store=<?=$_GET['store']?>&amp;ken=<?=$_GET['ken']?>" method="post">
		<h3>評価</h3>
		<p class="img cfx">
			<?php for($review=1;$review<6;$review++){ ?>
			<?php if($review <= $star){ ?>
				<img src="star-on.png" alt="星">
			<?php }else{ ?>
				<img src="star-off.png" alt="星">
			<? } ?>
			<? } ?>
		</p>
		<input type="hidden" name="score" value="<?=$star?>">
		<h3>コメント</h3>
		<?php if($text_area != ""){ ?>
			<p><?=nl2br($text_area)?></p>
		<?php }else{ ?>
			<p>未入力</p>
		<?php } ?>
		<p class="kome">
			※口コミを登録されている場合にはこの内容の口コミを登録し、<br>
			前回の登録された情報は削除されます。
		</p>
		<input type="hidden" name="textarea" value="<?=$text_area?>">
		<input type="submit" class="flR min" name="next" value="投稿する">
	</form>
	<form action="review.php?store=<?=$_GET['store']?>&amp;ken=<?=$_GET['ken']?>" method="post">
		<input type="hidden" name="score" value="<?=$star?>">
		<input type="hidden" name="textarea" value="<?=$text_area?>">
		<input type="submit" class="flL min" name="prev" value="戻る">
	</form>
	</section>

</article>
<!--ここまででコンテントの内容終わる　-->
<?php html_footer(); ?>
</div>	<!--wrap終了-->
</body>
</html>

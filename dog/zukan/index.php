<?php
//クッキー・セッションのphp
require_once("../core/session_cookie.php");

require_once("../core/zukan_list.php");

//ヘッダー・フッター・キャプションの内容を入れる場所(public.php)
require_once("../view/public.php");


//////////////////////////////////////////
//head内の文章入力場所　開始
//////////////////////////////////////////


//ファイルの回想を記入
$level = '../';
//使用するcssを記入
$css = '<link rel="stylesheet" href="../css/zukan.css" type="text/css" />';
//使用するjavascript(jQuery)を記入
$js = '<script type="text/javascript" src="../js/jquery.MyThumbnail.js"></script>
		 	 <script type="text/javascript" src="../js/zukan_images.js"></script>';
//サイトのタイトルを記入
$title = '犬図鑑｜ワンコム';
//サイトのキーワードを記入(表示には関係ない・任意)
$keywords = '犬,里親,コミュニティ,飼い主';
//サイトの説明文を記入(表示には関係ない・任意)
$description = 'ワンコム犬図鑑一覧ページです。ワンコムを利用してさまざまな人と交流を持ちましょう！';
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
		<li class="flL"><a href="../zukan/">図鑑一覧</a></li>
		<?php if(isset($_GET['janru'])){ ?>
		<span class="flL">></span>
		<li class="flL"><a href="../zukan/?janru=<?=$dog_janru_id?>"><?=$dog_janru_name?></a></li>
		<?php } ?>
	</ol>
</div>
<!--ここからコンテントの内容始まる　-->
<article>
	<p id="zukanmain">
		<img src="../img/zukantop.jpg" alt="図鑑トップ">
	</p>
	<p class="zukannav"><a href="../zukan">全て</a> | <a href="?janru=1">小型犬</a> | <a href="?janru=2">中型犬</a> | <a href="?janru=3">大型犬</a></p>
	<section id="zukan" class="cfx">
		<?php for($i=0;$i<count($DOG_JANRU_ID);$i++){ ?>
			<div class="waku flL txC">
				<h2><a href="detail.php?dog=<?=$DOG_BOOK_ID[$i]?>"><img src="../img/dog/<?=$DOG_BOOK_ID[$i]?>.jpg" alt="<?=$DOG_BOOK_NAME[$i]?>" width="100%"></a></h2>
				<h3><?=$DOG_BOOK_NAME[$i]?></h3>
				<p><a href="?janru=<?=$DOG_JANRU_ID[$i]?>"><?=$DOG_JANRU_NAME[$i]?></a></p>
				<p class="abu"><a href="detail.php?dog=<?=$DOG_BOOK_ID[$i]?>">詳しく見る</a></p>
			</div>
		<?php } ?>
	</section>
</article>
<!--ここまででコンテントの内容終わる　-->
<?php html_footer(); ?>
</div>	<!--wrap終了-->
</body>
</html>

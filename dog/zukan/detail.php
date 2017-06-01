<?php
//クッキー・セッションのphp
require_once("../core/session_cookie.php");

require_once("../core/zukan_detail.php");



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
		 	 <script type="text/javascript" src="../js/zukan_detail_images.js"></script>';
//サイトのタイトルを記入
$title = '犬詳細ページ｜ワンコム';
//サイトのキーワードを記入(表示には関係ない・任意)
$keywords = '犬,里親,コミュニティ,飼い主';
//サイトの説明文を記入(表示には関係ない・任意)
$description = 'ワンコム犬情報詳細ページです。ワンコムを利用してさまざまな人と交流を持ちましょう！';
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
		<li class="flL"><a href="../zukan/">図鑑一覧</a></li>
		<span class="flL">></span>
		<li class="flL"><a href="../zukan/?janru=<?=$dog_janru_id?>"><?=$dog_janru_name?></a></li>
		<span class="flL">></span>
		<li class="flL"><a href="../zukan/detail.php?dog=<?=$_GET['dog']?>"><?=$dog_name?></a></li>
	</ol>
</div>
<!--ここからコンテントの内容始まる　-->
<article>
	<section id="zukandetail">
		<div class="waku1 cfx">
			<p class="flL"><img src="../img/dog/<?=$_GET['dog']?>.jpg"></p>
			<div class="flL">
				<h2><?=$dog_name?></h2>
				<?php if(isset($dog_yurai)){ ?>
				<h3 class="title">名前の由来</h3>
				<p><?=nl2br($dog_yurai)?></p>
				<?php } ?>
			</div>
		</div>
		<?php if(isset($dog_history)){ ?>
		<h3 class="title"><?=$dog_name?>の歴史</h3>
		<p class="text"><?=nl2br($dog_history)?></p>
		<?php } ?>
		<h3 class="title"><?=$dog_name?>について</h3>
		<table>
			<tbody>
				<?php if(isset($dog_weight)){ ?>
				<tr>
					<th>体重</th>
					<td><?=$dog_weight?>g</td>
				</tr>
				<?php } ?>
				<?php if(isset($dog_janru_name)){ ?>
				<tr>
					<th>体型(大きさ)</th>
					<td><?=$dog_janru_name?></td>
				</tr>
				<?php } ?>
				<?php if(isset($dog_height)){ ?>
				<tr>
					<th>体高</th>
					<td><?=$dog_height?>cm</td>
				</tr>
				<?php } ?>
				<?php if(isset($dog_life)){ ?>
				<tr>
					<th>寿命</th>
					<td><?=$dog_life?>年</td>
				</tr>
				<?php } ?>
				<?php if(isset($dog_coat)){ ?>
				<tr>
					<th>被毛</th>
					<td><?=$dog_coat?></td>
				</tr>
				<?php } ?>
				<?php if(isset($dog_color)){ ?>
				<tr>
					<th>毛色(カラー)</th>
					<td><?=$dog_color?></td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
		<?php if(isset($dog_char)){ ?>
		<h3 class="title">性格</h3>
		<p class="text"><?=nl2br($dog_char)?></p>
		<?php } ?>
		<?php if(isset($dog_point)){ ?>
		<h3 class="title">日常での飼育ポイント</h3>
		<p class="text"><?=nl2br($dog_point)?></p>
		<?php } ?>
		<?php if(isset($dog_disease)){ ?>
		<h3 class="title">気をつけたい病気</h3>
		<p class="text"><?=nl2br($dog_disease)?></p>
		<?php } ?>
		<?php if(isset($dog_pointotext)){ ?>
		<h3 class="title">注意点</h3>
		<p class="text"><?=nl2br($dog_pointotext)?></p>
		<?php } ?>
	</section>
</article>
<!--ここまででコンテントの内容終わる　-->
<?php html_footer(); ?>
</div>	<!--wrap終了-->
</body>
</html>

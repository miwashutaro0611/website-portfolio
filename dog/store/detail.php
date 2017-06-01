<?php
//クッキー・セッションのphp
require_once("../core/session_cookie.php");

require_once("../core/store_detail_ken.php");

require_once("../core/store_detail_name.php");

require_once("../core/favo_seurch.php");

require_once("../core/store_review.php");

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
$js = '<script type="text/javascript" src="../js/jquery.MyThumbnail.js"></script>
		 	 <script type="text/javascript" src="../js/store_detail_images.js"></script>';

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
	</ol>
</div>
<!--ここからコンテントの内容始まる　-->
<article>
	<section id="storedetail">
		<div id="titlewaku">
			<small><?=$store_kana?></small>
			<h2><?=$store_name?></h2>
		</div>
		<?php if(isset($store_title)){ ?>
		<p class="storetitle"><?=nl2br($store_title)?></p>
		<?php } ?>
		<div class="waku cfx">
			<p class="flL"><img src="../img/store/<?=$store_id?>.jpg" alt="<?=$store_name?>"></p>
			<table class="flL">
				<tbody>
					<tr>
						<th>所在地</th>
						<td><?=$address01?></td>
					</tr>
					<tr>
						<th>電話</th>
						<td><?=$store_tel?></td>
					</tr>
					<tr>
						<th>駐車場</th>
						<td><?=$thusha?></td>
					</tr>
					<tr>
						<th>web</th>
						<td><a href="<?=$store_url?>" target="_blank" rel="nofollow"><?=$store_url?></a></td>
					</tr>
				</tbody>
			</table>
		</div>
		<p>
		<!--googleマップ
		<div id="google_map" style="width: 600px; height: 600px"></div>
		-->
		<h3>マップ</h3>
		<div id="map">
			<?=$address02?>
		</div>
		</p>
	</section>
	<section id="favo">
	<?php if(isset($_SESSION['id'])){ ?>
		<div class="favowaku">
			<p class="list2 txC">
			<?php if(!isset($fs)){ ?>
			<a href="../core/favostore.php?user=<?=$_SESSION['id']?>&amp;store=<?=$store_id?>">お気に入り登録する</a>
			<?php }else{ ?>
			<a href="../core/favo_del.php?userid=<?=$_SESSION['id']?>&amp;favo=<?=$store_id?>&amp;ken=<?=$_GET['ken']?>">お気に入りを解除する</a>
			<?php } ?>
			</p>
		</div>
	<?php }else{ ?>
		<div class="favowaku">
			<p class="list1 txC"><a href="../login/"><span>ログインをするとお気に入り登録が出来ます</span><br>ログインを行う</a></p>
		</div>
	<?php } ?>
	</section>
	<section id="kutikomi">
		<div class="cfx">
			<h2 clas="flL"><?=$store_name?>の口コミ</h2>
			<?php if(isset($_SESSION['id'])) { ?>
			<p class="btn flR txC"><a href="review.php?store=<?=$_GET['store']?>&amp;ken=<?=$_GET['ken']?>">投稿する</a></p>
			<?php } ?>
		</div>
		<?php if(isset($REVIEW_USER)){ ?>
			<?php for($i=0;$i<count($REVIEW_USER);$i++){ ?>
			<div class="toukou_waku">
				<div class="user_joho cfx">
					<?
					if($REVIEW_IMAGE[$i] == ""){
						$REVIEW_IMAGE[$i] = "noimage.jpg";
					}
					?>
					<p class="flL img"><img src="../img/user_img/<?=$REVIEW_IMAGE[$i]?>" alt="画像" width="100px" height="100px"></p>
					<p class="flL username"><a href="../friend/detail.php?id=<?=$REVIEW_USER[$i]?>"><?=$REVIEW_FIRST_NAME[$i]?><?=$REVIEW_SECOND_NAME[$i]?></a></p>
				</div>
				<p class="timestmp">投稿日時 : <?=$timedata[$i]?></p>
				<div class="star cfx">
					<h3 class="flL">評価</h3>
					<p class="img flL">
						<?php for($review=1;$review<6;$review++){ ?>
						<?php if($review <= $REVIEW_SCORE[$i]){ ?>
							<img src="star-on.png" alt="星">
						<?php }else{ ?>
							<img src="star-off.png" alt="星">
						<? } ?>
						<? } ?>
					</p>
				</div>
				<h4>投稿内容：</h4>
				<?php if(isset($REVIEW_TEXT)){ ?>
				<div class="text_area">
					<?php if($REVIEW_TEXT[$i] != ""){ ?>
					<?=nl2br($REVIEW_TEXT[$i])?>
					<?php }else{ ?>
						未登録
					<?php } ?>
				</div>
				<?php } ?>
			</div>
			<?php } ?>
		<?php }else{ ?>
			<p class="txC">現在口コミされている情報はございません。</p>
		<?php } ?>
	</section>

</article>
<!--ここまででコンテントの内容終わる　-->
<?php html_footer(); ?>
</div>	<!--wrap終了-->
</body>
</html>

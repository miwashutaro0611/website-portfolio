<?php
//クッキー・セッションのphp
require_once("../core/session_cookie.php");

require_once("../core/ken.php");

require_once("../core/store_janru.php");
if(!isset($_POST["store_seurch"])){
	require_once("../core/seurch_store.php");

	require_once("../core/seurch_store_list.php");
}else{
	require_once("../core/seurch_store_post.php");

	require_once("../core/seurch_store_list_post.php");
}
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
			 <script type="text/javascript" src="../js/store_images.js"></script>';
//サイトのタイトルを記入
$title = '店舗検索｜ワンコム';
//サイトのキーワードを記入(表示には関係ない・任意)
$keywords = '犬,里親,コミュニティ,飼い主';
//サイトの説明文を記入(表示には関係ない・任意)
$description = 'ワンコム店舗検索ページです。ワンコムを利用してさまざまな人と交流を持ちましょう！';
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
	</ol>
</div>
<!--ここからコンテントの内容始まる　-->
<article>
	<p id="tomodatimain">
		<img src="../img/storetop.jpg" alt="店舗・施設検索トップ">
	</p>
	<section id="kensaku">
	<form action="../store/" method="post">
		<h3>条件検索</h3>
		<div class="find cfx">
			<p class="flL">エリアから探す</p>
			<div class="custom flL">
				<select name="ken">
					<option value="0">選択してください</option>
					<?php for($i=1;$i<47;$i++){ ?>
					<option value="<?=$i+1?>"><?=$KEN[$i]?></option>
					<?php } ?>
				</select>
			</div>
		</div>
		<div class="find cfx">
		<p class="flL">施設から探す</p>
			<div class="custom flL">
				<select name="store_janru">
					<option value="0">選択してください</option>
					<?php for($i=0;$i<count($STORENAME);$i++){ ?>
					<option  class="<?=$i+1?>" value="<?=$i+1?>"><?=$STORENAME[$i]?></option>
					<?php } ?>
				</select>
			</div>
		</div>
		<input type="submit" id="btn" name="store_seurch" value="検索する">
	</form>
	</section>
	<section id="kekka">
		<h3>検索結果:<span><?=$ken_result?></span>
		<?php if($ken_result !="" && $store_result !=""){ ?>
		,
		<?php } ?>
		<span><?=$store_result?></span></h3>
		<?php if(isset($STORE_ID_LIST)){?>
		<?php for($i=0;$i<count($STORE_ID_LIST);$i++){ ?>
		<div class="waku cfx">
			<p class="image flL"><img src="../img/store/<?=$STORE_ID_LIST[$i]?>.jpg"></p>
			<p class="store flL">店舗名：<?=$STORE_NAME_LIST[$i]?></p>
			<p class="storejanru flL">ジャンル：<?=$STORE_JANRU_NAME_LIST[$i]?></p>
			<p class="address flL">住所：<?=$STORE_ADDRESS_LIST[$i]?></p>
			<p class="cal flL">電話番号：<?=$STORE_TEL_LIST[$i]?></p>
			<?php if(isset($STORE_TITLE_LIST[$i])){ ?>
			<h4>お店から一言</h4>
			<p class="setumei"><?=nl2br($STORE_TITLE_LIST[$i])?></p>
			<?php } ?>
		</div>
		<p class="more"><a href="detail.php?store=<?=$STORE_ID_LIST[$i]?>&amp;ken=<?=$PREFECTURE_ID_LIST[$i]?>">詳しくはコチラ</a></p>
		<?php } ?>
		<?php }else{ ?>
			<p class="txC">検索結果なし</p>
		<?php } ?>
	</section>
</article>
<!--ここまででコンテントの内容終わる　-->
<?php html_footer(); ?>
</div>	<!--wrap終了-->
</body>
</html>

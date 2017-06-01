<?php


//クッキー・セッションのphp
require_once("../core/session_cookie.php");

//ログインチェック
//していない場合トップページに戻す
if(!isset($_SESSION['id'])){
	//絶対参照
	header("Location: ../");
	exit();
}

//ファイルの回想を記入
$level = '../';

require_once("../core/mypage.php");

//フォロー一覧
require_once("../core/mypagefriend.php");

//フォロワー一覧
require_once("../core/mypageuke.php");

//お気に入り店舗一覧
require_once("../core/mypagestore.php");

//ヘッダー・フッター・キャプションの内容を入れる場所(public.php)
require_once("../view/public.php");

//////////////////////////////////////////
//head内の文章入力場所　開始
//////////////////////////////////////////



//使用するcssを記入
$css = '<link rel="stylesheet" href="../css/mypage.css" type="text/css" />';
//使用するjavascript(jQuery)を記入
$js = '<script type="text/javascript" src="../js/chat.js"></script>
			 <script type="text/javascript" src="../js/jquery.MyThumbnail.js"></script>
			 <script type="text/javascript" src="../js/mypage_images/mypage_images.js"></script>';
//$js = '';
//サイトのタイトルを記入
$title = 'マイページ｜ワンコム';
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
//$lcheck = '<p class="flL"><a href="#">新規登録</a></p><p class="flL"><a href="'.$level.'login/">ログイン</a></p>';
$lcheck = '<p class="flL"><a href="'.$level.'mypage/">Myページ</a></p><p class="flL"><a href="'.$level.'core/logout.php">ログアウト</a></p>';
}else{
//$lcheck = '<p class="flL"><a href="#">Myページ</a></p><p class="flL"><a href="'.$level.'core/logout.php">ログアウト</a></p>';
$lcheck = '<p class="flL"><a href="'.$level.'signup/">新規登録</a></p><p class="flL"><a href="'.$level.'login/">ログイン</a></p>';
}

///////////////////////////////////////
//database
///////////////////////////////////////
/*3桁ごとにカンマを入れる
$a = 10000000;
$a = number_format($a);
echo $a;
*/
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
		<li class="flL"><a href="../mypage/">マイページ</a></li>
	</ol>
</div>
<!--ここからコンテントの内容始まる　-->
<article>
	<?php mypage_nav(); ?>
	<div id="chat" class="flL">
	<section id="mypets">
		<h2>ペット一覧</h2>
		<?php if(isset($PET_NAME)){ ?>
		<ul class="cfx txC">
		<?php for($i=0;$i<count($PET_NAME);$i++){ ?>
			<li class="flL">
				<h3><img src="../img/user_img/<?=$IMAGE[$i]?>"/></h3>
				<h4>
				<?php if($PET_NAME[$i] != ""){ ?>
				<?=$PET_NAME[$i]?>
				<?php }else{ ?>
				未登録
				<?php } ?>
				</h4>
				<p>
				<?php if($PET_LIST_NAME[$i] != ""){ ?>
				<a href="../zukan/detail.php?dog=<?=$BOOK_ID[$i]?>"><?=$PET_LIST_NAME[$i]?></a>
				<?php }else{ ?>
				未登録
				<?php } ?>
				</p>
				<p><a href="../core/set.php?petid=<?=$PET_ID[$i]?>&amp;userid=<?=$_SESSION['id']?>">この犬に変更する</a></p>
				<p><a href="pet/change/?pet_id=<?=$PET_ID[$i]?>">確認・変更する</a></p>
			</li>
		<?php } ?>
		</ul>
		<p class="txR"><a href="pet/">一覧を見る</a></p>
		<?php }else{ ?>
		<p class="nopet txC">ただいま登録しているペットはありません。</p>
		<p class="nopetbtn txC"><a href="pet/add/">ペットを登録する</a></p>
		<?php } ?>
	</section>
	<section id="myfriends">
		<h2>フォロー一覧</h2>
		<?php if(isset($MYID)){ ?>
		<ul class="cfx txC">
		<?php for($i=0;$i<count($MYID);$i++){ ?>
			<li class="flL">
				<h3><img src="../img/user_img/<?=$PET_FRIEND_IMAGE[$i]?>"/></h3>
				<h4><?=$PET_LIST_FNAME[$i],$PET_LIST_SNAME[$i]?></h4>
				<p><?=$PET_FRIEND_NAME[$i]?></p>
				<p class="chat"><a class="link" href="../chat/?chatme=<?=$_SESSION['id']?>&amp;chatyou=<?=$FRIENDID[$i]?>" target="_blank">チャットをする</a></p>
				<p><a href="../friend/detail.php?id=<?=$FRIENDID[$i]?>">詳しく見る</a></p>
			</li>
		<?php } ?>
		</ul>
		<p class="txR"><a href="friend/">一覧を見る</a></p>
		<?php }else{ ?>
		<p class="no txC">ただいま登録している友達はいません。</p>
		<p class="nobtn txC"><a href="../friend/">友達を探す</a></p>
		<?php } ?>
	</section>
	<section id="myukes">
		<h2>フォロワー一覧</h2>
		<?php if(isset($MYIDBACK)){ ?>
		<ul class="cfx txC">
		<?php for($i=0;$i<count($MYIDBACK);$i++){ ?>
			<li class="flL">
				<h3><img src="../img/user_img/<?=$PET_FRIEND_IMAGE2[$i]?>" width="120" height="120"/></h3>
				<h4><?=$PET_LIST_FNAME2[$i],$PET_LIST_SNAME2[$i]?></h4>
				<p><?=$PET_FRIEND_NAME2[$i]?></p>
				<p class="chat"><a class="link" href="../chat/?chatme=<?=$_SESSION['id']?>&amp;chatyou=<?=$MYIDBACK[$i]?>" target="_blank">チャットをする</a></p>
				<p><a href="../friend/detail.php?id=<?=$MYIDBACK[$i]?>">詳しく見る</a></p>
			</li>
		<?php } ?>
		</ul>
		<p class="txR"><a href="friend/">一覧を見る</a></p>
		<?php }else{ ?>
		<p class="no txC">ただいま登録されている友達はいません。</p>
		<?php } ?>
	</section>
	<section id="mystores">
		<h2>お気に入り店舗一覧</h2>
		<?php if(isset($FAVOID)){ ?>
		<ul class="txC">
		<?php for($i=0;$i<count($FAVOID);$i++){ ?>
			<li class="cfx">
				<h3 class="flL"><img src="../img/store/<?=$STOREID[$i]?>.jpg" width="120" height="120"/></h3>
				<div class="waku flL txL">
				<h4><?=$STORE_NAME[$i]?></h4>
				<p class="store_janru"><?=$STORE_JANRU_NAME[$i]?></p>
				<p><?=$STORE_ADRESS[$i]?></p>
				<p class="l1 flL txC"><a href="../core/favodelete.php?favo=<?php print $STOREID[$i]; ?>&amp;userid=<?php print $_SESSION['id']; ?>">お気に入り解除</a></p>
				<p class="l2 flR txC"><a href="../store/detail.php?store=<?=$STOREID[$i]?>&amp;ken=<?=$STORE_KEN[$i]?>">詳しく見る</a></p>
			</li>
		<?php } ?>
		</ul>
		<p class="txR"><a href="store/">一覧を見る</a></p>
		<?php }else{ ?>
		<p class="no txC">ただいまお気に入り登録しているお店はありません。</p>
		<p class="nobtn txC"><a href="../store/">お店を探す</a></p>
		<?php } ?>
	</section>
	</div>
	</div><!--cfx閉じる-->
</article>
<!--ここまででコンテントの内容終わる　-->
<?php html_footer(); ?>
</div>	<!--wrap終了-->
</body>
</html>

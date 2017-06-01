<?php


//クッキー・セッションのphp
require_once("../../core/session_cookie.php");

//ログインチェック
//していない場合トップページに戻す
if(!isset($_SESSION['id'])){
	//絶対参照
	header("Location: ../../");
	exit();
}

//require_once("../../core/mypage.php");


//ファイルの回想を記入
$level = '../../';

require_once("../../core/mypage_pet_list.php");


//ヘッダー・フッター・キャプションの内容を入れる場所(public.php)
require_once("../../view/public.php");

//////////////////////////////////////////
//head内の文章入力場所　開始
//////////////////////////////////////////

//使用するcssを記入
$css = '<link rel="stylesheet" href="../../css/mypage/pet.css" type="text/css" />';
//使用するjavascript(jQuery)を記入
$js = '';
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
		<li class="flL"><a href="../../">ワンコム</a></li>
		<span class="flL">></span>
		<li class="flL"><a href="../../mypage/">マイページ</a></li>
		<span class="flL">></span>
		<li class="flL"><a href="../../mypage/pet/">ペット一覧</a></li>
	</ol>
</div>
<!--ここからコンテントの内容始まる　-->
<article>
	<?php mypage_nav(); ?>
	<div class="flL">
	<section id="mypets">
		<h2>ペット一覧</h2>
		<?php if(isset($PET_NAME)){ ?>
		<ul class="txC">
		<?php for($i=0;$i<count($PET_NAME);$i++){ ?>
			<li class="cfx">
				<h3 class="flL"><img src="../../img/user_img/<?=$IMAGE[$i]?>" width="120" height="120"/></h3>
				<div class="flL txL">
					<h4>
					ペット名 :
					<?php if($PET_NAME[$i] != ""){ ?>
					<?=$PET_NAME[$i]?>
					<?php }else{ ?>
					未登録
					<?php } ?>
					</h4>
					<p>
					犬種 :
					<?php if($PET_LIST_NAME[$i] != ""){ ?>
					<a href="../../zukan/detail.php?dog=<?=$BOOK_ID[$i]?>"><?=$PET_LIST_NAME[$i]?></a>
					<?php }else{ ?>
					未登録
					<?php } ?>
					</p>
					<p><a href="../../core/set.php?petid=<?php print $PET_ID[$i]; ?>&userid=<?php print $_SESSION['id']; ?>">この犬に変更する</a></p>
					<p><a href="change/?pet_id=<?=$PET_ID[$i]?>">確認・変更する</a></p>
				</div>
			</li>
		<?php } ?>
		</ul>
		<p class="nopetbtn txC"><a href="add/">ペットを登録する</a></p>
		<?php }else{ ?>
		<p class="nopet txC">ただいま登録しているペットはありません。</p>
		<p class="nopetbtn txC"><a href="add/">ペットを登録する</a></p>
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

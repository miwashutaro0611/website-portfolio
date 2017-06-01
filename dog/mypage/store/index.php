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

//ファイルの回想を記入
$level = '../../';

require_once("../../core/mypage.php");

require_once("../../core/mypagestore_list.php");

//ヘッダー・フッター・キャプションの内容を入れる場所(public.php)
require_once("../../view/public.php");

//////////////////////////////////////////
//head内の文章入力場所　開始
//////////////////////////////////////////

//使用するcssを記入
$css = '<link rel="stylesheet" href="../../css/mypage/store.css" type="text/css" />';
//使用するjavascript(jQuery)を記入
$js = '';
//サイトのタイトルを記入
$title = 'お気に入り店舗一覧｜ワンコム';
//サイトのキーワードを記入(表示には関係ない・任意)
$keywords = '犬,里親,コミュニティ,飼い主';
//サイトの説明文を記入(表示には関係ない・任意)
$description = 'ワンコムお気に入り店舗一覧ページです。ワンコムを利用してさまざまな人と交流を持ちましょう！';
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
		<li class="flL"><a href="../../mypage/store/">お気に入り店舗一覧</a></li>
	</ol>
</div>
<!--ここからコンテントの内容始まる　-->
<article>
	<?php mypage_nav(); ?>
	<div class="flL">
		<section id="mystores">
			<h2>お気に入り店舗一覧</h2>
			<?php if(isset($FAVOID)){ ?>
			<ul class="txC">
			<?php for($i=0;$i<count($FAVOID);$i++){ ?>
				<li class="cfx">
					<h3 class="flL"><img src="../../img/store/<?=$STOREID[$i]?>.jpg" width="120" height="120"/></h3>
					<div class="waku flL txL">
					<h4><?=$STORE_NAME[$i]?></h4>
					<p class="store_janru"><?=$STORE_JANRU_NAME[$i]?></p>
					<p><?=$STORE_ADRESS[$i]?></p>
					<p class="l1 flL txC"><a href="../../core/listfavodelete.php?favo=<?php print $STOREID[$i]; ?>&userid=<?php print $_SESSION['id']; ?>">お気に入り解除</a></p>
					<p class="l2 flR txC"><a href="../../store/detail.php?store=<?=$STOREID[$i]?>&amp;ken=<?=$STORE_KEN[$i]?>">詳しく見る</a></p>
				</li>
			<?php } ?>
			</ul>
			<?php }else{ ?>
			<p class="no txC">ただいまお気に入り登録しているお店はありません。</p>
			<p class="nobtn txC"><a href="../../store/">お店を探す</a></p>
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
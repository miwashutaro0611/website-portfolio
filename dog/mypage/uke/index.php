<?php

//クッキー・セッションのphp
require_once("../../core/session_cookie.php");

//ログインチェック
//していない場合トップページに戻す
if(!isset($_SESSION['id'])){
	//絶対参照
	header("Location:../../");
	exit();
}

//ファイルの回想を記入
$level = '../../';

require_once("../../core/mypage.php");

require_once("../../core/mypageuke_list.php");

//ヘッダー・フッター・キャプションの内容を入れる場所(public.php)
require_once("../../view/public.php");

//////////////////////////////////////////
//head内の文章入力場所　開始
//////////////////////////////////////////

//使用するcssを記入
$css = '<link rel="stylesheet" href="../../css/mypage/friend.css" type="text/css" />';
//使用するjavascript(jQuery)を記入
$js = '<script type="text/javascript" src="../../js/chat.js"></script>';
//サイトのタイトルを記入
$title = 'フォロワー一覧｜ワンコム';
//サイトのキーワードを記入(表示には関係ない・任意)
$keywords = '犬,里親,コミュニティ,飼い主';
//サイトの説明文を記入(表示には関係ない・任意)
$description = 'ワンコムフォロワー一覧ページです。ワンコムを利用してさまざまな人と交流を持ちましょう！';
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
		<li class="flL"><a href="../../mypage/uke/">フォロワー一覧</a></li>
	</ol>
</div>
<!--ここからコンテントの内容始まる　-->
<article>
	<?php mypage_nav(); ?>
	<div class="flL">
		<section id="myfriends">
			<h2>フォロワー一覧</h2>
			<?php if(isset($MYIDBACK)){ ?>
			<ul class="cfx txC">
			<?php for($i=0;$i<count($MYIDBACK);$i++){ ?>
				<li class="flL">
					<h3><img src="../../img/user_img/<?=$PET_FRIEND_IMAGE2[$i]?>" width="120" height="120"/></h3>
					<h4><?=$PET_LIST_FNAME2[$i],$PET_LIST_SNAME2[$i]?></h4>
					<p><?=$PET_FRIEND_NAME2[$i]?></p>
					<p class="chat"><a class="link" href="../../chat/?chatme=<?=$_SESSION['id']?>&amp;chatyou=<?=$MYIDBACK[$i]?>" target="_blank">チャットをする</a></p>
					<p><a href="../../friend/detail.php?id=<?=$MYIDBACK[$i]?>">詳しく見る</a></p>
				</li>
			<?php } ?>
			</ul>
			<?php }else{ ?>
			<p class="no txC">ただいま登録・申請している友達はいません。</p>
			<p class="nobtn txC"><a href="../../friend/">友達を探す</a></p>
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

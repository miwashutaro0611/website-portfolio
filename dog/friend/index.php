<?php
//クッキー・セッションのphp
require_once("../core/session_cookie.php");

require_once("../core/ken.php");

require_once("../core/dog_book.php");

require_once("../core/seurch_friend.php");

require_once("../core/seurch_friend_list.php");

//ヘッダー・フッター・キャプションの内容を入れる場所(public.php)
require_once("../view/public.php");

//////////////////////////////////////////
//head内の文章入力場所　開始
//////////////////////////////////////////


//ファイルの回想を記入
$level = '../';
//使用するcssを記入
$css = '<link rel="stylesheet" href="../css/friend.css" type="text/css" />';
//使用するjavascript(jQuery)を記入
$js = '<script type="text/javascript" src="../js/store.js"></script>
			 <script type="text/javascript" src="../js/jquery.MyThumbnail.js"></script>
			 <script type="text/javascript" src="../js/friend_images.js"></script>';
//サイトのタイトルを記入
$title = '友達検索｜ワンコム';
//サイトのキーワードを記入(表示には関係ない・任意)
$keywords = '犬,里親,コミュニティ,飼い主';
//サイトの説明文を記入(表示には関係ない・任意)
$description = 'ワンコム友達検索ページです。ワンコムを利用してさまざまな人と交流を持ちましょう！';
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
		<li class="flL"><a href="../friend/">友達検索</a></li>
	</ol>
</div>
<!--ここからコンテントの内容始まる　-->
<article>
	<p id="tomodatimain">
		<img src="../img/friendtop.jpg" alt="友達検索トップ">
	</p>
	<section id="kensaku">
	<form action="../friend/" method="post">
		<h3>条件検索</h3>
		<div class="find cfx">
			<p class="flL">エリアから探す</p>
			<div class="custom flL">
			<select name="ken" class="">
				<option value="0">選択してください</option>
				<?php for($i=1;$i<47;$i++){ ?>
				<option value="<?=$i+1?>"><?=$KEN[$i]?></option>
				<?php } ?>
			</select>
			</div>
		</div>
		<div class="find cfx">
		<p class="flL">ペットから探す</p>
			<div class="custom flL">
			<select name="dog_size" class="">
				<option value="0">選択してください</option>
				<?php for($i=0;$i<count($DOGNAME);$i++){ ?>
				<option  class="<?=$i+1?>" value="<?=$i+1?>"><?=$DOGNAME[$i]?></option>
				<?php } ?>
			</select>
			</div>
			<div class="custom flL">
			<select name="dog_janru" class="">
				<option value="0">選択してください</option>
				<?php for($i=0;$i<count($DOG2NAME);$i++){ ?>
				<option class="<?=$JANRU[$i]?>" value="<?=$BOOK[$i]?>"><?=$DOG2NAME[$i]?></option>
				<?php } ?>
			</select>
			</div>

		</div>
		<input type="submit" id="btn" name="friend_seurch" value="検索する">
	</form>
	</section>
	<section id="kekka">
		<h3>検索結果:

		<span><?=$ken_result?></span>
		<?php if($ken_result != "" && $size_result != ""){ ?>
		,
		<?php } ?>
		<span><?=$size_result?></span>
		<?php if($janru_result != "" && $size_result != ""){ ?>
		,
		<?php } ?>
		<span><?=$janru_result?></span>
		</h3>
		<?php if(isset($USERFIRSTNAME)){ ?>
		<?php for($i=0;$i<count($USERFIRSTNAME);$i++){ ?>
		<div class="waku cfx">
		<?php if($DOGIMAGE[$i] != ""){ ?>
			<p class="image flL"><img src="../img/user_img/<?=$DOGIMAGE[$i]?>" alt="あり"></p>
		<?php }else{ ?>
			<p class="image flL"><img src="../img/user_img/noimage.jpg?>" alt="なし"></p>
		<?php } ?>
			<p class="title flL">名前：<?=$USERFIRSTNAME[$i]?><?=$USERSECONDNAME[$i]?></p>
		<?php if($PETNAME[$i] != ""){ ?>
			<p class="dog flL">ペット名：<?=$PETNAME[$i]?></p>
		<?php }else{ ?>
			<p class="dog flL">ペット名：未入力</p>
		<?php } ?>
			<p class="dogsyu flL">犬種：<?=$JANRUNAME[$i]?></p>
			<p class="ken flL">都道府県：<?=$KENNAME[$i]?></p>
		</div>
		<p class="more"><a href="detail.php?id=<?=$USER_ID[$i]?>">詳しくはコチラ</a></p>
		<?php } ?>
		<?php }else{ ?>
		<p class="txC">検索結果なし</p>
		<?php } ?>
	</section>
</article>
<!--ここまでコンテントの内容終わる　-->
<?php html_footer(); ?>
</div>	<!--wrap終了-->
</body>
</html>

<?php
//クッキー・セッションのphp
require_once("../core/session_cookie.php");

require_once("../core/friend_detail_name.php");

require_once("../core/friend_favo.php");

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
$js = '<script type="text/javascript" src="../js/jquery.MyThumbnail.js"></script>
			 <script type="text/javascript" src="../js/friend_detail_images.js"></script>';
//サイトのタイトルを記入
$title = 'ユーザ詳細｜ワンコム';
//サイトのキーワードを記入(表示には関係ない・任意)
$keywords = '犬,里親,コミュニティ,飼い主';
//サイトの説明文を記入(表示には関係ない・任意)
$description = 'ワンコムユーザ詳細ページです。ワンコムを利用してさまざまな人と交流を持ちましょう！';
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
		<span class="flL">></span>
		<li class="flL"><a href="../friend/detail.php?id=<?=$_GET['id']?>"><?=$user_first_name?><?=$user_second_name?>さん詳細ページ</a></li>
	</ol>
</div>
<!--ここからコンテントの内容始まる　-->
<article>
	<div class="cfx">
		<section id="friend_top" class="flL">
			<p class="image txC"><img src="../img/user_img/<?=$image?>" alt="<?=$pet_name?>"></p>
			<table>
					<tbody>
					<tr>
						<th class="txL">ペット名</th>
						<td><?=$pet_name?></td>
					</tr>
					<tr>
						<th class="txL">ユーザカナ</th>
						<td><?=$user_first_kana?><?=$user_second_kana?></td>
					</tr>
					<tr>
						<th class="txL">ユーザ名</th>
						<td><?=$user_first_name?><?=$user_second_name?></td>
					</tr>
					<tr>
						<th class="txL">性別</th>
						<td><?=$user_sex?></td>
					</tr>
				</tbody>
			</table>
		</section>
		<section id="friend_pet" class="flL">
			<div class="cfx">
				<table class="flL">
					<tbody>
						<tr>
							<th class="txL">犬種</th>
							<td>
								<?php if(isset($pet_janru) && $pet_janru != ""){ ?>
								<a href="../zukan/detail.php?dog=<?=$pet_janru?>"><?=$janru_name?></a>
								<?php }else{ ?>
								未設定
								<?php } ?>
							</td>
						</tr>
						<tr>
							<th class="txL">ペット性別</th>
							<td><?=$pet_sex?></td>
						</tr>
						<tr>
							<th class="txL">ペット生年月日</th>
							<td>
								<?php if($pet_year != "" || $pet_month != "" || $pet_day != ""){ ?>
									<?php if($pet_year != ""){ ?>
									<?=$pet_year?>年
									<?php } ?>
									<?php if($pet_month != ""){ ?>
									<?=$pet_month?>月
									<?php } ?>
									<?php if($pet_day != ""){ ?>
									<?=$pet_day?>日
									<?php } ?>
								<?php }else{ ?>
									未設定
								<?php } ?>
							</td>
						</tr>
						<tr>
							<th class="txL">ペット体重</th>
							<td>
								<?php if($pet_weight != 0){ ?>
								<?=$pet_weight?>g
								<?php }else{ ?>
								未設定
								<?php } ?>
							</td>
						</tr>
						<tr>
							<th class="txL">毛色</th>
							<td><?=$pet_color?></td>
						</tr>
					</tbody>
				</table>
				<div id="friend_touroku" class="flL">
				<?php if(isset($_SESSION['id'])){ ?>
					<?php if($_SESSION['id'] == $_GET['id']){ ?>
					<p class="part2 txC">こちらは自分のページ情報<br>となっております。</p>
					<?php }else if(!isset($frid)){ ?>
					<p class="part1 txC"><a href="../core/favofriend.php?myid=<?=$_SESSION['id']?>&amp;frid=<?=$_GET['id']?>">フォローする</a></p>
					<?php }else{ ?>
					<p class="part1 txC"><a href="../core/friend_del.php?myid=<?=$_SESSION['id']?>&amp;frid=<?=$_GET['id']?>">フォロー解除</a></p>
					<?php } ?>

				<?php }else{ ?>
				<p class="part3 txC"><a href="../login/"><span class="small">ログインが完了するとフォローを<br>行うことが出来ます。</span><br>ログイン・新規登録画面へ</a></p>
				<?php } ?>
					<!--<p class="partb txC"><a href="#">友達になる</a></p>-->
				</div>
			</div>
			<div class="waku cfx">
				<h2>住所</h2>
				<p><?=$address?></p>
			</div>

			<div class="waku2 cfx">
				<h2>一言</h2>
				<p ckass="textarea"><?=nl2br($pet_textarea)?></p>
			</div>

			<div class="waku cfx">
				<h2>性格</h2>
				<p><?=nl2br($q1)?></p>
			</div>
			<div class="waku cfx">
				<h2>特技</h2>
				<p><?=nl2br($q2)?></p>
			</div>
			<div class="waku cfx">
				<h2>好きな食べ物</h2>
				<p><?=nl2br($q3)?></p>
			</div>
			<div class="waku cfx">
				<h2>好きなおやつ</h2>
				<p><?=nl2br($q4)?></p>
			</div>
			<div class="waku cfx">
				<h2>癒される仕草</h2>
				<p><?=nl2br($q5)?></p>
			</div>
			<div class="waku cfx">
				<h2>よく一緒に行く場所</h2>
				<p><?=nl2br($q6)?></p>
			</div>
			<div class="waku cfx">
				<h2>困り事</h2>
				<p><?=nl2br($q7)?></p>
			</div>
			<div class="waku cfx">
				<h2>去勢済みか</h2>
				<p><?=$q8?></p>
			</div>
			<div class="waku cfx">
				<h2>フェラリア済みか</h2>
				<p><?=$q9?></p>
			</div>
			<div class="waku cfx">
				<h2>ノミ・ダニ対策</h2>
				<p><?=$q10?></p>
			</div>
			<div class="waku cfx">
				<h2>狂犬病済みか</h2>
				<p><?=$q11?></p>
			</div>
			<div class="waku cfx">
				<h2>１回目ワクチン日</h2>
				<p><?=$q12?></p>
			</div>
			<div class="waku cfx">
				<h2>２回目ワクチン日</h2>
				<p><?=$q13?></p>
			</div>
			<div class="waku cfx">
				<h2>３回目ワクチン日</h2>
				<p><?=$q14?></p>
			</div>
			<div class="waku cfx">
				<h2>その他病気にかかったことがあるか</h2>
				<p><?=nl2br($q15)?></p>
			</div>
		</section>
	</div>
</article>
<!--ここまででコンテントの内容終わる　-->
<?php html_footer(); ?>
</div>	<!--wrap終了-->
</body>
</html>

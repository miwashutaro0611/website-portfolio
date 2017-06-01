<?php
//クッキー・セッションのphp
require_once("../core/session_cookie.php");

//  HTTPヘッダーで文字コードを指定
header("Content-Type:text/html; charset=UTF-8");

//ヘッダー・フッター・キャプションの内容を入れる場所(public.php)
require_once("../view/public.php");

//////////////////////////////////////////
//格納情報チェック
//////////////////////////////////////////

$k1 = "";
$k21 = "";
$k22 = "";
$psex = "";
$pet_date = "";
$pet_year = "";
$pet_month = "";
$pet_day = "";
$k4 = "";
$k5 = "";
$k6 = "";
$k7 = "";
$k8 = "";
$t1 = "";
$t2 = "";
$t3 = "";
$t4 = "";
$t5 = "";
$t6 = "";
$t7 = "";
$i1 = "";
$i2 = "";
$i3 = "";
$i4 = "";
$i5 = "";
$i6 = "";
$i7 = "";
$i8 = "";

//エラー・送信内容格納場所
require_once("../core/error.php");

//////////////////////////////////////////
//head内の文章入力場所　開始
//////////////////////////////////////////


//ファイルの回想を記入
$level = '../';
//使用するcssを記入
$css = '<link rel="stylesheet" href="../css/signup.css" type="text/css" />';
//使用するjavascript(jQuery)を記入
$js = '<script type="text/javascript" src="../js/jquery.MyThumbnail.js"></script>
			 <script type="text/javascript" src="../js/signup_check.js"></script>';
//サイトのタイトルを記入
$title = '新規登録-確認｜ワンコム';
//サイトのキーワードを記入(表示には関係ない・任意)
$keywords = '犬,里親,コミュニティ,飼い主';
//サイトの説明文を記入(表示には関係ない・任意)
$description = 'ワンコム登録内容確認ページです。ワンコムを利用してさまざまな人と交流を持ちましょう！';
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
		<li class="flL"><a href="../signup/">新規登録</a></li>
		<span class="flL">></span>
		<li class="flL">ペット情報登録</li>
		<span class="flL">></span>
		<li class="flL">登録確認</li>
	</ol>
</div>
<!--ここからコンテントの内容始まる　-->
<section id="section_1">
	<div class="step">
						<ul class="cfx">
								<li class="flL step_item"><span>STEP1:<br />ユーザー情報を入力</span></li>
								<li class="flL step_item"><span>STEP2:<br />ペット情報の入力</span></li>
								<li class="flL step_item item_active"><span>STEP3:<br />ユーザー情報を確認</span></li>
								<li class="flL step_item"><span>STEP4:<br />登録完了</span></li>
						</ul>
				</div>
		</section>
<article>
<article>
        <section id="check_form">
            <form action="finish.php" method="post">
                <h3>お名前(漢字)</h3>
                <p><?php print htmlspecialchars($_POST["fname"]) ?><?php print htmlspecialchars($_POST["sname"]) ?></p>
                <input type="hidden" name="fname" value="<?php print htmlspecialchars($_POST["fname"]) ?>"> <!--苗字(漢字)-->
                 <input type="hidden" name="sname" value="<?php print htmlspecialchars($_POST["sname"]) ?>"><!--名前(漢字)-->
                <h3>お名前(カナ)</h3>
                <p><?php print htmlspecialchars($_POST["kfname"]) ?><?php print htmlspecialchars($_POST["ksname"]) ?></p>
                <input type="hidden" name="kfname" value="<?php print htmlspecialchars($_POST["kfname"]) ?>"> <!--苗字(カナ)-->
                <input type="hidden" name="ksname" value="<?php print htmlspecialchars($_POST["ksname"]) ?>"><!--名前(カナ)-->
                <h3>性別</h3>
                <p><?php print $sex ?></p>
                <input type="hidden" name="sex" value="<?php print htmlspecialchars($sex_num) ?>"> <!--性別-->
                <h3>郵便番号</h3>
                <p><?php print htmlspecialchars($_POST["zip1"]) ?>-<?php print htmlspecialchars($_POST["zip2"]) ?></p>
                <input type="hidden" name="zip1" value="<?php print htmlspecialchars($_POST["zip1"]) ?>"> <!--住所１-->
                <input type="hidden" name="zip2" value="<?php print htmlspecialchars($_POST["zip2"]) ?>"><!--住所２-->
                <h3>住所</h3>
                <p><?php print htmlspecialchars($_POST["addressku"]) ?></p>
                <input type="hidden" name="addressku" value="<?php print htmlspecialchars($_POST["addressku"]) ?>"><!--住所(詳細)-->
                <h3>生年月日</h3>
                <p><?php print htmlspecialchars($user_year) ?>年<?php print htmlspecialchars($user_month) ?>月<?php print htmlspecialchars($user_day) ?>日</p>
                <input type="hidden" name="date" value="<?php print htmlspecialchars($date) ?>"><!--ユーザ生年月日-->
                <h3>電話番号</h3>
                <p><?php print htmlspecialchars($_POST["8"]) ?></p>
                <input type="hidden" name="cal" value="<?php print htmlspecialchars($_POST["8"]) ?>"><!--電話番号-->
                <h3>メールアドレス</h3>
                <p><?php print htmlspecialchars($_POST["9"]) ?>@<?php print htmlspecialchars($_POST["domain"]) ?></p>
                <input type="hidden" name="mail" value="<?php print htmlspecialchars($_POST["9"]) ?>"><!--メールアドレス-->
								<input type="hidden" name="domain" value="<?php print htmlspecialchars($_POST["domain"]) ?>"><!--メールアドレス(ドメイン)-->
                <h3>パスワード</h3>
                <p>*****************</p>
                <input type="hidden" name="pass" value="<?php print htmlspecialchars($_POST["10"]) ?>"><!-- パスワード -->
                <h3>ペットの名前</h3>
                <p><?php print $k1 ?></p>
                <input type="hidden" name="k1" value="<?php print htmlspecialchars($_POST["dog_name"]) ?>"><!--犬名前-->
                <h3>犬の種類</h3>
                <p><?php print $k21 ?>,<?php print $k22 ?></p>
                <input type="hidden" name="k21" value="<?php print htmlspecialchars($_POST["dog_janru1"]) ?>"><!--犬ジャンル分野-->
                <input type="hidden" name="k22" value="<?php print htmlspecialchars($_POST["dog_janru2"]) ?>"><!--犬ジャンル名前-->
                <h3>ペットの性別</h3>
                <p><?=$psex?></p>
                <input type="hidden" name="psex" value="<?php print htmlspecialchars($_POST["psex"]) ?>"><!--犬の性別-->
                <h3>ペットの生年月日</h3>
								<?php if($pet_year != "" || $pet_month != "" || $pet_day != ""){ ?>
								<p><?php print htmlspecialchars($pet_year) ?>年<?php print htmlspecialchars($pet_month) ?>月<?php print htmlspecialchars($pet_day) ?>日</p>
								<?php }else{ ?>
									<p><?php print htmlspecialchars($pet_date) ?></p>
								<?php } ?>
                <input type="hidden" name="pet_date" value="<?php print htmlspecialchars($_POST["pet_date"]) ?>"><!--ペット生年月日-->
                <h3>体重</h3>
                <p><?php print $k4 ?></p>
                <input type="hidden" name="k4" value="<?php print htmlspecialchars($_POST["omosa"]) ?>"><!--体重-->
                <h3>毛色</h3>
                <p><?php print $k5 ?></p>
                <input type="hidden" name="k5" value="<?php print htmlspecialchars($_POST["keiro"]) ?>"><!--毛色-->
                <h3>お住いの地域</h3>
                <p><?php print $k6 ?></p>
                <input type="hidden" name="k6" value="<?php print htmlspecialchars($_POST["ken"]) ?>"><!--お住いの地域-->
                <h3>ペットの画像</h3>
               <p class="input_image">
               <?php
	              $file = $_FILES['pic'];
	              // ファイルアップロードの処理をする
	              $ext = substr($file['name'], -4);
								if($file['name'] != ""){
	                if ($ext == '.gif' || $ext == '.jpg' || $ext == '.jpeg' || $ext == '.png' || $ext == '.GIF' || $ext == '.JPG' || $ext == '.JPEG' || $ext == '.PNG') {
											$file_text = $file['name'];
	                    $filePath = '../img/user_img/' .$file_text ;
	                    move_uploaded_file($file['tmp_name'], $filePath);
	                    print('<img src="' . $filePath . '"/>');
	                }
								}else if(isset($_POST['pic_text'])){
									$file_text = $_POST["pic_text"];
									?>
									<img src="../img/user_img/<?=$file_text?>"/>
									<?php
								}else{
									$file_text = "";
	                print('未入力');
	              }
                ?>
                </p>
                <input type="hidden" name="k7" value="<?php print $file_text ?>"><!--犬イメージ画像-->
                <h3>一言</h3>
                <p><?php print nl2br($k8) ?></p>
                <input type="hidden" name="k8" value="<?php print htmlspecialchars($_POST["textarea"]) ?>"><!--一言-->
                <h3>性格</h3>
                <p><?php print $t1 ?></p>
                <input type="hidden" name="t1" value="<?php print htmlspecialchars($_POST["toku1"]) ?>"><!--性格-->
                <h3>特技</h3>
                <p><?php print $t2 ?></p>
                <input type="hidden" name="t2" value="<?php print htmlspecialchars($_POST["toku2"]) ?>"><!--特技-->
                <h3>好きな食べ物</h3>
                <p><?php print $t3 ?></p>
                <input type="hidden" name="t3" value="<?php print htmlspecialchars($_POST["toku3"]) ?>"><!--好きな食べ物-->
                <h3>好きなおやつ</h3>
                <p><?php print $t4 ?></p>
                <input type="hidden" name="t4" value="<?php print htmlspecialchars($_POST["toku4"]) ?>"><!--好きなおやつ-->
                <h3>癒される仕草</h3>
                <p><?php print $t5 ?></p>
                <input type="hidden" name="t5" value="<?php print htmlspecialchars($_POST["toku5"]) ?>"><!--癒される仕草-->
                <h3>よく一緒に行く場所</h3>
                <p><?php print $t6 ?></p>
                <input type="hidden" name="t6" value="<?php print htmlspecialchars($_POST["toku6"]) ?>"><!--よく行く場所-->
                <h3>困り事・悩まれる仕草</h3>
                <p><?php print $t7 ?></p>
                <input type="hidden" name="t7" value="<?php print htmlspecialchars($_POST["toku7"]) ?>"><!--困り事・悩まれる仕草-->
                <h3>去勢済みか</h3>
                <p><?php print $i1 ?></p>
                <?php if(isset($_POST["qa1"])){ ?>
                <input type="hidden" name="i1" value="<?php print htmlspecialchars($_POST["qa1"]) ?>"><!--去勢済みか-->
                <?php } ?>
                <h3>フェラリア済みか</h3>
                <p><?php print $i2 ?></p>
                <?php if(isset($_POST["qa2"])){ ?>
                <input type="hidden" name="i2" value="<?php print htmlspecialchars($_POST["qa2"]) ?>"><!--フェラリア済みか-->
                <?php } ?>
                <h3>ノミ・ダニ対策</h3>
                <p><?php print $i3 ?></p>
                <?php if(isset($_POST["qa3"])){ ?>
                <input type="hidden" name="i3" value="<?php print htmlspecialchars($_POST["qa3"]) ?>"><!--ノミ・ダニ対策-->
                <?php } ?>
                <h3>狂犬病済みか</h3>
                <p><?php print $i4 ?></p>
                <?php if(isset($_POST["qa4"])){ ?>
                <input type="hidden" name="i4" value="<?php print htmlspecialchars($_POST["qa4"]) ?>"><!--狂犬病済みか-->
                <?php } ?>
                <h3>１回目ワクチン日</h3>
                <p><?php print $i5 ?></p>
                <input type="hidden" name="i5" value="<?php print htmlspecialchars($_POST["qa5"]) ?>"><!--１回目ワクチン日-->
                <h3>２回目ワクチン日</h3>
                <p><?php print $i6 ?></p>
                <input type="hidden" name="i6" value="<?php print htmlspecialchars($_POST["qa6"]) ?>"><!--２回目ワクチン日-->
                <h3>３回目ワクチン日</h3>
                <p><?php print $i7 ?></p>
                <input type="hidden" name="i7" value="<?php print htmlspecialchars($_POST["qa7"]) ?>"><!--３回目ワクチン日-->
                <h3>その他病気にかかった事があるか</h3>
                <p><?php print $i8 ?></p>
                <input type="hidden" name="i8" value="<?php print htmlspecialchars($_POST["qa8"]) ?>"><!--その他病気にかかった事があるか-->
                <input type="submit" class="post sub01 flR" id="submit_button" name="submit_end" value="内容を登録する" >
            </form>
            <form action="dogs.php" method="post">
            	<input type="hidden" name="fname" value="<?php print htmlspecialchars($_POST["fname"]) ?>"> <!--苗字(漢字)-->
                <input type="hidden" name="sname" value="<?php print htmlspecialchars($_POST["sname"]) ?>"><!--名前(漢字)-->
                <input type="hidden" name="kfname" value="<?php print htmlspecialchars($_POST["kfname"]) ?>"> <!--苗字(カナ)-->
                <input type="hidden" name="ksname" value="<?php print htmlspecialchars($_POST["ksname"]) ?>"><!--名前(カナ)-->
                <input type="hidden" name="sex" value="<?php print htmlspecialchars($_POST['sex']) ?>"> <!--性別-->
                <input type="hidden" name="zip1" value="<?php print htmlspecialchars($_POST["zip1"]) ?>"> <!--住所１-->
                <input type="hidden" name="zip2" value="<?php print htmlspecialchars($_POST["zip2"]) ?>"><!--住所２-->
                <input type="hidden" name="addressku" value="<?php print htmlspecialchars($_POST["addressku"]) ?>"><!--住所(詳細)-->
                <input type="hidden" name="date" value="<?php print htmlspecialchars($_POST["date"]) ?>"><!--年-->
                <input type="hidden" name="cal" value="<?php print htmlspecialchars($_POST["8"]) ?>"><!--電話番号-->
                <input type="hidden" name="mail" value="<?php print htmlspecialchars($_POST["9"]) ?>"><!--メールアドレス-->
								<input type="hidden" name="domain" value="<?php print htmlspecialchars($_POST["domain"]) ?>"><!--メールアドレス-->
                <input type="hidden" name="pass" value="<?php print htmlspecialchars($_POST["10"]) ?>"><!-- パスワード -->
                <input type="hidden" name="k1" value="<?php print htmlspecialchars($_POST["dog_name"]) ?>"><!--犬名前-->
                <input type="hidden" name="k21" value="<?php print htmlspecialchars($_POST["dog_janru1"]) ?>"><!--犬ジャンル分野-->
                <input type="hidden" name="k22" value="<?php print htmlspecialchars($_POST["dog_janru2"]) ?>"><!--犬ジャンル名前-->
                <input type="hidden" name="psex" value="<?php print htmlspecialchars($_POST["psex"]) ?>"><!--ペット性別-->
                <input type="hidden" name="pet_date" value="<?php print htmlspecialchars($_POST["pet_date"]) ?>"><!--犬生まれ　年-->
                <input type="hidden" name="k4" value="<?php print htmlspecialchars($_POST["omosa"]) ?>"><!--体重-->
                <input type="hidden" name="k5" value="<?php print htmlspecialchars($_POST["keiro"]) ?>"><!--毛色-->
                <input type="hidden" name="k6" value="<?php print htmlspecialchars($_POST["ken"]) ?>"><!--お住いの地域-->
                <input type="hidden" name="k7" value="<?php print $file_text ?>"><!--犬イメージ画像-->
                <input type="hidden" name="k8" value="<?php print htmlspecialchars($_POST["textarea"]) ?>"><!--一言-->
                <input type="hidden" name="t1" value="<?php print htmlspecialchars($_POST["toku1"]) ?>"><!--性格-->
                <input type="hidden" name="t2" value="<?php print htmlspecialchars($_POST["toku2"]) ?>"><!--特技-->
                <input type="hidden" name="t3" value="<?php print htmlspecialchars($_POST["toku3"]) ?>"><!--好きな食べ物-->
                <input type="hidden" name="t4" value="<?php print htmlspecialchars($_POST["toku4"]) ?>"><!--好きなおやつ-->
                <input type="hidden" name="t5" value="<?php print htmlspecialchars($_POST["toku5"]) ?>"><!--癒される仕草-->
                <input type="hidden" name="t6" value="<?php print htmlspecialchars($_POST["toku6"]) ?>"><!--よく行く場所-->
                <input type="hidden" name="t7" value="<?php print htmlspecialchars($_POST["toku7"]) ?>"><!--困り事・悩まれる仕草-->
                <input type="hidden" name="i1" value="<?php print htmlspecialchars($_POST["qa1"]) ?>"><!--去勢済みか-->
                <input type="hidden" name="i2" value="<?php print htmlspecialchars($_POST["qa2"]) ?>"><!--フェラリア済みか-->
                <input type="hidden" name="i3" value="<?php print htmlspecialchars($_POST["qa3"]) ?>"><!--ノミ・ダニ対策-->
                <input type="hidden" name="i4" value="<?php print htmlspecialchars($_POST["qa4"]) ?>"><!--狂犬病済みか-->
                <input type="hidden" name="i5" value="<?php print htmlspecialchars($_POST["qa5"]) ?>"><!--１回目ワクチン日-->
                <input type="hidden" name="i6" value="<?php print htmlspecialchars($_POST["qa6"]) ?>"><!--２回目ワクチン日-->
                <input type="hidden" name="i7" value="<?php print htmlspecialchars($_POST["qa7"]) ?>"><!--３回目ワクチン日-->
                <input type="hidden" name="i8" value="<?php print htmlspecialchars($_POST["qa8"]) ?>"><!--その他病気にかかった事があるか-->

                 <input type="submit" class="post fLL" id="submit_button" name="submit_prev" value="戻る" >
            </form>
        </section>
</article>
<!--ここまででコンテントの内容終わる　-->
<?php html_footer(); ?>
</div>	<!--wrap終了-->
</body>
</html>

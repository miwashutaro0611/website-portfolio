<?php
//クッキー・セッションのphp
require_once("../../../core/session_cookie.php");

//  HTTPヘッダーで文字コードを指定
header("Content-Type:text/html; charset=UTF-8");

//ヘッダー・フッター・キャプションの内容を入れる場所(public.php)
require_once("../../../core/pet_update.php");

//ヘッダー・フッター・キャプションの内容を入れる場所(public.php)
require_once("../../../view/public.php");

//////////////////////////////////////////
//head内の文章入力場所　開始
//////////////////////////////////////////


//ファイルの回想を記入
$level = '../../../';
//使用するcssを記入
$css = '<link rel="stylesheet" href="../../../css/mypage/signup.css" type="text/css" />';
//使用するjavascript(jQuery)を記入
$js = '';
//サイトのタイトルを記入
$title = 'ペット登録-完了｜ワンコム';
//サイトのキーワードを記入(表示には関係ない・任意)
$keywords = '犬,里親,コミュニティ,飼い主';
//サイトの説明文を記入(表示には関係ない・任意)
$description = 'ワンコムマイページです。ワンコムを利用してさまざまな人と交流を持ちましょう！';
//サイトの製作者を記入(表示には関係ない・任意)
$author = '三輪俊太郎';

require_once("../../../core/mypage.php");

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
      <li class="flL"><a href="../../../">ワンコム</a></li>
      <span class="flL">></span>
      <li class="flL"><a href="../../../mypage/">マイページ</a></li>
      <span class="flL">></span>
      <li class="flL"><a href="../../../mypage/pet/">ペット一覧</a></li>
      <span class="flL">></span>
      <li class="flL"><a href="../../../mypage/pet/change/?pet_id=<?=$_SESSION["pet"]?>">ペット情報編集</a></li>
				<span class="flL">></span>
        <li class="flL">編集情報確認</li>
				<span class="flL">></span>
        <li class="flL">編集完了</li>
    </ol>
</div>
<!--ここからコンテントの内容始まる　-->
<article>
  <?php mypage_nav(); ?>
  <div class="flL area">
        <section id="finish">
        <h2>ペット情報編集完了</h2>
	        <p class="text">ペットの編集が完了いたしました。<br>引き続きワンコムをお楽しみください。</p>
	        <p class="waku txC"><a href="../../../mypage/">マイページへ</a><span>></span></p>
        </section>
      </div>
      </div><!--cfx閉じる-->
</article>
<!--ここまででコンテントの内容終わる　-->
<?php html_footer(); ?>
</div>	<!--wrap終了-->
</body>
</html>

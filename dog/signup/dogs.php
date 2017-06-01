<?php
//クッキー・セッションのphp
require_once("../core/session_cookie.php");

require_once("../core/ken.php");

require_once("../core/dog_book.php");

//////////////////////////////////////////
//エラーチェック
//////////////////////////////////////////

/*これはフォームの内容*/
$k1 = "";
$k21 = "";
$k22 = "";
$psex = "";
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
$pet_date = "";

//エラー・送信内容格納場所
require_once("../core/error.php");

//ヘッダー・フッター・キャプションの内容を入れる場所(public.php)
require_once("../view/public.php");

//////////////////////////////////////////
//head内の文章入力場所　開始
//////////////////////////////////////////


//ファイルの回想を記入
$level = '../';
//使用するcssを記入
$css = '
<link rel="stylesheet" href="../css/signup.css" type="text/css" />
<link rel="stylesheet" href="../css/calendar.css" type="text/css" />
';
//使用するjavascript(jQuery)を記入
$js = '
<script src="../js/calendar.js"></script>
<script type="text/javascript" src="../js/slidetoggle.js">
</script><script type="text/javascript" src="../js/signlist.js"></script>
';
//サイトのタイトルを記入
$title = '新規登録-ペットの登録｜ワンコム';
//サイトのキーワードを記入(表示には関係ない・任意)
$keywords = '犬,里親,コミュニティ,飼い主';
//サイトの説明文を記入(表示には関係ない・任意)
$description = 'ワンコムペット情報登録ページです。ワンコムを利用してさまざまな人と交流を持ちましょう！';
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
    </ol>
</div>
<!--ここからコンテントの内容始まる　-->
<section id="section_1">
  <div class="step">
            <ul class="cfx">
                <li class="flL step_item"><span>STEP1:<br />ユーザー情報を入力</span></li>
                <li class="flL step_item item_active"><span>STEP2:<br />ペット情報の入力</span></li>
                <li class="flL step_item"><span>STEP3:<br />ユーザー情報を確認</span></li>
                <li class="flL step_item"><span>STEP4:<br />登録完了</span></li>
            </ul>
        </div>
    </section>
<article>
<article>
        <section id="form">
            <div class="content">
                <form action="check.php" method="post" enctype="multipart/form-data">
                    <h2 class="dogs_h2 h2title">ユーザ登録情報確認<span class="rote">></span></h2>
                    <div id="cform">
                        <div id="form_check" class="cfx">
                                    <!-- お名前　-->
                            <div class="form_box-min cfx">
                                <h3 class="form_h3-min flL">お名前</h3>
                                <p class="flL checktext"><?=$fname; ?><?=$sname; ?></p>
                                <input type="hidden" name="fname" value="<?=$fname ?>"><!-- 苗字(漢字) -->
                                <input type="hidden" name="sname" value="<?=$sname ?>"><!-- 名前(漢字) -->
                            </div>
                                    <!-- カナ　-->
                            <div class="form_box-min cfx">
                                <h3 class="form_h3-min flL">カナ</h3>
                                <p class="flL checktext"><?=$kfname; ?><?=$ksname; ?></p>
                                <input type="hidden" name="kfname" value="<?=$kfname ?>"><!-- 苗字(カナ) -->
                                <input type="hidden" name="ksname" value="<?=$ksname ?>"><!-- 名前(カナ) -->
                            </div>

                                    <!-- 性別　-->
                            <div class="form_box-min cfx">
                                <h3 class="form_h3-min flL">性別</h3>
                                <p class="flL checktext"><?=$sex; ?></p>
                                <input type="hidden" name="sex" value="<?=$sex_num ?>"><!-- 性別 -->
                            </div>
                                    <!-- 郵便番号　-->
                            <div class="form_box-min cfx">
                                <h3 class="form_h3-min flL">郵便番号</h3>
                                <p class="flL checktext"><?=$zip1; ?>-<?=$zip2; ?></p>
                                <input type="hidden" name="zip1" value="<?=$zip1 ?>"><!-- 郵便番号１ -->
                                <input type="hidden" name="zip2" value="<?=$zip2 ?>"><!-- 郵便番号２ -->
                            </div>
                                    <!-- 住所　-->
                            <div class="form_box-min cfx">
                                <h3 class="form_h3-min flL">住所</h3>
                                <p class="flL checktext"><?=$addressku; ?></p>
                                <input type="hidden" name="addressku" value="<?=$addressku ?>"><!-- 住所 -->
                            </div>
                                    <!-- 生年月日　-->
                            <div class="form_box-min cfx">
                                <h3 class="form_h3-min flL">生年月日</h3>
                                <p class="flL checktext"><?=$user_year?>年<?=$user_month?>月<?=$user_day?>日</p>
                                <input type="hidden" name="date" value="<?=$date; ?>"><!-- ユーザ生年月日 -->
                            </div>

                                    <!-- 電話番号　-->
                            <div class="form_box-min cfx">
                                <h3 class="form_h3-min flL">電話番号</h3>
                                <p class="flL checktext"><?=$cal; ?></p>
                                <input type="hidden" name="8" value="<?=$cal ?>"><!-- 電話番号 -->
                            </div>

                                    <!-- メールアドレス　-->
                            <div class="form_box-min cfx">
                                <h3 class="form_h3-min flL">メールアドレス</h3>
                                <p class="flL checktext"><?=$mail?>@<?=$domain?></p>
                                <input type="hidden" name="9" value="<?=$mail ?>"><!-- メールアドレス -->
                                <input type="hidden" name="domain" value="<?=$domain ?>"><!-- メールアドレス -->
                            </div>

                                    <!-- パスワード　-->
                            <div class="form_box-min cfx">
                                <h3 class="form_h3-min flL">パスワード</h3>
                                <p class="flL checktext">***********************</p>
                                <input type="hidden" name="10" value="<?=$pass ?>"><!-- パスワード -->
                            </div>
                        </div>
                    </div>

                    <h2 class="h2title dog_form1">ペット基本情報（任意）<span>></span></h2>
                    <div id="form01" class="inputform">
                        <h3 class="form_h3">ペットの名前</h3>
                        <input type="text" name="dog_name" value="<?=$k1; ?>">
                        <h3 class="form_h3">犬の種類</h3>
                        <span class="custom">
                        <select name="dog_janru1">
                            <option value="" selected>-------</option>
                            <?php for($i=0;$i<count($DOGNAME);$i++){ ?>
            								<option  class="<?=$i+1?>" value="<?=$i+1?>"<?php if ($k21 == $i+1) { print ' selected'; }; ?>><?=$DOGNAME[$i]?></option>
            							<?php } ?>
                        </select>
                      </span>
                      <span class="custom">
                        <select name="dog_janru2">
                            <option value="" selected>-------</option>
                            <?php for($i=0;$i<count($DOG2NAME);$i++){ ?>
            								<option class="<?=$JANRU[$i]?>" value="<?=$BOOK[$i]?>"<?php if ($k22 == $BOOK[$i]) { print ' selected'; }; ?>><?=$DOG2NAME[$i]?></option>
            							<?php } ?>
                        </select>
                      </span>
                        <!-- 性別　-->
                        <h3 class="form_h3">性別<span class=""></span></h3>

                        <ul class="cfx">
                            <li class="flL">
                              <input type="radio" class="validate[required]" name="psex" value="1" id="radio01" <?php if ($psex == 1) { print ' checked'; }; ?> />
                              <label for="radio01" class="radio">男（オス）</label>
                            </li>
                            <li class="flL">
                              <input type="radio" class="validate[required]" name="psex" value="2" id="radio02" <?php if ($psex == 2) { print ' checked'; }; ?> />
                              <label for="radio02" class="radio">女（メス）</label>
                            </li>
                            <li class="flL">
                              <input type="radio" class="validate[required]" name="psex" value="0" id="radio03" <?php if ($psex == 0) { print ' checked'; }; ?> />
                              <label for="radio03" class="radio">未入力</label>
                            </li>
                        </ul>

                        <h3 class="form_h3">生年月日<span class=""></span></h3>
                            <div class="form_box">
                                <input type="text" id="cal" class="min" name="pet_date" placeholder="クリックするとカレンダーが表示されます" value="<?=$pet_date?>">
                                <p class="">※テキストでの入力も可</p>
                            </div>
                        <h3 class="form_h3">体重</h3>
                        <input type="text" class="min" name="omosa" value="<?=$k4?>">g
                        <h3 class="form_h3">毛色</h3>
                        <input type="text" name="keiro" value="<?=$k5?>">
                        <h3 class="form_h3">お住いの地域</h3>
                        <span class="custom">
                          <select id="ken" name="ken">
                            <option value="">-------</option>
                            <?php for($r=0;$r<47;$r++){ ?>
                            <option value="<?=$r+1?>"<?php if ($k6 == $r+1) { print ' selected'; }; ?>><?=$KEN[$r]?></option>
                            <?php } ?>
                          </select>
                        </span>
                        <h3 class="form_h3">ペットの画像</h3>
                        <div class="cfx">
                        <div class="flL waku txC">画像</div>
                       <label class="my-file-input flL"><input type="file" name="pic" id="test3" />
                        <?php if($k7 == ""){ ?>
                         ファイルを選択
                        <?php }else{ ?>
                          <?=$k7?>
                          <input type="hidden" name="pic_text" value="<?=$k7?>">
                        <?php } ?>
                       </label>
                       </div>
                       <p>※画像サイズは縦200px,横200pxとなっております。(大きさは画像枠参照)</p>
                       <p>※このページではファイルを選択しても画像は変更されません。次の確認ページでご確認できます。</p>
                        <h3 class="form_h3">一言</h3>
                        <textarea name="textarea"><?=$k8; ?></textarea>
                    </div>

                    <h2 class="h2title dog_form2">特徴（任意）<span>></span></h2>
                    <div id="form02" class="inputform">
                        <h3 class="form_h3">性格</h3>
                        <input type="text" name="toku1" value="<?=$t1?>">
                        <h3 class="form_h3">特技</h3>
                        <input type="text" name="toku2" value="<?=$t2?>">
                        <h3 class="form_h3">好きな食べ物</h3>
                        <input type="text" name="toku3" value="<?=$t3?>">
                        <h3 class="form_h3">好きなおやつ</h3>
                        <input type="text" name="toku4" value="<?=$t4?>">
                        <h3 class="form_h3">癒される仕草</h3>
                        <input type="text" name="toku5" value="<?=$t5?>">
                        <h3 class="form_h3">よく一緒にいく場所</h3>
                        <input type="text" name="toku6" value="<?=$t6?>">
                        <h3 class="form_h3">困り事・悩まれる仕草</h3>
                        <input type="text" name="toku7" value="<?=$t7?>">
                    </div>
                    <h2 class="h2title dog_form3">医療（任意）<span>></span></h2>
                    <div id="form03" class="inputform">
                        <h3 class="form_h3">去勢済みか</h3>
                        <ul class="cfx">
                            <li class="flL">
                              <input type="radio" class="" name="qa1" value="1" id="radio11" <?php if ($i1 == 1) { print ' checked'; }; ?> />
                              <label for="radio11" class="radio">はい</label>
                            </li>
                            <li class="flL">
                              <input type="radio" class="" name="qa1" value="2" id="radio12" <?php if ($i1 == 2) { print ' checked'; }; ?> />
                              <label for="radio12" class="radio">いいえ</label>
                            </li>
                            <li class="flL">
                              <input type="radio" class="" name="qa1" value="3" id="radio13" <?php if ($i1 == 3) { print ' checked'; }; ?> />
                              <label for="radio13" class="radio">わからない</label>
                            </li>
                        </ul>
                        <h3 class="form_h3">フェラリア済みか</h3>
                        <ul class="cfx">
                            <li class="flL">
                              <input type="radio" class="" name="qa2" value="1" id="radio21" <?php if ($i2 == 1) { print ' checked'; }; ?> />
                              <label for="radio21" class="radio">はい</label>
                            </li>
                            <li class="flL">
                              <input type="radio" class="" name="qa2" value="2" id="radio22" <?php if ($i2 == 2) { print ' checked'; }; ?> />
                              <label for="radio22" class="radio">いいえ</label>
                            </li>
                            <li class="flL">
                              <input type="radio" class="" name="qa2" value="3" id="radio23" <?php if ($i2 == 3) { print ' checked'; }; ?> />
                              <label for="radio23" class="radio">わからない</label>
                            </li>
                        </ul>
                        <h3 class="form_h3">ノミ・ダニ対策</h3>
                        <ul class="cfx">
                            <li class="flL">
                              <input type="radio" class="" name="qa3" value="1" id="radio31" <?php if ($i3 == 1) { print ' checked'; }; ?> />
                              <label for="radio31" class="radio">はい</label>
                            </li>
                            <li class="flL">
                              <input type="radio" class="" name="qa3" value="2" id="radio32" <?php if ($i3 == 2) { print ' checked'; }; ?> />
                              <label for="radio32" class="radio">いいえ</label>
                            </li>
                            <li class="flL">
                              <input type="radio" class="" name="qa3" value="3" id="radio33" <?php if ($i3 == 3) { print ' checked'; }; ?> />
                              <label for="radio33" class="radio">わからない</label>
                            </li>
                        </ul>
                        <h3 class="form_h3">狂犬病済みか</h3>
                        <ul class="cfx">
                            <li class="flL">
                              <input type="radio" class="" name="qa4" value="1" id="radio41" <?php if ($i4 == 1) { print ' checked'; }; ?> />
                              <label for="radio41" class="radio">はい</label>
                            </li>
                            <li class="flL">
                              <input type="radio" class="" name="qa4" value="2" id="radio42" <?php if ($i4 == 2) { print ' checked'; }; ?> />
                              <label for="radio42" class="radio">いいえ</label>
                            </li>
                            <li class="flL">
                              <input type="radio" class="" name="qa4" value="3" id="radio43" <?php if ($i4 == 3) { print ' checked'; }; ?> />
                              <label for="radio43" class="radio">わからない</label>
                            </li>
                        </ul>
                        <h3 class="form_h3">１回目ワクチン日</h3>
                        <input type="text" name="qa5" value="<?=$i5; ?>">
                        <h3 class="form_h3">２回目ワクチン日</h3>
                        <input type="text" name="qa6" value="<?=$i6; ?>">
                        <h3 class="form_h3">３回目ワクチン日</h3>
                        <input type="text" name="qa7" value="<?=$i7; ?>">
                        <h3 class="form_h3">その他病気にかかった事があるか</h3>
                        <input type="text" name="qa8" value="<?=$i8; ?>">
                    </div>
                    <p class="hosoku">※複数のペットをお飼いの方は、このページでは一匹のみ登録することができます。<br>
                    マイページからでも、追加・変更・登録が行えます。</p>


                <div id="dog_sub" class="cfx">
                   <input type="submit" class="post flR" id="submit_button" name="submit02" value="内容確認ページへ行く">
                    </form>
                    <form action="../signup/" method="post">
                        <input type="hidden" name="1" value="<?=$_POST["sei"] ?>"><!-- 苗字(漢字) -->
                        <input type="hidden" name="2" value="<?=$_POST["mei"] ?>"><!-- 名前(漢字) -->
                        <input type="hidden" name="3" value="<?=$_POST["ksei"] ?>"><!-- 苗字(カナ) -->
                        <input type="hidden" name="4" value="<?=$_POST["kmei"] ?>"><!-- 名前(カナ) -->
                        <input type="hidden" name="5" value="<?=$_POST["radioprice"] ?>"><!-- 性別 -->
                        <input type="hidden" name="zip1" value="<?=$_POST["zip1"] ?>"><!-- 郵便番号1 -->
                        <input type="hidden" name="zip2" value="<?=$_POST["zip2"] ?>"><!-- 郵便番号2 -->
                        <input type="hidden" name="addressku" value="<?=$_POST["addressku"] ?>"><!-- 住所 -->
                        <input type="hidden" name="date" value="<?=$_POST["date"] ?>"><!-- 生年月日(年) -->
                        <input type="hidden" name="10" value="<?=$_POST["cal"] ?>"><!-- 電話番号 -->
                        <input type="hidden" name="11" value="<?=$_POST["address"] ?>"><!-- メールアドレス -->
                        <input type="hidden" name="domain" value="<?=$_POST["mail_domain"] ?>"><!-- メールアドレス -->
                        <input type="hidden" name="12" value="<?=$_POST["pass01"] ?>"><!-- パスワード -->
                        <input type="submit" class="post flL" id="submit_button" name="submit03" value="戻る">
                    </form>
                </div>
            </div>
        </section>
</article>
<!--ここまででコンテントの内容終わる　-->
<?php html_footer(); ?>
</div>  <!--wrap終了-->
</body>
</html>

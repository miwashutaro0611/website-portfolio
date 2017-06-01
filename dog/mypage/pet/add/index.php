<?php
//クッキー・セッションのphp
require_once("../../../core/session_cookie.php");

require_once("../../../core/ken.php");

require_once("../../../core/dog_book.php");

//////////////////////////////////////////
//エラーチェック
//////////////////////////////////////////
  $k1 = "";
  $k21 = "";
  $k22 = "";
  $pet_date = "";
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
//ヘッダー・フッター・キャプションの内容を入れる場所(public.php)
require_once("../../../view/public.php");

//エラー・送信内容格納場所
require_once("../../../core/peterror.php");

//////////////////////////////////////////
//head内の文章入力場所　開始
//////////////////////////////////////////


//ファイルの回想を記入
$level = '../../../';
//使用するcssを記入
$css = '
<link rel="stylesheet" href="../../../css/mypage/signup.css" type="text/css" />
<link rel="stylesheet" href="../../../css/calendar.css" type="text/css" />
';
//使用するjavascript(jQuery)を記入
$js = '
<script src="../../../js/calendar.js"></script>
<script type="text/javascript" src="../../../js/slidetoggle.js">
</script><script type="text/javascript" src="../../../js/signlist.js"></script>
';
//サイトのタイトルを記入
$title = 'ペット登録・編集｜ワンコム';
//サイトのキーワードを記入(表示には関係ない・任意)
$keywords = '犬,里親,コミュニティ,飼い主';
//サイトの説明文を記入(表示には関係ない・任意)
$description = 'ワンコムペット情報登録・編集ページです。ワンコムを利用してさまざまな人と交流を持ちましょう！';
//サイトの製作者を記入(表示には関係ない・任意)
$author = '三輪俊太郎';


require_once("../../../core/mypage.php");
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
        <li class="flL"><a href="../../../">ワンコム</a></li>
        <span class="flL">></span>
        <li class="flL"><a href="../../../mypage/">マイページ</a></li>
        <span class="flL">></span>
        <li class="flL"><a href="../../../mypage/pet/">ペット一覧</a></li>
        <span class="flL">></span>
        <li class="flL"><a href="../../../mypage/pet/add/">ペット情報登録</a></li>
    </ol>
</div>
<!--ここからコンテントの内容始まる　-->
<article>
  <?php mypage_nav(); ?>
  <div class="flL area">
        <section id="form">
            <div class="content">
                <form action="check.php" method="post" enctype="multipart/form-data">
                    <h2 class="h2title dog_form1">ペット基本情報</h2>
                    <div id="form01" class="inputform">
                        <h3 class="form_h3">ペットの名前</h3>
                        <input type="text" name="dog_name" value="<?php print $k1; ?>">
                        <h3 class="form_h3">犬の種類</h3>
                        <select name="dog_janru1">
                            <option value="" selected>-------</option>
                            <?php for($i=0;$i<count($DOGNAME);$i++){ ?>
								<option  class="<?=$i+1?>" value="<?=$i+1?>"<?php if ($k21 == $i+1) { print ' selected'; }; ?>><?=$DOGNAME[$i]?></option>
							<?php } ?>
                        </select>
                        <select name="dog_janru2">
                            <option value="">-------</option>
                            <?php for($i=0;$i<count($DOG2NAME);$i++){ ?>
								<option class="<?=$JANRU[$i]?>" value="<?=$BOOK[$i]?>"<?php if ($k22 == $BOOK[$i]) { print ' selected'; }; ?>><?=$DOG2NAME[$i]?></option>
							<?php } ?>
                        </select>
                        <!-- 性別　-->
                        <h3 class="form_h3">性別<span class=""></span></h3>

                        <ul class="cfx">
                            <li class="flL sex"><label><input type="radio" id="" name="psex" value="1"<?php if ($psex == 1) { print ' checked'; }; ?> /><span>オス</span></label></li>
                            <li class="flL sex"><label><input type="radio" id="" name="psex" value="2"<?php if ($psex == 2) { print ' checked'; }; ?> /><span>メス</span></label></li>
                            <li class="flL sex"><label><input type="radio" id="" name="psex" value="0"<?php if ($psex == 0) { print ' checked'; }; ?> /><span>未入力</span></label></li>
                        </ul>

                        <h3 class="form_h3">生年月日<span class=""></span></h3>
                            <div class="form_box">
                                <?php
                                  if($pet_date == "0000-00-00"){
                                    $pet_date = "";
                                  }
                                ?>
                                <input type="text" id="cal" class="min" name="pet_date" placeholder="クリックするとカレンダーが表示されます" value="<?=$pet_date?>">
                                <p class="">※テキストでの入力も可</p>
                            </div>
                        <h3 class="form_h3">体重</h3>
                        <?php
                          if($k4 == "0"){
                            $k4 = "";
                          }
                        ?>
                        <input type="text" class="min" name="omosa" value="<?php print $k4; ?>">g
                        <h3 class="form_h3">毛色</h3>
                        <input type="text" name="keiro" value="<?php print $k5; ?>">
                        <h3 class="form_h3">お住いの地域</h3>
                        <select id="ken" name="ken">
                            <option value="">-------</option>
                            <?php for($r=1;$r<47;$r++){ ?>
                            <option value="<?=$r?>"<?php if ($k6 == $r) { print ' selected'; }; ?>><?=$KEN[$r]?></option>
                            <?php } ?>
                            </select>
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
                        <textarea name="textarea"><?php print $k8; ?></textarea>
                    </div>

                    <h2 class="h2title dog_form2">特徴</h2>
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
                    <h2 class="h2title dog_form3">医療</h2>
                    <div id="form03" class="inputform">
                        <h3 class="form_h3">去勢済みか</h3>
                        <ul class="cfx">
                                <li class="flL question1"><label><input type="radio" id="" name="qa1" value="1"<?php if ($t1 == 1) { print ' checked'; }; ?>/><span>はい</span></label></li>
                                <li class="flL question1"><label><input type="radio" id="" name="qa1" value="2"<?php if ($t1 == 2) { print ' checked'; }; ?>/><span>いいえ</span></label></li>
                                <li class="flL question1"><label><input type="radio" id="" name="qa1" value="3"<?php if ($t1 == 3) { print ' checked'; }; ?>/><span>わからない</span></label></li>
                            </ul>
                        <h3 class="form_h3">フェラリア済みか</h3>
                        <ul class="cfx">
                                <li class="flL question1"><label><input type="radio" id="" name="qa2" value="1"<?php if ($t2 == 1) { print ' checked'; }; ?>/><span>はい</span></label></li>
                                <li class="flL question1"><label><input type="radio" id="" name="qa2" value="2"<?php if ($t2 == 2) { print ' checked'; }; ?>/><span>いいえ</span></label></li>
                                <li class="flL question1"><label><input type="radio" id="" name="qa2" value="3"<?php if ($t2 == 3) { print ' checked'; }; ?>/><span>わからない</span></label></li>
                            </ul>
                        <h3 class="form_h3">ノミ・ダニ対策</h3>
                       <ul class="cfx">
                                <li class="flL question1"><label><input type="radio" id="" name="qa3" value="1"<?php if ($t3 == 1) { print ' checked'; }; ?>/><span>はい</span></label></li>
                                <li class="flL question1"><label><input type="radio" id="" name="qa3" value="2"<?php if ($t3 == 2) { print ' checked'; }; ?>/><span>いいえ</span></label></li>
                                <li class="flL question1"><label><input type="radio" id="" name="qa3" value="3"<?php if ($t3 == 3) { print ' checked'; }; ?>/><span>わからない</span></label></li>
                            </ul>
                        <h3 class="form_h3">狂犬病済みか</h3>
                        <ul class="cfx">
                                <li class="flL question1"><label><input type="radio" id="" name="qa4" value="1"<?php if ($t4 == 1) { print ' checked'; }; ?>/><span>はい</span></label></li>
                                <li class="flL question1"><label><input type="radio" id="" name="qa4" value="2"<?php if ($t4 == 2) { print ' checked'; }; ?>/><span>いいえ</span></label></li>
                                <li class="flL question1"><label><input type="radio" id="" name="qa4" value="3"<?php if ($t4 == 3) { print ' checked'; }; ?>/><span>わからない</span></label></li>
                            </ul>
                        <h3 class="form_h3">１回目ワクチン日</h3>
                        <input type="text" name="qa5" value="<?php print $i5; ?>">
                        <h3 class="form_h3">２回目ワクチン日</h3>
                        <input type="text" name="qa6" value="<?php print $i6; ?>">
                        <h3 class="form_h3">３回目ワクチン日</h3>
                        <input type="text" name="qa7" value="<?php print $i7; ?>">
                        <h3 class="form_h3">その他病気にかかった事があるか</h3>
                        <input type="text" name="qa8" value="<?php print $i8; ?>">
                    </div>
                    <p class="hosoku">※複数のペットをお飼いの方は、このページでは一匹のみ登録することができます。<br>
                    マイページからでも、追加・変更・登録が行えます。</p>


                <div id="dog_sub" class="cfx">
                   <input type="submit" class="post flR" id="submit_button" name="submit02" value="内容確認ページへ行く">
                    </form>
                </div>
            </div>
        </section>
      </div>
      </div><!--cfx閉じる-->
</article>
<!--ここまででコンテントの内容終わる　-->
<?php html_footer(); ?>
</div>  <!--wrap終了-->
</body>
</html>

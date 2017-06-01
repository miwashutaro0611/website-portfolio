<!--住所検索-->

$(document).ready(function(){
    $("#lookup").click(function(){
        var zip1 = $.trim($('#zip1').val());
        var zip2 = $.trim($('#zip2').val());
        var zipcode = zip1 + zip2;

        $.ajax({
            type: "post",
            url: "api.php",
            data: JSON.stringify(zipcode),
            crossDomain: false,
            dataType : "jsonp",
            scriptCharset: 'utf-8'
        }).done(function(data){
            if(data[0] == ""){
                alert('見つかりませんでした。');
            } else {
                $('#addressku').val(data[0] + data[1] + data[2]);
            }
        }).fail(function(XMLHttpRequest, textStatus, errorThrown){
            alert(errorThrown);
        });
     });
});


<!-- フォントサイズ変更 -->

$(function(){
   var target = $('article');          // フォントサイズ変更エリア
   var controler = $('div#font li')  // フォントサイズ変更ボタン（画像あるいはテキストを設定）
   var fontSize = [15,16,18];         // フォントサイズ（単位は％、HTMLと同じ並び順）
   var hoverSuffix = '_on';          // ボバー用画像の接尾辞名（ボバー用画像を使用しない場合は値を空にする）
   var activeSuffix = '_active';     // アクティブ用画像の接尾辞名（アクティブ用画像を使用しない場合は値を空にする）
   var hoverClass = 'hover';         // フォントサイズ変更ボタンのボバー時のクラス名（ボバー時のクラスを使用しない場合は値を空にする）
   var activeClass = 'active';       // フォントサイズ変更ボタンのアクティブ時のクラス名（アクティブ時のクラスを使用しない場合は値を空にする）
   var defaultFont = 1;              // 初期フォントサイズ設定（HTMLと同じ並び順で0から設定）
   var cookieExpires = 7;            // クッキー保存期間
   var number = fontSize.length;     // フォントサイズ変更ボタンの数
   var hoverImg = hoverSuffix!='' && controler.is('[src]');
   var activeImg = activeSuffix!='' && controler.is('[src]');

   // クッキー設定
   function cookieSet(index){
      $.cookie('fontsize',fontSize[index],{path:'/',expires:cookieExpires});
   }

   // 現在フォントサイズ取得
   function nowFont(){
      return $.cookie('fontsize');
   }

   // フォントサイズ設定
   function changeFont(){
      target.css({'font-size':nowFont()+'px'});
   }

   // ボタン画像ハイライトオン
   function imgOn(btn,suffix) {
      btn.attr('src',btn.attr('src').replace(eval('/^(\.+)(\\.[a-z]+)$/'),'$1'+suffix+'$2')).css('cursor','pointer');
   }

   // ボタン画像ハイライトオフ
   function imgOff(btn,suffix) {
      btn.attr('src',btn.attr('src').replace(eval('/^(\.+)'+suffix+'(\\.[a-z]+)$/'),'$1$2')).css('cursor','pointer');
   }

   // 初期表示
   // フォントサイズがクッキーに保存されている場合
   if(nowFont()){
      for(var i=0; i<number; i++){
         if(nowFont()==fontSize[i]){
            // 初期ボタン設定
            var btn = controler.eq(i);
            // フォントサイズ設定
            changeFont();
            // アクティブ用の画像がある場合は表示
            if(activeImg){
               imgOn(btn,activeSuffix);
            }
             // アクティブ時のクラス名を設定
            btn.addClass(activeClass);
         }
      }
   }
   // フォントサイズがクッキーに保存されていない場合
   else {
      // 初期ボタン設定
      var btn = controler.eq(defaultFont);
      // デフォルトのフォントサイズをクッキーに保存する
      cookieSet(defaultFont);
      // フォントサイズ設定
      changeFont();
      // アクティブ用の画像がある場合は表示
      if(activeImg){
         imgOn(btn,activeSuffix);
      }
       // アクティブ時のクラス名を設定
      btn.addClass(activeClass);
   }

   // ホバーイベント
   controler.each(function(i){
      // 現在のボタン要素を取得
      var self = $(this);
      if(hoverImg){
         self.hover(
         function(){
            if(nowFont()!=fontSize[i]){
               // ホバー用画像に切り替え
               imgOn(self,hoverSuffix);
               return;
            }
         },
         function(){
            if(nowFont()!=fontSize[i]){
               // 通常用画像に切り替え
               imgOff(self,hoverSuffix);
            }
         });
      }
      self.hover(
      function(){
         if(nowFont()!=fontSize[i]){
            // ホバーしたボタンにホバー時のクラス名を設定
            self.addClass(hoverClass);
         }
      },
      function(){
         if(nowFont()!=fontSize[i]){
            // ホバーしたボタンのホバー時のクラス名を削除
            self.removeClass(hoverClass);
         }
      });
   });

   // クリックイベント
   controler.click(function(){
      // 現在のボタン要素を取得
      var self = $(this);
      // 現在のボタン要素のインデックス番号（ボタンID）を取得
      var index = controler.index(self);
      // フォントサイズをクッキーに保存する
      cookieSet(index);
      // フォントサイズ設定
      changeFont();
      if(hoverImg){
         // ホバー用画像をオフ
         imgOff(self,hoverSuffix);
      }
      if(activeImg){
         // アクティブ用画像に切り替え
         imgOn(self,activeSuffix);
         // 非設定画像のアクティブ用画像を通常用に切り替え
         for(var i=0; i<number; i++){
            if(nowFont()!=fontSize[i]){
               imgOff(controler.eq(i),activeSuffix);
            }
         }
      }
      // クリックしたボタンのホバー時のクラス名を削除
      self.removeClass(hoverClass);
      // クリックしたボタンにアクティブ時のクラス名を設定
      self.addClass(activeClass);
      // 非設定ボタンのアクティブ時のクラス名を削除
      controler.not(self).removeClass(activeClass);
   });

   <!--ページ内スクロール-->
  $(".scroll").click(function(event){
     event.preventDefault();

     var url = this.href;

     var parts = url.split("#");
     var target = parts[1];

     var target_offset = $("#"+target).offset();
     var target_top = target_offset.top;

     $('html, body').animate({scrollTop:target_top}, 1500, 'easeInOutCirc');
  });

});

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-11061469-3']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  });

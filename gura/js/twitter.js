/**
 * Author	: Daisuke Mizutani
 * Create	: 2016 / 10 / 21
 * Overview	: ツイート内容をカスタマイズし、ツイート画面表示
 *
 *		--- Update ---
 *		2016/10/21	openTweetWindow作成。
 *    2016/10/24  checkBrowser作成。
 *
**/

/**
* Name     :	openTweetWindow
* Contents :	入力されたテキストを取得し、ツイート文に加筆
**/
function openTweetWindow() {
   $( function() {
      var text    = $( '#name-form [name=character-name]' ).val();
      var width   = 650;
      var height  = 470;

      if ( checkBrowser() != 'chrome' ) {
         width    = 1000;
         height   = 750;

      }

      if ( text == "" ) {
         alert( 'キャラクター名を入力してください。' );
      }
      else {
         window.open(
            encodeURI(
               'http://twitter.com/share?text=' +
               'キャラクター名は「' + text + '」です。' +
               '&url=www.example.com&hashtags=グラデザキャラお名前募集キャンペーン'
            ),
            "new",
            "width=" + width + ",height=" + height
         );
      }
   } );
}


/**
* Name     :	checkBrowser
* Contents :	開いているブラウザの判定
**/
function checkBrowser() {
   var userAgent = window.navigator.userAgent.toLowerCase();

   if (userAgent.indexOf('opera') != -1) {
     return 'opera';
   }
   else if (userAgent.indexOf('msie') != -1) {
     return 'ie';
   }
   else if (userAgent.indexOf('chrome') != -1) {
     return 'chrome';
   }
   else if (userAgent.indexOf('safari') != -1) {
     return 'safari';
   }
   else if (userAgent.indexOf('gecko') != -1) {
     return 'gecko';
   }
   else {
     return false;
   }
}

/**
 * Author   : D-miz
 * Create   : 2016 / 10 / 18
 * Overview : 切り替えボタンでキャラクター画像の切り替え( 通常 <--> デフォルメ )
 *
 *    --- Update ---
 *    2016/10/18  changeImage作成。
 *    2016/10/25  imageObj, deviceObj作成。
 *                changeImage削除。changeImageの機能はimageObjが保持。
 *    2016/10/26  クリック判定処理を追加し、アニメーションの連続自動発生を無効化。
 *
**/


// ----- jQuery Start -----
$( function() {


var BUTTON_CLASS   = '.btn1';


/**
 * Name     :   imageObj
 * Contents :   画像の切り替え
**/
var imageObj = function() {
   var main             = $( '#main-image' );
   var sd               = $( '#character-sd' );
   var visibleMain      = true;
   var clickReady       = true;
   var pcMainPosition   = [ '-50%', '-6%' ];    // [0]:hide, [1]:show
   var pcSdPosition     = [ '0', '-65%' ];      // [0]:show, [1]:hide
   var spMainPosition   = [ '-100%', '-35%' ];  // [0]:hide, [1]:show
   var spSdPosition     = [ '-9%', '-80%' ];    // [0]:show, [1]:hide
   var moveSize         = [];

   // ----- デバイスをチェックし、移動量を格納 -----
   function checkDevice() {
      if ( deviceObj.getDevice() === 'pc' ) {
         moveSize[0] = pcMainPosition;  // [0][0]:mainHide, [0][1]:mainShow
         moveSize[1] = pcSdPosition;    // [1][0]:sdShow, [1][1]:sdHide
      }
      else if ( deviceObj.getDevice() === 'sp' ) {
         moveSize[0] = spMainPosition;  // [0][0]:mainHide, [0][1]:mainShow
         moveSize[1] = spSdPosition;    // [1][0]:sdShow, [1][1]:sdHide
      }
   }

   // ----- クリックフラグを変更 -----
   function changeClickFlg() {
      clickReady = !clickReady;
   }

   // ----- アニメーション実行 -----
   function playAnimation() {
      if ( clickReady ) {     // クリック判定:クリック連打されても反応しないように
         changeClickFlg();    // クリック連打を防止

         if ( visibleMain ) {          // main表示状態 --> main:hide, sd:show
            main.animate( {
               left: moveSize[0][0],   // main:hide
            }, 650,"easeOutBack" );

            sd.animate( {
               left: moveSize[1][0],   // sd:show
            },
            {
               duration: 650,
               easing: "easeOutBack",
               complete: function() {
                  changeClickFlg();    // アニメーション終了時にクリックフラグを変更
               }
            } );
         }
         else if ( !visibleMain ) {    // main非表示状態 --> main:show, sd:hide
            main.animate( {
               left: moveSize[0][1],   // main:show
            }, 650,"easeOutBack" );

            sd.animate( {
               left: moveSize[1][1],   // sd:hide
            },
            {
               duration: 650,
               easing: "easeOutBack",
               complete: function() {
                  changeClickFlg();    // アニメーション終了時にクリックフラグを変更
               }
            } );
         }

         // 表示切り替えのためFlagを変更
         visibleMain   = !visibleMain;
      }
      else if ( !clickReady ) {
         return false;
      }
   }

   // ----- 画像切り替え -----
   var change = function() {
      checkDevice();    // デバイスによってアニメーションの移動量が変わるため
      playAnimation();  // アニメーション実行
   }

   // ----- ウィンドウのリサイズ時に、画像位置を修正 -----
   var relocation = function() {
      if ( deviceObj.getDevice() === 'pc' ) {
         if ( visibleMain ) {
            main.css( 'left', pcMainPosition[1] );
            sd.css( 'left', pcSdPosition[1] );
         }
         else if ( !visibleMain ) {
            main.css( 'left', pcMainPosition[0] );
            sd.css( 'left', pcSdPosition[0] );
         }
      }
      else if ( deviceObj.getDevice() === 'sp' ) {
         if ( visibleMain ) {
            main.css( 'left', spMainPosition[1] );
            sd.css( 'left', spSdPosition[1] );
         }
         else if ( !visibleMain ) {
            main.css( 'left', spMainPosition[0] );
            sd.css( 'left', spSdPosition[0] );
         }
      }
   }

   // ----- オブジェクトの返却 -----
   return {
      change: change,
      relocation: relocation,
   }
}();


/**
 * Name     :   deviceObj
 * Contents :   デバイスの判定
**/
var deviceObj = function() {
   var device  = [ 'pc', 'sp' ];

   // ----- デバイスを判定し、結果を返却 -----
   var getDevice = function() {
      var width   = window.innerWidth;
      var height  = window.innerHeight;
      if ( 768 <= width ) {
         return device[0];
      }
      else if ( width < 768 ) {
         return device[1]
      }
   }

   // ----- オブジェクトの返却 -----
   return {
      getDevice: getDevice,
   }
}();


/**
 *	実行関数呼び出し
**/
$( window ).resize( function() {
   imageObj.relocation();
} );

$( BUTTON_CLASS ).click( function() {
   imageObj.change();
} );


} );	// ----- jQuery End -----

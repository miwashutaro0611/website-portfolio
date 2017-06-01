var width=window.innerWidth;
$(function(){

var h = $(window).height();

$('#wrap').css('display','none');
$('#loader-bg ,#loader').height(h).css('display','block');

$(window).load(function () { //全ての読み込みが完了したら実行
$('#loader-bg').delay(900).fadeOut(1500);
$('#loader').delay(600).fadeOut(1000);
$('#wrap').css('display', 'block');
if($(window).width()>=768){
  $(".navi-hover").addClass("hvr-radial-out");
}
else if($(window).width()<768){
  $(".navi-hover").removeClass("hvr-radial-out");
}
});



//10秒たったら強制的にロード画面を非表示
$(function(){
setTimeout('stopload()',10000);
});

function stopload(){
$('#wrap').css('display','block');
$('#loader-bg').delay(900).fadeOut(800);
$('#loader').delay(600).fadeOut(300);
}
      $('a[href^="#"]').click(function(){
        var a=1500,b=$(this).attr("href"),c=$("#"==b||""==b?"html":b),d=c.offset().top;
        return $("body,html").animate({scrollTop:d},a,"easeInQuint"),!1});

    $("#nav_btn").click(function(){
      $("nav").fadeToggle();
      $(this).toggleClass("active");
    });

    $("nav ul li a").click(function() {
      if($(window).width()<768){
        $("nav").fadeToggle();
        $("#nav_btn").toggleClass("active");
      }
    });

    $("#open01").click(function() {
        $("#photo01").show();
        $("#open01").addClass("active");
        $("#photo02").hide();
        $("#open02").removeClass("active");
        $("#photo03").hide();
        $("#open03").removeClass("active");
    });

    $("#open02").click(function() {
        $("#photo01").hide();
        $("#open01").removeClass("active");
        $("#photo02").show();
        $("#open02").addClass("active");
        $("#photo03").hide();
        $("#open03").removeClass("active");
    });

    $("#open03").click(function() {
        $("#photo01").hide();
        $("#open01").removeClass("active");
        $("#photo02").hide();
        $("#open02").removeClass("active");
        $("#photo03").show();
        $("#open03").addClass("active");
    });

    $(window).resize(function() {
        // 何らかの処理
        if($(window).width()>=768){
          $('nav').show();
          $("header .logo").css({position:"relative",left:"2%"});
          $(".navi-hover").addClass("hvr-radial-out");
        }
        else if($(window).width()<768){
          $('nav').hide();
          $("header .logo").css({position:"relative",left:"0%"});
          $(".navi-hover").removeClass("hvr-radial-out");
        }
        $("#nav_btn").toggleClass("active",false);
    });

    function initialize01() {
       var latlng = new google.maps.LatLng(34.6909525,138.9708754);
       var opts = {
       zoom: 15,
       center: latlng,
       mapTypeControl: true,
       mapTypeId: google.maps.MapTypeId.ROADMAP
       };
       /* 表示エリアのID名を指定。この場合id="map01"のところに出力されます */
       var map = new google.maps.Map(document.getElementById("map01"), opts);

       /* 地図style */
       var styleOptions = [{

       'stylers': [{
       'gamma': 0.8
       }, {
       'saturation': -100
       }, {
       'lightness': 20
       }]
       }]

       //マーカーの画像パス(相対、絶対どっちでも)
       var image = 'image/marker.png';
       var Marker = new google.maps.Marker({
       position: latlng,
       map: map,
       icon: image//デフォルトのマーカーを表示する場合は指定無し
       });

       //マップのタイトル
       var contentString = 'マップのタイトル';
       var infowindow = new google.maps.InfoWindow({
       content: contentString
       });
       //infowindow.open(map, lopanMarker);//初期状態で吹き出しを表示させる場合は有効にする
       google.maps.event.addListener(Marker, 'click', function() {
       infowindow.open(map, Marker);
       });
      }
      function initialize02() {
         var latlng = new google.maps.LatLng(35.6871215,135.9754546);
         var opts = {
         zoom: 15,
         center: latlng,
         mapTypeControl: true,
         mapTypeId: google.maps.MapTypeId.ROADMAP
         };
         /* 表示エリアのID名を指定。この場合id="map01"のところに出力されます */
         var map = new google.maps.Map(document.getElementById("map02"), opts);

         /* 地図style */
         var styleOptions = [{

         'stylers': [{
         'gamma': 0.8
         }, {
         'saturation': -100
         }, {
         'lightness': 20
         }]
         }]

         //マーカーの画像パス(相対、絶対どっちでも)
         var image = 'image/marker.png';
         var Marker = new google.maps.Marker({
         position: latlng,
         map: map,
         icon: image//デフォルトのマーカーを表示する場合は指定無し
         });

         //マップのタイトル
         var contentString = 'マップのタイトル';
         var infowindow = new google.maps.InfoWindow({
         content: contentString
         });
         //infowindow.open(map, lopanMarker);//初期状態で吹き出しを表示させる場合は有効にする
         google.maps.event.addListener(Marker, 'click', function() {
         infowindow.open(map, Marker);
         });
        }
        function initialize03() {
           var latlng = new google.maps.LatLng(31.8043944,131.4635602);
           var opts = {
           zoom: 15,
           center: latlng,
           mapTypeControl: true,
           mapTypeId: google.maps.MapTypeId.ROADMAP
           };
           /* 表示エリアのID名を指定。この場合id="map01"のところに出力されます */
           var map = new google.maps.Map(document.getElementById("map03"), opts);

           /* 地図style */
           var styleOptions = [{

           'stylers': [{
           'gamma': 0.8
           }, {
           'saturation': -100
           }, {
           'lightness': 20
           }]
           }]

           //マーカーの画像パス(相対、絶対どっちでも)
           var image = 'image/marker.png';
           var Marker = new google.maps.Marker({
           position: latlng,
           map: map,
           icon: image//デフォルトのマーカーを表示する場合は指定無し
           });

           //マップのタイトル
           var contentString = 'マップのタイトル';
           var infowindow = new google.maps.InfoWindow({
           content: contentString
           });
           //infowindow.open(map, lopanMarker);//初期状態で吹き出しを表示させる場合は有効にする
           google.maps.event.addListener(Marker, 'click', function() {
           infowindow.open(map, Marker);
           });
          }
      google.maps.event.addDomListener(window, 'load', initialize01);
      google.maps.event.addDomListener(window, 'load', initialize02);
      google.maps.event.addDomListener(window, 'load', initialize03);
      var map = $('.googlemap');
       map.css('pointer-events', 'none');
       $('.map-area').click(function() {
           map.css('pointer-events', 'auto');
       });
       map.mouseout(function() {
           map.css('pointer-events', 'none');
       })
});

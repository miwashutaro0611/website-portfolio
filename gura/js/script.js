
var str;
var width=window.innerWidth;
$(function() {

   $( window ).load( function() {
      animationAfterLoading();
   } );

   function animationAfterLoading() {
      if(width>=768){
         $("header .key_visual").css({position:"absolute",top:"50%"});
         $("header .logo").css({position:"relative",left:"-5vw"});
         $("header h1").css({position:"relative",left:"-5vw"});
         $("header .twitter").css({position:"relative",top:"-5vw"});

         // 呼び出し
         header_first();
         setTimeout( header_second, 1000 );

         // 第一アニメーション
         function header_first() {
            $("header .key_visual").animate({
               top:"4%",
               opacity:1
            },2000,"linear");

            $("header h1,header .logo").animate({
               left:"2%",
               opacity:1
            },2000,"linear");
         }

         // 第二アニメーション
         function header_second(){
            $("header .twitter").animate({
               top:0,
               opacity:1
            },1000,"linear");
         }
      }else{
         $("header .logo,header h1,header .twitter,header .key_visual").css("opacity","1");
      }
   }

   // $("#nav_btn").click(function(){がスタート
    $("#nav_btn").click(function(){
      $("nav").fadeToggle();
      $(this).toggleClass("active");
      });

    $('a[href^=#]').click(function() {
      var speed = 800;
      var href= $(this).attr("href");
      var target = $(href == "#" || href == "" ? 'html' : href);
      var position = target.offset().top;
      $('body,html').animate({scrollTop:position}, speed, 'swing');
    });

    $("nav ul li a").click(function() {
      if($(window).width()<768){
        $("nav").fadeToggle();
        $("#nav_btn").toggleClass("active");
      }
    });

    $(window).resize(function() {
        // 何らかの処理
        if($(window).width()>=768){
          $('nav').show();
          $("header .logo").css({position:"relative",left:"2%"});
        }
        else if($(window).width()<768){
          $('nav').hide();
          $("header .logo").css({position:"relative",left:"0%"});
        }
        $("#nav_btn").toggleClass("active",false);
    });
  if(width>=768){
    $('#profile .char-fade-in,#profile .profile-fade-in,#profile h2').css("opacity","0");
    $(window).scroll(function (){
        var imgPos = $("#profile").offset().top;
        var scroll = $(window).scrollTop();
        var windowHeight = $(window).height();
        if (scroll > imgPos - windowHeight / 2 * 3) {
          $("#profile .char-fade-in,#profile .profile-fade-in,#profile h2").css("opacity","1" );
          $("#profile img.gurachan").animate({
              'right':'50%',
              'opacity':1,
           }, 2000);
        }
    });
  }

  $('#campaign .button_icon').css({bottom:"-45%",opacity:"0"});
  $(window).scroll(function (){
      var imgPos3 = $("#campaign").offset().top;
      var scroll3 = $(window).scrollTop();
      var windowHeight3 = $(window).height();
      if (scroll3 > imgPos3 - windowHeight3 + windowHeight3/5){
        $("#campaign .button_icon").css("opacity","1" );
        $("#campaign .button_icon").css("bottom","-55%" );
      }else{
        $("#campaign .button_icon").css("opacity","0" );
        $("#campaign .button_icon").css("bottom","-45%" );
      }
  });
  $(window).scroll(function (){
  if(width>=768){
      CampaignImageView();
    }
  });
  
  $(window).resize(function() {
    if($(window).width()<768){
      SPchangeImageView();
    }
    if($(window).width()>=768){
      PCchangeImageView();
    }
  });

  var position01 = $("#campaign .image1");
  var position02 = $("#campaign .image2");
  var position03 = $("#campaign .image3");
  function CampaignImageView() {
    var imgPos3 = $("#campaign").offset().top;
    var scroll3 = $(window).scrollTop();
    var windowHeight3 = $(window).height();
      if (scroll3 > imgPos3 - windowHeight3 + windowHeight3/5){
       position01.addClass("pcanimate01");
       position02.addClass("pcanimate02");
       position03.addClass("pcanimate03");
      }
  }

  function PCchangeImageView() {
    position01.removeClass("pcanimate01");
    position02.removeClass("pcanimate02");
    position03.removeClass("pcanimate03");
    position01.removeClass("spposition01");
    position02.removeClass("spposition02");
    position03.removeClass("spposition03");
    position01.addClass("pcposition01");
    position02.addClass("pcposition02");
    position03.addClass("pcposition03");
  }

  function SPchangeImageView() {
    position01.removeClass("pcanimate01");
    position02.removeClass("pcanimate02");
    position03.removeClass("pcanimate03");
    position01.removeClass("pcposition01");
    position02.removeClass("pcposition02");
    position03.removeClass("pcposition03");
    position01.addClass("spposition01");
    position02.addClass("spposition02");
    position03.addClass("spposition03");
  }

  $('#tweet h3,.button_icon').css("opacity","0");
  $('#tweet .button_icon').css("bottom","5%");
  $(window).scroll(function (){
      var imgPos2 = $("#tweet").offset().top;
      var scroll2 = $(window).scrollTop();
      var windowHeight2 = $(window).height();
      if (scroll2 > imgPos2 - windowHeight2 + windowHeight2/5){
        $("#tweet h3,#tweet .button_icon").css("opacity","1" );
        $("#tweet .button_icon").css("bottom","-10%" );
      } else {
        $("#tweet h3,#tweet .button_icon").css("opacity","0" );
        $("#tweet .button_icon").css("bottom","-5%" );
      }
  });


});

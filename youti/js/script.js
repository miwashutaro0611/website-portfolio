var scrolltop= 0;

/*ナビついてくるやつ*/
$(function() {
    $('nav ul li').hover(function(){
        var left = $(this).position().left;
        $('#btn-bd').stop().animate({
            marginLeft : parseInt($(this).css('margin-left'))+ left +'px'
        },'3000');
    });

/*navスクロールしたら固定*/

    var box    = $("#navi");
    var bigbox    = $("nav");
    var boxTop = box.offset().top;
    $(window).scroll(function () {
      if($(window).scrollTop() >= boxTop) {
            box.addClass("fixed");
            bigbox.addClass("white");
			$(".wrap").css("margin-top","50px");
            scrolltop = 50;
        } else {
            box.removeClass("fixed");
            bigbox.removeClass("white");
			$(".wrap").css("margin-top","0px");
            scrolltop = 0;
        }
    });


/*トップのリストをクリックしたら任意のページへ行く*/

   $('#top_nav a[href^=#]').click(function() {
      var speed = 800;
      var href= $(this).attr("href");
      var target = $(href == "#" || href == "" ? 'html' : href);
      if(scrolltop != 0){
          $(".wrap").css("margin-top","-30px");
      }else{
          $(".wrap").css("margin-top","-80px");
      }
      var position = target.offset().top;
      $('body,html').animate({scrollTop:position}, speed, 'swing');
      return false;
   });

/*トップへのボタンをクリックしたらトップへ行く*/

    var showFlag = false;
    var topBtn = $('#top');
    topBtn.hide();
    var showFlag = false;
    $(window).scroll(function () {
        if ($(this).scrollTop() > 100) {
            if (showFlag == false) {
                showFlag = true;
                topBtn.fadeIn();
            }
        } else {
            if (showFlag) {
                showFlag = false;
                topBtn.fadeOut();
            }
        }
    });
    //スクロールしてトップ
    topBtn.click(function () {
        $('body,html').animate({
            scrollTop: 0
        }, 800);
        return false;
    });

/*スクロールボタンの効果*/
    var bottomBtn = $('#bottom');
    bottomBtn.click(function(){
    　 var takasa =$(window).scrollTop() + 600;
      $('body,html').animate({scrollTop:takasa}, 800);
    });

    $(window).scroll(function(ev) {
        var $window = $(ev.currentTarget),
            height = $window.height(),
            scrollTop = $window.scrollTop(),
            documentHeight = $(document).height();
        if (documentHeight <= height + scrollTop + 50) {
            $('#bottom').fadeOut();
        }else{
            $('#bottom').fadeIn();
        }
    });
    //写真スライドショー
    var slidew = 0
    var slidetime= 6000;
    start();
    function start(){
        var slide = setInterval(function(){
            if(slidew >=2520){
                $('#photolist').animate({'left':'0px'},'slow');
                slidew = 0
            }
            else{
                $('#photolist').animate({'left':'-=280px'},'slow');
                slidew = slidew + 280;
            }
        },slidetime);
    }

    //写真一覧前へボタン
    $('.prev').click(function () {
        if(slidew <=0){
            $('#photolist').animate({'left':'-=2520px'},'slow');
            slidew = 2520
        }
        else{
            $('#photolist').animate({'left':'+=280px'},'slow');
            slidew = slidew - 280;
        }
        stop();
    });

    //写真一覧次へボタン
    $('.next').click(function () {
        if(slidew >=2520){
            $('#photolist').animate({'left':'0px'},'slow');
            slidew = 0
        }
        else{
            $('#photolist').animate({'left':'-=280px'},'slow');
            slidew = slidew + 280;
        }
        stop();
    });

    function stop(){
        clearInterval(slide);
    }
});

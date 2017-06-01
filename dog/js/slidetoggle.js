<!--新規登録確認プルダウン(アコーディオンメニュー)-->

$(function(){
  document.getElementById("test3").addEventListener("change", function(e){
      e.target.nextSibling.nodeValue = e.target.files.length ? e.target.files[0].name : "ファイルを選択";
  });
  //領域をクリック
  $(".dogs_h2").click(function(){
    //クリック時の処理
    $("#cform").slideToggle(400);
    //矢印回転
    var c = $('.dogs_h2 span');
    if(c.hasClass('rote')){
      c.removeClass('rote');
    }else{
      c.addClass('rote');
    }
  });
});

$(function(){
  //領域をクリック
  $(".dog_form1").click(function(){
    //クリック時の処理
    $("#form01").slideToggle(400);
    //矢印回転
    var c = $('.dog_form1 span');
    if(c.hasClass('rote')){
      c.removeClass('rote');
    }else{
      c.addClass('rote');
    }
  });
});

$(function(){
  //領域をクリック
  $(".dog_form2").click(function(){
    //クリック時の処理
    $("#form02").slideToggle(400);
    //矢印回転
    var c = $('.dog_form2 span');
    if(c.hasClass('rote')){
      c.removeClass('rote');
    }else{
      c.addClass('rote');
    }
  });
});

$(function(){
  //領域をクリック
  $(".dog_form3").click(function(){
    //クリック時の処理
    $("#form03").slideToggle(400);
    //矢印回転
    var c = $('.dog_form3 span');
    if(c.hasClass('rote')){
      c.removeClass('rote');
    }else{
      c.addClass('rote');
    }
  });
});

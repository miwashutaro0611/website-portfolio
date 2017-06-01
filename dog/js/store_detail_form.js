
$(function(){
  <!--スターレーティング-->
     $('#star').raty({
    score: function() {
      return $(this).attr('data-score');
      }
    });
});

$(function () {
  // リンク形式
  $('.link').click(function(){
    // hrefで指定されたURLが別窓で開く
    winOpen(this.href, 300, 500);
    return false;
  });

  /**
   * 別窓
   * @param {string} url
   * @param {int} width
   * @param {int} height
   */
  function winOpen(url, width, height) {

    // 幅上限
    if (width > 800) {
      width = 800;
    }

    // 高さ上限
    if (height > 1000) {
      height = 1000;
    }

    window.open(url, '_blank', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=' + width + ', height=' + height);
  }
});

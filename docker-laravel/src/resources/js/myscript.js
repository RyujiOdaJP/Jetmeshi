// slider value showing
(function () {
  var valueBudget = document.getElementById('budget');
  var valueCookingTime = document.getElementById('cooking_time');
  var targetBudget = document.getElementById('target_budget');
  var targetCookingTime = document.getElementById('target_cooking_time');

  var rtnSliderValue = function (value, target) {
    return function () {
      target.innerHTML = value.value;
    };
  };
  valueBudget.addEventListener('input', rtnSliderValue(valueBudget, targetBudget));
  valueCookingTime.addEventListener('input', rtnSliderValue(valueCookingTime, targetCookingTime));
})();

(function () {
  document.getElementById('image_top').addEventListener('change', function () {
  // フォームで選択された全ファイルを取得
    var fileList = this.files;
    var targetImageTop = document.getElementById('target_image_top');
    // 個数分の画像を表示する
    for (var i = 0, l = fileList.length; l > i; i++) {
    // Blob URLの作成
      var blobUrl = window.URL.createObjectURL(fileList[i]);

      // HTMLに書き出し (src属性にblob URLを指定)
      targetImageTop.innerHTML = '<img src="' + blobUrl + '" width="100%">';
    }
  });

  document.getElementById('image_seq1').addEventListener('change', function () {
    // フォームで選択された全ファイルを取得
    var fileList = this.files;
    var targetImageTop = document.getElementById('target_image_seq1');
    // 個数分の画像を表示する
    for (var i = 0, l = fileList.length; l > i; i++) {
      // Blob URLの作成
      var blobUrl = window.URL.createObjectURL(fileList[i]);

      // HTMLに書き出し (src属性にblob URLを指定)
      targetImageTop.innerHTML = '<img src="' + blobUrl + '" width="100%">';
    }
  });

  document.getElementById('image_seq2').addEventListener('change', function () {
    // フォームで選択された全ファイルを取得
    var fileList = this.files;
    var targetImageTop = document.getElementById('target_image_seq2');
    // 個数分の画像を表示する
    for (var i = 0, l = fileList.length; l > i; i++) {
      // Blob URLの作成
      var blobUrl = window.URL.createObjectURL(fileList[i]);

      // HTMLに書き出し (src属性にblob URLを指定)
      targetImageTop.innerHTML = '<img src="' + blobUrl + '" width="100%">';
    }
  });
  document.getElementById('image_seq3').addEventListener('change', function () {
    // フォームで選択された全ファイルを取得
    var fileList = this.files;
    var targetImageTop = document.getElementById('target_image_seq3');
    // 個数分の画像を表示する
    for (var i = 0, l = fileList.length; l > i; i++) {
      // Blob URLの作成
      var blobUrl = window.URL.createObjectURL(fileList[i]);

      // HTMLに書き出し (src属性にblob URLを指定)
      targetImageTop.innerHTML = '<img src="' + blobUrl + '" width="100%">';
    }
  });
  document.getElementById('image_seq4').addEventListener('change', function () {
    // フォームで選択された全ファイルを取得
    var fileList = this.files;
    var targetImageTop = document.getElementById('target_image_seq4');
    // 個数分の画像を表示する
    for (var i = 0, l = fileList.length; l > i; i++) {
      // Blob URLの作成
      var blobUrl = window.URL.createObjectURL(fileList[i]);

      // HTMLに書き出し (src属性にblob URLを指定)
      targetImageTop.innerHTML = '<img src="' + blobUrl + '" width="100%">';
    }
  });
})();

(function () {
  $(function swipeMenu () {
    alert('OK');
    console.log('swipeFunction');
    $('#app').bind('touchstart', onTouchStart);
    $('#app').bind('touchmove', onTouchMove);
    $('#app').bind('touchend', onTouchEnd);
    let status, position;

    // スワイプ開始時の横方向の座標を格納
    function onTouchStart (event) {
	    position = getPosition(event);
    }

    // スワイプの方向（left／right）を取得
    function onTouchMove (event) {
      status = (position > getPosition(event)) ? 'in' : '';
    }

    // スワイプ終了時に方向（left／right）をクラス名に指定
    function onTouchEnd (event) {
      $('#js-bootstrap-offcanvas').removeAttr('class').addClass(status);
    }

    // 横方向の座標を取得
    function getPosition (event) {
      console.log('swipingNow');
      return event.originalEvent.touches[0].pageX;
    }
  });
})();

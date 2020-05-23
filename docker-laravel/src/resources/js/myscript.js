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
    jQuery(function swipeMenu() {
        $("main").bind("touchstart", onTouchStart);
        $("main").bind("touchmove", onTouchMove);
        $("main").bind("touchend", onTouchEnd);

        $("#nav-button").on("click", function(){
          if ($("#nav-button").hasClass('not-clicked')) {
            $("#js-bootstrap-offcanvas").removeClass('out').addClass('in');
            $("#nav-button").removeClass('not-clicked').addClass('clicked');
            return;
          }
          if ($("#nav-button").hasClass('clicked')) {
            $("#js-bootstrap-offcanvas").removeClass('in').addClass('out');
            $("#nav-button").removeClass('clicked').addClass('not-clicked');
          }
        });

        let status = [], position;

        //スワイプ開始時の横方向の座標を格納
        function onTouchStart(event) {
            startPosition = getPosition(event);
        }

        //スワイプの方向を取得(数値でトリガー感度を調節)
        function onTouchMove(event) {
            if(startPosition < getPosition(event) + 15){
                status = ['in', 'out', 'clicked', 'not-clicked',];
            }else{
                status = ['out', 'in', 'not-clicked', 'clicked',];
            }
        }

        //スワイプ終了時にstatusをクラス名に指定
        function onTouchEnd(event) {
            $("#js-bootstrap-offcanvas").removeClass(status[0]).addClass(status[1]);
            $('#nav-button').removeClass(status[2]).addClass(status[3]);
        }

        //横方向の座標を取得
        function getPosition(event) {
            let position = event.originalEvent.touches[0].pageX
            return position;
        }
    });
})();

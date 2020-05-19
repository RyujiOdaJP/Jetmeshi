// showing preview of pics
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

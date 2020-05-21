(function () {
    let blobUrl;
    function createBlob(fileList, target=targetImage){
        for (let i = 0, l = fileList.length; l > i; i++) {
      // Blob URLの作成
      blobUrl = window.URL.createObjectURL(fileList[i]);

      // HTMLに書き出し (src属性にblob URLを指定)
      target.innerHTML = '<img src="' + blobUrl + '" width="100%">';
      return blobUrl;
      }
    }
  document.getElementById('image_top').addEventListener('change', function () {
    let fileList = this.files;
    let targetImage = document.getElementById('target_image_top');
    createBlob(fileList, targetImage);
    console.log(blobUrl);

    $uploadCrop = $('#croppie_image_top').croppie({
        // enableExif: true,
        viewport: {
            width: 300,
            height: 200,
            type: 'square'
        },
        boundary: {
            width: 300,
            height: 300
          },
    });

    $uploadCrop.croppie('bind',{
        url: blobUrl,
        points: [77,469,280,739]
    });

    $('.upload-result').on('click', function (ev) {
        $uploadCrop.croppie('result', {
            type: 'blob',
            size: 'viewport'
        }).then( function(blob){
            createBlob(blob, targetImage);
        } )
    });
  });

  document.getElementById('image_seq1').addEventListener('change', function () {
    // フォームで選択された全ファイルを取得
    let fileList = this.files;
    let targetImage = document.getElementById('target_image_seq1');
    // 個数分の画像を表示する
    createBlob(fileList, targetImage);
  });

  document.getElementById('image_seq2').addEventListener('change', function () {
    // フォームで選択された全ファイルを取得
    let fileList = this.files;
    let targetImage = document.getElementById('target_image_seq2');
    // 個数分の画像を表示する
    createBlob(fileList, targetImage);
  });

  document.getElementById('image_seq3').addEventListener('change', function () {
    // フォームで選択された全ファイルを取得
    let fileList = this.files;
    let targetImage = document.getElementById('target_image_seq3');
    // 個数分の画像を表示する
    createBlob(fileList, targetImage);
  });

  document.getElementById('image_seq4').addEventListener('change', function () {
    // フォームで選択された全ファイルを取得
    let fileList = this.files;
    let targetImage = document.getElementById('target_image_seq4');
    // 個数分の画像を表示する
    createBlob(fileList, targetImage);
  });
})();


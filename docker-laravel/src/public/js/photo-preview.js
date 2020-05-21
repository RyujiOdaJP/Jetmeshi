(function () {

    let blobUrl;
    function createBlob(fileList, target=targetImage){
        for (let i = 0, l = fileList.length; l > i; i++) {
      // Blob URLの作成
      blobUrl = window.URL.createObjectURL(fileList[i]);

      // HTMLに書き出し (src属性にblob URLを指定)
      target.innerHTML = '<img src="' + blobUrl + '" width="100%">';
      }
    }

    function croppieJS(croppieDivId, blobUrl, targetImage){
      $uploadCrop = $(croppieDivId).croppie({
        // enableExif: true,
        viewport: {
            width: 240,
            height: 240,
            type: 'square'
        },
        boundary: {
            width: 350,
            height: 350
            },
      });

      $uploadCrop.croppie('bind',{
        url: blobUrl,
        // points: [77,469,280,739]
      });

      $('.upload-result').on('click', function (ev) {
        $uploadCrop.croppie('result', {
            type: 'blob',
            size: 'original'
        }).then( function(blob){
            blobUrl = window.URL.createObjectURL(blob);
            // HTMLに書き出し (src属性にblob URLを指定)
            targetImage.innerHTML = '<img src="' + blobUrl + '" width="100%">';
        } )
        // TODO: make destroy method here
      });
    }

  document.getElementById('image_top').addEventListener('change', function () {
    let targetImage = document.getElementById('target_image_top');
    let fileList = this.files;
    createBlob(fileList, targetImage);
    croppieJS('#croppie_image_top' ,blobUrl, targetImage);
  });

  document.getElementById('image_seq1').addEventListener('change', function () {
    // フォームで選択された全ファイルを取得
    let fileList = this.files;
    let targetImage = document.getElementById('target_image_seq1');
    createBlob(fileList, targetImage);
    croppieJS('#croppie_image_seq1' ,blobUrl, targetImage);
  });

  document.getElementById('image_seq2').addEventListener('change', function () {
    // フォームで選択された全ファイルを取得
    let fileList = this.files;
    let targetImage = document.getElementById('target_image_seq2');
    createBlob(fileList, targetImage);
    croppieJS('#croppie_image_top' ,blobUrl, targetImage);
  });

  document.getElementById('image_seq3').addEventListener('change', function () {
    // フォームで選択された全ファイルを取得
    let fileList = this.files;
    let targetImage = document.getElementById('target_image_seq3');
    createBlob(fileList, targetImage);
    croppieJS('#croppie_image_top' ,blobUrl, targetImage);
  });

  document.getElementById('image_seq4').addEventListener('change', function () {
    // フォームで選択された全ファイルを取得
    let fileList = this.files;
    let targetImage = document.getElementById('target_image_seq4');
    createBlob(fileList, targetImage);
    croppieJS('#croppie_image_top' ,blobUrl, targetImage);
  });
})();


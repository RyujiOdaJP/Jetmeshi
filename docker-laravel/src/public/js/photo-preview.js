(function () {
    // hidden button until input image
    $('a.upload-result').hide();
    $('a.cancel-edit').hide();

    let blobUrl;
    let targetImage;

    function createBlob(fileList){
        for (let i = 0, l = fileList.length; l > i; i++) {
      // Blob URLの作成
      blobUrl = URL.createObjectURL(fileList[i]);
      }
    }

    function croppieJS(imageId, croppieDivId, blobUrl, target){
      $(`${croppieDivId} a.upload-result`).show();
      $(`${croppieDivId} a.cancel-edit`).show();
      $(imageId).prop('disabled', true);
      $(`${croppieDivId} a.file-upload`).addClass('disabled');
      $uploadCrop = $(croppieDivId).croppie({
        viewport: {
            width: 240,
            height: 240,
            type: 'square'
        },
        boundary: {
            width: 320,
            height: 320
            },
      });

      $uploadCrop.croppie('bind',{
        url: blobUrl
      });

      $('a.cancel-edit').on('click', function(){
        destroyInstance(imageId, croppieDivId);
        return
      });

      $(`${croppieDivId} a.upload-result`).bind('click', function () {
        $uploadCrop.croppie('result', {
            type: 'base64',
            size: 'original'
        }).then( function(base64){
            console.log(imageId);
            target.innerHTML = '<img src="' + base64 + '" width="100%">';
            $(`${croppieDivId} a.upload-result`).off();
        });
        destroyInstance(imageId, croppieDivId, target);
      });
    }

    function destroyInstance(imageId, croppieDivId, target){
        $(croppieDivId).removeClass('croppie-container');
        $('.cr-boundary').remove();
        $('.cr-slider-wrap').remove();
        $('a.upload-result').hide();
        $(imageId).prop('disabled', false);
        $('a.file-upload').removeClass('disabled');
        $('a.cancel-edit').hide();
        return URL.revokeObjectURL(blobUrl);
    }

    // run individual images editing method
  document.getElementById('image_top').addEventListener('change', function (ev) {
    targetImage = document.getElementById('target_image_top');
    fileList = this.files;
    createBlob(fileList);
    croppieJS(this.getAttribute('id'), '#croppie_image_top', blobUrl, targetImage);
    return
  });

  document.getElementById('image_seq1').addEventListener('change', function () {
    targetImage = document.getElementById('target_image_seq1');
    fileList = this.files;
    createBlob(fileList);
    croppieJS(this.getAttribute('id'), '#croppie_image_seq1', blobUrl, targetImage);
    return
  });

  document.getElementById('image_seq2').addEventListener('change', function () {
    targetImage = document.getElementById('target_image_seq2');
    fileList = this.files;
    createBlob(fileList);
    croppieJS(this.getAttribute('id'), '#croppie_image_seq2', blobUrl, targetImage);
    return
  });

  document.getElementById('image_seq3').addEventListener('change', function () {
    targetImage = document.getElementById('target_image_seq3');
    fileList = this.files;
    createBlob(fileList);
    croppieJS(this.getAttribute('id'), '#croppie_image_seq3', blobUrl, targetImage);
    return
  });

  document.getElementById('image_seq4').addEventListener('change', function () {
    targetImage = document.getElementById('target_image_seq4');
    fileList = this.files;
    createBlob(fileList);
    croppieJS(this.getAttribute('id'), '#croppie_image_seq4', blobUrl, targetImage);
    return
  });
})();

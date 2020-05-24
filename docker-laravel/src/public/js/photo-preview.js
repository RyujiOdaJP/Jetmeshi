(function () {
  // test

  $.ajax({
    type: 'POST',
    u
  })


  // hidden button until input image
  $('a.upload-result').hide();
  $('a.cancel-edit').hide();

  let blobUrl;
  let targetImage;

  const blobList = {
    image_top: '',
    image_seq1: '',
    image_seq2: '',
    image_seq3: '',
    image_seq4: ''
  };

  function createBlob (fileList, revoke = false) {
    if (!revoke) {
      for (let i = 0, l = fileList.length; l > i; i++) {
        // Blob URLの作成
        blobUrl = URL.createObjectURL(fileList[i]);
      }
    } else {

    }
  }

  function croppieJS (imageId, croppieDivId, blobUrl, target) {
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
      }
    });

    $uploadCrop.croppie('bind', {
      url: blobUrl
    });
    // TODO delete image button on click
    $('a.cancel-edit').on('click', function () {
      destroyInstance(imageId, croppieDivId);
    });

    $(`${croppieDivId} a.upload-result`).bind('click', function () {
      $uploadCrop.croppie('result', {
        type: 'blob',
        size: 'original'
      }).then(function (blob) {
        // ファイルリストを取得
        // var file_list = $(`#${imageId}`).files;
        // if(!file_list) return;

        // 0 番目の File オブジェクトを取得
        // var file = file_list[0];
        // if(!file) return;

        console.log(imageId);
        console.log(blob);

        const reader = new FileReader();
        reader.onload = function (e) {
          e.target.console.log(reader.result);
          e.target.blobList[imageId] = reader.result;
        };
        reader.readAsBinaryString(blob);
        console.log(blobList);

        // For user preview
        try {
          target.innerHTML = `<img id="edited_${imageId}" src="${URL.createObjectURL(blob)}" name="edited_images" width="100%" value="${blob}">`;
        } catch (e) {
          console.log(e);
        }
        // document.getElementById('edited_image_top').getAttribute('src');
        reader.abort();
        $(`${croppieDivId} a.upload-result`).off();
      });
      destroyInstance(imageId, croppieDivId, target);
    });
  }

  function destroyInstance (imageId, croppieDivId, target) {
    $(croppieDivId).removeClass('croppie-container');
    $(`${croppieDivId} .cr-boundary`).remove();
    $(`${croppieDivId} .cr-slider-wrap`).remove();
    $(`${croppieDivId} a.upload-result`).hide();
    $(imageId).prop('disabled', false);
    $(`${croppieDivId} a.file-upload`).removeClass('disabled');
    $(`${croppieDivId} a.cancel-edit`).hide();
    URL.revokeObjectURL(blobUrl);
  }

  // run individual images editing method
  const imageElements = document.getElementsByName('input_images');

  for (const imageElement of imageElements) {
    imageElement.addEventListener('change', function (ev) {
      if (!imageElement) { return; }
      const imageId = this.getAttribute('id');
      targetImage = document.getElementById(`target_${imageId}`);
      const fileList = this.files;
      createBlob(fileList);
      croppieJS(imageId, `#croppie_${imageId}`, blobUrl, targetImage);
    });
  }

  $('#submit_images').bind('click', function () {
    // TODO hidden el, let be disabled value
    const hiddenElements = document.getElementsByName('hidden');
    // let srcElement = document.getElementById('edited_'+document.getElementsByName('input_images')[0].getAttribute('id')).getAttribute('src');
    for (let i = 0, l = hiddenElements.length; i < l; i++) {
      // get src of edited image as below statement
      const imageId = imageElements[i].getAttribute('id');
      try {
        hiddenElements[i].value = (blobList[imageId]);
      } catch (e) {
        // blob.push('');
        console.log(e);
      }
      imageElements[i].disabled = 'true';
      console.log(blobList);
      console.log(hiddenElements[i]);
      console.log(imageElements[i]);
    }
  });
})();

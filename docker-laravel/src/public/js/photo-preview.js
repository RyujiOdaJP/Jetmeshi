(function() {
  // hidden button until input image
  $('a.upload-result').hide();
  $('a.cancel-edit').hide();

  let blobUrl;
  let targetImage;

  /**
 * create Blob getting photos to crop
 * @param {string} fileList
 * @param {boolean} revoke
 */
  function createBlob(fileList, revoke = false) {
    if (!revoke) {
      for (let i = 0, l = fileList.length; l > i; i++) {
        // Blob URLの作成
        blobUrl = URL.createObjectURL(fileList[i]);
      }
    } else {

    }
  }
  /**
 * crop provided blobUrl
 * @param {string} imageId
 * @param {string} croppieDivId
 * @param {string} blobUrl
 * @param {object} target
 */
  function croppieJS(imageId, croppieDivId, blobUrl, target) {
    $(`${croppieDivId} a.upload-result`).show();
    $(`${croppieDivId} a.cancel-edit`).show();
    $(imageId).prop('disabled', true);
    $(`${croppieDivId} a.file-upload`).addClass('disabled');
    const $uploadCrop = $(croppieDivId).croppie({
      viewport: {
        width: 240,
        height: 240,
        type: 'square',
      },
      boundary: {
        width: 320,
        height: 320,
      },
    });

    $uploadCrop.croppie('bind', {
      url: blobUrl,
    });
    // TODO delete image button on click
    $('a.cancel-edit').on('click', function() {
      destroyInstance(imageId, croppieDivId);
    });

    $(`${croppieDivId} a.upload-result`).bind('click', function() {
      $uploadCrop.croppie('result', {
        type: 'canvas',
        size: 'original',
        quality: '0.8',
        format: 'jpeg',
      }).then(function(resp) {
        $(`#sent_${imageId}`).val(resp);
        console.log(imageId);
        console.log(resp);

        // For user preview
        try {
          target.innerHTML =
          `<img id="edited_${imageId}" class="edited" src="${resp}"
          name="edited_images" width="100%">`;
        } catch (e) {
          console.log(e);
        }
        $(`${croppieDivId} a.upload-result`).off();
      });
      destroyInstance(imageId, croppieDivId, target);
    });
  }
  /**
 * delete crop instance
 * @param {string} imageId
 * @param {string} croppieDivId
 * @param {object} target
 */
  function destroyInstance(imageId, croppieDivId, target) {
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
  const sizeLimit = 1024 * 1024 * 3;

  for (const imageElement of imageElements) {
    imageElement.addEventListener('change', function(ev) {
      if (!imageElement) {
        return;
      }
      // eslint-disable-next-line no-invalid-this
      const imageId = this.getAttribute('id');
      targetImage = document.getElementById(`target_${imageId}`);
      // eslint-disable-next-line no-invalid-this
      const fileList = this.files;
      if (fileList[0].size > sizeLimit) {
        alert('ファイルサイズは3MB以下にしてください'); // エラーメッセージを表示
        return; // 終了する
      }
      createBlob(fileList);
      croppieJS(imageId, `#croppie_${imageId}`, blobUrl, targetImage);
    });
  }

  $('#submit_images').bind('click', function() {
    const hiddenElements = document.getElementsByName('hidden');
    for (let i = 0, l = hiddenElements.length; i < l; i++) {
      // get src of edited image as below statement
      imageElements[i].disabled = 'true';
      console.log(blobList);
      console.log(hiddenElements[i]);
      console.log(imageElements[i]);
    }
  // submit end
  });
})();

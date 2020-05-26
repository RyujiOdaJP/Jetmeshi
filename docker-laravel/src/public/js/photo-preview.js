(function () {
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
    let $uploadCrop = $(croppieDivId).croppie({
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
        type: 'canvas',
        size: 'original'
      }).then(function (resp) {

        $(`#sent_${imageId}`).val(resp);
        // $('#form').submit();
        // ファイルリストを取得
        // var file_list = $(`#${imageId}`).files;
        // if(!file_list) return;

        // 0 番目の File オブジェクトを取得
        // var file = file_list[0];
        // if(!file) return;

        console.log(imageId);
        // console.log(blob);
        console.log(resp);
        // const reader = new FileReader();
        // reader.onload = function (e) {
        //   e.target.console.log(reader.result);
        //   e.target.blobList[imageId] = reader.result;
        // };
        // reader.readAsBinaryString(blob);
        // console.log(blobList);

        // For user preview
        try {
        //   target.innerHTML = `<img id="edited_${imageId}" src="${URL.createObjectURL(blob)}" name="edited_images" width="100%" value="${blob}">`;
        target.innerHTML = `<img id="edited_${imageId}" src="${resp}" name="edited_images" width="100%" value="${resp}">`;
        } catch (e) {
          console.log(e);
        }
        // document.getElementById('edited_image_top').getAttribute('src');
        // reader.abort();
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
    const hiddenElements = document.getElementsByName('hidden');
    // let srcElement = document.getElementById('edited_'+document.getElementsByName('input_images')[0].getAttribute('id')).getAttribute('src');
    for (let i = 0, l = hiddenElements.length; i < l; i++) {
      // get src of edited image as below statement
      const imageId = imageElements[i].getAttribute('id');
    //   try {
    //     hiddenElements[i].value = (blobList[imageId]);
    //   } catch (e) {
    //     // blob.push('');
    //     console.log(e);
    //   }
      // preventing to post original image input
      imageElements[i].disabled = 'true';
      console.log(blobList);
      console.log(hiddenElements[i]);
      console.log(imageElements[i]);
    }
  // submit end
  });



  // WIP
//   const token = document.getElementsByName('csrf-token').item(0).content;
//   const link = $('#user_input_form').action;
//   var form = document.forms.namedItem("user_input");
//   form.addEventListener('submit', function(ev) {

//   var oOutput = document.querySelector("div.output"),
//       oData = new FormData(form);

//   oData.append("CustomField", "This is some extra data");

//   var oReq = new XMLHttpRequest();
//   oReq.open("POST", 'post/update', true);
//   oReq.onload = function(oEvent) {
//     if (oReq.status == 200) {
//       oOutput.innerHTML = "Uploaded!";
//     } else {
//       oOutput.innerHTML = "Error " + oReq.status + " occurred when trying to upload your file.<br \/>";
//     }
//   };
//   oReq.setRequestHeader('X-CSRF-Token', token);
//   oReq.send(oData);
//   ev.preventDefault();
// }, false);
//   const xhrForPost = new XMLHttpRequest();
//   const FD = new FormData()
//   // HTML file input, chosen by user
//   //   FD.append("userfile", fileInputElement.files[0]);

//   xhrForPost.open('POST', '/post/update');

//   xhrForPost.onload = () => {
//     console.log(xhrForPost.response);
//     if (xhrForPost.status != 200) {
//       alert('Updating Err!')
//       return;
//     }
//   };
//   document.getElementById('test').addEventListener('bind',
//   function a(){
//     const token = document.getElementsByName('csrf-token').item(0).content;
//     const link = $('#user_input_form').action;
//     xhrForPost.open('GET', link);
//     xhrForPost.onload = () => {
//         console.log(xhrForPost.response);
//         if (xhrForPost.status != 200) {
//             alert('Updating Err!');
//             return;
//         }else{alert('uho!');}
//     xhrForPost.setRequestHeader('X-CSRF-Token', token);
//     xhrForPost.send(FD);
//    }
// }
// );

})();

// function a(){
//   const xhrForPost = new XMLHttpRequest();
//   const FD = new FormData()
// //   // HTML file input, chosen by user
// //    FD.append("userfile", document.getElementById().files[0]);

//   xhrForPost.open('POST', '/post/update');

// //   xhrForPost.onload = () => {
// //     console.log(xhrForPost.response);
// //     if (xhrForPost.status != 200) {
// //       alert('Updating Err!')
// //       return;
// //     }
// //   };
//     const token = document.getElementsByName('csrf-token').item(0).content;
//     // const redirectLink = document.user_input.action;
//     // console.log(redirectLink);
//     // xhrForPost.open('POST', redirectLink, true);
//     xhrForPost.onload = () => {
//         console.log(xhrForPost.responseText);
//         if (xhrForPost.status != 200) {
//             alert('Updating Err!');
//             return;
//         }else{
//             console.log('sucsess');
//             alert('uho!');
//         }
//     xhrForPost.setRequestHeader('X-CSRF-Token', token);
//     xhrForPost.send(FD);
//     }
// }

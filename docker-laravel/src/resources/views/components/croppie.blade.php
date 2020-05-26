@php
    $id_attr = $id;
    $image_name = $name;
    $src = $old_ref ?? 'https://cm-jetmeshi.s3-ap-northeast-1.amazonaws.com/noimage+template.jpg';
    $regulation = $input_regu ?? '';

    // if( $src === null){
    //     $src = 'https://cm-jetmeshi.s3-ap-northeast-1.amazonaws.com/noimage+template.jpg';
    // }
@endphp

<div id="croppie_{{ $id_attr }}" class="col-md-5">
    <label for="cr-boundary">{{ __($image_name) }}</label>
       <span id="target_{{ $id_attr }}" class="target_image">
          <img src="{{ $src }}" alt="" class="position-static previews">
       </span>
     @if ($errors->has( $id_attr ))
        <span class="invalid-feedback" role="alert">
            {{ $errors->first( $id_attr ) }}
        </span>
     @endif
    <div class="actions">
      <a class="btn btn-info position-relative file-upload">
        <span>Upload</span>
        {{-- <input type="file" id="upload" value="Choose a file" accept="image/*" /> --}}
        <input id="{{ $id_attr }}" type="file" class="form-control position-absolute
            @if ($errors->has( $id_attr )) is-invalid
            @endif" name="input_images" rows="8" accept="image/jpeg,image/png" style="opacity: 0;" {{ $regulation }} ></input>
        <input id="sent_{{ $id_attr }}" type="hidden" name="sent_{{ $id_attr }}"></input>
      </a>
       {{-- // TODO delete image button on click --}}
      <a class="btn btn-success upload-result">保存</a>
      <a class="btn btn-outline-secondary cancel-edit">キャンセル</a>
    </div>
  </div>


{{-- <script type="text/javascript">
    $( document ).ready(function() {
        var $uploadCrop;

        function readFile(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $uploadCrop.croppie('bind', {
                        url: e.target.result
                    });
                    $('.upload-demo').addClass('ready');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        $uploadCrop = $('#upload-demo').croppie({
            viewport: {
                width: 200,
                height: 200,
                type: 'circle'
            },
            boundary: {
                width: 300,
                height: 300
            }
        });

        $('#upload').on('change', function () { readFile(this); });
        $('.form_submit').on('click', function (ev) {
            $uploadCrop.croppie('result', {
                type: 'canvas',
                size: 'original'
            }).then(function (resp) {
                $('#imagebase64').val(resp);
                $('#form').submit();
            });
    return false;
        });

    });
    </script>
    <form action="testth.php" id="form" method="post">
    <input type="file" id="upload" value="Choose a file">
    <div id="upload-demo"></div>
    <input type="hidden" id="imagebase64" name="imagebase64">
    <!--<a href="#" class="upload-result">Send</a> Working with this...-->
    <button type="button" class="form_submit">Send/button>
    </form> --}}

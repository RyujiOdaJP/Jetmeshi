@php
    $id_attr = $id;
    $image_name = $name;
    $src = $old_ref ?? 'https://cm-jetmeshi.s3-ap-northeast-1.amazonaws.com/noimage+template.jpg';
    $regulation = $input_regu ?? '';
    $shape = 'square';
    $margin = 'm-2';
    if ($image_name == 'ユーザー画像') {
        $margin = '';
        $shape = 'round';
    }
@endphp
<style>
    img.round{
        border-radius: 50%;
    }
</style>
<div id="croppie_{{ $id_attr }}" class="col-md-5 {{ $margin }}">
    <label for="cr-boundary">{{ __($image_name) }}</label>
       <span id="target_{{ $id_attr }}" class="target_image">
       <img src="{{ $src }}" alt="" class="{{ $shape }} position-static previews">
       </span>
     @if ($errors->has( $id_attr ))
        <span class="invalid-feedback" role="alert">
            {{ $errors->first( $id_attr ) }}
        </span>
     @endif
    <div class="actions">
      <a class="btn btn-Jetblue position-relative file-upload">
        <span>Upload</span>
        {{-- <input type="file" id="upload" value="Choose a file" accept="image/*" /> --}}
        <input id="{{ $id_attr }}" type="file" class="form-control position-absolute
            @if ($errors->has( $id_attr )) is-invalid
            @endif" name="input_images" rows="8" accept="image/jpeg,image/png" style="opacity: 0;" {{ $regulation }} ></input>
        <input id="sent_{{ $id_attr }}" type="hidden" name="sent_{{ $id_attr }}"></input>
      </a>
       {{-- // TODO delete image button on click --}}
      <a class="btn btn-Jetgreen upload-result"><span>保存</span></a>
      <a class="btn btn-outline-secondary cancel-edit">キャンセル</a>
    </div>
  </div>

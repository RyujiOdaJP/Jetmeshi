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
            @endif" name="top" rows="8" accept="image/jpeg,image/png" style="opacity: 0;" {{ $regulation }} ></input>
        </a>
        <a class="btn btn-success upload-result">保存</a>
        <a class="btn btn-outline-secondary cancel-edit">キャンセル</a>
    </div>
  </div>

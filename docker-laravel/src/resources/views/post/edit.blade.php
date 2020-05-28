@php
    $title = __('Edit') . ': ' . $post->title;
    $old_src_top = old('image_top', $post->image_top);
    $old_src_seq1 = old('image_seq1', $post->image_seq1);
    $old_src_seq2 = old('image_seq1', $post->image_seq2);
    $old_src_seq3 = old('image_seq1', $post->image_seq3);
    $old_src_seq4 = old('image_seq1', $post->image_seq4);
@endphp

@extends('layouts.app')
@section('content')
<div class="container">
<h1>{{ $title }}</h1>
{{-- // TODO lower 2MB is acceptable into input tag --}}
  <form id="user_input_form" name="user_input" action="{{ url('post/'.$post->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="form-group">
      <label for="title">{{ __('Title') }}</label>
      <input id="title" type="text" class="form-control @if ($errors->has('title')) is-invalid @endif" name='title' value="{{ old('title',$post->title) }}" required autofocus>
      @if ($errors->has('title'))
          <span class="invalid-feedback" role="alert">
              {{ $errors->first('title') }}
          </span>
      @endif
    </div>
    <div class="form-group">
      <label for="sequence_body">{{ __('Body') }}</label>
      <textarea id="sequence_body" class="form-control @if ($errors->has('sequence_body')) is-invalid @endif" name="sequence_body" rows="8" required>{{ old('sequence_body', $post->sequence_body) }}</textarea>
      @if ($errors->has('sequence_body'))
          <span class="invalid-feedback" role="alert">
              {{ $errors->first('sequence_body') }}
          </span>
      @endif
    </div>

    {{-- // TODO: make croppie as modal --}}
    <div class="row form-group justify-content-around">
      @component('components.croppie')
      @slot('id', 'image_top')
      @slot('name', 'TOP画像')
      @slot('old_ref', $old_src_top)
      {{-- @slot('input_regu', 'required') --}}
      @endcomponent

      @component('components.croppie')
      @slot('id', 'image_seq1')
      @slot('name', '画像１')
      @slot('old_ref', $old_src_seq1)
      @endcomponent

      @component('components.croppie')
      @slot('id', 'image_seq2')
      @slot('name', '画像2')
      @slot('old_ref', $old_src_seq2)
      @endcomponent

      @component('components.croppie')
      @slot('id', 'image_seq3')
      @slot('name', '画像3')
      @slot('old_ref', $old_src_seq3)
      @endcomponent

      @component('components.croppie')
      @slot('id', 'image_seq4')
      @slot('name', '画像4')
      @slot('old_ref', $old_src_seq4)
      @endcomponent
    </div>
    <div class="row form-group justify-content-around">
      <div class="col2">
        <label for="cooking_time">{{ __('調理時間 ') }} <span id="target_cooking_time">{{ old('cooking_time', $post->cooking_time) }}</span>分</label>
        <input id="cooking_time" type="range"  min="0" max="60" value="{{ old('cooking_time', $post->cooking_time) }}" step="1" class="custom-range" name="cooking_time" rows="8" required>


        </input>

        @if ($errors->has('cooking_time'))
            <span class="invalid-feedback" role="alert">
                {{ $errors->first('cooking_time') }}
            </span>
        @endif
      </div>
      <div class="col2">
        <label for="budget">{{ __('調理費用 ') }}<span id="target_budget">{{ old('budget', $post->budget) }}</span>円</label>
        <input id="budget" type="range" min="0" max="2000" value="{{ old('budget', $post->budget) }}" step="10" class="custom-range" name="budget" rows="8" required>
          {{ old('budget') }}
        </input>
        @if ($errors->has('budget'))
          <span class="invalid-feedback" role="alert">
            {{ $errors->first('budget') }}
          </span>
        @endif
      </div>

    </div>
    <button id="submit_images" type="submit" name="submit" class="row btn btn-primary">{{ __('Submit') }}</button>
  </form>
  <div class="output"></div>
  {{-- <button id="test" class="btn btn-dark" onclick="a()">test</button> --}}
</div>
<script src=" {{ asset('js/range.js') }} "></script>
<script src=" {{ asset('js/photo-preview.js') }} "></script>
@endsection

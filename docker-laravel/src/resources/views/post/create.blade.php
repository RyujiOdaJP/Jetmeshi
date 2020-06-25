@php
    $title = __('投稿する');
@endphp
@extends('layouts.app')
@section('content')

<div class="container">
    <h1>{{ $title }}</h1>
    <form action="{{ url('post') }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('POST')
        <div class="form-group">
            <label for="title">{{ __('タイトル') }}</label>
            <input id="title" type="text" class="form-control @if ($errors->has('title')) is-invalid @endif"
             name='title' value="{{ old('title') }}" placeholder="タイトル、テーマなど" required autofocus>
            @if ($errors->has('title'))
                <span class="invalid-feedback" role="alert">
                    {{ $errors->first('title') }}
                </span>
            @endif
        </div>
        <div class="form-group">
            <label for="sequence_body">{{ __('作り方') }}</label>
            <textarea id="sequence_body" class="form-control @if ($errors->has('sequence_body')) is-invalid @endif"
             name="sequence_body" rows="8" placeholder="材料、手順、コツなど" required>{{ old('sequence_body') }}</textarea>
            @if ($errors->has('sequence_body'))
                <span class="invalid-feedback" role="alert">
                    {{ $errors->first('sequence_body') }}
                </span>
            @endif
        </div>
        <div class="row form-group justify-content-around">
            @component('components.croppie')
            @slot('id', 'image_top')
            @slot('name', 'TOP画像')
            @slot('input_regu', 'required')
            @endcomponent

            @component('components.croppie')
            @slot('id', 'image_seq1')
            @slot('name', '画像１')
            @endcomponent

            @component('components.croppie')
            @slot('id', 'image_seq2')
            @slot('name', '画像2')
            @endcomponent

            @component('components.croppie')
            @slot('id', 'image_seq3')
            @slot('name', '画像3')
            @endcomponent

            @component('components.croppie')
            @slot('id', 'image_seq4')
            @slot('name', '画像4')
            @endcomponent
        </div>
            @component('components.slider')
            @slot('post', '')
            @endcomponent

            @component('components.tags')
            @slot('tags', $tags)
            @endcomponent
        {{-- <input type="file" class="btn btn-dark" name="testfile"> --}}
        <button type="submit" name="submit" class="row ml-1 btn btn-success">
            <span><i class="fas fa-paper-plane"></i>{{ __(' 投 稿 ') }}</span>
        </button>
    </form>
</div>
<script src=" {{ asset('js/range.js') }} "></script>
<script src=" {{ asset('js/photo-preview.js') }} "></script>
@endsection

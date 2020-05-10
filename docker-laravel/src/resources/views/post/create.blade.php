@php
    $title = __('Create Post');
@endphp
@extends('layouts.app')
@section('content')
<div class="container">
    <h1>{{ $title }}</h1>
    <form action="{{ url('post') }}" method="post">
        @csrf
        @method('POST')
        <div class="form-group">
            <label for="title">{{ __('Title') }}</label>
            <input id="title" type="text" class="form-control @if ($errors->has('title')) is-invalid @endif" name='title' value="{{ old('title') }}" required autofocus>
            @if ($errors->has('title'))
                <span class="invalid-feedback" role="alert">
                    {{ $errors->first('title') }}
                </span>
            @endif
        </div>
        <div class="form-group">
            <label for="sequence_body">{{ __('Body') }}</label>
            <textarea id="sequence_body" class="form-control @if ($errors->has('sequence_body')) is-invalid @endif" name="sequence_body" rows="8" required>
                {{ old('sequence_body') }}
            </textarea>
            @if ($errors->has('sequence_body'))
                <span class="invalid-feedback" role="alert">
                    {{ $errors->first('sequence_body') }}
                </span>
            @endif
        </div>
        <div class="form-group">
            <label for="image_top">{{ __('image_top') }}</label>
            <input id="image_top" type="url" class="form-control @if ($errors->has('image_top')) is-invalid @endif" name="image_top" rows="8" required>
                {{ old('image_top') }}
            </input>
            @if ($errors->has('image_top'))
                <span class="invalid-feedback" role="alert">
                    {{ $errors->first('image_top') }}
                </span>
            @endif
        </div>
        <button type="submit" name="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </form>
</div>
@endsection

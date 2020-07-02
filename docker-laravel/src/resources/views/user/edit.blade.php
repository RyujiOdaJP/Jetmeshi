@php
    $title = __('アカウント編集').': '.$user->name;
    $old_src = old('image', $user->image);
@endphp
@extends('layouts.app')
@section('content')
<div class="container">
    <h1>{{ $title }}</h1>
    <form action="{{ url('user/'.$user->id) }}" method="post">
        @csrf
        @method('PUT')
        <div class="form-group">
            @component('components.croppie')
            @slot('id', 'image')
            @slot('name', 'ユーザー画像')
            @slot('old_ref', $old_src)
            {{-- @slot('input_regu', 'required') --}}
            @endcomponent

            <label for="name">{{ __('名前') }}</label>
            <input id="name" type="text" class="form-control
            @if ($errors->has('name')) is-invalid @endif" name="name" value="{{ old('name', $user->name) }}" autofocus>
            @if($errors->has('name'))
            <span class="invalid-feedback" role="alert">
                {{ $errors->first('name') }}
            </span>
            @endif

            <label for="bio">{{ __('自己紹介') }}</label>
            <textarea id="bio" class="form-control
            @if ($errors->has('bio')) is-invalid @endif" name="bio" rows="8"
                autofocus>{{ old('bio', $user->bio) }}</textarea>
            @if ($errors->has('bio'))
            <span class="invalid-feedback" role="alert">
                {{ $errors->first('bio') }}
            </span>
            @endif
            <label for="twitter">{{ __('Twitter') }}</label>
            <input id="twitter" type="text" class="form-control
            @if ($errors->has('twitter')) is-invalid @endif" name="twitter"
                value="{{ old('twitter', $user->twitter) }}" autofocus>
            @if($errors->has('twitter'))
            <span class="invalid-feedback" role="alert">
                {{ $errors->first('twitter') }}
            </span>
            @endif
            <label for="instagram">{{ __('Instagram') }}</label>
            <input id="instagram" type="text" class="form-control
            @if ($errors->has('instagram')) is-invalid @endif" name="instagram"
                value="{{ old('instagram', $user->instagram) }}" autofocus>
            @if($errors->has('instagram'))
            <span class="invalid-feedback" role="alert">
                {{ $errors->first('instagram') }}
            </span>
            @endif
            <label for="github">{{ __('GitHub') }}</label>
            <input id="github" type="text" class="form-control
            @if ($errors->has('github')) is-invalid @endif" name="github" value="{{ old('github', $user->github) }}"
                autofocus>
            @if($errors->has('github'))
            <span class="invalid-feedback" role="alert">
                {{ $errors->first('github') }}
            </span>
            @endif
            <label for="facebook">{{ __('Facebook') }}</label>
            <input id="facebook" type="text" class="form-control
            @if ($errors->has('facebook')) is-invalid @endif" name="facebook"
                value="{{ old('facebook', $user->facebook) }}" autofocus>
            @if($errors->has('facebook'))
            <span class="invalid-feedback" role="alert">
                {{ $errors->first('facebook') }}
            </span>
            @endif

        </div>
        <button type="submit" name="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </form>
</div>
<script src="{{ asset('js/user-photo-preview.js') }}"></script>
@endsection

@php
    $title = __('Create Post');
@endphp
@extends('layouts.app')
@section('content')

<div class="container">
    <h1>{{ $title }}</h1>
    <form action="{{ url('post') }}" method="post" enctype="multipart/form-data">
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
        <div class="row form-group justify-content-around">
            <div class="col2">
                <label for="image_top">{{ __('image_top') }}</label>
                <input id="image_top" type="file" class="form-control
                @if ($errors->has('image_top')) is-invalid
                @endif" name="image_top" rows="8" required>
                    {{ old('image_top') }}
                </input>
                @if ($errors->has('image_top'))
                    <span class="invalid-feedback" role="alert">
                        {{ $errors->first('image_top') }}
                    </span>
                @endif
            </div>
            <div class="col2">
                <label for="image_seq1">{{ __('image_seq1') }}</label>
                <input id="image_seq1" type="file" class="form-control
                @if ($errors->has('image_seq1')) is-invalid
                @endif" name="image_seq1" rows="8" required>
                    {{ old('image_seq1') }}
                </input>
                @if ($errors->has('image_seq1'))
                    <span class="invalid-feedback" role="alert">
                        {{ $errors->first('image_seq1') }}
                    </span>
                @endif
            </div>
        </div>

            <div class="row form-group justify-content-around">
                <div class="col2">
                    <label for="cooking_time">{{ __('調理時間 ') }} <span id="target_cooking_time">10</span>分</label>
                    <input id="cooking_time" type="range"  min="0" max="60" value="10" step="1" class="custom-range" name="cooking_time" rows="8" required>
                        {{ old('cooking_time') }}

                    </input>

                    @if ($errors->has('cooking_time'))
                        <span class="invalid-feedback" role="alert">
                            {{ $errors->first('cooking_time') }}
                        </span>
                    @endif
                </div>
                <div class="col2">
                    <label for="budget">{{ __('調理費用 ') }}<span id="target_budget">100</span>円</label>
                    <input id="budget" type="range" min="0" max="2000" value="100" step="10" class="custom-range" name="budget" rows="8" required>
                        {{ old('budget') }}
                    </input>
                    @if ($errors->has('budget'))
                        <span class="invalid-feedback" role="alert">
                            {{ $errors->first('budget') }}
                        </span>
                    @endif
                </div>

        </div>
        <button type="submit" name="submit" class="row btn btn-primary">{{ __('Submit') }}</button>
    </form>
</div>
<script src=" {{ asset('js/range.js') }} "></script>
<script src=" {{ asset('js/photo-preview.js') }} "></script>
@endsection

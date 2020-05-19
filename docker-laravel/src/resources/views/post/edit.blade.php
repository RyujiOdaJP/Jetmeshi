@php
    $title = __('Edit') . ': ' . $post->title;
@endphp
@extends('layouts.app')
@section('content')
<div class="container">
    <h1>{{ $title }}</h1>
    <form action="{{ url('post/'.$post->id) }}" method="post">
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
            <div class="col-md-4">
                <label for="image_top">{{ __('image_top') }}</label>
                <input id="image_top" type="file" class="form-control image
                @if ($errors->has('image_top')) is-invalid
                @endif" name="top" rows="8" accept="image/bmp,image/gif,image/jpeg,image/png" required>
                    <span id="target_image_top" class="target_image"><img src="{{ old('image_top',$post->image_top) }}" alt="" class="previews"></span>
                {{-- Insert JS into src='' as tempolary URL--}}
                </input>
                @if ($errors->has('image_top'))
                    <span class="invalid-feedback" role="alert">
                        {{ $errors->first('image_top') }}
                    </span>
                @endif
            </div>
            <div class="col-md-4">
                <label for="image_seq1">{{ __('image_seq1') }}</label>
                <input id="image_seq1" type="file" class="form-control image
                @if ($errors->has('image_seq1')) is-invalid
                @endif" name="seq1" rows="8" accept="image/bmp,image/gif,image/jpeg,image/png" required>
                    <span id="target_image_seq1" class="target_image"><img src="{{ old('image_seq1',$post->image_seq1) }}" alt="" class="previews"></span>
                </input>
                @if ($errors->has('image_seq1'))
                    <span class="invalid-feedback" role="alert">
                        {{ $errors->first('image_seq1') }}
                    </span>
                @endif
            </div>
            <div class="col-md-4">
                <label for="image_seq2">{{ __('image_seq2') }}</label>
                <input id="image_seq2" type="file" class="form-control image
                @if ($errors->has('image_seq2')) is-invalid
                @endif" name="seq1" rows="8" accept="image/bmp,image/gif,image/jpeg,image/png" required>
                    <span id="target_image_seq2" class="target_image"><img src="{{ old('image_seq2',$post->image_seq2) }}" alt="" class="previews"></span>
                </input>
                @if ($errors->has('image_seq2'))
                    <span class="invalid-feedback" role="alert">
                        {{ $errors->first('image_seq2') }}
                    </span>
                @endif
            </div>
            <div class="col-md-4">
                <label for="image_seq3">{{ __('image_seq3') }}</label>
                <input id="image_seq3" type="file" class="form-control image
                @if ($errors->has('image_seq3')) is-invalid
                @endif" name="seq1" rows="8" accept="image/bmp,image/gif,image/jpeg,image/png" required>
                    <span id="target_image_seq3" class="target_image"><img src="{{ old('image_seq3',$post->image_seq3) }}" alt="" class="previews"></span>
                </input>
                @if ($errors->has('image_seq3'))
                    <span class="invalid-feedback" role="alert">
                        {{ $errors->first('image_seq3') }}
                    </span>
                @endif
            </div>
            <div class="col-md-4">
                <label for="image_seq4">{{ __('image_seq4') }}</label>
                <input id="image_seq4" type="file" class="form-control image
                @if ($errors->has('image_seq4')) is-invalid
                @endif" name="seq1" rows="8" accept="image/bmp,image/gif,image/jpeg,image/png" required>
                    <span id="target_image_seq4" class="target_image"><img src="{{ old('image_seq4',$post->image_seq4) }}" alt="" class="previews"></span>
                </input>
                @if ($errors->has('image_seq4'))
                    <span class="invalid-feedback" role="alert">
                        {{ $errors->first('image_seq4') }}
                    </span>
                @endif
            </div>
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
        <button type="submit" name="submit" class="row btn btn-primary">{{ __('Submit') }}</button>
    </form>
</div>
<script src=" {{ asset('js/range.js') }} "></script>
<script src=" {{ asset('js/photo-preview.js') }} "></script>
@endsection

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
        {{-- <div class="demo-wrap upload-demo">
            <div class="container">
                <div class="col-1-2">
                    <div class="actions">
                        <a class="btn file-btn">
                            <span>Upload</span>
                            <input type="file" id="upload" value="Choose a file" accept="image/*" />
                        </a>
                        <button class="upload-result">Result</button>
                    </div>
                </div>
                <div class="col-1-2">
                    <div class="upload-msg">
                        Upload a file to start cropping
                    </div>
                    <div class="upload-demo-wrap">
                        <div id="upload-demo"></div>
                    </div>
                </div>

        </div>
        </div> --}}
        {{-- <div class="demo-wrap upload-demo">
            <div class="container">
            <div class="grid">
                <div class="col-1-2">
                    <div class="actions">
                        <a class="btn file-btn">
                            <span>Upload</span>
                            <input type="file" id="upload" value="Choose a file" accept="image/*" />
                        </a>
                        <button class="upload-result">Result</button>
                    </div>
                </div>
                <div class="col-1-2">
                    <div class="upload-msg">
                        Upload a file to start cropping
                    </div>
                    <div class="upload-demo-wrap">
                        <div id="upload-demo" class="croppie-container">
                            <div class="cr-boundary" aria-dropeffect="none">
                                <img class="cr-image" alt="preview" aria-grabbed="false">
                                <div class="cr-viewport cr-vp-circle" tabindex="0" style="width: 100px; height: 100px;"></div>
                                <div class="cr-overlay"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div> --}}
        <div class="row form-group justify-content-around">
            <div id="croppie_image_top" class="col-md-6">
             {{-- <input id="image_top" type="file" class="form-control image
              @if ($errors->has('image_top')) is-invalid
              @endif" name="top" rows="8" accept="image/jpeg,image/png" required></input> --}}
              <label for="cr-boundary">{{ __('image_top') }}</label>
              {{-- <div class="cr-boundary"> --}}

               <span id="target_image_top" class="target_image">
                  <img src="{{ old('image_top',$post->image_top) }}" alt="" class="position-static cr-image previews">
               </span>
               {{-- <div class="cr-viewport"></div>
               <div class="cr-overlay"></div> --}}
              {{-- </div> --}}
             @if ($errors->has('image_top'))
                <span class="invalid-feedback" role="alert">
                    {{ $errors->first('image_top') }}
                </span>
             @endif
                {{-- <div class="cr-slider-wrap">
                  <input class="cr-slider" type="range" step="0.0001" aria-label="zoom" min="0.2667" max="1.5000" aria-valuenow="0.5552">
                </div> --}}
                <div class="actions">
                    <a class="btn btn-info position-relative">
                        <span>Upload</span>
                        {{-- <input type="file" id="upload" value="Choose a file" accept="image/*" /> --}}
                        <input id="image_top" type="file" class="form-control position-absolute
                        @if ($errors->has('image_top')) is-invalid
                        @endif" name="top" rows="8" accept="image/jpeg,image/png" style="opacity: 0;" required></input>
                    </a>
                    <a class="btn btn-outline-success upload-result" type="menu">Result</a>
                  </div>
            </div>

            <div class="col-md-6">
            　<label for="image_seq1">{{ __('image_seq1') }}</label>
            　<input id="image_seq1" type="file" class="form-control" name="seq1" rows="8" accept="image/bmp,image/gif,image/jpeg,image/png" >
            　</input>

                <span id="target_image_seq1" class="target_image">
                    <img src="{{ old('image_seq1',$post->image_seq1) }}" alt="" class="previews">
                </span>
                <div class="cr-slider-wrap"><input class="cr-slider" type="range" step="0.0001" aria-label="zoom" min="0.2667" max="1.5000" aria-valuenow="0.5552"></div>
                @if ($errors->has('image_seq1'))
                    <span class="invalid-feedback" role="alert">
                        {{ $errors->first('image_seq1') }}
                    </span>
                @endif
            </div>


            <div class="col-md-6">
                <label for="image_seq2">{{ __('image_seq2') }}</label>
                <input id="image_seq2" type="file" class="form-control
                @if ($errors->has('image_seq2')) is-invalid
                @endif" name="seq1" rows="8" accept="image/bmp,image/gif,image/jpeg,image/png">
                    <span id="target_image_seq2" class="target_image"><img src="{{ old('image_seq2',$post->image_seq2) }}" alt="" class="previews"></span>
                </input>
                @if ($errors->has('image_seq2'))
                    <span class="invalid-feedback" role="alert">
                        {{ $errors->first('image_seq2') }}
                    </span>
                @endif
            </div>

            <div class="col-md-6">
                <label for="image_seq3">{{ __('image_seq3') }}</label>
                <input id="image_seq3" type="file" class="form-control
                @if ($errors->has('image_seq3')) is-invalid
                @endif" name="seq1" rows="8" accept="image/bmp,image/gif,image/jpeg,image/png">
                    <span id="target_image_seq3" class="target_image"><img src="{{ old('image_seq3',$post->image_seq3) }}" alt="" class="previews"></span>
                </input>
                @if ($errors->has('image_seq3'))
                    <span class="invalid-feedback" role="alert">
                        {{ $errors->first('image_seq3') }}
                    </span>
                @endif
            </div>
            <div class="col-md-6">
                <label for="image_seq4">{{ __('image_seq4') }}</label>
                <input id="image_seq4" type="file" class="form-control
                @if ($errors->has('image_seq4')) is-invalid
                @endif" name="seq1" rows="8" accept="image/bmp,image/gif,image/jpeg,image/png">
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

@php
    $title = $post->title;
@endphp
@extends('layouts.app')
@section('content')

<div class="container post_show">
    <div class="container mt-2">
        @component('components.carousel')
        @slot('post', $post)
        @slot('star_avg', $star_avg)
        @slot('tag_names', $tag_names)
        @slot('grid', 'row')
        @endcomponent
    </div>
    <div class="container mb-3">
        <div class="card ml-auto mr-auto">
            <div class="card-body">
                <h4 class="card-title">{{__('手順')}}</h4>

                <p class="card-text">
                    {{ $post->sequence_body }}
                </p>
            </div>
        </div>
    </div>

    <div class="container mb-3">
        <div class="card ml-auto mr-auto">
            <div class="card-body">
                @auth
                <h4 class="card-title">レビュー投稿</h4>
                <form action="{{ url('post/review/'.$post->id) }}" method="post" class="mb-3"
                    enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="form-group row mb-2">
                        <div class="col-md-4">
                            <label for="stars" class="mb-0">{{__('評価')}}</label>
                            <div id="stars" class="evaluation">
                                <input id="star1" type="radio" name="star" value="5" />
                                <label for="star1">★</label>
                                <input id="star2" type="radio" name="star" value="4" />
                                <label for="star2">★</label>
                                <input id="star3" type="radio" name="star" value="3" />
                                <label for="star3">★</label>
                                <input id="star4" type="radio" name="star" value="2" />
                                <label for="star4">★</label>
                                <input id="star5" type="radio" name="star" value="1" checked />
                                <label for="star5">★</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <label for="review">{{__('コメント(1000文字以下)')}}</label>
                            <textarea type="text" name="review_body" id="review_body" class="review form-control w-100
                    @if ($errors->has('review_body')) is-invalid @endif" required>{{ old('review_body') }}</textarea>
                            @if ($errors->has('review_body'))
                            <span class="invalid-feedback" role="alert">
                                {{ $errors->first('review_body') }}
                            </span>
                            @endif
                        </div>
                    </div>
                    <button class="btn btn-outline-success mb-2" type="submit">
                        <span><i class="fas fa-paper-plane"></i> {{__('投 稿')}}</span>
                    </button>
                </form>
                @endauth
                <h4 class="card-title">{{__('レビュー')}}</h4>
                @if ($id_exist ?? '')
                @foreach ($reviews as $review)
                <h6 class="card-subtitle mb-2">
                    　<a href="{{ url('user/' . $review->user->id) }}" class=""><img src="{{ $review->user->image }}"
                            alt="user_img" class="rounded-circle" style="width: 50px"></a>
                    {{ ' ' . $review->user->name }}
                </h6>
                <p>
                    評価：
                    @for ($i = 0; $i < $review->stars; $i++)
                        <i class="fas fa-star"></i>
                        @endfor
                        @for ($i = 0; $i < (5 - $review->stars); $i++)
                            <i class="fas fa-star disabled"></i>
                            @endfor
                </p>
                <p class="card-text">
                    {{ $review->review_body }}
                </p>
                @endforeach
                @else
                <h6 class="card-subtitle mb-2 text-muted">{{__('レビューがありません')}}</h6>
                @endif
            </div>
        </div>
    </div>
</div>
<div class="container">

    <div class="row justify-content-center">
        @auth
        @can('edit', $post)
        {{-- 編集・削除ボタン --}}
        <div class="edit mb-2">
            <a href="{{ url('post/'.$post->id.'/edit') }}" class="btn btn-Jetgreen">
                <span><i class="fas fa-edit"></i>{{ __(' 編 集 ') }}</span>
            </a>
        </div>
        @component('components.btn-del')
        @slot('controller', 'post')
        @slot('id', $post->id)
        @slot('name', $post->title)
        @endcomponent

        @endcan
        @endauth
    </div>
</div>
<script src="{{ asset('js/show.js') }}"></script>
@endsection

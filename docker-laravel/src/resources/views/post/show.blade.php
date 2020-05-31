@php
    $title = $post->title;
@endphp
@extends('layouts.app')
@section('content')

<div class="container">
    <h1 id="post-title">{{ $title }}</h1>
@auth
@can('edit', $post)
    {{-- 編集・削除ボタン --}}
    <div class="edit">
        <a href="{{ url('post/'.$post->id.'/edit') }}" class="btn btn-primary">
            {{ __('Edit') }}
        </a>
        @component('components.btn-del')
            @slot('controller', 'post')
            @slot('id', $post->id)
            @slot('name', $post->title)
        @endcomponent

    </div>
@endcan
@endauth
    {{-- 記事内容 --}}
    <dl id="user_info" class="row ml-auto mr-auto">
        <dt class="col-md-2">{{ __('Auther') }}:</dt>
        <dd class="col-md-10">
            <a href="{{ url('user/'.$post->user->id) }}">
                {{ $post->user->name }}
            </a>
        </dd>
        <dt class="col-md-2">{{ __('Created') }}:</dt>
        <dd class="col-md-10">
            <time itemprop="dateCreated" datetime="{{ $post->created_at }}">
                {{ $post->created_at }}
            </time>
        </dd>
        <dt class="col-md-2">{{ __('Updated') }}:</dt>
        <dd class="col-md-10">
            <time itemprop="dateModified" datetime="{{ $post->updated_at }}">
                {{ $post->updated_at }}
            </time>
        </dd>
    </dl>
</div>

<div class="container">
    <hr>
    <div id="slider_show" class="card ml-auto mr-auto">
        <div class="bd-example">
            <div id="carouselCaptions" class="carousel slide" data-ride="carousel" data-interval="false">
              <ol class="carousel-indicators">
                <li data-target="#carouselCaptions" data-slide-to="0" class="active"></li>
                @for ( $i = 1; $i < 5 ; $i++ )
                    @if (! $post->{'image_seq'.$i})
                    @continue
                    @endif
                    <li data-target="#carouselCaptions" data-slide-to="{{ $i }}"></li>
                @endfor
              </ol>
              <div class="carousel-inner" role="listbox">
                <div class="carousel-item active">
                  <img class="d-block w-100" src="{{ $post->image_top }}" alt="Top slide">
                </div>
                @for ( $i = 1; $i < 5 ; $i++ )
                    @if (! $post->{'image_seq'.$i})
                    @continue
                    @endif
                    <div class="carousel-item">
                        <img class="d-block w-100" src="{{ $post->{'image_seq'.$i} }}" alt="{{ $i.'_slide' }}">
                    </div>
                @endfor
              </div>
              <a class="carousel-control-prev" href="#carouselCaptions" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
              </a>
              <a class="carousel-control-next" href="#carouselCaptions" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
              </a>
            </div>
        </div>
        <div class="row justify-content-sm-center tags">
            <div class="card-body col-sm-5  p-1 "> Some more card content </div>
            <div class="card-body col-sm-5 p-1"> Some more card content </div>
            <div class="card-body col-sm-5  p-1"> Some more card content </div>
            <div class="card-body col-sm-5 p-1"> Some more card content </div>
            <div class="card-body  col-sm-10 p-1"> Tag </div>
        </div>
        </div>
    </div>
    <div class="container mt-5">
        <div id="explain_text" class="card ml-auto mr-auto">
            <div class="card-body">
                <h4 class="card-title">手順</h4>

                <p class="card-text">
                {{ $post->sequence_body }}
                </p>
            </div>
        </div>
    </div>

    <div class="container mt-5">
        <div id="explain_text" class="card ml-auto mr-auto">
            <div class="card-body">
                @auth
              <h4 class="card-title">レビュー投稿</h4>
              <form action="{{ url('post/review/'.$post->id) }}" method="post" class="" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <div class="form-group row mb-2">
                  <div class="col-md-4">
                    <label for="stars" class="mb-0">評価</label>
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
                    <label for="review">コメント(1000文字以下)</label>
                    <textarea type="text" name="review_body" id="review_body" class="review form-control w-100
                    @if ($errors->has('review_body')) is-invalid @endif" required>{{ old('review_body') }}</textarea>
                    @if ($errors->has('review_body'))
                    <span class="invalid-feedback" role="alert">
                        {{ $errors->first('review_body') }}
                    </span>
                    @endif
                  </div>
                </div>
                <button class="btn btn-success mb-2" type="submit">投稿</button>
              </form>
              @endauth
              <h4 class="card-title">レビュー</h4>
              @if ($id_exist ?? '')
                @foreach ($reviews as $review)
                <h6 class="card-subtitle mb-2">
                    User ID: {{ $review->user_id }}
                    @for ($i = 0; $i < $review->stars; $i++)
                    <i class="fas fa-star"></i>
                    @endfor
                    @for ($i = 0; $i < (5 - $review->stars); $i++)
                    <i class="fas fa-star disabled"></i>
                    @endfor
                </h6>
                <p class="card-text">
                  {{ $review->review_body }}
                </p>
                @endforeach
              @else
              <h6 class="card-subtitle mb-2 text-muted">レビューがありません</h6>
              @endif
            </div>
        </div>
    </div>

<script src="{{ asset('js/show.js') }}"></script>
@endsection

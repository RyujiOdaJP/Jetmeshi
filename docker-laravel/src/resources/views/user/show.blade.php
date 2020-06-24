@php

@endphp
@extends('layouts.app')
@section('content')

<div class="container mb-3">
    <div class="card ml-auto mr-auto">
        <div class="card-body container profile">
            {{-- ユーザー1件の情報 --}}
            <div class="row w-100 m-0">
                <div class="media mb-3 offset-1 align-items-center">
                    <img class="d-flex mr-3 rounded-circle" src="{{ $user->image }}"
                    alt="Generic placeholder image" style="width: 100px;">
                    <div class="media-body">
                      <h4>{{ $user->name }}</h4>
                    </div>
                </div>
            </div>
            <div class="row justify-content-start">
                @auth
                @can('edit', $user)
                    {{-- 編集・削除ボタン --}}
                    <div class="edit offset-1 mb-2">
                        <a href="{{ url('user/'.$user->id.'/edit') }}" class="btn btn-outline-success w-100">
                            <i class="fas fa-edit"></i>{{ __(' 編 集 ') }}
                        </a>
                    </div>
                    @component('components.btn-del')
                        @slot('controller', 'user')
                        @slot('id', $user->id)
                        @slot('name', $user->name)
                    @endcomponent

                @endcan
                @endauth
            </div>
            <div class="w-100 row">
                <p class="offset-1 col-10">{{ $user->bio }}</p>
            </div>
            <div class="row justify-content-center w-100 m-0 user_evaluation">
                <div class="col-4">
                    <label for="rate"><i class="fas fa-star"></i>{{ __(' 平均') }}</label>
                    <p id="rate">{{ $rate . ' / 5.0' }}</p>
                </div>

                <div class="col-4">
                    <label for="like"><i class="fas fa-heart"></i>{{ __(' いいね') }}</label>
                    <p id="like">{{ $user->likes_where_1()->count() }}</p>
                </div>

                <div class="col-4">
                    <label for="receipt"><i class="fas fa-receipt"></i>{{ __(' レシピ数') }}</label>
                    <p id="receipt">{{ $user->posts()->count() }}</p>
                </div>
            </div>
            <dl class="row m-0 justify-content-center">
                @can ('edit', $user)
                <dt class="col-md-3"><i class="far fa-envelope"></i>{{ __('　E-Mail') }}</dt>
                <dd class="col-md-7">{{ $user->email }}</dd>
                @endcan
                <dt class="col-md-3"><i class="fab fa-twitter"></i>{{ __('　Twitter') }}</dt>
                <dd class="col-md-7">{{ $user->twitter }}</dd>
                <dt class="col-md-3"><i class="fab fa-instagram"></i>{{ __('　Instagram') }}</dt>
                <dd class="col-md-7">{{ $user->instagram }}</dd>
                <dt class="col-md-3"><i class="fab fa-github"></i>{{ __('　GitHub') }}</dt>
                <dd class="col-md-7">{{ $user->github }}</dd>
                <dt class="col-md-3"><i class="fab fa-facebook"></i>{{ __('　Facebook') }}</dt>
                <dd class="col-md-7 ">{{ $user->facebook }}</dd>
            </dl>
        </div>
    </div>
</div>
<div class="container mt-5">
    {{-- ユーザーの記事一覧 --}}
    <h2>{{ $user->name . 'の投稿' }}</h2>

    <div class="slide_container row">
        @for ($i = 0; $i < count($user->posts); $i++)
             @component('components.carousel')
             @slot('post', $user->posts[$i])
             @slot('star_avg', $stars_avg[$i])
             @slot('grid', 'col-5')
             @slot('tag_names', $tag_names[$i])
             @endcomponent
        @endfor
    </div>
</div>
<div class="container">

    {{ $user->posts->appends(request()->except('page'))->links('pagination::default') }}
</div>
@endsection

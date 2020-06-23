@php

@endphp
@extends('layouts.app')
@section('content')

<div class="container mb-3">
    <div class="card ml-auto mr-auto">
        <div class="card-body container">
            {{-- ユーザー1件の情報 --}}
            <div class="row w-100 m-0">
                <div class="media mb-3 offset-1">
                    <img class="d-flex align-self-start mr-3" src="https://cm-jetmeshi.s3-ap-northeast-1.amazonaws.com/AI+%E7%94%BB%E4%BC%AF.png"
                    alt="Generic placeholder image" style="width: 64px;">
                    <div class="media-body pt-3">
                      <h5>{{ $user->name }}</h5>
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
            <div class="w-100 row m-0">
                <p class="col-10">{{ __('自己紹介weeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeee') }}</p>

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
                {{-- <dt class="col-5"><i class="fas fa-star"></i>{{ __('　平均レート') }}</dt>
                <dd class="col-5">{{ $rate . ' / 5.0' }}</dd>
                <dt class="col-5"><i class="fas fa-receipt"></i>{{ __('　レシピ数') }}</dt>
                <dd class="col-5">{{ $user->posts()->count() }}</dd>
                <dt class="col-5"><i class="fas fa-heart"></i>{{ __('　いいね数') }}</dt>
                <dd class="col-5 mb-3">{{ $user->likes_where_1()->count() }}</dd> --}}
            <dl class="row m-0 justify-content-center">
                @can ('edit', $user)
                <dt class="col-sm-5"><i class="far fa-envelope"></i>{{ __('　E-Mail') }}</dt>
                <dd class="col-sm-5">{{ $user->email }}</dd>
                @endcan
                <dt class="col-sm-5"><i class="fas fa-heart"></i>{{ __('　Twitter') }}</dt>
                <dd class="col-sm-5 ">{{ '' }}</dd>
                <dt class="col-sm-5"><i class="fas fa-heart"></i>{{ __('　Instagram') }}</dt>
                <dd class="col-sm-5 ">{{ '' }}</dd>
                <dt class="col-sm-5"><i class="fas fa-heart"></i>{{ __('　GitHub') }}</dt>
                <dd class="col-sm-5 ">{{ '' }}</dd>
                <dt class="col-sm-5"><i class="fas fa-heart"></i>{{ __('　Facebook') }}</dt>
                <dd class="col-sm-5 ">{{ '' }}</dd>
            </dl>
            <div class="row">

            </div>
        </div>
    </div>
</div>
<div class="container mt-5">
    {{-- ユーザーの記事一覧 --}}
    <h2>{{ $user->name . 'の投稿' }}</h2>
    {{-- <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>{{ __('Title') }}</th>
                    <th>{{ __('Sequence_Body') }}</th>
                    <th>{{ __('Created') }}</th>
                    <th>{{ __('Updated') }}</th> --}}

                {{-- 記事の編集・削除ボタンのカラム --}}
                    {{-- @auth
                        @can('edit', $user)<th></th>@endcan
                    @endauth
                </tr>
            </thead>
            <tbody>
                @foreach ($user->posts as $post)
                    <tr>
                        <td>
                            <a href="{{ url('post/' . $post->id) }}">
                                {{ $post->title }}
                            </a>
                        </td>
                        <td>{{ $post->sequence_body }}</td>
                        <td>{{ $post->created_at }}</td>
                        <td>{{ $post->updated_at }}</td> --}}



                    {{-- 管理者のページを表示中の場合は、編集・削除ボタンを表示させない --}}
                    {{-- @if (Auth::check() && !Auth::user()->isAdmin($user->id))
                    @auth
                        @can('edit', $user)<td nowrap>
                            <a href="{{ url('post/' . $post->id . '/edit') }}" class="btn btn-primary">
                                {{ __('Edit') }}
                            </a>
                            @component('components.btn-del')
                            @slot('controller', 'user')
                            @slot('id', $user->id)
                            @slot('name', $user->title)
                            @endcomponent
                        </td>
                    @endcan
                @endauth
                @endif --}}
                     {{-- </tr>

                @endforeach
            </tbody>
        </table>
    </div> --}}

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

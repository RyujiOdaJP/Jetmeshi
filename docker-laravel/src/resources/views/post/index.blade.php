@php
    $title = __('投稿一覧');
@endphp
@extends('layouts.app')
@section('content')
<div class="container">
    <h1>{{ $title }}</h1>
    <form action="{{ url('search') }}" class="mb-5" method="get" enctype="multipart/form-data">
        <div class="container　justify-content-sm-start form-budget-time">
            <div id="cooking_time" class="row form-group ">
                <div class=" col-md-4 mb-1">
                    <label for="cooking_time_min" class="d-block">
                        <i class="fas fa-stopwatch"></i>{{ __(' 調理時間') }}
                    </label>
                    <input id="cooking_time_min" type="number" min="0" max="60" value=""
                        class="form-control custom-control-inline " name="cooking_time_min"></input>
                    <span>~</span>
                    <input id="cooking_time_max" type="number" min="0" max="60" value=""
                        class="form-control custom-control-inline" name="cooking_time_max"></input>
                    <span>分</span>
                </div>
            </div>
            <div id="budget" class="row form-group ">
                <div class=" col-md-4 mb-1">
                    <label for="budget_min" class="d-block">
                        <i class="fas fa-yen-sign"></i>{{ __(' 調理費用') }}
                    </label>
                    <input id="budget_min" type="number" min="0" max="2000" step="50" value=""
                        class="form-control custom-control-inline" name="budget_min">
                    <span>~</span>
                    <input id="budget_max" type="number" min="0" max="2000" step="50" value=""
                        class="form-control custom-control-inline" name="budget_max">
                    <span>円</span>
                </div>
            </div>
        </div>

        @component('components.tags')
        @slot('tags', $tags)
        @endcomponent

        <div class="container">
            <div class="row form-group">
                <label for="keyword"><i class="fas fa-globe"></i> キーワード</label>
                <input class="form-control" type="text" name="keyword" id="keyword" placeholder="キーワード検索" value="">
            </div>
        </div>
        <button type="submit" class="btn btn-success"><i class="fas fa-search"></i>{{ __(' 検 索') }}</button>
    </form>
    <div class="slide_container row">
        @for ($i = 0; $i < count($posts); $i++)
            @component('components.carousel')
            @slot('post', $posts[$i])
            @slot('star_avg', $stars_avg[$i])
            @slot('grid', 'col-5')
            @slot('tag_names', $tag_names[$i])
            @endcomponent
        @endfor
        @if (count($posts)%2 != 0)
            <div class="col-5 slide_show"></div>
        @endif
    </div>
    {{ $posts->appends(request()->except('page'))->links('pagination::default') }}
</div>
<script src="{{ asset('js/search.js') }}"></script>
@endsection

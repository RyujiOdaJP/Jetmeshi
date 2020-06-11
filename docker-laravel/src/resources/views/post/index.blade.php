@php
    $title = __('Posts');
@endphp
@extends('layouts.app')
@section('content')
<div class="container">
    <h1>{{ $title }}</h1>
    <form action="{{ url('search') }}" class="mb-5" method="get" enctype="multipart/form-data">
        <div class="container　justify-content-sm-start">
            <div id="cooking_time" class="row form-group ">
                <div class=" col-md-4 mb-1">
                    <label for="cooking_time_min" class="d-block">{{ __('調理時間 ') }}</label>
                    <input id="cooking_time_min" type="number" min="0" max="60" value="5" class=" custom-control-inline m-0" name="cooking_time_min" ></input>
                    <span>~</span>
                    <input id="cooking_time_max" type="number" min="0" max="60" value="10" class=" custom-control-inline m-0" name="cooking_time_max" ></input>
                    <span>分</span>
                </div>
            </div>
            <div id="budget" class="row form-group ">
                <div class=" col-md-6 mb-1">
                    <label for="budget_min" class="d-block">{{ __('調理費用 ') }}</label>
                    <input id="budget_min" type="number" min="0" max="2000" step="50" value="100" class="form-control custom-control-inline m-0 w-25" name="budget_min" >
                    <span>~</span>
                    <input id="budget_max" type="number" min="0" max="2000" step="50" value="200" class="form-control custom-control-inline m-0 w-25" name="budget_max" >
                    <span>円</span>
                </div>
            </div>
        </div>
        <label for="tag" class="d-block">{{ __('タグ ') }}</label>
        <div id="tag_container" class="container">
            <div id="tag_group1" class="row form-group justify-content-lg-between">
                <div class="col-lg-2">
                    <input id="tag" type="checkbox" class=" custom-control-inline" name="tag" rows="8" >
                        <span>akofepwk</span>
                    </input>
                </div>
                <div class="col-lg-2">
                    <input id="tag" type="checkbox" class=" custom-control-inline" name="tag" rows="8" >
                        <span>akofepwk</span>
                    </input>
                </div>
                <div class="col-lg-2">
                    <input id="tag" type="checkbox" class=" custom-control-inline" name="tag" rows="8" >
                        <span>akofepwk</span>
                    </input>
                </div>
                <div class="col-lg-2">
                    <input id="tag" type="checkbox" class=" custom-control-inline" name="tag" rows="8" >
                        <span>akofepwk</span>
                    </input>
                </div>
                <div class="col-lg-2">
                    <input id="tag" type="checkbox" class=" custom-control-inline" name="tag" rows="8" >
                        <span>akofepwk</span>
                    </input>
                </div>
                <div class="col-lg-2">
                    <input id="tag" type="checkbox" class=" custom-control-inline" name="tag" rows="8" >
                        <span>akofepwk</span>
                    </input>
                </div>

            </div>
            <div id="tag_group2" class="row form-group justify-content-lg-between">
                <div class="col-lg-2">
                    <input id="tag" type="checkbox" class=" custom-control-inline" name="tag" rows="8" >
                        <span>akofepwk</span>
                    </input>
                </div>
                <div class="col-lg-2">
                    <input id="tag" type="checkbox" class=" custom-control-inline" name="tag" rows="8" >
                        <span>akofepwk</span>
                    </input>
                </div>
                <div class="col-lg-2">
                    <input id="tag" type="checkbox" class=" custom-control-inline" name="tag" rows="8" >
                        <span>akofepwk</span>
                    </input>
                </div>
                <div class="col-lg-2">
                    <input id="tag" type="checkbox" class=" custom-control-inline" name="tag" rows="8" >
                        <span>akofepwk</span>
                    </input>
                </div>
                <div class="col-lg-2">
                    <input id="tag" type="checkbox" class=" custom-control-inline" name="tag" rows="8" >
                        <span>akofepwk</span>
                    </input>
                </div>
                <div class="col-lg-2">
                    <input id="tag" type="checkbox" class=" custom-control-inline" name="tag" rows="8" >
                        <span>akofepwk</span>
                    </input>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row form-group">
                <label for="keyword">キーワード</label>
                <input class="form-control" type="text" name="keyword" id="keyword" placeholder="キーワード検索" value="">
            </div>
        </div>
        <button type="submit" class="btn btn-success">{{ __('検索') }}</button>
    </form>
    <div class="slide_container row">
            @for ($i = 0; $i < count($posts); $i++)
                 @component('components.carousel')
                 @slot('post', $posts[$i])
                 @slot('star_avg', $stars_avg[$i])
                 @endcomponent
            @endfor
    </div>
    {{ $posts->links('pagination::default') }}
</div>
<script src="{{ asset('js/search.js') }}"></script>
@endsection

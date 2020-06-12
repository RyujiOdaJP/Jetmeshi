@php
    $title = __('Posts');
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
                    <input id="cooking_time_min" type="number" min="0" max="60" value="5"
                    class="form-control custom-control-inline " name="cooking_time_min" ></input>
                    <span>~</span>
                    <input id="cooking_time_max" type="number" min="0" max="60" value="10"
                    class="form-control custom-control-inline" name="cooking_time_max" ></input>
                    <span>分</span>
                </div>
            </div>
            <div id="budget" class="row form-group ">
                <div class=" col-md-4 mb-1">
                    <label for="budget_min" class="d-block">
                        <i class="fas fa-yen-sign"></i>{{ __(' 調理費用') }}
                    </label>
                    <input id="budget_min" type="number" min="0" max="2000" step="50" value="100"
                    class="form-control custom-control-inline" name="budget_min" >
                    <span>~</span>
                    <input id="budget_max" type="number" min="0" max="2000" step="50" value="200"
                    class="form-control custom-control-inline" name="budget_max" >
                    <span>円</span>
                </div>
            </div>
        </div>
        <label for="tag" class="d-block">
            <i class="fas fa-tags"></i>{{ __(' タグ ') }}
        </label>
        <div id="tag_container" class="row">
            <div id="tag_group1" class="col-6 form-group justify-content-between">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" id="customCheck1" class="custom-control-input" name="tag">
                    <label class="custom-control-label" for="customCheck1">checkbox</label>
                </div>
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" id="customCheck2" class="custom-control-input" name="tag">
                    <label class="custom-control-label" for="customCheck2">checkbox</label>
                </div>
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" id="customCheck3" class="custom-control-input" name="tag">
                    <label class="custom-control-label" for="customCheck3">checkbox</label>
                </div>
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" id="customCheck4" class="custom-control-input" name="tag">
                    <label class="custom-control-label" for="customCheck4">checkbox</label>
                </div>
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" id="customCheck5" class="custom-control-input" name="tag">
                    <label class="custom-control-label" for="customCheck5">checkbox</label>
                </div>
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" id="customCheck6" class="custom-control-input" name="tag">
                    <label class="custom-control-label" for="customCheck6">checkbox</label>
                </div>
            </div>

            <div id="tag_group2" class="col-5 form-group justify-content-between">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" id="customCheck7" class="custom-control-input" name="tag">
                    <label class="custom-control-label" for="customCheck7">checkbox</label>
                </div>
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" id="customCheck8" class="custom-control-input" name="tag">
                    <label class="custom-control-label" for="customCheck8">checkbox</label>
                </div>
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" id="customCheck9" class="custom-control-input" name="tag">
                    <label class="custom-control-label" for="customCheck9">checkbox</label>
                </div>
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" id="customCheck10" class="custom-control-input" name="tag">
                    <label class="custom-control-label" for="customCheck10">checkbox</label>
                </div>
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" id="customCheck11" class="custom-control-input" name="tag">
                    <label class="custom-control-label" for="customCheck11">checkbox</label>
                </div>
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" id="customCheck12" class="custom-control-input" name="tag">
                    <label class="custom-control-label" for="customCheck12">checkbox</label>
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

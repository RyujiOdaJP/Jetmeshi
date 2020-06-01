@php
    $title = __('Posts');
@endphp
@extends('layouts.app')
@section('content')
<div class="container">
    <h1>{{ $title }}</h1>
    <form action="">
        <div class="container　justify-content-sm-start">
            <div id="cooking_time" class="row form-group ">
                <div class=" col-md-4 mb-1">
                    <label for="cooking_time_min" class="d-block">{{ __('調理時間 ') }}</label>
                    <input id="cooking_time_min" type="number" min="0" max="60" value="10" step="1" class=" custom-contro m-0" name="cooking_time_min" rows="8" required></input>
                    <span>~</span>
                    <input id="cooking_time_max" type="number" min="0" max="60" value="10" step="1" class=" custom-control-inline m-0" name="cooking_time_max" rows="8" required></input>
                    <span>分</span>
                </div>
            </div>
            <div id="budget" class="row form-group ">
                <div class=" col-md-4 mb-1">
                    <label for="budget_min" class="d-block">{{ __('調理費用 ') }}</label>
                    <input id="budget_min" type="number" min="0" max="2000" value="100" step="10" class=" custom-control-inline m-0" name="budget_min" rows="8" required>
                    <span>~</span>
                    <input id="budget_max" type="number" min="0" max="2000" value="100" step="10" class=" custom-control-inline m-0" name="budget_max" rows="8" required>
                    <span>円</span>
                </div>
            </div>
        </div>
        <label for="tag" class="d-block">{{ __('タグ ') }}</label>
        <div id="tag_container" class="container">
            <div id="tag_group1" class="row form-group justify-content-lg-between">
                <div class="col-lg-2">
                    <input id="tag" type="checkbox" class=" custom-control-inline" name="tag" rows="8" required>
                        <span>akofepwk</span>
                    </input>
                </div>
                <div class="col-lg-2">
                    <input id="tag" type="checkbox" class=" custom-control-inline" name="tag" rows="8" required>
                        <span>akofepwk</span>
                    </input>
                </div>
                <div class="col-lg-2">
                    <input id="tag" type="checkbox" class=" custom-control-inline" name="tag" rows="8" required>
                        <span>akofepwk</span>
                    </input>
                </div>
                <div class="col-lg-2">
                    <input id="tag" type="checkbox" class=" custom-control-inline" name="tag" rows="8" required>
                        <span>akofepwk</span>
                    </input>
                </div>
                <div class="col-lg-2">
                    <input id="tag" type="checkbox" class=" custom-control-inline" name="tag" rows="8" required>
                        <span>akofepwk</span>
                    </input>
                </div>
                <div class="col-lg-2">
                    <input id="tag" type="checkbox" class=" custom-control-inline" name="tag" rows="8" required>
                        <span>akofepwk</span>
                    </input>
                </div>

            </div>
            <div id="tag_group2" class="row form-group justify-content-lg-between">
                <div class="col-lg-2">
                    <input id="tag" type="checkbox" class=" custom-control-inline" name="tag" rows="8" required>
                        <span>akofepwk</span>
                    </input>
                </div>
                <div class="col-lg-2">
                    <input id="tag" type="checkbox" class=" custom-control-inline" name="tag" rows="8" required>
                        <span>akofepwk</span>
                    </input>
                </div>
                <div class="col-lg-2">
                    <input id="tag" type="checkbox" class=" custom-control-inline" name="tag" rows="8" required>
                        <span>akofepwk</span>
                    </input>
                </div>
                <div class="col-lg-2">
                    <input id="tag" type="checkbox" class=" custom-control-inline" name="tag" rows="8" required>
                        <span>akofepwk</span>
                    </input>
                </div>
                <div class="col-lg-2">
                    <input id="tag" type="checkbox" class=" custom-control-inline" name="tag" rows="8" required>
                        <span>akofepwk</span>
                    </input>
                </div>
                <div class="col-lg-2">
                    <input id="tag" type="checkbox" class=" custom-control-inline" name="tag" rows="8" required>
                        <span>akofepwk</span>
                    </input>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-success">{{ __('検索') }}</button>
    </form>

            @foreach ($posts as $post)
                 @component('components.carousel')
                 @slot('post', $post)
                 @endcomponent
            @endforeach
            </tbody>
        </table>
    </div>
    {{ $posts->onEachSide(1)->links() }}
</div>
<script src="{{ asset('js/search.js') }}"></script>
@endsection

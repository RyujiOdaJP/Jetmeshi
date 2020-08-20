@php
    $title = $post->title;
@endphp
@extends('layouts.app')
@section('content')
<!-- Modal -->
<div class="modal fade" id="report-modal" tabindex="-1" role="dialog" aria-labelledby="report-modal-label" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="report-modal-label">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ url('report') . '/' . $post->id }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <div class="modal-body form-group">
                <p>
                    このレビューを報告しますか？
                </p>
            {{-- hidden input for validation at least 1 check required --}}
                <input type="hidden" name="reports" value="">
                {{-- <input type="hidden" name="user_id" value="{{ Auth::id() }}"> --}}
                <input type="hidden" id="review_id" name="review_id" value="">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" name="harmful" id="harmful" value="1">
                    <label for="harmful">誹謗中傷を含んでいる</label>
                </div>
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" name="irrevant" id="irrevant" value="1">
                    <label for="irrevant">投稿内容と関係がない</label>
                </div>
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" name="personal" id="personal" value="1">
                    <label for="personal">個人情報を流出させている</label>
                </div>
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" name="inappropriate" id="inappropriate" value="1">
                    <label for="inappropriate">不適切な表現（暴力、性的、差別）</label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
      </div>
    </div>
  </div>

<div class="container post_show">
    <div class="container mt-2">
        @component('components.carousel')
        @slot('post', $post)
        @slot('star_avg', $star_avg)
        @slot('tag_names', $tag_names)
        @slot('grid', '')
        @endcomponent
    </div>
    <div class="container mb-3">
        <div class="card ml-auto mr-auto">
            <div class="card-body">
                <h4 class="card-title">{{__('手順')}}</h4>
                <p class="card-text">
                    {!! nl2br($post->sequence_body) !!}
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
                    <div class="form-group mb-2">
                        <div class="col-md-4">
                            <label for="stars" class="mb-0">{{__('評価')}}</label>
                            <div id="stars" class="evaluation">
                                <input id="star1" type="radio" name="star" value="5" />
                                <label for="star1">★</label>
                                <input id="star2" type="radio" name="star" value="4" />
                                <label for="star2">★</label>
                                <input id="star3" type="radio" name="star" value="3" checked />
                                <label for="star3">★</label>
                                <input id="star4" type="radio" name="star" value="2" />
                                <label for="star4">★</label>
                                <input id="star5" type="radio" name="star" value="1" />
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
                <h6 class="card-subtitle mb-2 mt-3">
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
                    {!! nl2br($review->review_body) !!}
                </p>
                @auth
                    @if (!in_array($review->id, $report_arr))
                    <a href="" id="{{'report_' . $review->id}}" class="report card-text" data-toggle="modal" data-target="#report-modal" data-id="{{ $review->id }}">
                            <i class="fas fa-flag"></i> 問題を報告
                        </a>
                    @else
                    <a href="" class="report btn disabled" data-toggle="modal" data-target="#report-modal">
                        <i class="fas fa-flag"></i> 問題報告済み
                    </a>
                    @endif
                @endauth

                @endforeach
                @else
                <h6 class="card-subtitle mb-2 text-muted">{{__('レビューがありません')}}</h6>
                @endif
            </div>
        </div>
    </div>
    <div class="container mb-3">
        <div class="card ml-auto mr-auto">
            <div class="card-body">
                <h4 class="card-title">投稿者</h4>
                <div class="media mt-3 mb-3 offset-1 align-items-center">
                    <a href="{{ url( 'user/' . $post->user_id) }}">
                        <img class="d-flex mr-3 rounded-circle"
                            src="{{ ($post->user()->select('image')->first())['image'] ?? 'https://cm-jetmeshi.s3-ap-northeast-1.amazonaws.com/noimage+template.jpg' }}"
                            alt="Generic placeholder image"
                            style="width: 100px;">
                    </a>
                    <div class="media-body">
                        <h4>{{ ($post->user()->select('name')->first())['name'] }}</h4>
                    </div>
                </div>
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

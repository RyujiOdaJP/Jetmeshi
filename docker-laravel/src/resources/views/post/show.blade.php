@php
    $title = $post->title;
@endphp
@extends('layouts.app')
@section('content')

{{-- <script>
    var infScroll = new InfiniteScroll( '.scroll_area', {
      path : ".pagination a[rel=next]",
      append : ".post"
    });
</script> --}}
{{-- “.pagination a[rel=next]” はLaravelの
    paginateが出力するリンクの形に合わせています --}}
{{--

    Reference:https://mrkmyki.com/laravel%E3%81%AEpaginate%E3%81%A8infinite-scroll%E3%82%92%E4%BD%BF%E3%81%84%E3%80%81%E3%83%87%E3%83%BC%E3%82%BF%E3%83%99%E3%83%BC%E3%82%B9%E5%86%85%E3%81%AE%E3%83%87%E3%83%BC%E3%82%BF%E3%82%92

    <section class="scroll_area"
  data-infinite-scroll='{
    "path": ".pagination a[rel=next]",
    "append": ".post"
  }'
>
  @foreach($posts as $key => $post)
    <div class="post">
      <h3>{{ $post->title }}</h3>
      <p>{{ $post->text }}</p>
    </div>
  @endforeach
</section>
{{ $posts->links() }} --}}


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
    <dl class="row">
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
    <hr>
    <div class="card w-75 ml-auto mr-auto">
        <div class="bd-example">
            <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
              <ol class="carousel-indicators">
                <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
              </ol>
              <div class="carousel-inner" role="listbox">
                <div class="carousel-item active">
                  <img class="d-block w-100" src="{{ $post->image_top }}" alt="First slide">
                  <div class="carousel-caption d-none d-md-block">
                    <h3>First slide label</h3>
                    <p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p>
                  </div>
                </div>
                <div class="carousel-item">
                  <img class="d-block w-100" src="{{ $post->image_top }}" alt="Second slide">
                  <div class="carousel-caption d-none d-md-block">
                    <h3>Second slide label</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                  </div>
                </div>
              </div>
              <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
              </a>
              <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
              </a>
            </div>
          </div>
        <div class="card-body col-md-6"> Some more card content </div>
        <div class="card-body col-md-6"> Some more card content </div>
        </div>


    </div>



@endsection

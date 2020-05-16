@php
    $title = $post->title;
@endphp
@extends('layouts.app')
@section('content')

<script>
    var infScroll = new InfiniteScroll( '.scroll_area', {
      path : ".pagination a[rel=next]",
      append : ".post"
    });
</script>
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
        <dt class="col-md-2">{{ __('Recipe') }}:</dt>
        <dd class="col-md-10">
            <a href="{{ url('user/'.$post->user->id) }}">
               <img src="{{ $post->image_top }}" alt="" width="560px"> 
            </a>
        </dd>
    </dl>
    <hr>
    <div id="post-body">
        {{ $post->body }}
    </div>
</div>
@endsection

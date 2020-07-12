@php
    $post = $post;
    $star_avg = $star_avg;
    $grid = $grid;
    $tag_names = $tag_names ?? '';

    $count_of_likes =
        $post->likes('post_id')
        ->where('likes', '1')
        ->count();

    $liked_or_not =
        $post->likes('post_id')
        ->select('likes')
        ->where('user_id', Auth::id())
        ->first();
@endphp

<div id="{{'slide_show_'.$post->id}}" class="{{ $grid }} card slide_show">
    <div id="{{'carouselCaptions_'.$post->id}}" class="carousel slide" data-ride="carousel" data-interval="false">
        <ol class="carousel-indicators">
            <li data-target="{{'#carouselCaptions_'.$post->id}}" data-slide-to="0" class="active"></li>
            @for ( $i = 1; $i < 5 ; $i++ ) @if (! $post->{'image_seq'.$i})
                @continue
                @endif
                <li data-target="{{'#carouselCaptions_'.$post->id}}" data-slide-to="{{ $i }}"></li>
                @endfor
        </ol>
        <div class="carousel-inner" role="listbox">
            <div class="carousel-item active">
                <a href="{{url('post/'.$post->id)}}">
                    <img class="d-block w-100 if-showpage-disable-anchor" src="{{ $post->image_top }}" alt="Top slide">
                </a>
            </div>
            @for ( $i = 1; $i < 5 ; $i++ ) @if (! $post->{'image_seq'.$i})
                @continue
                @endif
                <div class="carousel-item">
                    <a href="{{url('post/'.$post->id)}}">
                        <img class="d-block w-100 if-showpage-disable-anchor" src="{{ $post->{'image_seq'.$i} }}"
                            alt="{{ $i.'_slide' }}">
                    </a>
                </div>
                @endfor
        </div>
        <a class="carousel-control-prev" href="{{'#carouselCaptions_'.$post->id}}" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="{{'#carouselCaptions_'.$post->id}}" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    {{-- <div class="row justify-content-sm-center tags"> --}}
    <div class="card-body">
        <h5>{{ $post->title }}</h5>
    </div>
    <div class="card-body">
        @if ( $star_avg !== null)
        @for ($i = 0; $i < round($star_avg); $i++) <i class="fas fa-star"></i>
            @endfor
            @for ($i = 0; $i < 5 - round($star_avg); $i++) <i class="fas fa-star disabled"></i>
                @endfor
                {{ ' '.round($star_avg, 1) }}
                @else
                <i class="fas fa-star disabled"></i> 未評価
                @endif
    </div>
    <div class="card-body">
        <i class="fas fa-yen-sign"></i> {{ $post->budget }}円
    </div>
    <div class="card-body">
        <i class="fas fa-stopwatch"></i> {{ $post->cooking_time }}分
    </div>
    <div class="card-body">
        <i class="fas fa-tags"></i>
        @if ($tag_names != '')
        @foreach ($tag_names as $tag)
        {{ $tag. ',' }}
        @endforeach
        @endif

    </div>

    <div class="card-body">
        @auth
        <button type="button" id="{{'btn_'.$post->id}}" data-like="{{ $post->id }}" name="likes"
            class="btn btn-outline-secondary">
            <i class="fas fa-heart"></i>
            <span id="{{'count_'.$post->id}}" data-count="{{ $count_of_likes }}" data-inserted="{{$count_of_likes}}">
                @if ($liked_or_not['likes'] ?? '' == '1')
                {{ ' いいね済み ' . $count_of_likes }}
                @else
                {{ ' いいね ' . $count_of_likes }}
                @endif
            </span>
        </button>
        @endauth
        {{-- <a href="https://twitter.com/share?ref_src=twsrc%5Etfw"
        class="twitter-share-button" data-url="{{('https://app.jetmeshi.net/post/' . $post->id)}}"
        data-via="SyodoB" data-hashtags="Jetmeshi" data-lang="ja" data-show-count="false">Tweet</a> --}}
        <a href="https://twitter.com/intent/tweet?text=【Jetmeshi】即席飯を作ってみた！{{ $post->title .' by ' . $post->user()->select('name')->first()['name'] }}&url={{('https://app.jetmeshi.net/post/' . $post->id)}}&related=@SyodoB"
        target="_blank" rel="nofollow" class="btn btn-Twitter">
            <span><i class="fab fa-twitter"></i>ツイートする</span>
        </a>
    </div>
</div>


@php
    $post = $post;
    $star_avg = $star_avg;
    $grid = $grid;
    $tag_names = $tag_names ?? '';
@endphp

<div id="{{'slide_show_'.$post->id}}" class="{{ $grid }} card slide_show">
        <div id="{{'carouselCaptions_'.$post->id}}" class="carousel slide" data-ride="carousel" data-interval="false">
          <ol class="carousel-indicators">
            <li data-target="{{'#carouselCaptions_'.$post->id}}" data-slide-to="0" class="active"></li>
            @for ( $i = 1; $i < 5 ; $i++ )
                @if (! $post->{'image_seq'.$i})
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
            @for ( $i = 1; $i < 5 ; $i++ )
                @if (! $post->{'image_seq'.$i})
                @continue
                @endif
                <div class="carousel-item">
                    <a href="{{url('post/'.$post->id)}}">
                        <img class="d-block w-100 if-showpage-disable-anchor" src="{{ $post->{'image_seq'.$i} }}" alt="{{ $i.'_slide' }}">
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
                @for ($i = 0; $i < round($star_avg); $i++)
                <i class="fas fa-star"></i>
                @endfor
                @for ($i = 0; $i < 5 - round($star_avg); $i++)
                <i class="fas fa-star disabled"></i>
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
    {{-- </div> --}}
</div>

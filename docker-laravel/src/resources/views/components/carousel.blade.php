@php
    $post = $post;
@endphp

<div id="slider_show" class="card ml-auto mr-auto">
    <div class="bd-example">
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
              <img class="d-block w-100" src="{{ $post->image_top }}" alt="Top slide">
            </div>
            @for ( $i = 1; $i < 5 ; $i++ )
                @if (! $post->{'image_seq'.$i})
                @continue
                @endif
                <div class="carousel-item">
                    <img class="d-block w-100" src="{{ $post->{'image_seq'.$i} }}" alt="{{ $i.'_slide' }}">
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
    </div>
    <div class="row justify-content-sm-center tags">
        <div class="card-body col-sm-5  p-1 "> Some more card content </div>
        <div class="card-body col-sm-5 p-1"> Some more card content </div>
        <div class="card-body col-sm-5  p-1"> Some more card content </div>
        <div class="card-body col-sm-5 p-1"> Some more card content </div>
        <div class="card-body  col-sm-10 p-1"> Tag </div>
    </div>
    </div>

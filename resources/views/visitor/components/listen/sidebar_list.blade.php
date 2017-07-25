@if($audio && !empty($audio))
<li class="post-list__view post-list__item">
    <a href="{{ route('visitor.audio.album', $audio->id) }}" class="custom-a__link uk-flex uk-flex-inline">
        <div class="uk-flex-first post-list__thumbnail">
            <img src="@if($audio->featured_image){{ asset($audio->featured_image) }}@else{{ asset('images/no_thumbnail_img.jpg') }}@endif" alt="">
        </div>
        <div class="post-list__snippet uk-flex-item-1">
            <p>
                {{ $audio->title }}
            </p>
            <p class="singer">
            @if($audio->artist)
                {{ $audio->artist }}
            @endif
            </p>
        </div>
    </a>
</li>
@endif

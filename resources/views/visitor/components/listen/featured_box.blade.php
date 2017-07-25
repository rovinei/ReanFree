@if($album && !empty($album))
<div class="uk-panel padding-bottom-small">
    <div class="audio-featured__box">
        <div class="box-inner">
            <div class="thumbnail">
                <img src="@if($album->featured_image){{ asset($album->featured_image) }}@else{{ asset('images/no_thumbnail_img.jpg') }}@endif">

                <div class="overlay-hover">
                    <a href="{{ route('visitor.audio.album', $album->id) }}" class="custom-link">
                        Listen <i class="fa fa-arrow-right"></i>
                    </a>
                </div>
            </div>
            <div class="caption">
                <div class="meta">
                    <div class="genre">{{ $album->genre }}</div>
                    <div class="date">
                        <i class="fa fa-calendar"></i>
                        {{ $album->created_at->format('d M\\, Y') }}
                    </div>
                </div>
                <div class="title padding-bottom-small">
                    {{ $album->title }}
                </div>
            </div>
        </div>
    </div>
</div>
@endif

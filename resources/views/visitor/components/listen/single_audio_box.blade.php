@if($audio && !empty($audio))
<div class="uk-panel uk-margin-bottom">
    <div class="audio-featured__box">
        <div class="box-inner">
            <div class="thumbnail">
                <img src="@if($audio->featured_image){{ asset($audio->featured_image) }}@else{{ asset('images/no_thumbnail_img.jpg') }}@endif">

                <div class="overlay-hover">
                    <a href="{{ route('visitor.audio.detail', $audio->id) }}" class="custom-link">
                        Listen <i class="fa fa-arrow-right"></i>
                    </a>
                </div>
            </div>
            <div class="caption">
                <div class="meta">
                    <div class="genre">{{ $audio->category->name }}</div>
                    <div class="date">
                        <i class="fa fa-calendar"></i>
                        {{ $audio->created_at->format('d M\\, Y') }}
                    </div>
                </div>
                <div class="title padding-bottom-small">
                    {{ $audio->title }}
                </div>
            </div>
        </div>
    </div>
</div>
@endif

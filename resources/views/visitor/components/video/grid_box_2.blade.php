@if(!empty($video))
<div class="video-box-feature no-margin-left no-margin-right uk-margin-bottom">
    <div class="inner">
        <a class="mansory-container" href="{{ route('visitor.video.detail', $video->id) }}">
            <div class="feature-box-teaser row">
                <div class="thumbnail">
                @if($video->featured_image)
                    <img src="{{ asset($video->featured_image) }}" alt="{{ $video->title }}">
                @else
                    <img src="{{ asset('images/no_thumbnail_img.jpg') }}" alt="{{ $video->title }}">
                @endif
                </div>
            </div>

            <div class="feature-box-text row">
                <h3>
                    {{ str_limit($video->title, 70) }}
                </h3>
                <p>
                    <i class="fa fa-clock-o"></i>
                    {{ $video->created_at->format('D\\, d M\\, Y') }}
                </p>
            </div>
        </a>
    </div>
</div>
@endif

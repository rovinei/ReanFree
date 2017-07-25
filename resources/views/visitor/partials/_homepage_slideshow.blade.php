<li>
    @if($slider->mediatype_id==3)
        <iframe width="auto" height="100%" src="https://www.youtube.com/embed/{{ $slider->video_url }}" frameborder="0"></iframe>
    @else
        <img src="@if($slider->featured_image){{ asset(str_replace('thumbs', 'uploads', $slider->featured_image)) }}@else{{ asset('images/no_thumbnail_img.jpg') }}@endif" alt="{{ $slider->title }}">
    @endif


    <div class="uk-overlay-panel uk-overlay-fade">
        <div class="uk-container uk-container-center uk-height-1-1 uk-width-1-1 uk-flex uk-flex-middle">
            <div class="uk-width-medium-1-2 uk-width-large-1-3 uk-width-xlarge-1-3">
                <div class="slideshow-overlay__box bg-grey-transparent uk-panel uk-panel-body uk-text-center">
                    <div class="slideshow-overlay__category">
                        <h3 class="font-kh-nokora">{{ $slider->genre }}</h3>
                    </div>
                    <h3 class="uk-margin-top text-title uk-heading-large font-kh-nokora">
                        {{ str_limit($slider->title, 11) }}
                    </h3>

                    <div class="uk-margin-top text-caption uk-text-large uk-margin font-kh-hanuman">
                        {!! str_limit(strip_tags($slider->content), 50) !!}
                    </div>

                    <p class="uk-margin-top">
                    @if($slider->mediatype_id==1)
                        <a class="custom-slider__cta" href="{{ route('visitor.article.detail', $slider->id) }}">
                            Read Now
                        </a>
                    @elseif($slider->mediatype_id==2)
                        <a class="custom-slider__cta" href="{{ route('visitor.audio.detail', $slider->id) }}">
                            Listen Now
                        </a>
                    @elseif($slider->mediatype_id==3)
                        <a class="custom-slider__cta" href="{{ route('visitor.video.detail', $slider->id) }}">
                            Watch Now
                        </a>
                    @endif

                    </p>
                </div>
            </div>
        </div>
    </div>
</li>


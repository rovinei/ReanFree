@if(!empty($slideshow))
<!-- Slideshow -->
<div class="slideshow_container">
    <div class="uk-panel">
        <div class="slideshow_section" data-uk-slideshow="{animation: 'swipe'}">
            <div class="uk-slidenav-position">
                <ul class="uk-slideshow uk-overlay-active">
                    <li>
                        <img src="@if($slideshow->featured_image){{ asset(str_replace('thumbs','uploads', $slideshow->featured_image)) }}@else{{ asset('images/no_thumbnail_img.jpg') }}@endif" alt="{{ $slideshow->title }}" alt="">

                        <div class="uk-overlay-panel uk-overlay-fade">
                            <div class="uk-container uk-container-center uk-height-1-1 uk-width-1-1 uk-flex uk-flex-middle">
                                <div class="uk-width-medium-1-2 uk-width-large-1-3 uk-width-xlarge-1-3">
                                    <div class="slideshow-overlay__box uk-panel uk-panel-body">
                                        <div class="breadcrum">
                                            <h3 class="font-kh-nokora yellow">
                                                <i class="fa fa-music"></i>
                                                <a class="" href="{{ route('visitor.audio.page') }}">@lang('visitor.audio')</a>
                                                <i class="fa fa-big fa-angle-double-right"></i>
                                                <a class="" href="{{ route('visitor.audio.category', $slideshow->category->id) }}">{{ $slideshow->category->name }}</a>
                                            </h3>
                                        </div>
                                        <h3 class="title-medium uk-margin-top font-yellow font-kh-nokora">
                                            {{ $slideshow->title }}
                                        </h3>

                                        <div class="uk-margin-top uk-margin-bottom">
                                            <p class="datetime">{{ $slideshow->created_at->format('d M\\, Y') }}</p>
                                        </div>

                                        <p class="">
                                            <a class="custom-slider__cta btn-flat-border" href="{{ route('visitor.audio.album', $slideshow->id) }}">CHECK ALBUM</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>

                <a href="#" class="uk-slidenav uk-slidenav-previous uk-hidden-touch" data-uk-slideshow-item="previous"></a>
                <a href="#" class="uk-slidenav uk-slidenav-next uk-hidden-touch" data-uk-slideshow-item="next"></a>
            </div>
        </div>
    </div>
</div>
<!-- /Slideshow -->
@endif

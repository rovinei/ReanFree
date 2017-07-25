@if(!empty($slideshow))
<!-- Slideshow -->
<div class="slideshow_container">
    <div class="uk-panel">
        <div class="slideshow_section" data-uk-slideshow="{animation: 'swipe'}">
            <div class="uk-slidenav-position">
                <ul class="uk-slideshow uk-overlay-active">
                    <li>
                        <img src="@if($slideshow->featured_image){{ asset(str_replace('thumbs', 'uploads', $slideshow->featured_image)) }}@else{{ asset('images/no_thumbnail_img.jpg') }}@endif" alt="">

                        <div class="uk-overlay-fade">
                            <div class="uk-container uk-container-center uk-height-1-1 uk-width-1-1 uk-flex margin-bottom-large">
                                <div class="uk-width-1-1">
                                    <div class="padding-left-md breadcrum">
                                        <h3 class="font-kh-nokora yellow">
                                            <i class="fa fa-newspaper-o fa-big"></i>
                                            <a href="#">អត្ថបទ</a>
                                            <i class="fa fa-angle-double-right"></i>
                                            <a href="{{ route('visitor.article.category', $slideshow->category->id) }}">{{ $slideshow->category->name }}</a>
                                        </h3>
                                    </div>
                                    <div class="slideshow-overlay__box">

                                        <div class="uk-panel-body bg-grey-transparent">

                                            <h2 class="uk-display-inline-block font-yellow font-kh-nokora uk-margin-remove">
                                                {{ $slideshow->title }}
                                            </h2>
                                        </div>

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

@if(!empty($slideshow))
<!-- Top video slideshow -->
<div class="video-slideshow bg-dark-grey">
    <div class="uk-container uk-container-center">
        <div class="video-slideshow__outter uk-clearfix">

            <div class="video-preview">
                @if($slideshow->video_url)
                <iframe width="100%" height="430" src="https://youtube.com/embed/{{ $slideshow->video_url }}" frameborder="0" allowfullscreen></iframe>
                @endif
            </div>

            <div class="video-desc">
                <div class="inner uk-clearfix">
                    <div class="breadcrum uk-margin-top">
                        <h3 class="font-kh-siemreap uk-margin-remove yellow">
                            <i class="fa fa-play"></i>
                            <a href="{{ route('visitor.video.page') }}">@lang('visitor.video')</a>
                            <i class="fa fa-angle-double-right"></i>
                            <a href="{{ route('visitor.video.category', $slideshow->category->id) }}">{{ $slideshow->category->name }}</a>
                        </h3>
                    </div>

                    <h3 class="title font-yellow">
                        {{ $slideshow->title }}
                    </h3>

                    <div class="datetime">
                        <i class="fa fa-clock-o"></i>
                        {{ $slideshow->created_at->diffForHumans() }}
                    </div>

                    <div class="snippet">
                        <p>
                        @if($slideshow->content)
                            {!! str_limit(strip_tags($slideshow->content), 150) !!}
                        @endif
                        </p>
                    </div>

                    <div class="socials">
                        <div class="social-share">

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- /Top video slideshow -->
@endif

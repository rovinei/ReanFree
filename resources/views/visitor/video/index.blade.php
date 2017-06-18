@extends('visitor.layouts.main')

@section('page_title', '180 INSPIRE | Watching the most recent and trending videos media')

@push('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('lib/jssocial/jssocials.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('lib/jssocial/jssocials-theme-flat.css') }}">
@endpush

@section('slideshow')
    @includeIf('visitor.components.video.slideshow', ['slideshow' => $videos[0]])
@endsection

@section('content')
<!-- Page content wrapper -->
<div class="page-bg__wrapper">
    <div class="uk-container uk-container-center">

        <div class="breadcrum uk-margin-top">
            <h3 class="font-kh-siemreap uk-margin-remove plain">
                <a href="{{ route('visitor.index.page') }}">@lang('visitor.homepage')</a>
                <i class="fa fa-angle-double-right"></i>
                <a href="{{ route('visitor.video.page') }}">@lang('visitor.video')</a>
            </h3>
        </div>

        <!-- Section top videos feature -->
        <div class="video-feature">
            <div class="heading">
                <h3>
                    TOP VIDEOS
                </h3>
            </div>
            <div class="feature-contents">
                <div class="feature-inner">
                    <div class="features-slider">
                        <div class="slideset">
                        @foreach($videos as $video)
                            @includeIf('visitor.components.video.grid_box_1', ['video' => $video])
                        @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Section videos feature -->



        <!-- Bottom post grid -->
        <div class="section">
            <div class="section-heading">
                <h3 class="bg_black font-en-opensans-cond extra-pad">
                    YOU SHOULD WATCH
                </h3>
            </div>

            <div class="section-bg__white uk-panel-body suggest-video">
                <div class="bottom-post uk-grid uk-grid-collapse uk-gird-width-1-2 uk-grid-width-small-1-2 uk-grid-width-medium-1-4 uk-grid-large-1-4 uk-grid-width-xlarge-1-4 uk-grid-match uk-margin-bottom uk-margin-top" uk-grid-match>
                @foreach($suggestVideos as $post)
                    @includeIf('visitor.components.video.grid_box_1', ['video' => $post])
                @endforeach
                </div>
            </div>
        </div>
        <!-- /Bottom post grid -->

    </div>
</div>
<!-- /Page content wrapper -->
@endsection

@push('script_dependencies')
    <script src="{{ asset('lib/slick/slick.min.js') }}"></script>
    <script src="{{ asset('lib/jssocial/jssocials.min.js') }}"></script>
@endpush

@section('script')
    <script>
        // Slick Slideset Configuration
        $('.features-slider .slideset').slick({
            infinite: false,
            slidesToShow: 4,
            slidesToScroll: 1,
            speed: 300,
            arrows: true,
            cssEase: 'linear',
            prevArrow: '<button class="slide-control prev"></button>',
            nextArrow: '<button class="slide-control next"></button>',
            responsive: [
            {
              breakpoint: 1024,
              settings: {
                slidesToShow: 4,
                slidesToScroll: 4
              }
            },
            {
              breakpoint: 960,
              settings: {
                slidesToShow: 3,
                slidesToScroll: 3
              }
            },
            {
              breakpoint: 768,
              settings: {
                slidesToShow: 2,
                slidesToScroll: 2
              }
            },
            {
              breakpoint: 480,
              settings: {
                slidesToShow: 1,
                slidesToScroll: 1
              }
            }
          ]
        });

        $(".social-share").jsSocials({
            shares: ["facebook", "twitter", "googleplus", "linkedin"]
        });
    </script>
@endsection

@extends('visitor.layouts.main')

@section('page_title', '180 inspire | Listen to trend album')

@push('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('lib/jssocial/jssocials.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('lib/jssocial/jssocials-theme-flat.css') }}">
@endpush

@section('slideshow')
    <!-- Slideshow -->
    <div class="slideshow_container">
        <div class="uk-panel">
            <div class="slideshow_section" data-uk-slideshow="{animation: 'swipe'}">
                <div class="uk-slidenav-position">
                    <ul class="uk-slideshow uk-overlay-active">
                        <li>
                            <img src="@if($audioAlbum->featured_image){{ asset(str_replace('thumbs','uploads', $audioAlbum->featured_image)) }}@else{{ asset('images/no_thumbnail_img.jpg') }}@endif" alt="{{ $audioAlbum->title }}" alt="">
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- /Slideshow -->

    <!-- Top audio player -->
    <div class="top-aduio__wrapper uk-clearfix">

        <div class="player-preview">
            <div class="thumbnail">
                <div class="inner" style="background-image: url(@if($audioAlbum->posts[0]->featured_image){{ $audioAlbum->posts[0]->featured_image }}@else{{ asset('images/no_thumbnail_img.jpg') }}@endif)">

                </div>
            </div>
            <div class="title">
                <h3 class="title">
                @if($audioAlbum->posts)
                    {{ $audioAlbum->posts[0]->title }}
                @endif
                </h3>
                <span class="artist">
                @if($audioAlbum->posts)
                    {{ $audioAlbum->posts[0]->genre }}
                @endif
                </span>
            </div>
        </div>

        <div class="top-ele">
            <i class="fa fa-music"></i>
        </div>

        <div class="player-wrapper">
            <div class="audio-control__outter">
                <div class="audio-control">
                    <button class="previous-btn" id="music-box__player-btnPrev">
                        <i class="fa fa-step-backward"></i>
                    </button>
                </div>
                <div class="audio-control">
                    <button class="play-pause-btn">
                        <i class="fa fa-play"></i>
                    </button>
                </div>
                <div class="audio-control">
                    <button class="next-btn" id="music-box__player-btnNext">
                        <i class="fa fa-step-forward"></i>
                    </button>
                </div>
            </div>

            <div class="audio-timeline__outter">
                <div class="audio1">
                    <audio controls width="100%" id="audioEle" class="custom-audio-player fc-audio">

                    </audio>
                </div>
            </div>
        </div>
    </div>
    <!-- /Top audio player -->

        <!-- Audio Playlist -->
    <div class="top-audio__playlist">
        <div class="uk-container uk-container-center">
            <ul id="music-box__playlist">

            </ul>
        </div>
    </div>
    <!-- Audio Playlist -->

@endsection

@section('content')
    <!-- Page content wrapper -->
    <div class="page-bg__wrapper">
        <div class="uk-container uk-container-center">
            <div class="video-detail__bottom uk-margin-top">
                <div class="uk-grid uk-grid-collapse">

                    <!-- Video left description -->
                    <div class="detail-left post-detail__entry">

                        <div class="fb-connect uk-float-left">
                            <h3 class="heading">
                                ភ្ជាប់ទំនាក់ទំនងជាមួយ
                                <span class="company_name">
                                    180 Inspire
                                </span>
                            </h3>
                            <span class="facebook-like-share">

                            </span>
                        </div>

                        <div class="facebook-comment uk-float-left">
                            <h3 class="heading">
                                <i class="fa fa-comments"></i>
                                <i class="fa fa-facebook-square"></i>
                                មតិយោបល់
                            </h3>
                            <div class="fb-comments" data-href="{{ route('visitor.audio.album', $audioAlbum->id) }}" data-width="100%" data-numposts="5"></div>
                        </div>
                    </div>
                    <!-- /Video left description -->

                    <!-- Video sidebar -->
                    <div class="video-detail__sidebar">
                        <div class="inner uk-margin-bottom uk-margin-top uk-clearfix">

                            <div class="top-share uk-margin-bottom">
                                <div class="social-share">

                                </div>
                            </div>
                            <div class="related-video__outer uk-clearfix uk-float-left">
                                <div class="section-heading uk-float-left">
                                    <h3 class="font-black bottom-line no-pad font-en-opensans-cond">
                                        NEXT ALBUM
                                    </h3>
                                </div>

                                @if(!empty($nextAlbum))
                                <div class="uk-margin-top padding-small uk-float-left section-bg__white related-video">
                                    <div class="next-album uk-panel audio-featured__album zoomOut">
                                        <div class="audio-featured__box padding-bottom-small">
                                            <div class="box-inner">
                                                <div class="thumbnail">
                                                    <img src="@if($nextAlbum->featured_image){{ asset(str_replace('thumbs','uploads', $nextAlbum->featured_image))}}@else{{ asset('images/no_thumbnail_img.jpg') }}@endif">

                                                    <div class="overlay-hover">
                                                        <a href="{{ route('visitor.audio.album', $nextAlbum->id) }}" class="custom-link">
                                                            Listen <i class="fa fa-arrow-right"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="caption">
                                                    <div class="meta">
                                                        <div class="genre">{{ $nextAlbum->genre }}</div>
                                                        <div class="date">
                                                            <i class="fa fa-calendar"></i>
                                                            {{ $nextAlbum->created_at->format('d M\\, Y') }}
                                                        </div>
                                                    </div>
                                                    <div class="title">
                                                        {{ $nextAlbum->title }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>

                        </div>
                    </div>
                    <!-- /Video sidebar -->

                </div>
            </div>
        </div>

        <div class="related-audio__album section-bg__white">
            <div class="uk-container uk-container-center">
                <div class="section-heading bg-transparent extra-size">
                    <h1 class="uk-text-center">
                        <span class="bold bottom-line font-en-opensans-cond">OTHER ALBUMS</span>
                    </h1>
                </div>

                <div class="section">
                    <div class="audio-featured__album zoomOut">
                        <div class="uk-grid uk-grid-medium uk-grid-small-medium uk-grid-width-small-1-1 uk-grid-width-medium-1-3 uk-grid-width-large-1-3 uk-grid-width-xlarge-1-3">
                        @if(!empty($relatedAlbums))
                            @foreach($relatedAlbums as $album)
                                @includeIf('visitor.components.listen.featured_box', ['album' => $album])
                            @endforeach
                        @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Page content wrapper -->
@endsection

@push('script_dependencies')
    <script src="{{ asset('lib/mediaelement/build/mediaelement-and-player.min.js') }}"></script>
    <script>
        var tracks = [
            @if($audioAlbum->posts)
                @foreach($audioAlbum->posts as $key => $audio)
                {
                    "track": '{{ ++$key }}',
                    "name": "{{ $audio->title }}",
                    "length": "{{ $audio->duration }}",
                    "file": "{{ $audio->sound_url }}"
                },
                @endforeach
            @endif
        ];
    </script>
    <script src="{{ asset('js/sound-player.js') }}"></script>
    <script src="{{ asset('lib/jssocial/jssocials.min.js') }}"></script>
@endpush

@section('script')
    <script>
        $(document).ready(function(){
            var $media = $('#audioEle');
            if ($media.length) {
                var player = new MediaElementPlayer('audioEle', {
                    audioHeight              : 40,
                    stretching               : 'responsive',
                    setDimensions            : false,
                    features                 : ['current', 'duration', 'progress', 'volume', 'tracks' ],
                    alwaysShowControls       : true,
                    timeAndDurationSeparator : '<span></span>',
                    iPadUseNativeControls: true,
                    iPhoneUseNativeControls: true,
                    AndroidUseNativeControls: true
                });

                // Bind with custom play-pause button
                $('.play-pause-btn').on('click', function(){
                    if(!player.paused){
                        player.pause();
                        $(this).find('i').removeClass('fa-pause').addClass('fa-play');
                    }else{
                        player.play();
                        $(this).find('i').removeClass('fa-play').addClass('fa-pause');
                    }
                });
            }

            // social share configuration
            $(".social-share").jsSocials({
                shares: ["facebook", "twitter", "googleplus", "linkedin"]
            });
        });
    </script>
@endsection

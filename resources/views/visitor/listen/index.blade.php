@extends('visitor.layouts.main')

@section('page_title', '180 inspire | Listen trend songs')

@section('slideshow')
    @if(!empty($latestAlbum))
        @includeIf('visitor.components.listen.slideshow', ['slideshow' => $latestAlbum])
        <!-- Top audio player -->
        <div class="top-aduio__wrapper uk-clearfix">

            <div class="player-preview">
                <div class="thumbnail">
                    <div class="inner" style="background-image: url(@if($latestAlbum->posts[0]->featured_image){{ $latestAlbum->posts[0]->featured_image }}@else{{ asset('images/no_thumbnail_img.jpg') }}@endif)">

                    </div>
                </div>
                <div class="title">
                    <h3 class="title">
                        {{ $latestAlbum->posts[0]->title }}
                    </h3>
                    <span class="artist">
                        {{ $latestAlbum->posts[0]->artist }}
                    </span>
                </div>
            </div>

            <div class="top-ele">
                <i class="fa fa-music"></i>
            </div>

            <div class="player-wrapper">
                <div class="audio-control__outter">
                    <div class="audio-control">
                        <button class="previous-btn">
                            <i class="fa fa-step-backward"></i>
                        </button>
                    </div>
                    <div class="audio-control">
                        <button class="play-pause-btn">
                            <i class="fa fa-play"></i>
                        </button>
                    </div>
                    <div class="audio-control">
                        <button class="next-btn">
                            <i class="fa fa-step-forward"></i>
                        </button>
                    </div>
                </div>

                <div class="audio-timeline__outter">
                    <div class="audio1">
                        <audio controls width="100%" id="custom-audio-player" class="custom-audio-player fc-audio">
                            <source src="{{ $latestAlbum->posts[0]->sound_url }}" type="audio/mp3"/>
                        </audio>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Top audio player -->
    @endif
@endsection

@section('content')
    <!-- Page content wrapper -->
    <div class="audio-page page-wrapper__bg bg-white section">
        <div class="uk-container uk-container-center">
            <div class="post-detail__wrapper uk-margin-top">

                <div class="left-column">
                    <!-- Post detail entry -->
                    <div class="post-detail__entry uk-clearfix">
                        <div class="uk-float-left post-detail__entry">
                            <div class="inner no-pad">
                                <div class="section-heading uk-margin-bottom">
                                    <h3 class="no-pad bg-transparent grey-color bottom-line font-en-opensans-cond">
                                        LATEST <span class="bold">ALBUMS</span>
                                    </h3>
                                </div>
                                @if(!empty($latestAlbum))
                                <div class="latest-album">
                                    <div class="player-thumbnail">
                                        <div class="bg-thumbnail">
                                            <img src="@if($latestAlbum->featured_image){{ asset(str_replace('thumbs','uploads',$latestAlbum->featured_image)) }}@else{{ asset('images/no_thumbnail_img.jpg') }}@endif" width="100%">
                                        </div>
                                    </div>

                                    <div class="player-caption">
                                        <div class="player-wrapper">
                                            <div class="audio-control__outter">
                                                <div class="audio-control">
                                                    <button id="music-box__player-btnPrev" class="audio-previous-btn">
                                                        <i class="fa fa-step-backward"></i>
                                                    </button>
                                                </div>
                                                <div class="audio-control">
                                                    <button class="audio-play-pause-btn">
                                                        <i class="fa fa-play"></i>
                                                    </button>
                                                </div>
                                                <div class="audio-control">
                                                    <button id="music-box__player-btnNext" class="audio-next-btn">
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

                                    <div class="song-playlist">

                                        <ul id="music-box__playlist">

                                        </ul>

                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- /Post deatil entry -->

                </div>

                <!-- Sidebar -->
                <div class="sidebar">
                    <!-- /Popular post -->
                    <div class="sidebar-popular__post">
                        <div class="section-heading uk-margin-small-bottom">
                            <h3 class="no-pad bg-transparent grey-color bottom-line font-en-opensans-cond">
                                TOP <span class="bold">ALBUMS</span>
                            </h3>
                        </div>
                        <div class="no-pad inner">
                            <ul class="list_view">
                            @if(!empty($relatedAlbums))
                                @foreach($relatedAlbums as $audio)
                                    @includeIf('visitor.components.listen.sidebar_list', ['audio' => $audio])
                                @endforeach
                            @endif
                            </ul>
                        </div>
                    </div>
                    <!-- /Popular post -->
                </div>
                <!-- /Sidebar -->
            </div>

            <div class="section"></div>

            <!-- Category box -->
            <div class="section">
                <div class="section-heading uk-margin-bottom padding-bottom-md">
                    <h3 class="no-pad bg-transparent grey-color font-en-opensans-cond">
                        LATEST <span class="bold bottom-line">ALBUMS BY CATEGORIES</span>
                    </h3>
                </div>
                @if(!empty($categories))
                <div class="uk-clearfix pad-top" style="display: flex;">
                    <div class="uk-width-1-1 uk-width-small-1-1 uk-width-medium-1-2 uk-width-large-1-2 uk-width-xlarge-1-2 uk-clearfix post-grid">
                        <div class="">
                            @if(count($categories->categories) > 0)
                            <figure class="uk-overlay uk-overlay-hover">
                                <div class="post-grid__categoy">
                                    <h3 class="font-kh-nokora bg-yellow extra-large">
                                    {{ $categories->categories[0]->name }}
                                    </h3>
                                </div>
                                <img class="uk-overlay-scale" src="@if($categories->categories[0]->latestAudioAlbum->featured_image){{ asset(str_replace('thumbs','uploads', $categories->categories[0]->latestAudioAlbum->featured_image)) }}@else{{ asset('images/no_thumbnail_img.jpg') }}@endif" alt="">

                                <a href="{{ route('visitor.audio.album', $categories->categories[0]->latestAudioAlbum->id) }}" class="uk-position-cover"></a>
                            </figure>
                            @endif
                        </div>
                    </div>

                    <div class="uk-width-1-1 uk-width-small-1-1 uk-width-medium-1-2 uk-width-large-1-2 uk-width-xlarge-1-2 no-pad-top post-grid uk-grid uk-grid-collapse uk-grid-width-1-2">
                    @foreach($categories->categories as $key => $category)
                        @if($key==0 || $key > 4)
                        @else
                            @includeIf('visitor.components.listen.category_box', ['category' => $category])
                        @endif
                    @endforeach
                    </div>
                </div>
                @endif
            </div>
            <!-- /Category box -->

        </div>
    </div>
    <!-- /Page content wrapper -->
@endsection

@push('script_dependencies')
    <script src="{{ asset('lib/mediaelement/build/mediaelement-and-player.min.js') }}"></script>
    <script>
        var tracks = [
            @if(!empty($latestAlbum->posts))
                @foreach($latestAlbum->posts as $key => $audio)
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
@endpush

@section('script')
    <script>
        $(document).ready(function(){
            var $media = $('#custom-audio-player');
            if ($media.length) {
                var player = new MediaElementPlayer('custom-audio-player', {
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

            var $secondMedia = $('#audioEle');
            if ($secondMedia.length) {
                var audioPlayer = new MediaElementPlayer('audioEle', {
                    audioHeight              : 50,
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
                $('.audio-play-pause-btn').on('click', function(){
                    if(!audioPlayer.paused){
                        audioPlayer.pause();
                        $(this).find('i').removeClass('fa-pause').addClass('fa-play');
                    }else{
                        audioPlayer.play();
                        $(this).find('i').removeClass('fa-play').addClass('fa-pause');
                    }
                });

            }
        });
    </script>
@endsection

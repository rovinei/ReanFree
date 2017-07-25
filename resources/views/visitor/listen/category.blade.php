@extends('visitor.layouts.main')

@section('page_title', '180 inspire | Listen trend songs')

@section('slideshow')
    @if($latestAlbum !== null)
        @includeIF('visitor.components.listen.slideshow', ['slideshow' => $latestAlbum])

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
            <div class="section-heading bg-transparent extra-size">
                <h1 class="uk-text-center">
                    Featured <span class="bold bottom-line">Albums</span>
                </h1>
            </div>

            <div class="section">
                <div class="audio-featured__album zoomOut">
                    <div class="uk-grid uk-grid-medium uk-grid-small-medium uk-grid-width-small-1-1 uk-grid-width-medium-1-3 uk-grid-width-large-1-3 uk-grid-width-xlarge-1-3">
                    @foreach($featuredAlbums as $album)
                        @includeIf('visitor.components.listen.featured_box', ['album' => $album])
                    @endforeach
                    </div>
                </div>
            </div>

            <div class="section">
                <div class="section-heading bg-transparent uk-margin-large-bottom">
                    <h3 class="bottom-line font-black no-pad-left no-pad-right extra-large">
                        {{  $category->name }}
                    </h3>
                </div>

                <div class="uk-grid uk-grid-medium uk-grid-width-small-1-1 uk-grid-width-medium-1-3 uk-grid-width-large-1-4 uk-grid-width-small-xlarge-1-4">
                @foreach($albums as $album)
                    @includeIf('visitor.components.listen.featured_box', ['album' => $album])
                @endforeach
                </div>

                <!-- Pagination -->
                {{ $albums->links('visitor.components.pagination') }}
                <!-- /Pagination -->

            </div>
        </div>
    </div>
    <!-- /Page content wrapper -->
@endsection

@push('script_dependencies')
    <script src="{{ asset('lib/mediaelement/build/mediaelement-and-player.min.js') }}"></script>
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
        });
    </script>
@endsection

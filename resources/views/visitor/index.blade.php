@extends('visitor.layouts.main')

@section('page_title', 'welcome to 180 inspire website')

@push('styles')
<style type="text/css">

</style>
@endpush

@section('slideshow')
    @includeIf('visitor.partials._homepage_slideshow')
@endsection

@section('content')
<div class="page-wrapper__bg">
    <!-- Latest article -->
    <div class="section">
        <div class="latest-article">
            <div class="uk-container uk-container-center">
                <div class="uk-grid uk-grid-collapse">

                    <div class="uk-width-small-1-1 uk-width-medium-2-3 uk-width-large-2-3 uk-width-xlarge-2-3">
                        <div class="section-heading bottom-line">
                            <h3 class="bg_grey font-kh-siemreap">
                                <i class="fa fa-newspaper-o"></i>
                                @lang('visitor.latest_post')
                            </h3>
                        </div>

                        <div class="section-bg__white uk-grid uk-grid-collapse uk-grid-width-1-1 uk-grid-width-small-1-2 uk-grid-width-medium-1-3 uk-grid-width-large-1-3 uk-grid-width-xlarge-1-3">

                            @foreach($articles as $article)
                                @includeIf('visitor.components.article.grid_box_1', ['article' => $article])
                            @endforeach

                        </div>
                    </div>

                    <div class="uk-width-small-1-1 uk-width-medium-1-3 uk-width-large-1-3 uk-width-xlarge-1-3">
                        <div class="section-advert__right padding-left__sm">
                            <div class="advert-box">
                                <div class="inner">
                                    <a href="#" class="custom-advert__link">
                                        <img src="{{ asset('images/ads/media_ads_video.png') }}"alt="">
                                    </a>
                                </div>
                            </div>
                            <div class="advert-box">
                                <div class="inner">
                                    <a href="#" class="custom-advert__link">
                                        <img src="{{ asset('images/ads/media_ads_bigk_film.png') }}" alt="">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- /Latest article -->

    <!-- Latest video grid -->
    <div class="section">
        <div class="latest-video">
            <div class="uk-container uk-container-center">

                <div class="section-heading bottom-line">
                    <h3 class="bg_grey font-kh-siemreap">
                        <i class="fa fa-play"></i>
                        @lang('visitor.latest_video')
                    </h3>
                </div>

                <div class="section-bg__white uk-grid uk-grid-collapse uk-grid-width-1-1 uk-grid-width-small-1-2 uk-grid-width-medium-1-3 uk-grid-width-large-1-4 uk-grid-width-xlarge-1-4">
                    @foreach($videos as $video)
                        @includeIf('visitor.components.video.video_grid_index', ['video' => $video])
                    @endforeach
                </div>

            </div>
        </div>
    </div>
    <!-- /Latest video grid -->

    <!-- Latest music -->
    <div class="section">
        <div class="latest-song">
            <div class="uk-container uk-container-center">
                <div class="section-heading bottom-line">
                    <h3 class="bg_grey font-kh-siemreap">
                        <i class="fa fa-music"></i>
                        @lang('visitor.latest_song')
                    </h3>
                </div>

                <div class="section-bg__dark">
                    <div class="uk-panel uk-panel-body">
                        <div class="uk-grid uk-grid-collapse uk-grid-width-1-1 uk-grid-width-small-1-1 uk-grid-width-medium-1-2 uk-grid-width-large-1-2 uk-grid-width-xlarge-1-2">

                            <div class="music-box__thumbnail" style="background-image: url('{{ asset('images/musics/song_player_album_featured_image.png') }}')">
                                <div class="inner">

                                </div>
                            </div>

                            <div class="music-box__player">
                                <div class="column">
                                    <div class="music-box__player-wrap">
                                        <div class="music-box__player-nowPlay">
                                            <span class="left music-box__player-action">Paused...</span>
                                            <span class="right music-box__player-title"></span>
                                        </div>
                                        <div class="music-box__player-audiowrap">
                                            <div id="audio0">
                                                <audio preload id="audioEle" controls="controls">Your browser does not support HTML5 Audio!</audio>
                                            </div>
                                            <div class="music-box__player-tracks">
                                                <a class="audio-control-next-pre" id="music-box__player-btnPrev">&laquo;</a>
                                                <a class="audio-control-next-pre" id="music-box__player-btnNext">&raquo;</a>
                                            </div>
                                        </div>
                                        <div class="music-box__playlist-wrap">
                                            <ul id="music-box__playlist"></ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Latest music -->
</div>
@endsection

@push('script_dependencies')
    <script>
        var tracks = [
            @if(!empty($audios))
                @foreach($audios as $key => $audio)
                {
                    "track": '{{ ++$key }}',
                    "name": "{{ $audio->title }}",
                    "length": "3:26",
                    "file": "{{ $audio->sound_url }}"
                },
                @endforeach
            @endif
        ];
    </script>
    <script src="{{ asset('js/sound-player.js') }}"></script>
@endpush

@section('scripts')

@endsection

@extends('visitor.layouts.main')

@section('page_title', 'welcome to 180 inspire website')

@section('slideshow')
    @if(!empty($sliders) && count($sliders) > 0)
    <!-- Slideshow -->
    <div class="slideshow_container">
        <div class="uk-panel">
            <div class="slideshow_section" data-uk-slideshow="{animation: 'swipe'}">
                <div class="uk-slidenav-position">
                    <ul class="uk-slideshow uk-overlay-active">
                    @foreach($sliders as $slider)
                        @includeIf('visitor.partials._homepage_slideshow', ['slider' => $slider])
                    @endforeach
                    </ul>

                    <a href="#" class="uk-slidenav uk-slidenav-previous uk-hidden-touch" data-uk-slideshow-item="previous"></a>
                    <a href="#" class="uk-slidenav uk-slidenav-next uk-hidden-touch" data-uk-slideshow-item="next"></a>
                </div>
            </div>
        </div>
    </div>
    <!-- /Slideshow -->
    @endif
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
                            <h3 class="bg_grey font-kh-nokora">
                                <i class="fa fa-newspaper-o"></i>
                                @lang('visitor.latest_post')
                            </h3>
                        </div>

                        <div class="section-bg__white">
                            <div class="padding-small uk-grid uk-grid-collapse uk-grid-width-1-1 uk-grid-width-small-1-2 uk-grid-width-medium-1-3 uk-grid-width-large-1-3 uk-grid-width-xlarge-1-3">
                                @foreach($articles as $article)
                                    @includeIf('visitor.components.article.grid_box_1', ['article' => $article])
                                @endforeach
                            </div>

                            <div class="sponsor-slideset__footer">
                                <div class="inner">
                                    <a href="{{ route('visitor.article.page') }}">READ MORE</a>
                                </div>
                            </div>

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
                    <h3 class="bg_grey font-kh-nokora">
                        <i class="fa fa-play"></i>
                        @lang('visitor.latest_video')
                    </h3>
                </div>

                <div class="section-bg__white">
                    <div class=" uk-grid uk-grid-collapse uk-grid-width-1-1 uk-grid-width-small-1-2 uk-grid-width-medium-1-3 uk-grid-width-large-1-4 uk-grid-width-xlarge-1-4 padding-small">
                        @foreach($videos as $video)
                            @includeIf('visitor.components.video.video_grid_index', ['video' => $video])
                        @endforeach
                    </div>

                    <div class="sponsor-slideset__footer">
                        <div class="inner">
                            <a href="{{ route('visitor.video.page') }}">WATCH MORE</a>
                        </div>
                    </div>
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
                    <h3 class="bg_grey font-kh-nokora">
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

                <div class="section-bg__white">
                    <div class="sponsor-slideset__footer">
                        <div class="inner">
                            <a href="{{ route('visitor.audio.page') }}">LISTEN MORE</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- /Latest music -->

    @if(count($partners) > 0)
    <!-- Sponsor slideset -->
    <div class="section">
        <div class="sponsor-slideset">
            <div class="uk-container uk-container-center">
                <div class="section-heading-large">
                    <h3>
                        @lang('visitor.partner')
                    </h3>
                </div>

                <div class="section-bg__white">
                    <div class="uk-panel sponsor-slideset__wrapper">
                        <div>
                            <div data-uk-slideset="{small: 2, medium: 4, large: 6, animation: 'slide-horizontal', autoplay: true}">
                                <div class="uk-slidenav-position">
                                    <ul class="sponsor-slideset__list uk-grid uk-grid-collapse uk-slideset">
                                    @foreach($partners as $partner)
                                        @if($partner->logo_src)
                                        <li>
                                            <a href="{{ $partner->external_url }}" class="uk-display-block">
                                                <img src="{{ asset(str_replace('thumbs', 'uploads', $partner->logo_src)) }}" alt="{{ $partner->company_name }}">
                                            </a>
                                        </li>
                                        @endif
                                    @endforeach
                                    </ul>
                                    <a href="" class="uk-slidenav uk-slidenav-previous" data-uk-slideset-item="previous"></a>
                                    <a href="" class="uk-slidenav uk-slidenav-next" data-uk-slideset-item="next"></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="sponsor-slideset__footer">
                        <div class="inner">
                            <a href="#">SEE ALL</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Sponsor slideset -->
    @endif
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
                    "length": "{{ $audio->duration }}",
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

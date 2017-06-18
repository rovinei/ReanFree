@extends('visitor.layouts.main')

@section('page_title', 'watch')

@push('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('lib/jssocial/jssocials.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('lib/jssocial/jssocials-theme-flat.css') }}">
@endpush

@section('content')

<!-- Top video slideshow -->
<div class="video-detail bg-dark-grey">
    <div class="video-preview-fluid uk-clearfix">
        @if($video->video_url)
        <iframe width="100%" height="" src="https://www.youtube.com/embed/{{ $video->video_url }}" frameborder="0" allowfullscreen></iframe>
        @endif
    </div>
</div>
<!-- /Top video slideshow -->

<!-- Page background wrapper -->
<div class="page-bg__wrapper">
    <div class="uk-container uk-container-center">
        <div class="video-detail__bottom">
            <div class="uk-grid uk-grid-collapse">

                <!-- Video left description -->
                <div class="detail-left post-detail__entry">
                    <div class="top-share uk-margin-bottom uk-margin-top">
                        <div class="social-share">

                        </div>
                    </div>

                    <div class="section-bg__white video-detail__title uk-margin-bottom">
                        <div class="inner padding-small">
                            <h1 class="title">
                                {{ $video->title }}
                            </h1>
                        </div>
                    </div>

                    <div class="section-bg__white video-detail__desc uk-margin-bottom">
                        <div class="inner padding-small uk-clearfix">

                            <div class="post-detail__title uk-float-left">
                                <h1 class="title">
                                    DESCRIPTION
                                </h1>
                            </div>

                            <article class="post-detail__article uk-float-left">
                                {!! $video->content !!}
                            </article>

                        </div>
                    </div>

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
                        <h3 class="heading uk-margin-small-bottom">
                            <i class="fa fa-comments"></i>
                            <i class="fa fa-facebook-square"></i>
                            មតិយោបល់
                        </h3>
                        <div class="fb-comments" data-href="{{ route('visitor.video.detail', $video->id) }}" data-width="770" data-numposts="5"></div>
                    </div>
                </div>
                <!-- /Video left description -->

                <!-- Video sidebar -->
                <div class="video-detail__sidebar">
                    <div class="inner uk-margin-bottom uk-margin-top uk-clearfix">

                        <a href="{{ route('visitor.video.detail', $nextVideo->id) }}" class="section-bg__white next-video padding-small uk-float-left">
                            <div class="uk-flex uk-flex-inline">
                                <div class="thumbnail-outer">
                                    <img src="@if($nextVideo->featured_image){{ asset($nextVideo->featured_image) }}@else{{ asset('images/no_thumbnail_img.jpg') }}@endif" class="thumbnail-img" alt="{{ $nextVideo->title }}" />
                                </div>
                                <div class="text uk-flex-item-1">
                                    <li>
                                        <span class="next-text">Next</span>
                                        <span class="next-title">{{ str_limit($nextVideo->title, 100) }}</span>
                                    </li>
                                    <li>
                                        <span class="meta">
                                            {{ $nextVideo->category->name }}
                                        </span>
                                    </li>
                                </div>
                            </div>
                        </a>

                        <div class="related-video__outer uk-clearfix uk-float-left">
                            <div class="heading uk-float-left">
                                <h3 class="title">
                                    EPISODES
                                    <span class="total-episode">
                                    @if($serie->num_of_episode !==null & $serie->num_of_episode !== "")
                                        {{ $serie->num_of_episode }}
                                    @else
                                        unknown
                                    @endif
                                    </span>
                                </h3>
                            </div>
                            <div class="padding-xs uk-float-left section-bg__white related-video">
                                <div class="uk-grid uk-grid-collapse uk-grid-width-1-2">
                                @foreach($serie->posts as $video)
                                    @includeIf('visitor.components.video.sidebar_list', ['video' => $video])
                                @endforeach

                                @foreach($relatedVideos as $video)
                                    @includeIf('visitor.components.video.sidebar_list', ['video' => $video])
                                @endforeach
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- /Video sidebar -->

            </div>
        </div>
    </div>
</div>
<!-- /Page background wrapper -->
@endsection

@push('script_dependencies')
    <script src="{{ asset('lib/jssocial/jssocials.min.js') }}"></script>
@endpush

@section('script')
<script type="text/javascript">
    $(document).ready(function(){
        // social share configuration
        $(".social-share").jsSocials({
            shares: ["facebook", "twitter", "googleplus", "linkedin"]
        });
    });
</script>
@endsection

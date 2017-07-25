@extends('visitor.layouts.main')

@section('page_title', '180 INSPIRES | Video by category')

@push('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('lib/jssocial/jssocials.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('lib/jssocial/jssocials-theme-flat.css') }}">
@endpush

@section('slideshow')
    @includeIf('visitor.components.video.top_feature', ['video' => $videos[0]])
@endsection

@section('content')

<!-- Page content wrapper -->
<div class="page-wrapper__bg">
    <div class="uk-container uk-container-center">
        <div class="breadcrum uk-margin-top">
            <h3 class="font-kh-nokora uk-margin-remove plain">
                <a href="{{ route('visitor.index.page') }}">@lang('visitor.homepage')</a>
                <i class="fa fa-angle-double-right"></i>
                <a href="{{ route('visitor.video.page') }}">@lang('visitor.video')</a>
                <i class="fa fa-angle-double-right"></i>
                <a class="preventDefaultElement custom-a__link_disabled" href="#">
                    {{ $category_name }}
                </a>
            </h3>
        </div>

        <!-- post by category -->
        <div class="section">
            <div class="top-post__catgory">

                <div class="section-heading bottom-line">
                    <h3 class="bg_black font-kh-nokora extra-pad">
                        {{ $category_name }}
                    </h3>
                </div>

                <div class="section-bg__white uk-grid uk-grid-collapse uk-grid-width-1-1 uk-grid-width-small-1-2 uk-grid-width-medium-1-3 uk-grid-width-large-1-4 uk-grid-width-xlarge-1-4 padding-small">
                @foreach($videos as $video)
                    @includeIf('visitor.components.video.video_grid_index', ['video' => $video])
                @endforeach
                </div>

                <!-- Pagination -->
                {{ $videos->links('visitor.components.pagination') }}
                <!-- /Pagination -->

            </div>
        </div>
        <!-- /post by category -->

        <!-- Bottom post grid -->
        <div class="section">
            <div class="section-heading">
                <h3 class="bg_black font-en-opensans-cond extra-pad">
                    YOU SHOULD WATCH
                </h3>
            </div>
            <div class="section-bg__white uk-panel-body suggest-video">
                <div class="bottom-post uk-grid uk-grid-collapse uk-gird-width-1-2 uk-grid-width-small-1-2 uk-grid-width-medium-1-4 uk-grid-large-1-4 uk-grid-width-xlarge-1-4 uk-margin-bottom uk-margin-top">
                @foreach($suggestVideos as $video)
                    @includeIf('visitor.components.video.grid_box_1', ['video' => $video])
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
    <script src="{{ asset('lib/jssocial/jssocials.min.js') }}"></script>
@endpush

@section('script')
    <script>
        $(".social-share").jsSocials({
            shares: ["facebook", "twitter", "googleplus", "linkedin"]
        });
    </script>
@endsection

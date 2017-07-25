@extends('visitor.layouts.main')

@section('page_title', '180 INSPIRES | Reading Recent Article Page')

@push('styles')
<style type="text/css">

</style>
@endpush

@section('slideshow')
    @includeIf('visitor.components.article.slideshow', ['slideshow' => $articles[0]])
@endsection

@section('content')
<div class="page-wrapper__bg">
    <div class="uk-container uk-container-center">
        <div class="breadcrum uk-margin-top">
            <h3 class="font-kh-nokora uk-margin-remove plain">
                <a href="{{ route('visitor.index.page') }}">@lang('visitor.homepage')</a>
                <i class="fa fa-angle-double-right"></i>
                <a class="preventDefaultElement" href="#">@lang('visitor.article')</a>
            </h3>
        </div>

        <!-- Top story post list & grid -->
        <div class="section">
            <div class="section-bg__white uk-clearfix">

                <div class="uk-width-1-1 uk-width-small-1-1 uk-width-medium-1-2 uk-width-large-1-2 uk-width-xlarge-1-2 uk-panel-body post-list uk-clearfix">
                    <div class="top-post__heading">
                        <h3 class="font-en-opensans-cond uk-margin-remove">
                            TOP STORIES
                        </h3>
                    </div>
                    <ul class="top-post__list">
                    @foreach($articles as $article)
                        <li class="top-post__item">
                            <a href="{{ route('visitor.article.detail', $article->id) }}" class="custom-a__link overflow-ellipsis">
                                {{ str_limit($article->title, 70) }}
                            </a>
                        </li>
                    @endforeach
                    </ul>

                    <div class="uk-text-center">
                        <a id="loadmore" href="#" class="preventDefaultElement readmore uk-display-inline-block">
                            READ MORE
                        </a>
                    </div>
                </div>

                <div class="uk-width-1-1 uk-width-small-1-1 uk-width-medium-1-2 uk-width-large-1-2 uk-width-xlarge-1-2 no-pad-top uk-panel-body post-grid uk-grid uk-grid-collapse uk-grid-width-1-2">
                @foreach($categories->categories as $category)
                    @includeIf('visitor.components.article.category_box', ['category' => $category])
                @endforeach
                </div>

            </div>
        </div>
        <!-- /Top story post -->

        <!-- Story serie preview large thumbnail -->
        @if($latestSerie && !empty($latestSerie))
        <div class="section">
            <div class="section-bg__white">
                <div class="uk-panel uk-background-image">
                    <a class="uk-display-block" href="{{ route('visitor.article.serie', $latestSerie->id) }}">
                        <img width="100%" class="uk-display-block" src="@if($latestSerie->featured_image){{ asset(str_replace('thumbs', 'uploads', $latestSerie->featured_image)) }}@else{{ asset('images/no_thumbnail_img.jpg') }}@endif" />
                    </a>
                </div>
            </div>
        </div>
        @endif
        <!-- /Story serie preview large thumbnail -->

        <!-- Bottom post grid -->
        <div class="section">
            <div class="section-heading uk-margin-bottom">
                <h3 class="bg_black font-en-opensans-cond extra-pad">
                    YOU SHOULD READ
                </h3>
            </div>
            <div class="bottom-post uk-grid uk-grid-medium uk-grid-small-medium uk-gird-width-1-2 uk-grid-width-small-1-2 uk-grid-width-medium-1-4 uk-grid-large-1-4 uk-grid-width-xlarge-1-4">
            @foreach($suggestArticles as $article)
                @includeIf('visitor.components.article.grid_box_3', ['article' => $article])
            @endforeach
            </div>
        </div>
        <!-- /Bottom post grid -->
    </div>
</div>
@endsection

@push('script_dependencies')

@endpush

@section('scripts')

@endsection

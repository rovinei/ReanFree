@extends('visitor.layouts.main')

@section('page_title', 'Reading article {{ $article->title }}')

@push('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('lib/jssocial/jssocials.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('lib/jssocial/jssocials-theme-flat.css') }}">
@endpush

@section('content')
<div class="page-bg__wrapper">
    <div class="uk-container uk-container-center">
        <div class="breadcrum uk-margin-top">
            <h3 class="font-kh-nokora uk-margin-remove plain">
                <a href="{{ route('visitor.index.page') }}">@lang('visitor.homepage')</a>
                <i class="fa fa-angle-double-right"></i>
                <a href="{{ route('visitor.article.page') }}">@lang('visitor.article')</a>
                <i class="fa fa-angle-double-right"></i>
                <a href="{{ route('visitor.article.category', $article->category->id) }}">{{ $article->category->name }}</a>
            </h3>
        </div>

        <!-- Top detail preview -->
        <div class="section">
            <div class="post-detail__preview section-bg__white">
                <div class="uk-grid uk-grid-collapse">
                    <div class="uk-width-1-1 uk-width-small-1-1 uk-width-medium-1-2 uk-width-large-1-3 uk-width-xlarge-1-3 post-preview__article">
                        <div class="uk-panel uk-panel-body">
                            <div class="breadcrum uk-margin-bottom">
                                <h3 class="font-kh-nokora uk-margin-remove yellow">
                                    <i class="fa fa-newspaper-o"></i>
                                    <a href="{{ route('visitor.article.category', $article->category->id) }}">{{ $article->category->name }}</a>
                                </h3>
                            </div>

                            <h1 class="post-preview__title font-kh-nokora">
                                ​{{ $article->title }}
                            </h1>

                            <div class="datetime">
                                <p>
                                    <i class="fa fa-clock-o"></i>
                                    {{ $article->created_at->diffForHumans() }}
                                </p>
                            </div>

                            <div class="post-preview__snippet">
                                <p>
                                    {!! str_limit(strip_tags($article->content), 400) !!}
                                </p>
                            </div>

                            <div class="social-share">

                            </div>
                        </div>
                    </div>

                    <div class="uk-width-1-1 uk-width-small-1-1 uk-width-medium-1-2 uk-width-large-2-3 uk-width-xlarge-2-3 post-preview__thumbnail">
                        <div class="inner uk-background-cover">
                            <div class="uk-padding-small">
                                <img src="@if($article->featured_image) {{ asset(str_replace('thumbs', 'uploads', $article->featured_image)) }} @else {{ asset('images/no_thumbnail_img.jpg') }} @endif" style="width:100%;" alt="{{ $article->title }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Top detail preview -->

        <!-- Bottom post detail -->
        <div class="post-detail__wrapper uk-margin-top">

            <div class="left-column">
                <!-- Post detail entry -->
                <div class="post-detail__entry uk-clearfix">
                    <div class="section-bg__white uk-float-left">
                        <div class="inner">
                            <div class="post-detail__title uk-float-left">
                                <h2 class="title">
                                    <span>ព័ត៏មានលំអិត</span>
                                    <i class="fa fa-angle-double-right"></i>
                                    ​{{ $article->title }}
                                </h2>
                            </div>

                            <article class="post-detail__article uk-float-left">
                                ​{!! $article->content !!}
                            </article>

                            <div class="post-detail__bottom uk-float-left">
                                <div class="author">
                                    <p>
                                        <span>អត្ថបទ៖</span>{{ $article->createdBy->username }}
                                    </p>
                                </div>

                                <div class="uk-panel uk-margin-top uk-clearfix">
                                    <div class="related-tags uk-float-left">
                                        <h3 class="title">ពាក្យទាក់ទង</h3>
                                        <p>
                                        @foreach($article->tagged as $tag)
                                            <a href="{{ route('visitor.tag_posts') }}?name={{$tag->tag_slug}}" class="tag_item">{{ $tag->tag_name }}</a>
                                        @endforeach
                                        </p>
                                    </div>

                                    <div class="uk-float-right">
                                        <h3 class="title">ចែករំលែក</h3>
                                        <div class="social-share"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Facebook comment -->
                    <div class="facebook-comment uk-float-left">
                        <div class="fb-comments" data-href="{{ route('visitor.article.detail', $article->id) }}" data-width="100%" data-numposts="5"></div>
                    </div>
                    <!-- /Facebook comment -->
                </div>
                <!-- /Post deatil entry -->

                <!-- Related post -->
                <div class="section uk-float-left">
                    <div class="related-post">
                        <div class="section-heading bottom-line plain">
                            <h3 class="font-kh-nokora color-black">
                                អត្ថបទទាក់ទង
                            </h3>
                        </div>
                        <div class="section-bg__white">
                            <div class="uk-grid uk-grid-collapse uk-grid-width-1-1 uk-grid-width-small-1-1 uk-grid-width-medium-1-2 uk-grid-width-large-1-3 uk-grid-width-xlarge-1-3 uk-panel-body">
                            @if($relatedArticles->isNotEmpty())
                                @foreach($relatedArticles as $post)
                                    @includeIf('visitor.components.article.grid_box_2', ['article' => $post])
                                @endforeach
                            @else
                                <h1 class="uk-text-lead">
                                    No realated post found
                                </h1>
                            @endif
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Related post -->
            </div>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Ads section -->
                <div class="sidebar-ads__container">
                    <div class="ads-box">
                        <div class="inner">
                            <img src="{{ asset('images/article/detail/sidebar_ads_box_1.jpg') }}" alt="">
                        </div>
                    </div>

                    <div class="ads-box">
                        <div class="inner">
                            <img src="{{ asset('images/article/detail/sidebar_ads_box_2.jpg') }}" alt="">
                        </div>
                    </div>
                </div>
                <!-- /Ads section -->

                <!-- /Popular post -->
                <div class="sidebar-popular__post">
                    <div class="section-heading bottom-line">
                        <h3 class="bg_grey font-kh-nokora">
                            <i class="fa fa-newspaper-o"></i>
                            អត្តបទថ្មីបំផុត
                        </h3>
                    </div>
                    <div class="section-bg__white inner">
                        <ul class="list_view">
                        @if($recentArticles->isNotEmpty())
                            @foreach($recentArticles as $post)
                                <li class="post-list__view post-list__item">
                                    <a href="{{ route('visitor.article.detail', $post->id) }}" class="custom-a__link uk-flex uk-flex-inline">
                                        <div class="uk-flex-first post-list__thumbnail">
                                            <img src="@if($post->featured_image){{ asset($post->featured_image) }}@else {{ asset('images/no_thumbnail_img.jpg') }}@endif" alt="{{ $post->title }}">
                                        </div>
                                        <div class="post-list__snippet uk-flex-item-1">
                                            <p>
                                                {{ str_limit($post->title, 80) }}
                                            </p>
                                        </div>
                                    </a>
                                </li>
                            @endforeach
                        @else
                        <h3 class="uk-text-large">
                            No post yet
                        </h3>
                        @endif
                        </ul>
                    </div>
                </div>
                <!-- /Popular post -->
            </div>
            <!-- /Sidebar -->
        </div>
        <!-- /Bottom post detail -->

    </div>
</div>
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

@if($article && !empty($article))
<div class="uk-margin-bottom custom-grid__item">
    <div class="section-bg__white uk-panel">
        <a href="{{ route('visitor.article.detail', $article->id) }}" class="post-grid__box">
            <div class="post-thumbnail">
                <img src="@if($article->featured_image){{ asset($article->featured_image) }}@else{{ asset('images/no_thumbnail_img.jpg') }}@endif" alt="{{ $article->title }}">
            </div>
            <div class="post-grid__caption padding-small">
                <span class="post-grid__datetime">
                    <i class="fa fa-clock-o"></i> {{ $article->created_at->diffForHumans() }}
                </span>

                <p class="uk-margin-small-bottom uk-margin-small-top post-grid__title font-kh-nokora">
                    {{ str_limit($article->title, 100) }}
                </p>

                <p class="post-grid__snippet font-kh-hanuman">
                    {!! str_limit(strip_tags($article->content), 200) !!}
                </p>

            </div>
        </a>
    </div>
</div>
@endif

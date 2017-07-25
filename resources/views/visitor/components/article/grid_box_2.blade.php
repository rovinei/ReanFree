@if(!empty($article) & $article != null)
<div class="custom-grid__item">
    <div class="uk-panel padding-small">
        <a href="{{ route('visitor.article.detail', $article->id) }}" class="post-grid__box">
            <div class="post-thumbnail">
                <img src="@if($article->featured_image){{ asset($article->featured_image) }}@else{{ asset('images/no_thumbnail_img.jpg') }}@endif" alt="{{ $article->title }}">
            </div>
            <div class="post-grid__caption">
                <p class="black post-grid__title font-kh-nokora">
                    {{ str_limit($article->title, 70) }}
                </p>
            </div>
        </a>
    </div>
</div>
@endif

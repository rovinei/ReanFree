<div class="uk-panel-body no-pad-right no-pad-bottom">
    <figure class="uk-overlay uk-overlay-hover">
        <div class="post-grid__categoy">
            <h3 class="font-kh-nokora">{{ $category->name }}</h3>
        </div>
        <img class="uk-overlay-scale" src="@if($category->latestArticle->featured_image){{ asset($category->latestArticle->featured_image) }}@else{{ asset('images/no_thumbnail_img.jpg') }}@endif" alt="{{ $category->latestArticle->title }}">
        <figcaption class="font-kh-hanuman uk-overlay-background uk-ignore uk-overlay-panel uk-flex uk-flex-bottom">
            {{ str_limit($category->latestArticle->title, 50) }}
        </figcaption>
        <a href="{{ route('visitor.article.detail', $category->latestArticle->id) }}" class="uk-position-cover"></a>
    </figure>
</div>


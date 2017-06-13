
@if(!empty($article))
<div class="custom-grid__item">
    <div class="uk-panel uk-panel-body">
        <a href="{{ route('visitor.article.detail', $article->id) }}" class="post-grid__box">
            <div class="post-thumbnail fade scale">
                <img src="@if($article->featured_image)
                {{ asset($article->featured_image) }}
                @else
                {{ url('images/no_thumbnail_img.jpg') }}
                @endif" alt="">
            </div>
            <div class="post-grid__caption">
                <span class="post-grid__datetime">
                    {{ $article->created_at->diffForHumans() }}
                </span>

                <p class="post-grid__title font-kh-freehand">
                    {{ str_limit($article->title, 70) }}
                </p>
            </div>
        </a>
    </div>
</div>
@endif

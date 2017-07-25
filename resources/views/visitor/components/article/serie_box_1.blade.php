@if($serie && !empty($serie))
<div class="uk-margin-bottom custom-grid__item">
    <div class="section-bg__white uk-panel">
        <a href="{{ route('visitor.article.serie', $serie->id) }}" class="post-grid__box">
            <div class="post-thumbnail">
                <img src="@if($serie->featured_image){{ asset($serie->featured_image) }}@else{{ asset('images/no_thumbnail_img.jpg') }}@endif" alt="{{ $serie->title }}">
            </div>
            <div class="post-grid__caption padding-small">
                <span class="post-grid__datetime">
                    <i class="fa fa-clock-o"></i> {{ $serie->created_at->diffForHumans() }}
                </span>

                <p class="uk-margin-small-bottom uk-margin-small-top post-grid__title font-kh-nokora">
                    {{ str_limit($serie->title, 100) }}
                </p>

            </div>
        </a>
    </div>
</div>
@endif

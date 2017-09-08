@if(!empty($video))
<div class="custom-grid__item">
    <div class="uk-panel padding-small">
        <a href="{{ route('visitor.video.detail', $video->slug) }}" class="post-grid__box">
            <div class="post-thumbnail">
                <img src="@if($video->featured_image){{ url($video->featured_image) }}@else{{ url('images/no_thumbnail_img.jpg') }}@endif" alt="">
            </div>
            <div class="post-grid__caption">

                <p class="post-grid__title font-nokora-opensans_cond">
                    {{ str_limit($video->title, 50) }}
                </p>
                <div class="divider"></div>

                <div class="post-grid__meta">
                    <span class="post-grid__category font-kh-hanuman">
                        {{ $video->category->name }}
                    </span>
                    <span class="post-grid__datetime">
                        {{ $video->created_at->diffForHumans() }}
                    </span>
                </div>
            </div>
        </a>
    </div>
</div>
@endif



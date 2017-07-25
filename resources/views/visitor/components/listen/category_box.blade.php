@if($category && !empty($category))
<div class="">
    <figure class="uk-overlay uk-overlay-hover">
        <div class="post-grid__categoy">
            <h3 class=" bg-yellow extra-large font-kh-nokora">
            {{ $category->name }}
            </h3>
        </div>
        <img class="uk-overlay-scale" src="@if($category->latestAudioAlbum->featured_image){{ asset($category->latestAudioAlbum->featured_image) }}@else{{ asset('images/no_thumbnail_img.jpg') }}@endif" alt="">

        <a href="{{ route('visitor.audio.album', $category->latestAudioAlbum->id) }}" class="uk-position-cover"></a>
    </figure>
</div>
@endif

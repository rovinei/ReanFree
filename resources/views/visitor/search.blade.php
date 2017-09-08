@extends('visitor.layouts.main')

@section('page_title', 'welcome to 180 inspire website')

@section('content')
<div class="page-wrapper__bg">
    <div class="section">
        <div class="uk-container uk-container-center">
        @if(!empty($searchResults))
            <div class="section-heading bg-transparent extra-size">
                <h1 class="uk-text-center">
                    Search Results
                </h1>
            </div>

            <div class="section search-result">
                <div class="bottom-post uk-grid uk-grid-medium uk-grid-small-medium uk-gird-width-1-2 uk-grid-width-small-1-2 uk-grid-width-medium-1-4 uk-grid-large-1-4 uk-grid-width-xlarge-1-4">
                @foreach($searchResults as $post)
                    @if($post->mediatype_id==1)
                        @includeIf('visitor.components.article.grid_box_4', ['article' => $post])
                    @elseif($post->mediatype_id==3)
                        @includeIf('visitor.components.video.grid_box_2', ['video' => $post])
                    @endif
                @endforeach
                </div>

            </div>

            <!-- Pagination -->
            {{ $searchResults->appends(['q' => $query])->links('visitor.components.pagination') }}
            <!-- /Pagination -->

        @else
            <div class="section-heading bg-transparent extra-size">
                <h1 class="uk-text-center">
                    No result found
                </h1>
            </div>
        @endif
        </div>
    </div>
</div>
@endsection

@push('script_dependencies')

@endpush

@section('scripts')

@endsection

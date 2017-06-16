@extends('visitor.layouts.main')

@section('page_title', '180 INSPIRES PAGE NOT FOUND')

@section('content')
<div class="page-bg__wrapper">
    <div class="uk-container uk-container-small uk-container-center">
        <div class="uk-gird uk-grid-collapse uk-grid-width-1-1">
            <div class="uk-height-1-1 uk-flex uk-flex-middle uk-flex-center">
                <div class="section-bg__white">
                    <h1 class="uk-text-large uk-text-lead">
                        {{ $exception->getMessage() }}
                    </h2>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

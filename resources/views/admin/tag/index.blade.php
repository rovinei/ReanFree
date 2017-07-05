@extends('admin.layouts.main')

@section('title', '180 Inspire Admin panel | Display list of tag')

@section('content')
<div class="uk-section">
    <div class="uk-container">

        <div class="uk-width-1-1">
            <div class="card card-transparent">

                <div class="custom-table-wrapper uk-overflow-auto">
                    <table class="custom-table uk-table uk-table-hover">
                        <thead>
                            <th>N|O</th>
                            <th>Name</th>
                            <th>Total Post</th>
                            <th></th>
                        </thead>
                        <tbody id="tableData">
                            @foreach($tags as $key => $tag)
                            <tr>
                                <td class="order-number">{{ $tags->perPage() * ($tags->currentPage() - 1) + (++$key) }}</td>
                                <td>{{ Str::title($tag->name) }}</td>
                                <td>
                                    @if($tag->count > 0)
                                        <span class="uk-badge badge-primary">{{ $tag->count }}</span>
                                    @else
                                        <span class="uk-badge badge-warning">None</span>
                                    @endif
                                </td>

                                <td>
                                    <button class="action-btn"><i class="fa fa-ellipsis-v"></i></button>

                                    <div data-tag-id="{{ $tag->id }}" data-tag-slug="{{ $tag->slug }}" class="action-box uk-card uk-card-body">
                                        <li class="btnRemove">Remove &amp; Detach</li>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="footer">
                    <div class="uk-width-1-1">
                        {{ $tags->links('vendor.pagination.default') }}
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>
@endsection

@push('script_dependencies')
<script src="{{ asset('admins/js/crud.js') }}"></script>
@endpush

@section('script')
    <script>
        $(document).ready(function(){

            $(window).click(function() {
                $('.action-box.visible').removeClass('visible');
            });

            /**
             * Toggle visibility of action card box
             */
            $('.action-btn').on('click', function(e){
                e.preventDefault();
                e.stopPropagation();
                var target = $(this).parent('td').find('.action-box');
                $('.action-box.visible').not(target).removeClass('visible');
                $(target).toggleClass('visible');
            });

            /**
             * Handle record deletion
             */
            $('.btnRemove').on('click', function(e){
                e.preventDefault();
                var self = $(this);
                var route = "{{ route('admin.ajax.remove_tag') }}",
                    data = {
                        slug: $(this).parent('.action-box').attr('data-tag-slug')
                    },
                    csrfToken = $('meta[name="csrf-token"]').attr('content');
                BIGK.crud.deleteRecord(route, data, csrfToken, function(){
                    $(self).parents('tr').remove();
                    $('#tableData').find('tr').each(function(i, k, v){
                        $(this).find('.order-number').empty().text(++i);
                    });
                });
            });



        });
    </script>
@endsection

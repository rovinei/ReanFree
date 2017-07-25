@extends('admin.layouts.main')

@section('title', 'Admin display list of category')

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
                            <th>Description</th>
                            <th>Created By</th>
                            <th>Updated By</th>
                            <th></th>
                        </thead>
                        <tbody id="tableData">
                            @foreach($categories as $key => $category)
                            <tr>
                                <td class="order-number">{{ $categories->perPage() * ($categories->currentPage() - 1) + (++$key) }}</td>
                                <td>{{ Str::title($category->name) }}</td>
                                <td>
                                    @if($category->description == "" | $category->description == null)
                                        --unknown--
                                    @else
                                        {{ $category->description }}
                                    @endif
                                </td>

                                <td>
                                @if($category->created_by != null)
                                    {{ $category->createdBy->username }}
                                @else
                                    --annonymous--
                                @endif
                                </td>
                                <td>
                                @if($category->updated_by != null)
                                    {{ $category->updatedBy->username }}
                                @else
                                    ----
                                @endif
                                </td>
                                <td>
                                    <button class="action-btn"><i class="fa fa-ellipsis-v"></i></button>

                                    <div data-post-id="{{ $category->id }}" class="action-box uk-card uk-card-body">
                                        <a href="{{ route('admin.category.edit', $category->id) }}" class="btnEdit">Edit &amp; Update</a>
                                        <li class="btnRemove">Remove</li>
                                        <li class="btnView">View</li>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="footer">
                    <div class="uk-width-1-1">
                        {{ $categories->links('vendor.pagination.default') }}
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
                var route = "{{ route('admin.ajax.delete_category') }}",
                    data = {
                        id: $(this).parent('.action-box').attr('data-post-id')
                    },
                    csrfToken = $('meta[name="csrf-token"]').attr('content');
                BIGK.crud.deleteRecord(route, data, csrfToken, function(){
                    $(self).parents('tr').remove();
                    $('#tableData').find('tr').each(function(i, k, v){
                        $(this).find('.order-number').empty().text(++i);
                    });
                });
            });

            /**
             * Handle update
             */

        });
    </script>
@endsection

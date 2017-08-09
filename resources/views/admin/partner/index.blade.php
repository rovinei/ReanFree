@extends('admin.layouts.main')

@section('title', 'Display Partner, Client, Sponsor list')

@section('content')
<div class="uk-section">
    <div class="uk-container">

        <div class="uk-width-1-1">
            <div class="card card-transparent">

                <div class="custom-table-wrapper uk-overflow-auto">
                    <table class="custom-table uk-table uk-table-hover">
                        <thead>
                            <th>N|O</th>
                            <th>Company Name</th>
                            <th>Logo</th>
                            <th>Status</th>
                            <th>Featured</th>
                            <th>Publisher</th>
                            <th>Created At</th>
                            <th></th>
                        </thead>
                        <tbody id="tableData">
                            @foreach($partners as $key => $partner)
                            <tr>
                                <td class="order-number">{{ $partners->perPage() * ($partners->currentPage() - 1) + (++$key) }}</td>
                                <td class="uk-text-ellipse">{{ Str::title($partner->company_name) }}</td>
                                <td>
                                    @if($partner->logo_src)
                                        <img src="{{ asset(str_replace('thumbs', 'uploads', $partner->logo_src)) }}" alt="" width="90px">
                                    @else
                                        <img src="{{ asset('images/no_thumbnail_img.jpg') }}" alt="no thumbnail image" width="90px">
                                    @endif
                                </td>
                                <td>
                                    @if($partner->status == 1)
                                        Published
                                    @elseif($partner->status == 2)
                                        Draft
                                    @elseif($partner->status == 3)
                                        Disabled
                                    @endif
                                </td>
                                <td>
                                    <div class="custom-checkbox__outer">
                                        <input disabled @if($partner->is_featured == 1){{ 'checked="checked"' }}@endif type="checkbox" class="checkbox" id="_pF{{ $partner->id }}">
                                    </div>
                                </td>
                                <td>
                                @if($partner->created_by != null)
                                    {{ $partner->createdBy->username }}
                                @endif
                                </td>
                                <td>{{ $partner->created_at->format('d\, M Y') }}</td>
                                <td>
                                    <button class="action-btn"><i class="fa fa-ellipsis-v"></i></button>

                                    <div data-partner-id="{{ $partner->id }}" class="action-box uk-card uk-card-body">
                                        <a href="{{ route('admin.partner.edit', $partner->id) }}" class="btnEdit">Edit &amp; Update</a>
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
                        {{ $partners->links('vendor.pagination.default') }}
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
                var route = "{{ route('admin.ajax.delete_partner') }}",
                    data = {
                        id: $(this).parent('.action-box').attr('data-partner-id')
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

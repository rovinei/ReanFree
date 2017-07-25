@extends('admin.layouts.main')

@section('title', '180 Inspire Admin panel | Display serie and playlist')

@section('content')
<div class="uk-section">
    <div class="uk-container">
        @if(Session::has('success_message'))
            @component('admin.components.alert')
                @slot('title')
                    Succeed Confirmation
                @endslot
                @slot('message')
                    {{ Session::get('success_message') }}
                @endslot
                @slot('type')
                    success
                @endslot
                @slot('timer')
                    3000
                @endslot
                @slot('attributes')
                    allowOutsideClick: true
                @endslot
            @endcomponent
        @endif
        @if(Session::has('error_message'))
        <script type="text/javascript">
            swal({
                title: "Opp! Something went wrong",
                text: "{{ Session::get('error_message') }}",
                type: "error",
                timer: 5000,
                allowOutsideClick: true
            });
        </script>
        @endif
        @if($errors->any())
        <script type="text/javascript">
            swal({
                title: "Opp! Something went wrong",
                text: "@foreach($errors->all() as $error) <p>{{ $error }}</p> @endforeach",
                type: "error",
                timer: 5000,
                html: true,
                allowOutsideClick: true
            });
        </script>
        @endif
        <div class="uk-width-1-1">
            <div class="card card-transparent">

                <div class="custom-table-wrapper uk-overflow-auto">
                    <table class="custom-table uk-table uk-table-hover">
                        <thead>
                            <th>N|O</th>
                            <th>Title</th>
                            <th>Categoty</th>
                            <th>Featured</th>
                            <th>Total Post</th>
                            <th></th>
                        </thead>
                        <tbody id="tableData">
                            @foreach($playlists as $key => $playlist)
                            <tr>
                                <td class="order-number">{{ $playlists->perPage() * ($playlists->currentPage() - 1) + (++$key) }}</td>
                                <td>{{ Str::title($playlist->title) }}</td>
                                <td>
                                @if($playlist->category)
                                {{ $playlist->category->name }}
                                @else
                                {{ '----' }}
                                @endif
                                </td>
                                <td>
                                    <div class="custom-checkbox__outer">
                                        <input disabled @if($playlist->is_featured == 1){{ 'checked="checked"' }}@endif type="checkbox" class="checkbox" id="_pF{{ $playlist->id }}">
                                    </div>
                                </td>
                                <td>
                                    @if($playlist->count($playlist->id) > 0)
                                        <span class="uk-badge badge-primary">
                                        {{ $playlist->count($playlist->id) }}
                                        </span>
                                    @else
                                        <span class="uk-badge badge-warning">None</span>
                                    @endif
                                </td>

                                <td>
                                    <button class="action-btn"><i class="fa fa-ellipsis-v"></i></button>

                                    <div data-playlist-id="{{ $playlist->id }}" class="action-box uk-card uk-card-body">
                                        <a href="{{ route('admin.serie.edit', $playlist->id) }}" class="btnEdit">Edit &amp; Update</a>
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
                        {{ $playlists->links('vendor.pagination.default') }}
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
                var route = "{{ route('admin.ajax.remove_serie') }}",
                    data = {
                        id: $(this).parent('.action-box').attr('data-playlist-id')
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

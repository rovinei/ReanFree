@extends('admin.layouts.main')

@section('title', 'Admin File Entries List')

@section('style')
    <style></style>
@endsection

@section('content')
<div class="uk-section">
    <div class="uk-container">

        <div class="uk-width-1-1">
            <div class="card card-transparent">

                <div class="custom-table-wrapper uk-overflow-auto">
                    <table class="custom-table uk-table uk-table-hover">
                        <thead>
                            <th>N|O</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Type</th>
                            <th>Status</th>
                            <!-- <th>Content</th>
                            <th>Thumbnail</th> -->
                            <th>Publisher</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th></th>
                        </thead>
                        <tbody>
                            @foreach($files as $key => $file)
                            <tr>
                                <td>{{ $files->perPage() * ($files->currentPage() - 1) + (++$key) }}</td>
                                <td class="uk-table-shrink">{{ $file->filename.'.'.$file->extension }}</td>
                                <td>
                                   {{ $file->mime }}
                                </td>
                                <td>
                                @if($post->created_by != null)
                                    {{ $post->createdBy->username }}
                                @endif
                                </td>
                                <td>
                                @if($post->updated_by != null)
                                    {{ $post->updatedBy->username }}
                                @endif
                                </td>
                                <td>{{ $post->created_at }}</td>
                                <td>{{ $post->updated_at }}</td>
                                <td>
                                    <button class="action-btn"><i class="fa fa-ellipsis-v"></i></button>

                                    <div data-file-id="{{ $file->id }}" class="action-box uk-card uk-card-default uk-card-body">
                                        <a href="{{ route('admin.file.edit', $file->id) }}" class="btnEdit">Edit &amp; Update</a>
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
                        {{ $files->links('vendor.pagination.default') }}
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>
@endsection

@push('script_dependencies')
<script src="{{ asset('admin/js/crud.js') }}"></script>
@endpush

@section('script')
    <script>
        $(document).ready(function(){
            /**
             * Toggle visibility of action card box
             */
            $('.action-btn').on('click', function(e){
                e.preventDefault();
                $('.action-box.visible').not($(this).child('.action-box')).removeClass('visible');
                $(this).parent('td').find('.action-box').toggleClass('visible');
            });

            /**
             * Handle record deletion
             */
            $('.btnRemove').on('click', function(e){
                e.preventDefault();
                var self = $(this);
                var route = "{{ route('admin.ajax.delete_post') }}",
                    data = {
                        id: $(this).parent('.action-box').attr('data-post-id')
                    },
                    csrfToken = $('meta[name="csrf-token"]').attr('content');
                BIGK.crud.deleteRecord(route, data, csrfToken, function(){
                    $(self).parents('tr').remove();
                });
            });

            /**
             * Handle update
             */

        });
    </script>
@endsection

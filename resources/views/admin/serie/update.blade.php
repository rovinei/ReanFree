@extends('admin.layouts.main')

@section('title', '180 Inspire admin dashboard | Update Serie, Album and Playlist')

@push('styles')
    <style type="text/css">
        .label{
            font-size: 1.3rem;
            color: #817b73;
            font-weight: 500;
            margin: 0;
            padding: 10px 0;
        }
    </style>
@endpush
@section('content')

    <div>
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

        <form class="custom-form" enctype="multipart/form-data" action="{{ route('admin.serie.update', $serie->id) }}" method="POST">
            <input type="hidden" name="_token" value="{!! csrf_token() !!}">
            <div class="uk-flex">
                <!-- Card Form -->
                <div class="uk-flex-1">
                    <h2 class="form-title uk-text-center">
                        Update Album, Playlist &amp; Serie Form
                        <span>
                            It's ok, People usually made problem
                        </span>
                    </h2>

                    <div class="card card-transparent">

                        <div class="uk-container">

                            <div class="uk-width-1-1">

                                <div class="custom-form-group">
                                    <div class="uk-width-1-1">
                                        <input type="text" value="@if($serie->title){{ $serie->title }}@endif" placeholder="Album, Serie, Playlist title here ..." name="title" class="custom-input-text" required/>
                                    </div>
                                </div>

                                <div class="custom-form-group">
                                    <h2 class="label">
                                        Description
                                    </h2>
                                    <div class="uk-width-1-1">
                                        <textarea id="description" name="description" class="custom-input-textarea">
                                        @if($serie->description){{ $serie->description }}@endif
                                        </textarea>
                                    </div>
                                </div>

                                <div class="custom-form-group">
                                    <div class="padding-top-sm"></div>
                                    <input type="reset" class="custom-btn-cancel" value="Cancel">
                                    <input type="submit" class="custom-btn-submit" value="Update Now"/>
                                </div>

                            </div>

                        </div>
                        <div class="footer">

                        </div>
                    </div>

                </div>
                <!-- /Card From -->

                <!-- Advance Options -->
                <div class="sidebar-form-advance">
                    <div class="avoid-click-overlay">
                        <div uk-spinner></div>
                    </div>
                    <div class="heading">
                        <h2>
                            Advance Options
                        </h2>
                    </div>
                    <div class="advance-options">
                        <div class="custom-form-group clearfix uk-flex">
                            <div class="media_-select">
                                <select id="mediaField" name="mediatype_id" required>
                                </select>
                            </div>

                            <div class="category-select uk-flex-1">
                                <select id="categoryField" name="category_id" required>
                                </select>
                            </div>
                        </div>

                        <div class="custom-form-group">
                            <h3 class="uk-float-left uk-display-block uk-width-1-1"> Featured Post?</h3>
                            <div class="custom-checkbox__outer">
                                <input @if($serie->is_featured == 1){{ 'checked="checked"' }}@endif name="is_featured" id="is_featured" type="checkbox" value="1" class="checkbox">
                            </div>
                        </div>

                        <div class="custom-form-group">
                            <div class="uk-width-1-1">
                                <input value="@if($serie->genre){{ $serie->genre }}@endif" type="text" placeholder="Genre" name="genre" class="custom-input-text" />
                            </div>
                        </div>

                        <!-- Featured image field -->
                        <div class="custom-form-group">
                            <div class="file-input-wrapper">
                                <button class="custom-upload-btn image uploadFile" data-type="image" id="uploadImage"><i class="fa fa-upload"></i> Upload</button>
                                <input type="hidden" value="@if($serie->featured_image){{ $serie->featured_image }}@endif" name="featured_image" id="txtFeaturedImage" />
                            </div>
                            <div class="imagePreview">
                                <p>Image Preview</p>
                                <div id="imagePreviewDiv">
                                    @if($serie->featured_image)
                                    <img src="{{ $serie->featured_image }}" alt="">
                                    @endif
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- /Advance Options -->
            </div>
        </form>

    </div>
    @includeIf('admin.partials._uploadfile')
@endsection

@push('script_dependencies')
    <script type="text/javascript" src="{{ asset('admins/js/script.js') }}"></script>
@endpush

@section('script')

    <script>

        var categoryOptions = [
            @if(!empty($categories->categories))
                @foreach ($categories->categories as $category)
                { id: "{{ $category->id }}", name: "{{ $category->name }}" },
                @endforeach
            @endif
        ];

        var categorySeletedItems = [
            @if($serie->category)
                {{ $serie->category->id }},
            @endif
        ];

        function responsive_filemanager_callback(field_id){
            var uploadImageModal = UIkit.modal("#fileManagerModal")
                imageUrl="";
            switch(field_id){
                case 'txtFeaturedImage':
                    imageUrl = $('#'+field_id).val();
                    $('#imagePreviewDiv').css({
                        'background' : 'url("'+imageUrl+'") center center / cover no-repeat',
                        'position' : 'relative',
                        'min-height' : '130px'
                    });
                    break;
                case 'sound_url':
                    break;

                default:
                    return;

            }

            uploadImageModal.toggle();

        }

        $(document).on('click','#removeImage',function(){
            $('#imagePreviewDiv').empty();
            $("#txtFeaturedImage").val('');
        });

        $(document).ready(function(){

            var mediaSelect = $('#mediaField').selectize({
                delimiter: ',',
                persist: false,
                valueField: 'mediaId',
                labelField: 'mediaName',
                searchField: 'mediaName',
                options: [
                    {mediaId: 1, mediaName: 'Reading'},
                    {mediaId: 2, mediaName: 'Listening'},
                    {mediaId: 3, mediaName: 'Watching'}
                ],
                items: [
                    @if($serie->mediatype_id)
                        {{ $serie->mediatype_id }}
                    @endif
                ],
                placeholder: 'Type',
                onChange: function(value){
                    var category_select = categorySelect[0].selectize;

                    category_select.clear();
                    category_select.clearOptions();
                    category_select.renderCache['option'] = {};
                    category_select.renderCache['item'] = {};
                    categoryOptions = [];

                    $('.sidebar-form-advance')
                    .addClass('avoid-click');
                    $.ajax({
                        url: '{{ route('admin.ajax.typeCategories') }}',
                        data: {typeid: value, },
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        error: function(err) {
                            swal({
                                title: "Opp! Something went wrong",
                                text: err,
                                type: "error",
                                timer: 5000,
                                allowOutsideClick: true
                            });
                            $('.sidebar-form-advance').removeClass('avoid-click');
                        },
                        success: function(res) {

                            $(res['categories']).each(function(){
                                categoryOptions.push({id: this.id, name: this.name});
                            });

                            category_select.clear();
                            category_select.clearOptions();
                            category_select.renderCache['option'] = {};
                            category_select.renderCache['item'] = {};
                            category_select.load(function(callback){
                                callback(categoryOptions);
                            });

                            $('.sidebar-form-advance').removeClass('avoid-click');
                            $(category_select).focus();
                        }
                    });
                },
                create: false
            });

            var categorySelect = $('#categoryField').selectize({
                valueField: 'id',
                labelField: 'name',
                searchField: 'name',
                create: false,
                options: categoryOptions,
                placeholder: 'Choose category',
                items: [
                    @if($serie->category)
                        {{ $serie->category->id }},
                    @endif
                ],
            });
        });

    </script>
@endsection

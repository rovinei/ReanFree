@extends('admin.layouts.main')

@section('title', 'Publishing new post')

@push('styles')
    <style>
        #soundUpload,
        #videoUpload{
            display: none;
            opacity: 0;
            -webkit-transform: scale(0.3,0.3);
            -moz-transform: scale(0.3,0.3);
            -ms-transform: scale(0.3,0.3);
            -o-transform: scale(0.3,0.3);
            transform: scale(0.3,0.3);
            -webkit-transition: opacity 0.2s linear, transform 0.25s ease;
            -moz-transition: opacity 0.2s linear, transform 0.25s ease;
            -ms-transition: opacity 0.2s linear, transform 0.25s ease;
            -o-transition: opacity 0.2s linear, transform 0.25s ease;
            transition: opacity 0.2s linear, transform 0.25s ease;
        }

        #soundUpload.visible,
        #videoUpload.visible{
            display: block;
            opacity: 1;
            -webkit-transform: scale(1,1);
            -moz-transform: scale(1,1);
            -ms-transform: scale(1,1);
            -o-transform: scale(1,1);
            transform: scale(1,1);
        }

        #progressbar-wrap {
            border: 1px solid #0099CC;
            padding: 1px;
            position: relative;
            height: 30px;
            border-radius: 3px;
            margin: 10px;
            text-align: left;
            background: #fff;
            box-shadow: inset 1px 3px 6px rgba(0, 0, 0, 0.12);
        }
        #progressbar-wrap .progress-bar{
            height: 100%;
            border-radius: 3px;
            background-color: #f39ac7;
            width: 0;
            box-shadow: inset 1px 1px 10px rgba(0, 0, 0, 0.11);
        }
        #progressbar-wrap .status{
            top:3px;
            left:50%;
            position:absolute;
            display:inline-block;
            color: #000000;
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
        <form class="custom-form" enctype="multipart/form-data" action="{{ route('admin.post.store') }}" method="POST">
            <input type="hidden" name="_token" value="{!! csrf_token() !!}">
            <div class="uk-flex">
                <!-- Card Form -->
                <div class="uk-flex-1">
                    <h2 class="form-title uk-text-center">
                        POST REGISTRATION FORM
                        <span>
                            Start publishing something great
                        </span>
                    </h2>

                    <div class="card card-transparent">

                        <div class="uk-container">

                            <div class="uk-width-1-1">

                                <div class="custom-form-group">
                                    <div class="uk-width-1-1">
                                        <input type="text" placeholder="Enter post title here ..." name="title" class="custom-input-text" required/>
                                    </div>
                                </div>

                                <!-- <div class="custom-form-group">
                                    <div class="uk-width-1-1">
                                        <input class="custom-input-text" name="slug" type="text" required/>
                                    </div>
                                </div> -->

                                <div class="custom-form-group">
                                    <div class="uk-width-1-1">
                                        <textarea name="content" class="custom-input-textarea">

                                        </textarea>
                                    </div>
                                </div>

                                <div class="custom-form-group uk-grid-small uk-child-width-1-3" uk-grid>
                                    <div>
                                        <div class="input-radio-wrapper">
                                            <label for="status_draft">Draft</label>
                                            <input id="status_draft" type="radio" name="status" class="custom-input-radio" value="2" />
                                        </div>
                                    </div>
                                    <div>
                                        <div class="input-radio-wrapper">
                                            <label for="status_hide">In Active</label>
                                            <input type="radio" name="status" class="custom-input-radio" value="3" />
                                        </div>
                                    </div>
                                    <div>
                                        <div class="input-radio-wrapper">
                                            <label for="status_published">Published</label>
                                            <input id="status_published" type="radio" name="status" class="custom-input-radio" value="1" checked="checked" />
                                        </div>
                                    </div>
                                </div>

                                <div class="custom-form-group">
                                    <div class="padding-top-sm"></div>
                                    <input type="reset" class="custom-btn-cancel" value="Cancel">
                                    <input type="submit" class="custom-btn-submit" value="Publish Now"/>
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
                                <select id="mediaField" name="mediatype_id">
                                </select>
                            </div>

                            <div class="category-select uk-flex-1">
                                <select id="categoryField" name="category_id">
                                </select>
                            </div>
                        </div>

                        <div class="custom-form-group">
                            <input type="text" name="tags" id="tags">
                        </div>

                        <div class="custom-form-group">
                            <h3 class="uk-float-left uk-display-block uk-width-1-1"> Featured Post?</h3>
                            <div class="custom-checkbox__outer">
                                <input name="is_featured" id="is_featured" type="checkbox" value="1" class="checkbox">
                            </div>
                        </div>

                        <div class="custom-form-group">
                            <input placeholder="Genre type ..." type="text" name="genre" class="custom-input-text" />
                        </div>

                        <div class="custom-form-group">
                            <input placeholder="Source ..." type="text" name="source" class="custom-input-text" />
                        </div>

                        <!-- Featured image field -->
                        <div class="custom-form-group">
                            <div class="file-input-wrapper">
                                <button class="custom-upload-btn image uploadFile" data-type="image" id="uploadImage"><i class="fa fa-upload"></i> Image Thumbnail</button>
                                <input type="hidden" name="featured_image" id="txtFeaturedImage" />
                            </div>
                            <div class="imagePreview">
                                <p>Image Preview</p>
                                <div id="imagePreviewDiv">

                                </div>
                            </div>
                        </div>

                        <!-- Sound url field -->
                        <div class="custom-form-group" id="soundUpload">
                            <div class="file-input-wrapper">
                                <!-- <label for="uploadSoundFile">Attach Sound File</label> -->
                                <button class="custom-upload-btn sound uploadFile" data-type="sound" id="uploadSound"><i class="fa fa-sound"></i> Attach Sound File</button>
                                <input type="hidden" class="custom-input-text" name="sound_url" id="sound_url">

                                <div id="soundPreview" class="uk-panel uk-margin-medium-top">
                                    <audio preload id="audioEle" controls="controls">Your browser does not support HTML5 Audio!</audio>
                                </div>
                            </div>
                        </div>

                        <!-- video url field -->
                        <div class="custom-form-group" id="videoUpload">
                            <div class="file-input-wrapper">
                                <!-- <button class="custom-upload-btn video">Embed Video</button> -->
                                <input type="text" class="custom-input-text" name="video_url" id="video_url">

                                <div id="videoPreview">

                                </div>
                            </div>
                        </div>

                        <!-- video url field -->
                        <div class="custom-form-group">
                            <input name="series" id="seriesField" />
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
    <script type="text/javascript" src="{{ asset('admins/plugins/tinymce/tinymce.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admins/plugins/tinymce/tinymce-config.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/done-typing.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admins/js/script.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admins/js/crud.js') }}"></script>
@endpush

@section('script')

    <script>

        var tagOptions = [
            @if(!empty($tags))
                @foreach ($tags as $tag)
                {tag: "{{$tag}}" },
                @endforeach
            @endif
        ];

        var serieOptions = [
            @if(!empty($series))
                @foreach ($series as $serie)
                { id: "{{ $serie->id }}", title: "{{ $serie->title }}" },
                @endforeach
            @endif
        ];

        var categoryOptions = [
            @if(!empty($categories->categories))
                @foreach ($categories->categories as $category)
                { id: "{{ $category->id }}", name: "{{ $category->name }}" },
                @endforeach
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
                    var playing = false,
                        audioEle = $('#audioEle').bind('play', function () {
                                    playing = true;
                                }).bind('pause', function () {
                                    playing = false;
                                }).bind('ended', function () {
                                    audio.pause();
                                }).get(0);
                    var supportsAudio = !!document.createElement('audio').canPlayType;
                    if (supportsAudio){
                        $(audioEle).attr('src', $('#'+field_id).val());
                    }
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
            $('#video_url').donetyping(function(){
                $iframe = $('<iframe></iframe>');
                $iframe.attr('src', 'https://www.youtube.com/embed/'+$.trim($(this).val())).css({'width':'100%'});
                $('#videoPreview').empty().append($iframe);
            }, 2000);

            var tagSelect = $('#tags').selectize({
                plugins: ['restore_on_backspace', 'remove_button'],
                delimiter: ',',
                persist: false,
                valueField: 'tag',
                labelField: 'tag',
                searchField: 'tag',
                options: tagOptions,
                placeholder: 'Attach tags ...',
                create: function(input) {
                    return {
                        tag: input
                    }
                }
            });

            var serieSelect = $('#seriesField').selectize({
                plugins: ['restore_on_backspace', 'remove_button'],
                delimiter: ',',
                persist: false,
                valueField: 'id',
                labelField: 'title',
                searchField: 'title',
                options: serieOptions,
                placeholder: 'Attach series ...',
                render: {
                    option: function(item, escape) {
                        return '<div class="option">' + escape(item.title) + '</div>';
                    }
                },
                // create: function(input) {
                //     $thisSelect = serieSelect[0].selectize;
                //     $.ajax({
                //         url: "{{ route('admin.ajax.add_serie') }}",
                //         type: "POST",
                //         data: {
                //             title: input,
                //             type: $('#mediaField').val() || 'null'
                //         },
                //         headers: {
                //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                //         },
                //         error: function(err){
                //             swal({
                //                 title: "Opp! Something went wrong",
                //                 text: err,
                //                 type: "error",
                //                 timer: 5000,
                //                 allowOutsideClick: true
                //             });
                //         },
                //         success: function(res){
                //             if(res.status == 200){

                //                 serieOptions.push({
                //                     id: res.data.id,
                //                     title: res.data.title
                //                 });

                //                 $thisSelect.load(function(callback){
                //                     callback(serieOptions);
                //                 });

                //                 swal({
                //                     title: "succeed",
                //                     text: res.success.message,
                //                     type: "success",
                //                     timer: 2500,
                //                     allowOutsideClick: true
                //                 });

                //             }else{
                //                 swal({
                //                     title: "Opp! Something went wrong",
                //                     text: res.error.message,
                //                     type: "error",
                //                     timer: 5000,
                //                     allowOutsideClick: true
                //                 });
                //             }
                //         }
                //     });
                // }
            });

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
                    1
                ],
                placeholder: 'Type',
                onChange: function(value){
                    var category_select = categorySelect[0].selectize;
                    var series_select = serieSelect[0].selectize;

                    category_select.clear();
                    category_select.clearOptions();
                    category_select.renderCache['option'] = {};
                    category_select.renderCache['item'] = {};

                    series_select.clear();
                    series_select.clearOptions();
                    series_select.renderCache['option'] = {};
                    series_select.renderCache['item'] = {};

                    categoryOptions = [];
                    serieOptions = [];
                    if(value == 2){
                        $('#videoUpload').hasClass('visible') ? $('#videoUpload').removeClass('visible') : $('#videoUpload').removeClass('');
                        $('#soundUpload').toggleClass('visible');

                    }else if(value == 3){
                        $('#soundUpload').hasClass('visible') ? $('#soundUpload').removeClass('visible') : $('#soundUpload').removeClass('');
                        $('#videoUpload').toggleClass('visible');
                    }else if(value == 1){
                        $('#videoUpload').hasClass('visible') ? $('#videoUpload').removeClass('visible') : $('#videoUpload').removeClass('');
                        $('#soundUpload').hasClass('visible') ? $('#soundUpload').removeClass('visible') : $('#soundUpload').removeClass('');
                    }else{
                        return;
                    }

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

                            $(res['series']).each(function(){
                                serieOptions.push({id: this.id, title: this.title});
                            });

                            category_select.clear();
                            category_select.clearOptions();
                            category_select.renderCache['option'] = {};
                            category_select.renderCache['item'] = {};
                            category_select.load(function(callback){
                                callback(categoryOptions);
                            });

                            series_select.clear();
                            series_select.clearOptions();
                            series_select.renderCache['option'] = {};
                            series_select.renderCache['item'] = {};
                            series_select.load(function(callback){
                                callback(serieOptions);
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
            });
        });

    </script>
@endsection

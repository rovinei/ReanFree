@extends('admin.layouts.main')

@section('title', 'Admin dashboard overview')

@push('styles')

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
        <form class="custom-form" enctype="multipart/form-data" action="{{ route('admin.partner.store') }}" method="POST">
            <input type="hidden" name="_token" value="{!! csrf_token() !!}">
            <div class="uk-flex">
                <!-- Card Form -->
                <div class="uk-flex-1">
                    <h2 class="form-title uk-text-center">
                        PARTNER REGISTRATION FORM
                        <span>

                        </span>
                    </h2>

                    <div class="card card-transparent">

                        <div class="uk-container">

                            <div class="uk-width-1-1">

                                <div class="custom-form-group">
                                    <div class="uk-width-1-1">
                                        <input type="text" placeholder="Partner name here ..." name="company_name" class="custom-input-text" required/>
                                    </div>
                                </div>

                                <div class="custom-form-group">
                                    <div class="uk-width-1-1">
                                        <input type="text" placeholder="External link" name="external_url" class="custom-input-text" required/>
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
                                    <input type="submit" class="custom-btn-submit" value="Create Now"/>
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

                        <div class="custom-form-group">
                            <h3 class="uk-float-left uk-display-block uk-width-1-1"> Home Featured?</h3>
                            <div class="custom-checkbox__outer">
                                <input name="is_featured" id="is_featured" type="checkbox" value="1" class="checkbox">
                            </div>
                        </div>

                        <!-- Featured image field -->
                        <div class="custom-form-group">
                            <div class="file-input-wrapper">
                                <button class="custom-upload-btn image uploadFile" data-type="image" id="uploadImage"><i class="fa fa-upload"></i> Partner Logo</button>
                                <input type="hidden" name="logo_src" id="txtFeaturedImage" />
                            </div>
                            <div class="imagePreview">
                                <p>Logo Preview</p>
                                <div id="imagePreviewDiv"></div>
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

        function responsive_filemanager_callback(field_id){
            var uploadImageModal = UIkit.modal("#fileManagerModal")
                imageUrl="";
            switch(field_id){
                case 'txtFeaturedImage':
                    imageUrl = $('#'+field_id).val();
                    imageUrl.replace('thumbs', 'uploads', imageUrl);
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

        });

    </script>
@endsection

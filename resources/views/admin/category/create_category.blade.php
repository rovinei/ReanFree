@extends('admin.layouts.main')

@section('title', 'Create new category')

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
        <form class="custom-form" enctype="multipart/form-data" action="{{ route('admin.category.store') }}" method="POST">
            <input type="hidden" name="_token" value="{!! csrf_token() !!}">
            <div class="uk-flex">
                <!-- Card Form -->
                <div class="uk-flex-1">
                    <h2 class="form-title uk-text-center">
                        CATEGORY CREATION FORM
                        <span>
                            Start creating your awesome category
                        </span>
                    </h2>

                    <div class="card card-transparent">

                        <div class="uk-container uk-container-center">
                            <div class="uk-flex uk-flex-center uk-flex-middle">
                                <div class="uk-width-medium">

                                    <div class="custom-form-group">
                                        <div class="">
                                            <input type="text" placeholder="Category name goes here ..." name="name" class="custom-input-text" required/>
                                        </div>
                                    </div>

                                    <div class="custom-form-group">
                                        <div class="selectize-md">
                                            <select id="mediaField" name="mediatype_id" required>

                                            </select>
                                        </div>
                                    </div>

                                    <div class="custom-form-group">
                                        <div class="selectize-md">
                                            <select id="categoryParent" name="parent_id">

                                            </select>
                                        </div>
                                    </div>

                                    <div class="custom-form-group">
                                        <div class="">
                                            <input class="custom-input-text" placeholder="Order" name="order" value="1" type="text" />
                                        </div>
                                    </div>

                                    <div class="custom-form-group">
                                        <div class="">
                                            <input class="custom-input-text" placeholder="Write some description ..." name="description" type="text" />
                                        </div>
                                    </div>

                                    <div class="custom-form-group">
                                        <div class="padding-top-sm"></div>
                                        <input type="reset" class="custom-btn-cancel" value="Cancel">
                                        <input type="submit" class="custom-btn-submit" value="Create Now"/>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="footer">

                        </div>
                    </div>

                </div>
                <!-- /Card From -->
            </div>
        </form>
    </div>
@endsection

@section('script')
    <script>
        var categoryOptions = [
            @if(!empty($categories))
                @foreach ($categories as $category)
                { id: "{{ $category->id }}", name: "{{ $category->name }}" },
                @endforeach
            @endif
        ];
    </script>
    <script>

        $(document).ready(function(){

            // Initialize media select option
            var mediaSelect = $('#mediaField').selectize({
                delimiter: ',',
                persist: false,
                create: false,
                valueField: 'mediaId',
                labelField: 'mediaName',
                searchField: 'mediaName',
                placeholder: 'Attach media type',
                options: [
                    {mediaId: 1, mediaName: 'Article'},
                    {mediaId: 3, mediaName: 'Video'}
                ]
            });

            // Initialize category parent
            var categories = $('#categoryParent').selectize({
                delimiter: ',',
                persist: false,
                create: false,
                valueField: 'id',
                labelField: 'name',
                searchField: 'name',
                placeholder: '-----Parent-----',
                options: categoryOptions
            });
        });

    </script>
@endsection

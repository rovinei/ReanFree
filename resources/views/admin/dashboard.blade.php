@extends('admin.layouts.main')

@section('title', 'Admin dashboard overview')

@push('styles')
    <style></style>
@endpush

@section('content')
    <div class="uk-section">
        <div class="uk-container">
            <div class="uk-grid-small uk-grid-collape" uk-grid>

                <div class="uk-width-1-4@xl uk-width-1-3@l uk-width-1-2@m uk-width-1-1@s">
                    <div class="card">
                        <div class="content">
                            <div class="row">
                                <div class="uk-grid-collapse" uk-grid>
                                    <div class="uk-width-1-3">
                                        <i class="fa fa-users icon-big" style="color:#87314e;"></i>
                                    </div>
                                    <div class="uk-width-2-3">
                                        <div class="number">
                                            <p>Users</p>
                                            @if($usersCount > 0)
                                            {{ $usersCount }} total
                                            @else
                                            0 total
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <hr>
                                <div class="stats">
                                    <i class="fa fa-calendar-plus-o"></i>
                                    Last day
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="uk-width-1-4@xl uk-width-1-3@l uk-width-1-2@m uk-width-1-1@s">
                    <div class="card">
                        <div class="content">
                            <div class="row">
                                <div class="uk-grid-collapse" uk-grid>
                                    <div class="uk-width-1-3">
                                        <i class="fa fa-book icon-big" style="color:#534847;"></i>
                                    </div>
                                    <div class="uk-width-2-3">
                                        <div class="number">
                                            <p>Posts</p>
                                            @if($articlesCount > 0)
                                            {{ $articlesCount }} record
                                            @else
                                            0 record
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <hr>
                                <div class="stats">
                                    <i class="fa fa-calendar-plus-o"></i>
                                    Last day
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="uk-width-1-4@xl uk-width-1-3@l uk-width-1-2@m uk-width-1-1@s">
                    <div class="card">
                        <div class="content">
                            <div class="row">
                                <div class="uk-grid-collapse" uk-grid>
                                    <div class="uk-width-1-3">
                                        <i class="fa fa-chain icon-big" style="color:#D81159;"></i>
                                    </div>
                                    <div class="uk-width-2-3">
                                        <div class="number">
                                            <p>Playlist</p>
                                            @if($seriesCount > 0)
                                            {{ $seriesCount }} series
                                            @else
                                            0 series
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <hr>
                                <div class="stats">
                                    <i class="fa fa-calendar-plus-o"></i>
                                    Last day
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="uk-width-1-4@xl uk-width-1-3@l uk-width-1-2@m uk-width-1-1@s">
                    <div class="card">
                        <div class="content">
                            <div class="row">
                                <div class="uk-grid-collapse" uk-grid>
                                    <div class="uk-width-1-3">
                                        <i class="fa fa-user icon-big" style="color:#56445D;"></i>
                                    </div>
                                    <div class="uk-width-2-3">
                                        <div class="number">
                                            <p>Staff</p>
                                            @if($staffsCount > 0)
                                            {{ $staffsCount }} staffs
                                            @else
                                            0 staff
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <hr>
                                <div class="stats">
                                    <i class="fa fa-calendar-plus-o"></i>
                                    Last day
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="uk-width-1-4@xl uk-width-1-3@l uk-width-1-2@m uk-width-1-1@s">
                    <div class="card">
                        <div class="content">
                            <div class="row">
                                <div class="uk-grid-collapse" uk-grid>
                                    <div class="uk-width-1-3">
                                        <i class="fa fa-bookmark icon-big" style="color:#4F86C6;"></i>
                                    </div>
                                    <div class="uk-width-2-3">
                                        <div class="number">
                                            <p>Category</p>
                                            @if($categoriesCount & $categoriesCount > 0)
                                            {{ $categoriesCount }} lists
                                            @else
                                            0 lists
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <hr>
                                <div class="stats">
                                    <i class="fa fa-calendar-plus-o"></i>
                                    Last day
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="uk-width-1-4@xl uk-width-1-3@l uk-width-1-2@m uk-width-1-1@s">
                    <div class="card">
                        <div class="content">
                            <div class="row">
                                <div class="uk-grid-collapse" uk-grid>
                                    <div class="uk-width-1-3">
                                        <i class="fa fa-tags icon-big" style="color:#EC7357;"></i>
                                    </div>
                                    <div class="uk-width-2-3">
                                        <div class="number">
                                            <p>Tags</p>
                                            @if($tagsCount > 0)
                                            {{ $tagsCount }} tags
                                            @else
                                            0 tags
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <hr>
                                <div class="stats">
                                    <i class="fa fa-calendar-plus-o"></i>
                                    Last day
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="uk-width-1-4@xl uk-width-1-3@l uk-width-1-2@m uk-width-1-1@s">
                    <div class="card">
                        <div class="content">
                            <div class="row">
                                <div class="uk-grid-collapse" uk-grid>
                                    <div class="uk-width-1-3">
                                        <i class="fa fa-video-camera icon-big" style="color:#E71D36;"></i>
                                    </div>
                                    <div class="uk-width-2-3">
                                        <div class="number">
                                            <p>Video</p>
                                            @if($videosCount > 0)
                                            {{ $videosCount }} episodes
                                            @else
                                            0 episodes
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <hr>
                                <div class="stats">
                                    <i class="fa fa-calendar-plus-o"></i>
                                    Last day
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="uk-width-1-4@xl uk-width-1-3@l uk-width-1-2@m uk-width-1-1@s">
                    <div class="card">
                        <div class="content">
                            <div class="row">
                                <div class="uk-grid-collapse" uk-grid>
                                    <div class="uk-width-1-3">
                                        <i class="fa fa-soundcloud icon-big" style="color:#a5d296;"></i>
                                    </div>
                                    <div class="uk-width-2-3">
                                        <div class="number">
                                            <p>MP3 SOUND</p>
                                            @if($soundsCount)
                                            {{ $soundsCount }} sounds
                                            @else
                                            0 sounds
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <hr>
                                <div class="stats">
                                    <i class="fa fa-calendar-plus-o"></i>
                                    Last day
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="uk-width-1-4@xl uk-width-1-3@l uk-width-1-2@m uk-width-1-1@s">
                    <div class="card">
                        <div class="content">
                            <div class="row">
                                <div class="uk-grid-collapse" uk-grid>
                                    <div class="uk-width-1-3">
                                        <i class="fa fa-folder-open icon-big" style="color:#9055A2;"></i>
                                    </div>
                                    <div class="uk-width-2-3">
                                        <div class="number">
                                            <p>File Manager</p>
                                            @if($filesCount > 0)
                                            {{ $filesCount }} files
                                            @else
                                            0 files
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <hr>
                                <div class="stats">
                                    <i class="fa fa-calendar-plus-o"></i>
                                    Last day
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="uk-section">
        <div class="uk-container">
            <div class="uk-width-1-1">
                <div class="card">
                    <div class="card-header">
                        <h2 class="title">
                            Users Behavior
                        </h2>
                        <span class="title-span">24 hours Performance</span>
                    </div>

                    <div class="content">
                        <div class="row">
                            <div id="chartHours" class="chart"></div>
                        </div>
                    </div>

                    <div class="card-footer">

                    </div>
                </div>
            </div>

            <div class="uk-width-1-1 uk-grid-collapse uk-child-width-expand@m" uk-grid>

                <div class="padding-right@m">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="title">
                                Users Behavior
                            </h2>
                            <span class="title-span">24 hours Performance</span>
                        </div>

                        <div class="content">
                            <div class="row">
                                <div id="chartPreferences" class="chart"></div>
                            </div>
                        </div>

                        <div class="card-footer">

                        </div>
                    </div>
                </div>

                <div class="padding-left@m">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="title">
                                Users Behavior
                            </h2>
                            <span class="title-span">24 hours Performance</span>
                        </div>

                        <div class="content">
                            <div class="row">
                                <div id="chartActivity" class="chart"></div>
                            </div>
                        </div>

                        <div class="card-footer">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script_dependencies')
    <script src="{{ asset('admins/plugins/morris/morris.min.js') }}"></script>
    <script src="{{ asset('admins/js/chartist.min.js') }}"></script>
    <script src="{{ asset('js/chartist-tooltip.js') }}"></script>
    <script src="{{ asset('admins/js/dashboard.js') }}"></script>
@endpush

@section('script')
    <script>
        $(document).ready(function(){
            BIGK.chart.initChart();
        });
    </script>
@endsection

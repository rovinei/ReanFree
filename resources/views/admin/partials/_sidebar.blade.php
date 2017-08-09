<div class="sidebar">
    <div class="inner">
        <div class="sidebar-heading">
            <h3 style="display:none;">១៨០<span>MEDIA &amp; NEWS</span></h3>
            <img src="{{ asset('images/logo/site_logo_large.png') }}">
        </div>
        <div class="main-nav">
            <ul>
                <li>
                    <a class="active" href="{{ route('admin.dashboard.alias') }}">
                        <i class="fa fa-line-chart"></i>
                        Dashboard
                    </a>
                </li>

                <li>
                    <a href="#"><i class="fa fa-pencil-square-o"></i> Post</a>
                    <div class="dropdown-nav">

                        <ul class="">
                            <li class="">
                                <a href="{{ route('admin.posts') }}">
                                    <i class="fa fa-newspaper-o"></i> List All Posts
                                </a>
                            </li>
                            <li class="">
                                <a href="{{ route('admin.post.videos') }}">
                                    <i class="fa fa-play"></i> Videos
                                </a>
                            </li>
                            <li class="">
                                <a href="{{ route('admin.post.articles') }}">
                                    <i class="fa fa-newspaper-o"></i> Articles
                                </a>
                            </li>
                            <li class="">
                                <a href="{{ route('admin.post.audios') }}">
                                    <i class="fa fa-music"></i> Audios
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.post.create') }}">
                                    <i class="fa fa-plus-square-o"></i>
                                    Publish New Post
                                </a>
                            </li>
                        </ul>

                    </div>
                </li>
                <li>
                    <a href="#"><i class="fa fa-tags"></i> Tag</a>
                    <div class="dropdown-nav">

                        <ul class="">
                            <li class="uk-active">
                                <a href="{{ route('admin.tags') }}">
                                    <i class="fa fa-newspaper-o"></i> List All Tags
                                </a>
                            </li>
                        </ul>

                    </div>
                </li>
                <li>
                    <a href="#"><i class="fa fa-bookmark-o"></i> Category</a>
                    <div class="dropdown-nav">

                        <ul class="">
                            <li class="uk-active">
                                <a href="{{ route('admin.categories') }}">
                                    <i class="fa fa-newspaper-o"></i> Categories List
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.category.create') }}">
                                    <i class="fa fa-plus-square-o"></i>
                                    Create Category
                                </a>
                            </li>
                        </ul>

                    </div>
                </li>

                <li>
                    <a href="#"><i class="fa fa-chain"></i> Album &amp; Playlist</a>
                    <div class="dropdown-nav">

                        <ul class="">
                            <li class="uk-active">
                                <a href="{{ route('admin.series') }}">
                                    <i class="fa fa-book"></i> Albums &amp; Playlist Record
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.article_series') }}">
                                    <i class="fa fa-newspaper-o"></i>
                                    Article Series
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.audio_albums') }}">
                                    <i class="fa fa-music"></i>
                                    Audio Albums
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.video_playlists') }}">
                                    <i class="fa fa-play"></i>
                                    Video Playlists
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.serie.create') }}">
                                    <i class="fa fa-plus-square-o"></i>
                                    Create Album | Playlist | Serie
                                </a>
                            </li>
                        </ul>

                    </div>
                </li>

                <li>
                    <a href="#"><i class="fa fa-chain"></i> Partner &amp; Sponsor</a>
                    <div class="dropdown-nav">

                        <ul class="">
                            <li class="uk-active">
                                <a href="{{ route('admin.partners') }}">
                                    <i class="fa fa-book"></i> Partner List
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.partner.create') }}">
                                    <i class="fa fa-newspaper-o"></i>
                                    Create New Partner
                                </a>
                            </li>
                        </ul>

                    </div>
                </li>

                <li>
                    <a href="#"><i class="fa fa-users"></i> Author Management</a>
                    <div class="dropdown-nav">
                        <ul class="">
                            <li class="uk-active">
                                <a href="{{ route('admin.author.manage') }}">
                                    <i class="fa fa-book"></i>
                                    Manage Author
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.author.create') }}">
                                    <i class="fa fa-newspaper-o"></i>
                                    Register Author
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

            </ul>
        </div>
    </div>
</div>

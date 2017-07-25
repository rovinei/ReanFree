
<!-- Navigation bar -->
<div class="site_header">
    <div class="inner">
        <div class="uk-container uk-container-center">
            <div class="header-wrapper">
                <div class="site_logo">
                    <a href="{{ url('/') }}" class="uk-display-block">
                        <img src="{{ asset('images/logo/site_logo_large.png') }}" alt="180 INSPIRE site logo">
                    </a>
                </div>

                <div class="navigation-wrapper">
                    <div class="header-nav__type">
                        <div class="inner">
                            <ul class="uk-hidden-small header-nav__left custom-navbar">
                                <li>
                                    <a data-toggle=".reading_menu" href="#" class="toggle_menu custom-a__link font-en-opensans active">
                                        <i class="fa fa-newspaper-o"></i>
                                        <span>Reading</span>
                                    </a>
                                </li>
                                <li>
                                    <a data-toggle=".listen_menu" href="#" class="toggle_menu custom-a__link font-en-opensans">
                                        <i class="fa fa-music"></i>
                                        <span>Listen</span>
                                    </a>
                                </li>
                                <li>
                                    <a data-toggle=".video_menu" href="#" class="toggle_menu custom-a__link font-en-opensans">
                                        <i class="fa fa-play"></i>
                                        <span>Video</span>
                                    </a>
                                </li>
                            </ul>

                            <div class="header-nav__right">
                                <div class="header-nav__search">
                                    <form method="get" action="{{ route('visitor.search') }}">
                                        <input type="text" name="q" placeholder="Search" id="header-nav__search-input" class="search-input"/>
                                        <label for="header-nav__search-input" class="search-icon"><i class="fa fa-search"></i></label>
                                    </form>
                                </div>

                                <div class="header-nav__social">
                                    <ul>
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-facebook-official"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-youtube"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="header-nav__category">
                        <div class="inner">
                            <ul class="uk-hidden-small category_menu custom-navbar active reading_menu">
                                @if(!empty($reading_menus))
                                    @foreach($reading_menus->categories as $category)
                                    <li>
                                        <a href="{{ route('visitor.article.category', $category->id) }}" class="custom-a__link font-kh-nokora">
                                            {{ $category->name }}
                                        </a>
                                    </li>
                                    @endforeach
                                @endif
                            </ul>

                            <ul class="uk-hidden-small category_menu custom-navbar listen_menu">
                                @if(!empty($listen_menus))
                                    @foreach($listen_menus->categories as $category)
                                    <li>
                                        <a href="{{ route('visitor.audio.category', $category->id) }}" class="custom-a__link font-kh-nokora">
                                            {{ $category->name }}
                                        </a>
                                    </li>
                                    @endforeach
                                @endif
                            </ul>

                            <ul class="uk-hidden-small category_menu custom-navbar video_menu">
                                @if(!empty($video_menus))
                                    @foreach($video_menus->categories as $category)
                                    <li>
                                        <a href="{{ route('visitor.video.category', $category->id) }}" class="custom-a__link font-kh-nokora">
                                            {{ $category->name }}
                                        </a>
                                    </li>
                                    @endforeach
                                @endif
                            </ul>

                            <!-- Display up to 767px -->
                            <ul class="uk-visible-small header-nav__left custom-navbar">
                                <li>
                                    <a data-toggle=".reading_menu" href="#" class="toggle_menu custom-a__link font-en-opensans">
                                        <i class="fa fa-newspaper-o"></i>
                                        <span>Reading</span>
                                    </a>
                                </li>
                                <li>
                                    <a data-toggle=".listen_menu" href="#" class="toggle_menu custom-a__link font-en-opensans">
                                        <i class="fa fa-music"></i>
                                        <span>Listen</span>
                                    </a>
                                </li>
                                <li>
                                    <a data-toggle=".video_menu" href="#" class="toggle_menu custom-a__link font-en-opensans">
                                        <i class="fa fa-play"></i>
                                        <span>Video</span>
                                    </a>
                                </li>
                            </ul>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Responsive navigation menu -->
    <div class="responsive-navigation">
        <div class="uk-container uk-container-center">
            <div class="inner uk-visible-small">

                <div id="closeMenu">
                    <span></span>
                </div>

                <ul class="category_menu custom-navbar reading_menu active">
                    @if(!empty($reading_menus))
                        @foreach($reading_menus->categories as $category)
                        <li>
                            <a href="{{ route('visitor.article.category', $category->id) }}" class="custom-a__link font-kh-nokora">
                                {{ $category->name }}
                            </a>
                        </li>
                        @endforeach
                    @endif
                </ul>

                <ul class="category_menu custom-navbar listen_menu">
                    @if(!empty($listen_menus))
                        @foreach($listen_menus->categories as $category)
                        <li>
                            <a href="{{ route('visitor.article.category', $category->id) }}" class="custom-a__link font-kh-nokora">
                                {{ $category->name }}
                            </a>
                        </li>
                        @endforeach
                    @endif
                </ul>

                <ul class="category_menu custom-navbar video_menu">
                    @if(!empty($video_menus))
                        @foreach($video_menus->categories as $category)
                        <li>
                            <a href="{{ route('visitor.article.category', $category->id) }}" class="custom-a__link font-kh-nokora">
                                {{ $category->name }}
                            </a>
                        </li>
                        @endforeach
                    @endif
                </ul>
            </div>
        </div>
    </div>
    <!-- `/Responsive naigation menu -->
</div>
<!-- /Navigation bar -->
<div class="top-header__gap"></div>

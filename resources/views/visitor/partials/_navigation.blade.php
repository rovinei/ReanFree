
<!-- Navigation bar -->
<div class="site_header">
    <div class="inner">
        <div class="uk-container uk-container-center">
            <div class="header-wrapper">
                <div class="site_logo">
                    <img src="{{ asset('images/logo/site_logo_large.png') }}" alt="180 INSPIRE site logo">
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
                                    <input type="text" name="q" placeholder="Search" id="header-nav__search-input" class="search-input"/>
                                    <label for="header-nav__search-input" class="search-icon"><i class="fa fa-search"></i></label>
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
                                <li>
                                    <a href="#" class="custom-a__link font-kh-siemreap">
                                        សង្គម
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="custom-a__link font-kh-siemreap">
                                        សិល្បះកម្សាន្ត
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="custom-a__link font-kh-siemreap">
                                       បច្ចេកវិទ្យា
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="custom-a__link font-kh-siemreap">
                                        អក្សរសាស្ត្រ
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="custom-a__link font-kh-siemreap">
                                        គំនិតជោគជ័យ
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="custom-a__link font-kh-siemreap">
                                        សុខភាព​និងសម្រស់
                                    </a>
                                </li>
                            </ul>

                            <ul class="uk-hidden-small category_menu custom-navbar listen_menu">
                                <li>
                                    <a href="#" class="custom-a__link font-kh-siemreap">
                                        គំនិតជោគជ័យ
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="custom-a__link font-kh-siemreap">
                                        ល្ខោននិយាយ
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="custom-a__link font-kh-siemreap">
                                       បទយកការណ៍
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="custom-a__link font-kh-siemreap">
                                        ប្រវត្តសាស្រ្តនិងវប្បធម៏
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="custom-a__link font-kh-siemreap">
                                        ព្រះធម៌
                                    </a>
                                </li>

                            </ul>

                            <ul class="uk-hidden-small category_menu custom-navbar video_menu">
                                <li>
                                    <a href="#" class="custom-a__link font-kh-siemreap">
                                        តាមផ្លូវ
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="custom-a__link font-kh-siemreap">
                                        គូរស្នេហ៏
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="custom-a__link font-kh-siemreap">
                                       ជញ្ជាំងអង្គរ
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="custom-a__link font-en-opensans-cond">
                                        Be Professional
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="custom-a__link font-en-opensans-cond">
                                        Short Film/MV
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="custom-a__link font-kh-siemreap">
                                        សុខភាព​និងសម្រស់
                                    </a>
                                </li>
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
                    <li>
                        <a href="#" class="custom-a__link font-kh-siemreap">
                            សង្គម
                        </a>
                    </li>
                    <li>
                        <a href="#" class="custom-a__link font-kh-siemreap">
                            សិល្បះកម្សាន្ត
                        </a>
                    </li>
                    <li>
                        <a href="#" class="custom-a__link font-kh-siemreap">
                           បច្ចេកវិទ្យា
                        </a>
                    </li>
                    <li>
                        <a href="#" class="custom-a__link font-kh-siemreap">
                            អក្សរសាស្ត្រ
                        </a>
                    </li>
                    <li>
                        <a href="#" class="custom-a__link font-kh-siemreap">
                            គំនិតជោគជ័យ
                        </a>
                    </li>
                    <li>
                        <a href="#" class="custom-a__link font-kh-siemreap">
                            សុខភាព​និងសម្រស់
                        </a>
                    </li>
                </ul>

                <ul class="category_menu custom-navbar listen_menu">
                    <li>
                        <a href="#" class="custom-a__link font-kh-siemreap">
                            គំនិតជោគជ័យ
                        </a>
                    </li>
                    <li>
                        <a href="#" class="custom-a__link font-kh-siemreap">
                            ល្ខោននិយាយ
                        </a>
                    </li>
                    <li>
                        <a href="#" class="custom-a__link font-kh-siemreap">
                           បទយកការណ៍
                        </a>
                    </li>
                    <li>
                        <a href="#" class="custom-a__link font-kh-siemreap">
                            ប្រវត្តសាស្រ្តនិងវប្បធម៏
                        </a>
                    </li>
                    <li>
                        <a href="#" class="custom-a__link font-kh-siemreap">
                            ព្រះធម៌
                        </a>
                    </li>

                </ul>

                <ul class="category_menu custom-navbar video_menu">
                    <li>
                        <a href="#" class="custom-a__link font-kh-siemreap">
                            តាមផ្លូវ
                        </a>
                    </li>
                    <li>
                        <a href="#" class="custom-a__link font-kh-siemreap">
                            គូរស្នេហ៏
                        </a>
                    </li>
                    <li>
                        <a href="#" class="custom-a__link font-kh-siemreap">
                           ជញ្ជាំងអង្គរ
                        </a>
                    </li>
                    <li>
                        <a href="#" class="custom-a__link font-en-opensans-cond">
                            Be Professional
                        </a>
                    </li>
                    <li>
                        <a href="#" class="custom-a__link font-en-opensans-cond">
                            Short Film/MV
                        </a>
                    </li>
                    <li>
                        <a href="#" class="custom-a__link font-kh-siemreap">
                            សុខភាព​និងសម្រស់
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- `/Responsive naigation menu -->
</div>
<!-- /Navigation bar -->
<div class="top-header__gap"></div>

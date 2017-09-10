
<!-- Navigation bar -->
<div class="site_header">
    <div class="inner">
        <div class="uk-container uk-container-center">
            <div class="header-wrapper">
                <div class="site_logo">
                    <a href="{{ url('/') }}" class="uk-display-block">
                        <img src="{{ asset('images/logo/logo_168x90.png') }}" alt="Rean Free site logo">
                        <div class="hambuger_menu" id="toggleMenu">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </a>
                </div>

                <div class="navigation-wrapper">
                   <ul>
                        <li>
                            <a href="{{ route('visitor.index.page') }}">
                                Home
                            </a>
                        </li>
                    @if(!empty($menus))
                        @foreach($menus as $menu)
                        <li>
                            @if($menu->children->count() > 0)
                                @if($menu->mediatype_id == 1)
                                <a class="has-dropdown" href="{{ route('visitor.article.category', $menu->slug) }}">
                                    {{ $menu->name }}
                                </a>
                                @elseif($menu->mediatype_id == 3)
                                <a class="has-dropdown" href="{{ route('visitor.video.category', $menu->slug) }}">
                                    {{ $menu->name }}
                                </a>
                                @endif

                                <ul>
                                @foreach($menu->children as $child)
                                    <li>
                                    @if($child->mediatype_id == 1)
                                        <a class="has-dropdown" href="{{ route('visitor.article.category', $child->slug) }}">
                                            {{ $child->name }}
                                        </a>
                                        @elseif($child->mediatype_id == 3)
                                        <a class="has-dropdown" href="{{ route('visitor.video.category', $child->slug) }}">
                                            {{ $child->name }}
                                        </a>
                                    @endif
                                    </li>
                                @endforeach
                                </ul>
                            @else
                            @if($menu->mediatype_id == 1)
                                <a href="{{ route('visitor.article.category', $menu->slug) }}">
                                    {{ $menu->name }}
                                </a>
                                @elseif($menu->mediatype_id == 3)
                                <a href="{{ route('visitor.video.category', $menu->slug) }}">
                                    {{ $menu->name }}
                                </a>
                                @endif
                            @endif
                        </li>
                        @endforeach
                    @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /Navigation bar -->
<div class="top-header__gap"></div>

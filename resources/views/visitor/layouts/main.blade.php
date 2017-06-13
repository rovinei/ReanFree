<html>
<head>
    @includeIf('visitor.partials._head')
    @stack('styles')
</head>
<body id="main-body">
    @includeIf('visitor.partials._navigation')
    @yield('slideshow')

    <div class="page-wrapper__bg">
        @yield('content')
    </div>

    @includeIf('visitor.partials._footer')
    <!-- Required script -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('lib/modernizr/modernizr.min.js') }}"></script>
    <script src="{{ asset('lib/uikit2/js/uikit.min.js') }}"></script>
    <script src="{{ asset('lib/uikit2/js/components/sticky.min.js') }}"></script>
    <script src="{{ asset('lib/uikit2/js/components/slideshow.min.js') }}"></script>
    <script src="{{ asset('lib/uikit2/js/components/slideshow-fx.min.js') }}"></script>
    <script src="{{ asset('lib/uikit2/js/components/pagination.min.js') }}"></script>
    <script src="{{ asset('lib/uikit2/js/components/grid.min.js') }}"></script>
    <script src="{{ asset('lib/uikit2/js/components/slideset.min.js') }}"></script>
    <script src="{{ asset('lib/uikit2/js/components/lightbox.min.js') }}"></script>
    <script src="{{ asset('js/script.js') }}"></script>
    @stack('script_dependencies')
    @yield('script')
    <script>
      (function(d, s, id){
         var js, fjs = d.getElementsByTagName(s)[0];
         if (d.getElementById(id)) return;
         js = d.createElement(s); js.id = id;
         js.src = "//connect.facebook.net/es_LA/sdk.js";
         fjs.parentNode.insertBefore(js, fjs);
       }(document, 'script', 'facebook-jssdk'));
    </script>
</body>
</html>

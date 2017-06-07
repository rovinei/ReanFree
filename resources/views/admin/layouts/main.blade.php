<html>
<head>
    @include('admin.partials._header')
    @stack('styles')
</head>
<body>
    <div class="page-wrapper">

        @includeIf('admin.partials._sidebar')

        <div class="main-panel">
            @includeIf('admin.partials._navbar')
            @yield('content')
        </div>

        @includeIf('admin.partials._footer')
    </div>
</body>
    <script src="{{ asset('js/manifest.js') }}"></script>
    <script src="{{ asset('js/vendor.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('lib/uikit/js/uikit.min.js') }}"></script>
    <script src="{{ asset('lib/modernizr/modernizr.min.js') }}"></script>
    <!-- FastClick -->
    <script src="{{ asset('admin/plugins/fastclick/fastclick.min.js') }}"></script>
    @stack('script_dependencies')

    @yield('script')
</html>

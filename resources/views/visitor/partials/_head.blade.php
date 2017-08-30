
<title>@yield('page_title')</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="description" content="">
<meta name="domain" content="{{ url('/') }}">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Facebook web master meta -->
@if(!empty($fbMeta))
<meta property="og:url"           content="{{ $fbMeta->url }}" />
<meta property="og:type"          content="{{ $fbMeta->type }}" />
<meta property="og:title"         content="{{ $fbMeta->title }}" />
<meta property="og:description"   content="{{ $fbMeta->description }}" />
<meta property="og:image"         content="{{ $fbMeta->image }}" />
@else
<meta property="og:url"           content="http://180inspires.com" />
<meta property="og:type"          content="website" />
<meta property="og:title"         content="180 INSPIRES MEDIAS &amp; NEWS WEBSITE" />
<meta property="og:description"   content="We are the next leading media and news website in cambodia" />
<meta property="og:image"         content="http://180inspires.com/images/website_default_image.jpg" />
@endif

<link href="https://fonts.googleapis.com/css?family=Hanuman|Nokora" rel="stylesheet">

<link href="https://fonts.googleapis.com/css?family=Fasthand|Freehand|Metal|Open+Sans+Condensed:300,400,600|Open+Sans:400,500,600|Siemreap|Taprom&amp;subset=khmer" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="{{ asset('lib/font-awesome/css/font-awesome.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('lib/uikit2/css/uikit.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('lib/uikit2/css/components/slideshow.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('lib/uikit2/css/components/sticky.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('lib/uikit2/css/components/dotnav.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('lib/uikit2/css/components/slidenav.gradient.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">

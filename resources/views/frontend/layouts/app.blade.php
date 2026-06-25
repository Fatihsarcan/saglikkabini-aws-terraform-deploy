<!DOCTYPE html>
<html lang="zxx">
 <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>{{$seo['title'] ?? config('app.name')}}</title>
    <meta name="description" content="{{$seo['description'] ?? config('app.name')}}">
    <meta name="keywords" content="{{$seo['keywords'] ?? config('app.name')}}">
    <meta name="author" content="{{$seo['author'] ?? config('app.name')}}">
    <meta name="robots" content="{{$seo['robots'] ?? 'index, follow'}}">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@sağlıkkabini">
    <meta name="twitter:creator" content="@sağlıkkabinii">
    <meta name="twitter:title" content="{{$seo['title'] ?? config('app.name')}}">
    <meta name="twitter:description" content="{{$seo['description'] ?? config('app.name')}}">
    <meta name="twitter:image" content="{{$seo['image'] ?? ''}}">
    <meta property="og:title" content="{{$seo['title'] ?? config('app.name')}}">
    <meta property="og:description" content="{{$seo['description'] ?? config('app.name')}}">
    <meta property="og:image" content="{{$seo['image'] ?? ''}}">
    <meta property="og:url" content="{{$seo['url'] ?? ''}}">
    <meta property="og:site_name" content="{{ config('app.name') ?? ''}}">
    <meta property="og:type" content="website">


    <link rel="apple-touch-icon" sizes="57x57" href="{{asset('img/favicon/apple-icon-57x57.png')}}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{asset('img/favicon/apple-icon-60x60.png')}}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{asset('img/favicon/apple-icon-72x72.png')}}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('img/favicon/apple-icon-76x76.png')}}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{asset('img/favicon/apple-icon-114x114.png')}}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{asset('img/favicon/apple-icon-120x120.png')}}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{asset('img/favicon/apple-icon-144x144.png')}}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{asset('img/favicon/apple-icon-152x152.png')}}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('img/favicon/apple-icon-180x180.png')}}">
    <link rel="icon" type="image/png" sizes="192x192"  href="{{asset('img/favicon/android-icon-192x192.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('img/favicon/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{asset('img/favicon/favicon-96x96.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('img/favicon/favicon-16x16.png')}}">
    <link rel="manifest" href="{{asset('manifest.json')}}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{asset('img/favicon/ms-icon-144x144.png')}}">
    <meta name="theme-color" content="#ffffff">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&amp;display=swap">
    <link rel="stylesheet" href="{{asset('css/plugins.css')}}" />
    <link rel="stylesheet" href="{{asset('css/style.css')}}" />
    <link rel="stylesheet" href="{{ asset('css/breadcrumb.css') }}">
    @yield('css')
</head>
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-7C26G4DDBT">
</script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-7C26G4DDBT');
</script>

<body>
    <!-- Preloader -->
    <div class="preloader-bg"></div>
    <div id="preloader">
        <div id="preloader-status">
            <div class="preloader-position loader"> <span></span> </div>
        </div>
    </div>
    <!-- Progress scroll totop -->
    <div class="progress-wrap cursor-pointer">
        <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
        </svg>
    </div>
    <!-- Navbar -->
    @include('frontend.inc.header')

    @yield('content')
    <!-- Footer -->
    @include('frontend.inc.footer')
    <!-- jQuery -->
    <script src="{{asset('js/jquery-3.6.3.min.js')}}"></script>
    <script src="{{asset('js/jquery-migrate-3.0.0.min.js')}}"></script>
    <script src="{{asset('js/modernizr-2.6.2.min.js')}}"></script>
    <script src="{{asset('js/imagesloaded.pkgd.min.js')}}"></script>
    <script src="{{asset('js/jquery.isotope.v3.0.2.js')}}"></script>
    <script src="{{asset('js/popper.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/scrollIt.min.js')}}"></script>
    <script src="{{asset('js/jquery.waypoints.min.js')}}"></script>
    <script src="{{asset('js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('js/jquery.stellar.min.js')}}"></script>
    <script src="{{asset('js/jquery.magnific-popup.js')}}"></script>
    <script src="{{asset('js/YouTubePopUp.js')}}"></script>
    <script src="{{asset('js/select2.js')}}"></script>
    <script src="{{asset('js/datepicker.js')}}"></script>
    <script src="{{asset('js/smooth-scroll.min.js')}}"></script>
    <script src="{{asset('js/custom.js')}}"></script>
    @yield('js')
</body>
 </html>

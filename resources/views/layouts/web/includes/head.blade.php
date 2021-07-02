<title>@yield('title', config('app.name'))</title>
<meta charset="utf-8">
<meta name="robots" content="index, all"/>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<meta name="keywords" content="@yield('meta_keywords', config('app.name'))" />
<meta name="description" content="@yield('meta_description', config('app.name'))" />


<meta property="og:type"  content="website" />
<meta property="og:site_name" content="topsol.be">
<meta property="og:image" content="https://inservco.be/upload/pages/image-1-19.jpeg"/>

<meta property="og:title" content="@yield('title', config('app.name'))"/>
<meta property="og:url" content="https://{{ $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] }}" />
<meta property="og:description" content="@yield('meta_description', config('app.name'))"/>


<!-- favicon links -->
<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('img/favicons/apple-touch-icon.png') }}">
<link rel="icon" type="image/png" href="{{ asset('img/logo.png') }}" sizes="32x32">
<link rel="icon" type="image/png" href="{{ asset('img/logo.png') }}" sizes="16x16">
<link rel="mask-icon" href="{{  asset('img/favicons/safari-pinned-tab.svg') }}" color="#5bbad5">
<meta name="theme-color" content="#ffffff">



<!-- CSRF token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- styles -->
@stack('styles')

<link rel="stylesheet" href="{{ asset('packages/sweetalert2/sweetalert2.min.css') }}">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

<!-- scripts -->
<script>
    window.Laravel = <?php echo json_encode([
        'csrfToken' => csrf_token(),
    ]); ?>
</script>

<script type="application/ld+json">
    {
      "@context": "http://schema.org",
      "@type": "Organization",
      "name": "Topsol",
      "url": "https://wwww.topsol.be",
      "address": "Avenue de la Réforme 13, B-1083 Ganshoren,Bruxelles",
      "sameAs" : ["https://www.facebook.com/"]
    }
    </script>
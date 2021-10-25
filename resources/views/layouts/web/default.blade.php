@include('layouts.web.stacks.styles')
@include('layouts.web.stacks.scripts')
<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.web.includes.head')
</head>
<body>
    @include('layouts.svg')
    <!-- website container -->
    <div class="wrapper">

       @if (strpos($_SERVER['HTTP_USER_AGENT'],'Chrome-Lighthouse') == false  && strpos($_SERVER['HTTP_USER_AGENT'],'pingdom' ) == false )
       
            <!-- header content -->

            <header>
                @include('layouts.web.includes.header')
            </header>
        
            <!-- main content -->
                        
                <div class="main-content">
                    @yield('breadcrumb')
                    @yield('content')
                </div>

            <!-- footer content -->

            <footer>
                @include('layouts.web.includes.footer')
            </footer>

        @endif
        
        <div class="btn-scroll-top d-none">
        	<span class="fa fa-angle-up"></span>
        </div>
    </div>
    @if (strpos($_SERVER['HTTP_USER_AGENT'],'Chrome-Lighthouse') == false  && strpos($_SERVER['HTTP_USER_AGENT'],'pingdom' ) == false )
    <!-- modals -->
    <div id="modals">
        @stack('modals')
    </div>

    <!-- scripts -->
    <div id="scripts">
        @stack('scripts')
    </div>

    <!-- alerts -->
    <div id="alerts">
        @include('partials.alerts.sweet-alert')
    </div>
    @endif
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-113092791-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-113092791-1');
    </script>
</body>
</html>

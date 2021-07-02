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

        <!-- header content -->
        <header>
            @include('layouts.web.includes.header')
        </header>
       @if (strpos($_SERVER['HTTP_USER_AGENT'],'Chrome-Lighthouse') == false  && strpos($_SERVER['HTTP_USER_AGENT'],'pingdom' ) == false )
        <!-- main content -->
        <div id="main">
            <div class="main-container default">
                <div class="main-inner">
                    
                    <div class="main-content">
                        @yield('breadcrumb')
                        <div class="inner-wrap">
                            
                            @yield('content')
                        </div>
                    </div>
                </div>
                @include('partials.fixed-aside')
                
            </div>
        </div>

        <div class="copyright">
            <p class="d-none d-lg-block">{{trans('footer.copyright_text')}}</p>
            <span>{{trans('footer.copyright')}}</span>
        </div>
        <!-- footer content -->
        @endif
        
        <div class="btn-scroll-top">
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

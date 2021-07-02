@include('layouts.web.stacks.styles')
@include('layouts.web.stacks.scripts')
<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.web.includes.head')
</head>
<body>
    <!-- website container -->
    <div class="container-fluid">
    	<div class="row">
    		<div class="col-md-2">
    		
    			<!-- sidebar content -->
        		<div id="sidebar">
                    @include('layouts.web.includes.sidebar')
                </div>
    		</div>
    		
            <div class="col-md-10">
            
            	<!-- header content -->
            	<header class="">
                    @include('layouts.web.includes.header-login')
                </header>
                
                 <!-- page content -->
                <div id="content">
                    @yield('content')
                </div>
            </div>
    	</div>
    </div>

        <!-- footer content -->
        <!-- <footer class="">
            @include('layouts.web.includes.footer')
        </footer> -->
  

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
</body>
</html>
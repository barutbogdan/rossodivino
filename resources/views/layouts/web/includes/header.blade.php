<div class="container-fluid">
	<div class="row align-items-center">
		<div class="d-xl-block d-none col-xl-3 rossodivino_header_left">
			<div class="rossodivino_inner">
				<div class="rossodivino_inner_h_contact">
					<div class="rossodivino_h_phone">{{settings('phone')}}0700 000 000</div>
					<div class="rossodivino_h_wh">09:00 am – 22:00 pm</div>
				</div>
			</div>
		</div>
		<div class="col-12 col-xl-6 rossodivino_header_center">
			<div class="rossodivino_def_header">
				<div class="rossodivino_logo_cont">
					<a href="{{url('/')}}" title="{{settings('site_name')}}" class="rossodivino_image_logo"></a>
				</div>
				<nav class="rossodivino_menu_cont">
					<ul id="menu-main-menu" class="rossodivino_menu d-flex flex-wrap align-items-center justify-content-center">
						@foreach($menus as $menu)
							<li class="back-content">
								@include('partials.header.menu', ['parent' => $menu])
								<!-- @include('partials.header.submenu', ['parent' => $menu, 'childrens' => $menu->childrens]) 
								@include('partials.header.submenu', ['parent' => $menu, 'childrens' => $menu->servicesCategories])  -->
							</li>
						@endforeach
					</ul>
				</nav>
				<div class="clear"></div>
			</div>
			<div class="mobile_header ">
				<a href="{{url('/')}}"  title="{{settings('site-name')}}" class="rossodivino_image_logo"></a>
				<a href="javascript:void(0)" class="btn_mobile_menu">
					<span class="rossodivino_menu_line1"></span>
					<span class="rossodivino_menu_line2"></span>
					<span class="rossodivino_menu_line3"></span>
				</a>
			</div>
			<div class="mobile_menu_wrapper">
				<ul class="mobile_menu">
					@foreach($menus as $menu)
						<li class="back-content">
							@include('partials.header.menu', ['parent' => $menu])
							<!-- @include('partials.header.submenu', ['parent' => $menu, 'childrens' => $menu->childrens]) 
							@include('partials.header.submenu', ['parent' => $menu, 'childrens' => $menu->servicesCategories])  -->
						</li>
					@endforeach
				</ul>
			</div>
		</div>
		<div class="d-none col-xl-3 rossodivino_header_right d-none">
			<div class="rossodivino_inner">
				<a href="cart.html">
					<div class="rossodivino_shopping_cart">
						<div class="rossodivino_total_price">$0.00</div>
						<div class="rossodivino_total_items">0 items - View Cart</div>
						<div class="rossodivino_cart_item_counter">0</div>
					</div>
				</a>
			</div>
		</div>
	</div>
</div>

<div class="d-none">
<div class="top-header d-flex d-lg-none">

	<ul class="info-list">
		<li>
			<svg width="9px" height="12px"><use xlink:href="#phone"></use></svg>
			<a href="tel:{{settings('contact_phone_number')}}" title="{{settings('contact_phone_number')}}">{{settings('contact_phone_number')}}</a>
		</li>
		
		<li>
			<svg width="12px" height="9px"><use xlink:href="#email"></use></svg>
			<a href="mailto:{{ settings('contact_email_address') }}" title="{{ settings('contact_email_address') }}">{{ settings('contact_email_address') }}</a>
		</li>
	</ul>
	<ul class="lang d-none d-lg-flex">
		@foreach(\LanguageSelector::getLanguages() as $lang) 
			@if(!$loop->first) <li>|</li> @endif
			<li class="{{ $lang['active'] ? 'active' : '' }}">
        			<a href="{{ ($lang['name']=='FR'?'/':$lang['url']) }}" title="{{ $lang['name'] }}">
        				{{ $lang['name'] }}
        			</a>
        		</li>
		@endforeach
	</ul>
	<div class="main-btn contact-formular d-flex d-lg-none radius">Formulair de contact</div>
</div>
<div class="bottom-header">

	<a class="logo d-block back-content" href="{{ url('/') }}" title="{{ settings('site_name') }}">
		<svg width="123px" height="123px"><use xlink:href="#logo"></use></svg>
	</a>
	<div class="navigation main">

		<div class="hamburger d-block d-xl-none d-lg-none">
			<span></span>
			<span></span>
			<span></span>
		</div>
		<nav>
			<div class="close-menu d-block d-lg-none"><i class="fas fa-times"></i></div>
			<ul>
				@foreach($menus as $menu)
					<li class="back-content">
						@include('partials.header.menu', ['parent' => $menu])
						@include('partials.header.submenu', ['parent' => $menu, 'childrens' => $menu->childrens]) 
						@include('partials.header.submenu', ['parent' => $menu, 'childrens' => $menu->servicesCategories]) 
					</li>
				@endforeach
			</ul>
		</nav>

	</div>
</div>
</div>

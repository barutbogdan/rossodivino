
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

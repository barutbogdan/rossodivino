@extends('layouts.web.default')

@push('styles')
    <link rel="stylesheet" href="{{ elixir('css/pages/coupons.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/styles/slick-theme.css') }}">
@endpush

@section('content')
	<div class="coupons-section">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 left-area">
					<div class="heading">
						<h2>Save Your Money with Online Deals</h2>
					</div>
					<h2></h2>
					<div class="row">
    					<div class="col-lg-6">
    						<div class="coupon">
        						<div class="item">
            						<div>
            							<sup>$</sup>
            							<span>25 off</span>
            							<p>{{ trans('homepage.on_system_analysis') }}</p>
            						</div>
            						<a href="" title="{{ trans('homepage.click_to_print') }}" class="main-btn small red">{{ trans('homepage.click_to_print') }}</a>
            						<p>{{ trans('homepage.coupon_description') }}</p>
            					</div>
            				</div>
    					</div>
    					<div class="col-lg-6">
    						<div class="coupon">
        						<div class="item">
            						<div>
            							<sup>$</sup>
            							<span>25 off</span>
            							<p>{{ trans('homepage.on_system_analysis') }}</p>
            						</div>
            						<a href="" title="{{ trans('homepage.click_to_print') }}" class="main-btn small red">{{ trans('homepage.click_to_print') }}</a>
            						<p>{{ trans('homepage.coupon_description') }}</p>
            					</div>
            				</div>
    					</div>
    					<div class="col-lg-6">
    						<div class="coupon">
        						<div class="item">
            						<div>
            							<sup>$</sup>
            							<span>25 off</span>
            							<p>{{ trans('homepage.on_system_analysis') }}</p>
            						</div>
            						<a href="" title="{{ trans('homepage.click_to_print') }}" class="main-btn small red">{{ trans('homepage.click_to_print') }}</a>
            						<p>{{ trans('homepage.coupon_description') }}</p>
            					</div>
            				</div>
    					</div>
    					<div class="col-lg-6">
    						<div class="coupon">
        						<div class="item">
            						<div>
            							<sup>$</sup>
            							<span>25 off</span>
            							<p>{{ trans('homepage.on_system_analysis') }}</p>
            						</div>
            						<a href="" title="{{ trans('homepage.click_to_print') }}" class="main-btn small red">{{ trans('homepage.click_to_print') }}</a>
            						<p>{{ trans('homepage.coupon_description') }}</p>
            					</div>
            				</div>
    					</div>
    				</div>
				</div>
				<div class="col-lg-4 right-area">
					<h2 class="box-heading">Pages</h2>
					<ul>
    					<li>
    						<a href="" title=""><span class="lnr lnr-chevron-right-circle"></span>About</a>
    					</li>
    					<li>
    						<a href="" title=""><span class="lnr lnr-chevron-right-circle"></span>Team</a>
    					</li>
    					<li>
    						<a href="" title=""><span class="lnr lnr-chevron-right-circle"></span>Careers</a>
    					</li>
					</ul>

					@include('partials.request_service.boxes')

					<div class="box">
						<div class="content">
							<h2>Financing Available</h2>
							<h4>With Approved Credit</h4>
							<a href="" title="Learn more" class="main-btn">Learn more</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@push('scripts')
    <script src="{{ elixir('js/pages/coupons.js') }}"></script>
@endpush
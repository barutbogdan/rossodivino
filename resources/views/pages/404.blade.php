@extends('layouts.web.default')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/pages/404.css') }}">
@endpush

@section('content')
	<div class="not-found-section section">
		<div class="container main-container">
			<div class="row">
				<div class="col-lg-6 text-center">
					<img src="{{asset('img/404.jpg')}}" alt="404">
				</div>
				<div class="col-lg-6">
					<h2>404</h2>
					<p><span style="display:block; margin-bottom:20px;">Ooops!</span>{!! trans('404.something_wrong') !!}</p>
					<a href="{{url('/')}}" title="{{trans('general.home')}}" class="main-btn bordered">{{trans('general.home')}}</a>
				</div>
			</div>
		</div>
	</div>
@endsection

@push('scripts')
	<script src="{{ elixir('js/pages/404.js') }}"></script>
	<script src="{{ asset('plugins/owl/owl.carousel2.min.js') }}"></script>
@endpush
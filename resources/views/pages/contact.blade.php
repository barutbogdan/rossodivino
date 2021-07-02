@extends('layouts.web.default')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/pages/contact.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pages/homepage.css') }}">
@endpush

@section('title', $page->seo_title)
@section('og:title', $page->seo_title)
@section('meta_keywords', $page->seo_keywords)
@section('meta_description', $page->seo_description)
@section('og:description', $page->seo_description)

@section('breadcrumb')
    @include('partials.breadcrumb', [
        'title' => $page->getTranslation()->seo_title,
        'parts' => [$page],
        'image' => $page->image,
        'link'	=>	$page->path
    ])
@endsection

@section('content')
	<section class="contact-section">
		<h2 class="title-1">{!! $page->getTranslation()->seo_title !!}</h2>
		<p class="text text-16 my-5">{!! $page->getTranslation()->seo_description !!}</p>
		<div class="row">
			<div class="col-md-6 form-area">
				<h4 class="small-title mb-1">{{trans("contact.formular-contact")}}</h4>
				<form class="needs-validation {{ $errors->count() ? 'was-validated' : '' }}" method="post" action="{{ route('contact.store') }}" novalidate>
					{{ csrf_field() }}

					<dl>
						<dt class="text text-16">{{trans("contact.name")}} *</dt>
						<dd><input id="first_name" class="form-control" type="text" name="name" required value="{{ old('first_name') }}" ></dd>
						@if($error = $errors->first('first_name'))
							<span class="invalid-feedback">{{ $error }}</span>
						@endif
					</dl>
					<dl>
						<dt class="text text-16">{{ trans('contact.address') }}</dt>
						<dd>
							<input id="address" class="form-control" type="text" name="address" required value="{{ old('address') }}" >
						</dd>
						@if($error = $errors->first('address'))
							<span class="invalid-feedback">{{ $error }}</span>
						@endif
					</dl>
					<dl>
						<dt class="text text-16">{{ trans('contact.phone') }}</dt>
						<dd>
							<input id="phone" class="form-control" type="phone" name="phone" required value="{{ old('phone') }}" >
						</dd>
						@if($error = $errors->first('phone'))
							<span class="invalid-feedback">{{ $error }}</span>
						@endif
					</dl>
					<dl>
						<dt class="text text-16">{{ trans('contact.email') }}</dt>
						<dd>
							<input id="email" class="form-control" type="email" name="email" required value="{{ old('email') }}" >
						</dd>
						@if($error = $errors->first('email'))
							<span class="invalid-feedback">{{ $error }}</span>
						@endif
					</dl>
					<dl class="for-textarea">
						<dt class="text text-16">{{ trans('contact.comments') }}</dt>
						<dd>
							<textarea id="comments" class="form-control" name="body" rows="7" required >{{ old('body') }}</textarea>
						</dd>
						@if($error = $errors->first('body'))
							<span class="invalid-feedback">{{ $error }}</span>
						@endif
					</dl>
					<div class="to-right">

						<div class="g-recaptcha" data-sitekey="6LfY6IkaAAAAAD-AuyiPPFTa6NqullIVfaQj_lLW" style="width:200px;"></div> 
						@if($error = $errors->first('g-recaptcha-response'))
							<span class="invalid-feedback">{{ $error }}</span>
						@endif
						<button class="main-btn radius ml-auto mt-3 back-content" type="submit">
							{{ trans('contact.submit') }}
						</button>
					</div>

				</form>
			</div>
			<div class="col-md-6 map-area">
			<h4 class="small-title mb-1">{{trans("contact.map")}}</h4>
				<div id="map"></div>
			</div>
		</div>
	</section>

@endsection

@push('scripts')
    <script src="{{ elixir('js/pages/contact.js') }}"></script>
    <script src="{{ asset('plugins/owl/owl.carousel2.min.js') }}"></script>
    <script type="text/javascript">
		
        function initMap() {
        	var la = 50.8554502;
    		var lo = 4.381678;
            var uluru = {lat: la, lng: lo};
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 16,
                scrollwheel: false,
                styles: [
            		  {
            		    "elementType": "geometry",
            		    "stylers": [
            		      {
            		        "color": "#f9f6ec"
            		      }
            		    ]
            		  },
            		  {
            		    "elementType": "labels.icon",
            		    "stylers": [
            		      {
            		        "visibility": "off"
            		      }
            		    ]
            		  },
            		  {
            		    "elementType": "labels.text.fill",
            		    "stylers": [
            		      {
            		        "color": "#616161"
            		      }
            		    ]
            		  },
            		  {
            		    "elementType": "labels.text.stroke",
            		    "stylers": [
            		      {
            		        "color": "#f5f5f5"
            		      }
            		    ]
            		  },
            		  {
            		    "featureType": "administrative.land_parcel",
            		    "elementType": "labels.text.fill",
            		    "stylers": [
            		      {
            		        "color": "#bdbdbd"
            		      }
            		    ]
            		  },
            		  {
            		    "featureType": "poi",
            		    "elementType": "geometry",
            		    "stylers": [
            		      {
            		        "color": "#eeeeee"
            		      }
            		    ]
            		  },
            		  {
            		    "featureType": "poi",
            		    "elementType": "labels.text.fill",
            		    "stylers": [
            		      {
            		        "color": "#757575"
            		      }
            		    ]
            		  },
            		  {
            		    "featureType": "poi.park",
            		    "elementType": "geometry",
            		    "stylers": [
            		      {
            		        "color": "red"
            		      }
            		    ]
            		  },
            		  {
            		    "featureType": "poi.park",
            		    "elementType": "labels.text.fill",
            		    "stylers": [
            		      {
            		        "color": "#9e9e9e"
            		      }
            		    ]
            		  },
            		  {
            		    "featureType": "road",
            		    "elementType": "geometry",
            		    "stylers": [
            		      {
            		        "color": "#ffffff"
            		      }
            		    ]
            		  },
            		  {
            		    "featureType": "road.arterial",
            		    "elementType": "labels.text.fill",
            		    "stylers": [
            		      {
            		        "color": "#bcbcbc"
            		      }
            		    ]
            		  },
            		  {
            		    "featureType": "road.highway",
            		    "elementType": "geometry",
            		    "stylers": [
            		      {
            		        "color": "red"
            		      }
            		    ]
            		  },
            		  {
            		    "featureType": "road.highway",
            		    "elementType": "labels.text.fill",
            		    "stylers": [
            		      {
            		        "color": "#bcbcbc"
            		      }
            		    ]
            		  },
            		  {
            		    "featureType": "road.local",
            		    "elementType": "labels.text.fill",
            		    "stylers": [
            		      {
            		        "color": "#9e9e9e"
            		      }
            		    ]
            		  },
            		  {
            		    "featureType": "transit.line",
            		    "elementType": "geometry",
            		    "stylers": [
            		      {
            		        "color": "#e5e5e5"
            		      }
            		    ]
            		  },
            		  {
            		    "featureType": "transit.station",
            		    "elementType": "geometry",
            		    "stylers": [
            		      {
            		        "color": "#eeeeee"
            		      }
            		    ]
            		  },
            		  {
            		    "featureType": "water",
            		    "elementType": "geometry",
            		    "stylers": [
            		      {
            		        "color": "red"
            		      }
            		    ]
            		  },
            		  {
            		    "featureType": "water",
            		    "elementType": "labels.text.fill",
            		    "stylers": [
            		      {
            		        "color": "blue"
            		      }
            		    ]
            		  }
            		],
            });

            var image = '/img/placeholder.png';

            var immoMarker = new google.maps.Marker({
                position: uluru,
                map: map,
                icon: image
            });

            var contentString = '<div id="content-map">' +
                '<div id="siteNotice">' +
                '</div>' +
                '<h1 id="firstHeading" class="firstHeading">Topsol</h1>' +
                
                '</div>';

            var infowindow = new google.maps.InfoWindow({
                content: contentString,
                maxWidth: 200,
            });

            google.maps.event.addListener(immoMarker, 'click', function () {
                infowindow.open(map, immoMarker);
            });

            infowindow.open(map, immoMarker);
            map.setCenter(uluru);
        }
    </script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDFEYBod7pBbeN35mkUz25Twxdlzqk-UL4&callback=initMap" async defer></script>
@endpush

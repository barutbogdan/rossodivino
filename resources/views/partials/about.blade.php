<section class="about-us-section section">
	<div class="container custom-container">
		<div class="row">
			<div class="col-lg-6 left-side">
				@if($aboutPage = page('AboutController'))
    				<h2 class="main-title">{{$aboutPage->getTranslation()->heading}}</h2>
    				<div class="description">
    					<p>{{ $aboutPage->getTranslation()->short_description }}</p>
    				</div>
				@endif
				@if($aboutPage = page('AboutController'))
					<a href="{{$aboutPage->path}}" class="main-btn black" title="{{trans('homepage.read-more')}}">{{trans('homepage.read-more')}}</a> 
				@endif
				<img src="{{asset('img/h2-img-1.png')}}" alt="{{trans('homepage.about-us-title')}}">
			</div>
			<div class="col-lg-6 right-side">
				<img src="{{ asset('img/untitled-0475.jpg')}}" alt="{{trans('homepage.about-us-title')}}">
			</div>
		</div>
	</div>
</section>
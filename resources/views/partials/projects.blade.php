@if($projects->count())
	<section class="gallery-section section">
		<div class="container custom-container">
			<div class="row">
				<div class="col-md-12 heading text-center">
					@if($projectsPage = page('ProjectsController'))
    					<h2 class="main-title">{{$projectsPage->getTranslation()->short_description}}</h2>
					@endif
				</div>
				<div class="col-md-12 gallery-category">
					<ul>
						@foreach($categories as $k=>$category)
							<li data-trigger='{{$category->getTranslation()->name}}'>
								@if($projectsPage = page('ProjectsController'))
									<a href="{{$projectsPage->path.'#'.str_replace(' ', '-',strtolower($category->getTranslation()->name))}}" title="{{$category->getTranslation()->name}}">
								@endif
    								@if($k==0)
    									<img src="{{asset('img/nunta.jpg')}}" alt="{{$category->getTranslation()->name}}">
    								@endif
    								@if($k==1)
    									<img src="{{asset('img/evenimente.jpg')}}" alt="{{$category->getTranslation()->name}}">
    								@endif
    								@if($k==2)
    									<img src="{{asset('img/aniversari.jpg')}}" alt="{{$category->getTranslation()->name}}">
    								@endif
    								@if($k==3)
    									<img src="{{asset('img/florarie.jpg')}}" alt="{{$category->getTranslation()->name}}">
    								@endif
    								@if($k==4)
    									<img src="{{asset('img/aniversari.jpg')}}" alt="{{$category->getTranslation()->name}}">
    								@endif
    								<div class="cover">
    									<h2>{{$category->getTranslation()->name}}</h2>
    								</div>
								@if($projectsPage = page('ProjectsController'))
								</a>
								@endif
							</li>
						@endforeach
					</ul>
				</div>
			</div>
		</div>
	</section>
@endif
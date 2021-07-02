@if($teams->count())
    <section class="team-section section">
    	<div class="container custom-container">
    		<div class="row">
    			<div class="col-md-12 heading text-center">
    				@if($teamPage = page('TeamController'))
    					<h2 class="main-title">{{$teamPage->getTranslation()->short_description}}</h2>
					@endif
    			</div>
    			@foreach($teams as $team)
    				<div class="col-lg-3 col-md-6 team">
    					<div class="profile">
    						<div class="image">
    							<img src="{{asset('/upload/'.$team->image)}}" alt="{{$team->getTranslation()->name}}">
    						</div>
    						<div class="info">
    							<h2>{{$team->getTranslation()->name}}</h2>
    							<h4>{{$team->getTranslation()->position}}</h4>
    							<ul class="socials">
                                    @if($facebook = settings('facebook'))
                                        <li>
                                            <a href="{{ $facebook }}" title="Facebook" target="_blank">
                                                <i class="fab fa-facebook-f"></i>
                                            </a>
                                        </li>
                                    @endif
                                    @if($twitter = settings('twitter'))
                                        <li>
                                            <a href="{{ $twitter }}" title="Twitter" target="_blank">
                                                <i class="fab fa-twitter"></i>
                                            </a>
                                        </li>
                                    @endif
                                    @if($linkedin = settings('linkedin'))
                                        <li>
                                            <a href="{{ $linkedin }}" title="Linkedin" target="_blank">
                                                <i class="fab fa-linkedin-in"></i>
                                            </a>
                                        </li>
                                    @endif
                                </ul>
    						</div>
    					</div>
    				</div>
    			@endforeach
    		</div>
    	</div>
	</section>
@endif
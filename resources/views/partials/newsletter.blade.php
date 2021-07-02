<section class="newsletter-section section">
	<div class="container custom-container">
		<div class="row">
			<div class="col-md-12">
				<h3 class="main-title white text-center">{{trans('homepage.newsletter-title')}}</h3>
				<form class="newsletter-form" method="post" action="{{ route('newsletter.store') }}">
					{{ csrf_field() }}
					<div class="{{ $errors->has('newsletter_email') ? 'has-errors' : '' }}">
						<input id="newsletter-email" type="email" name="newsletter_email" value="{{ old('newsletter_email') }}" placeholder="{{ trans('homepage.newsletter_email') }}">
					</div>
					<button class="main-btn all-black" type="submit">
						{{ trans('homepage.sign_me_up') }}
					</button>
				</form>
			</div>
		</div>
	</div>
</section>
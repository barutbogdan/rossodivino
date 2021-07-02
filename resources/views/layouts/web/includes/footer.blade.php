<section id="footer">
	<h2 class="aside-heading">{{trans('general.program-title')}}</h2>
	<div class="footer-inner">
		<div>
			<ul class="info">
				<li>
					<svg width="13px" height="14px"><use xlink:href="#address"></use></svg>	
					{{settings('footer_contact_str')}} <br>
					{{settings('footer_address_code')}} <br>
					{{settings('footer_city')}} <a target="_blank" rel="nofollow" href="{{settings('maps')}}" title="{{trans('general.plan-access')}}"><span>{{trans('general.plan-access')}}</span></a>
				</li>
				<li>
					<svg width="13px" height="14px"><use xlink:href="#phone-second"></use></svg>	
					<a href="tel:{{settings('contact_phone_number')}}" title="{{settings('contact_phone_number')}}">{{settings('contact_phone_number')}}</a>
				</li>
				<li>
					{{settings('tva')}}
				</li>
			</ul>

		</div>
		<div class="program">
			<div class="inner">
				<div>
					<ul>
						<li>M</li>
						<li>M</li>
						<li>V</li>
					</ul>
				</div>
				<div>{{settings('program_mmv')}}</div>
			</div>
			<div class="inner">
				<div>
					<ul>
						<li>J</li>
					</ul>
				</div>
				<div>{{settings('program_j')}}</div>
			</div>
			<div class="inner">
				<div>
					<ul>
						<li>S</li>
					</ul>
				</div>
				<div>{{settings('program_s')}}</div>
			</div>
			<div class="inner">
				<div>
					<ul class="gray">
						<li>D</li>
						<li>L</li>
					</ul>
				</div>
				<div>{{settings('program_dl')}}</div>
			</div>
		</div>
	</div>
</section>

@push('scripts')
@endpush

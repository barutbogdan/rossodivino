@php
	$showroomPage = page('ShowroomController');
    $servicesPage = page('ServicesController');
    $servicesEquipePage = page('ServicesEquipeController');
    $contactPage = page('ContactController');

@endphp

<aside class="fixed-aside">
    <div class="main-btn main-btn-aside d-none d-md-flex">{{trans('contact.formular-contact')}}</div>

    <div class="fixed-inner">
        <div class="top-details d-none d-lg-flex">
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
        </div>
        <section class="main-categories">
            <ul class="back-content">
                <li style="background:url('{{asset('upload/'.$showroomPage->image)}}') no-repeat center center / cover">
                    <a href="{{$showroomPage->path}}" title="{{$showroomPage->getTranslation()->name}}">{{$showroomPage->getTranslation()->name}}</a>
                </li>
                <li style="background:url('{{asset('upload/'.$servicesPage->image)}}') no-repeat center center / cover">
                    <a href="{{$servicesPage->path}}" title="{{$servicesPage->getTranslation()->name}}">{{$servicesPage->getTranslation()->name}}</a>
                </li>
                <li style="background:url('{{asset('upload/'.$servicesEquipePage->image)}}') no-repeat center center / cover">
                    <a href="{{$servicesEquipePage->path}}" title="{{$servicesEquipePage->getTranslation()->name}}">{{$servicesEquipePage->getTranslation()->name}}</a>
                </li>
            </ul>
        </section>

        @if($testimonials)
        
        <section class="testimonials-area section">
            <h3 class="aside-heading text-center text-md-left">{{trans('general.testimonials-title')}}</h3>
            <div class="testimonials-slider owl-carousel">
                @foreach($testimonials as $t)
                    <div class="item">
                        <p class="text-center text-md-left">{!!$t->getTranslation()->description !!}</p>
                        <div class="text-center text-md-left">
                            <h2 class="name">{{$t->getTranslation()->name}}</h2>
                            <h3> {{$t->getTranslation()->profession}}</h3>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
        @endif

        <footer>
            @include('layouts.web.includes.footer')
        </footer>
    </div>
</aside>

<section class="contact-popup-formular">
    <div class="popup-inner">
        <div class="pop-heading">
            <h2 class="title-2 white">Formulair de contact</h2>
            <div class="close-pop"><i class="fas fa-times"></i></div>
        </div>
        <div class="popup-content">
            <p class="text text-16">{!! $contactPage->getTranslation()->seo_description !!}</p>
            <form class="needs-validation mt-4 {{ $errors->count() ? 'was-validated' : '' }}" method="post" action="{{ route('contact.store') }}" novalidate>
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
                    <!--<div class="g-recaptcha" data-sitekey=""></div> 
                    //@if($error = $errors->first('g-recaptcha-response'))
                        <span class="invalid-feedback">{{ $error }}</span>
                    //@endif-->
                    <div class="g-recaptcha" data-sitekey="6LfY6IkaAAAAAD-AuyiPPFTa6NqullIVfaQj_lLW" style="width:200px;"></div> 
                    <button class="main-btn radius mt-3 ml-auto" type="submit">
                        {{ trans('contact.submit') }}
                    </button>
                </div>

            </form>
        </div>
    </div>
</section>
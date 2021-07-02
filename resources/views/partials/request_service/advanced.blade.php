<div class="request-service">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 left-side">
                <h2>{!! trans('request_service.request_service_today_title') !!}</h2>
                <p>{!! nl2br(trans('request_service.request_service_today_description')) !!}</p>
            </div>
            <div class="col-lg-6 right-side">
                <form method="post" action="{{ route('request_service.store') }}">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-lg-6 group">
                            <input id="request-service-name" type="text" name="request_service_name" required value="{{ old('request_service_name') }}">
                            <label for="request-service-name">{{ trans('homepage.name') }}*</label>
                        </div>
                        <div class="col-lg-6 group">
                            <input id="request-service-phone" type="tel" name="request_service_phone" required value="{{ old('request_service_phone') }}">
                            <label for="request-service-phone">{{ trans('homepage.phone') }}*</label>
                        </div>
                        <div class="col-lg-6 group">
                            <input id="request-service-email" type="email" name="request_service_email" required value="{{ old('request_service_email') }}">
                            <label for="request-service-email">{{ trans('homepage.email') }}*</label>
                        </div>
                        <div class="col-lg-6 group">
                            <input type="text" name="request_service_type" value="{{ old('request_service_type') }}" required readonly title="{{ trans('request_service.type_of_service') }}" placeholder="{{ trans('request_service.type_of_service') }}">
                            <i class="fa fa-chevron-down"></i>
                            <div class="dropdown">
                                <ul>
                                    @foreach($request_services as $service)
                                        <li>{{ $service->getTranslation()->name }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-12 group">
                            <input id="request-service-details" type="text" name="request_service_details" value="{{ old('request_service_details') }}">
                            <label for="request-service-details">{{ trans('homepage.help_you') }}</label>
                        </div>
                        <div class="col-lg-12 group">
                            <button class="main-btn" type="submit">
                                {{ trans('homepage.submit_request') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
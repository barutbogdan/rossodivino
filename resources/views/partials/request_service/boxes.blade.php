<h2 class="title-sidebar">{{ trans('homepage.request_estimate') }}</h2>
<form method="post" action="{{ route('request_service.store') }}">
    {{ csrf_field() }}
    <div>
        <input id="request-service-name" type="text" name="request_service_name" required value="{{ old('request_service_name') }}">
        <label for="request-service-name">{{ trans('homepage.name') }}*</label>
    </div>
    <div>
        <input id="request-service-email" type="email" name="request_service_email" required value="{{ old('request_service_email') }}">
        <label for="request-service-email">{{ trans('homepage.email') }}*</label>
    </div>
    <div>
        <input id="request-service-phone" type="tel" name="request_service_phone" required value="{{ old('request_service_phone') }}">
        <label for="request-service-phone">{{ trans('homepage.phone') }}*</label>
    </div>
    <div class="select">
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
    <textarea rows="3" placeholder="{{ trans('request_service.enter_any_additional_details') }}" name="request_service_details">{{ old('request_service_details') }}</textarea>
    <button class="main-btn" type="submit">
        {{ trans('homepage.submit_request') }}
    </button>
</form>
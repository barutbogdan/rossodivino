@if($partners->count())
    <div class="brands-section">
        <div class="container">
            <div class="row">
                <div class="brands-carousel owl-carousel">
                    @foreach($partners as $partner)
                        <div class="item">
                            <a href="{{ $partner->link }}" title="{{ $partner->name }}" target="_blank">
                                @if($partner->icon)
                                    {!! $partner->icon !!}
                                @else
                                    <img src="{{ $partner->image_path }}" alt="{{ $partner->name }}">
                                @endif
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endif
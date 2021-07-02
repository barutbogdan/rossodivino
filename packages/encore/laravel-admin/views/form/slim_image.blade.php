<div class="form-group {!! !$errors->has($errorKey) ?: 'has-error' !!}">

    <label for="{{$id}}" class="col-sm-{{$width['label']}} control-label">{{$label}}</label>

    <div class="col-sm-{{$width['field']}}">

        @include('admin::form.error')

        <div class="slim {{ $class }}">

            @if($preview)
                <img src="{{ $preview }}" alt="" />
            @endif

            <input type="file" name="{{ $name }}" {!! $attributes !!} />

        </div>

        @include('admin::form.help-block')

    </div>
</div>

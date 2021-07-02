<style>
    .nav-tabs > li:hover > i{
        display: inline;
    }
</style>
<div id="has-many-{{$column}}" class="nav-tabs-custom has-many-{{$column}}">

    <ul class="nav nav-tabs">
        @foreach($forms as $pk => $form)
            <li class="@if ($form == reset($forms)) active @endif ">
                <a href="#{{ $relationName . '_' . $pk }}" data-toggle="tab">
                    {{ $form->getLabel() }} <i class="fa fa-exclamation-circle text-red hide"></i>
                </a>
            </li>
        @endforeach
    </ul>

    <div class="tab-content has-many-{{$column}}-forms">
        @foreach($forms as $pk => $form)
            <div class="tab-pane fields-group has-many-{{$column}}-form @if ($form == reset($forms)) active @endif" id="{{ $relationName . '_' . $pk }}">
                @foreach($form->fields() as $field)
                    {!! $field->render() !!}
                @endforeach
            </div>
        @endforeach
    </div>

</div>
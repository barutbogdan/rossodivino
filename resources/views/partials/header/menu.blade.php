@if($parent->servicesCategories->count())
<a 
    data-id="{{$parent->id}}"    title="{{ $parent->getTranslation()->name }}" href="{!! $parent->path !!}" data-trigger="{{ str_replace(' ', '-', strtolower($parent->getTranslation()->name)) }}"
>
    {{ $parent->getTranslation()->name }}
</a>
@else
    <a

    class="@if(isset($page)) {{$parent->id == $page->id ? 'active' : ''}}  @endif" data-id="{{$parent->id}}" title="{{ $parent->getTranslation()->name }}"  data-trigger="{{ str_replace(' ', '-', strtolower($parent->getTranslation()->name)) }}"
    {!! ($parent->childrens->count() || $parent->servicesCategories->count() ? '' : 'href="' . ($parent->getTranslation()->name == 'Accueil'?'/':($parent->getTranslation()->name == 'Ontvangst'?'/nl':$parent->path )).'"') !!}
>
    {{ $parent->getTranslation()->name }}
</a>
@endif

@if($childrens->count())
    <i class="fa fa-chevron-down"></i>
    <div class="dropdown">
        <div class="content">
            <ul>
                @foreach($childrens as $children)
                    <li>
                        <a href="{{ $children->path }}" title="{{ $children->getTranslation()->name }}">
                            <i class="fas fa-chevron-right d-xl-none d-lg-none"></i>
                            {{ $children->getTranslation()->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endif

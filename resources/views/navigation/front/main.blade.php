<ul class="nav navbar-nav menu-center-1">
    @foreach($items as $item)
        @if($item->hasChildren() && $item->data('openable'))
            <li class="{{ $item->attr("class") }} has-menu" >
        @else
            <li class="{{ $item->attr("class") }}">      
        @endif
            <a href="{{ $item->url() }}" target="{{$item->attributes['target']}}">
                {!! $item->title !!}
                @if($item->hasChildren() && $item->data('openable'))
                    <span class="fa caret"></span>
                @endif
            </a>
            @if($item->hasChildren() && $item->data('openable'))
                <ul class="nav nav-{{ (isset($level) ? $level : 'second') }}-level">
                    @include('navigation.admin.sidebar', array('items' => $item->children(), 'level' => 'second'))
                </ul>
            @endif
        </li>
    @endforeach
</ul>
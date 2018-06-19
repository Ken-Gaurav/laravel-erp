@foreach($items as $item)
<P>HELLO</P>
    <li class="{{ $item->attr("class") }}">
        <a href="{{ $item->url() }}">
            {!! $item->title !!}
            @if($item->hasChildren() && $item->data('openable'))
                <span class="fa arrow"></span>
            @endif
        </a>
        @if($item->hasChildren() && $item->data('openable'))
            <ul class="nav nav-{{ (isset($level) ? $level : 'second') }}-level">
                @include('navigation.admin.sidebar', array('items' => $item->children(), 'level' => 'third'))
            </ul>
        @endif
    </li>
@endforeach
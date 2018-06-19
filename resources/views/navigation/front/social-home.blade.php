<ul class="list-inline">
    @foreach($items as $item)
    <li class="infont" style="font-size: 40px;">
        <a href="{{ $item->url() }}" target="{{$item->attributes['target']}}">
            <i class="{{$item->data('icon')}} txt-white"></i>
        </a>
    </li>
    @endforeach
</ul>

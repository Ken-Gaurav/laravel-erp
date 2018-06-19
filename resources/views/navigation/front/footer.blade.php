<ul class="footer-style">
    @foreach($items as $item)
        <li>
            <a href="{{ $item->url() }}" target="{{$item->attributes['target']}}">
                <span>{!! $item->title !!}</span>
            </a>
        </li>
    @endforeach
</ul>
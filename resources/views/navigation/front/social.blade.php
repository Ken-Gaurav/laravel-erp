<ul class="footer-style">
    @foreach($items as $item)
        <li>
            <a href="{{ $item->url() }}" target="{{$item->attributes['target']}}">
                {!! $item->title !!}
            </a>
        </li>
    @endforeach
</ul>

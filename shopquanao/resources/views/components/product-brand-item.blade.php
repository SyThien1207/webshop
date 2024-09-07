<ul>
    @foreach ($listbrand as $rowbrand)
        <li>
            <a href="/san-pham/{{ $rowbrand->slug }}">
                {{ $rowbrand->name }}
                <span class="products-count">({{ $rowbrand->products_count }})</span>
            </a>
        </li>
    @endforeach
</ul>

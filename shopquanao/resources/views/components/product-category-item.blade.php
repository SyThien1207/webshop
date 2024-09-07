@if (count($listcategory) == 0)
<li>
    <a href="/san-pham/{{ $category_item->slug }}">{{ $category_item->name }}</a>
    @if($listcategory && $listcategory->products_count != 0)
        <span class="products-count">({{ $listcategory->products_count }})</span>
    @endif
</li>

@else
<li>
    <a href="#widget-category-1" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="widget-category-1">
    {{ $category_item->name }}<span class="products-count"></span>
        <span class="toggle"></span>
    </a>
    <div class="collapse show" id="widget-category-1">
        <ul class="cat-sublist">
        @foreach ($listcategory as $item)

            <li><a href="/san-pham/{{ $item->slug }}">{{$item->name}}<span class="products-count">({{ $item->products_count }})</span></a></li>
            @endforeach

        </ul>
    </div>
</li>

@endif
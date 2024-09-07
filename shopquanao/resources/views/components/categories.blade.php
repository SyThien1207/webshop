<div class="categories-slider owl-carousel owl-theme show-nav-hover nav-outer">
    @foreach ( $category as $row)
    <div class="product-category appear-animate" data-animation-name="fadeInUpShorter">
        <a href="/san-pham/{{ $row->slug }}">
            <figure>
                <img src="{{ asset('images/category/' . $row->image) }}" alt="{{ $row->image }}" style="width:220px; height:220px;object-fit: cover;" />
            </figure>
            <div class="category-content">
                <h3>{{$row->name}}</h3>
                <span><mark class="count">{{$row->products_count }}</mark> sản phẩm</span>
            </div>
        </a>
    </div>
    @endforeach



</div>
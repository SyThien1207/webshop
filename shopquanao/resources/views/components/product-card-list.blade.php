<div class="col-sm-12 col-6 product-default left-details product-list mb-2">
    <figure>
        <a href="product.html">
            <img src="{{ asset('images/product/' . $product->image) }}"style="width:250px; height:250px;object-fit: cover;" alt="{{ $product->image }}" />
            <img src="{{ asset('images/product/' . $product->image2) }}" style="width:250px; height:250px;object-fit: cover;" alt="{{ $product->image2 }}">
        </a>
    </figure>

    <div class="product-details">
        <div class="category-list">
            <a href="category.html" class="product-category">{{$product->category->name}}</a>
        </div>

        <h3 class="product-title"> <a href="/chi-tiet-san-pham/{{$product->id}}">{{$product->name}}</a>
        </h3>

        <div class="ratings-container">
          
            <!-- End .product-ratings -->
        </div>
        <!-- End .product-container -->

        <p class="product-description">       @php
                        $words = explode(' ', $product->description);
                        $limitedWords = array_slice($words, 0, 17);
                        @endphp
                        <p>{{ implode(' ', $limitedWords) }}{{ count($words) > 17 ? '...' : '' }}
                        </p>
        </p>

        <div class="price-box">
            @if($product->pricesale)
            <del class="old-price">{{ number_format($product->price )}}₫</del>
            <span class="product-price">{{ number_format($product->pricesale) }}₫</span>
            @else
            <span class="product-price">{{ number_format($product->price) }}₫</span>
            @endif
        </div>
        <!-- End .price-box -->

        <div class="product-action">
            <a href="wishlist.html" class="btn-icon-wish" title="wishlist"><i
                    class="icon-heart"></i></a>

            <a href="#" class="btn-icon btn-add-cart product-type-simple"
                onclick="handleAddCart({{$product->id}})" id="qty">
                <i class="icon-shopping-cart"></i><span>ADD TO CART</span>
            </a>
            <a href="ajax/product-quick-view.html" class="btn-quickview" title="Quick View"><i
                    class="fas fa-external-link-alt"></i></a>
        </div>
    </div>
    <!-- End .product-details -->
</div>
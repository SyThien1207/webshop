@php
use App\Models\OrderDetail;

// Tính tổng số lượng bán của sản phẩm từ bảng orderdetail
$totalSold = OrderDetail::where('product_id', $product->id)->sum('qty');

// Tính phần trăm giảm giá
$discountPercentage = 0;
if ($product->price > 0 && $product->pricesale > 0) {
$discountPercentage = (($product->price - $product->pricesale) / $product->price) * 100;
}

// Kiểm tra nếu sản phẩm là bán chạy
$isHot = $totalSold > 10; // Thay thế 100 bằng ngưỡng cụ thể của bạn

// Kiểm tra nếu sản phẩm có giảm giá
$isSale = $product->pricesale > 0;
@endphp
<div class="product-default appear-animate" data-animation-name="fadeInRightShorter">
  <figure>
    <a href="product.html">
      <img src="{{ asset('images/product/' . $product->image) }}" style="width:220px; height:220px;object-fit: cover;" alt="{{ $product->image }}">
      <img src="{{ asset('images/product/' . $product->image2) }}" style="width:220px; height:220px;object-fit: cover;" alt="{{ $product->image2 }}">
    </a>
    @if($isHot || $isSale)
    <div class="label-group">
      @if($isHot)
      <div class="product-label label-hot">HOT</div>
      @endif

      @if($isSale)
      <div class="product-label label-sale">-{{ number_format($discountPercentage) }}%</div>
      @endif
    </div>
    @endif

  </figure>
  <div class="product-details">
    <div class="category-list">
      <a href="category.html" class="product-category">{{$product->category->name}}</a>
    </div>
    <h3 class="product-title">
      <a href="/chi-tiet-san-pham/{{$product->id}}">{{$product->name}}</a>
    </h3>
    <div class="ratings-container">
      
      <!-- End .product-ratings -->
    </div>
    <!-- End .product-container -->
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
      <a href="wishlist.html" class="btn-icon-wish"  onclick="handleAddLike({{ $product->id }})" title="wishlist"><i
          class="icon-heart"></i></a>
      <input style=" display: none;" type="number" id="qty" name="qty" value="1" min="1" />
      <a href="" class="btn-icon btn-add-cart product-type-simple"
        onclick="handleAddCart({{$product->id}})">
        <i class="icon-shopping-cart"></i><span>Thêm giỏ hàng</span>
      </a>
      <a href="{{route('product.quick',['id'=>$product->id])}}" class="btn-quickview" title="Quick View"><i
          class="fas fa-external-link-alt"></i></a>
    </div>

  </div>
  <!-- End .product-details -->
</div>
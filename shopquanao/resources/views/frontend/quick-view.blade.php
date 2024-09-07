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
<div class="product-single-container product-single-default product-quick-view mb-0 custom-scrollbar">
    <div class="row">
        <div class="col-md-6 product-single-gallery mb-md-0">
            <div class="product-slider-container">
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

                <div class="product-single-carousel owl-carousel owl-theme show-nav-hover">
                    <div class="product-item">
                        <img id="main-product-image" class="product-single-image" src="{{ asset('images/product/' . $product->image) }}" width="468" height="468" alt="product" />
                    </div>

                </div>
                <!-- End .product-single-carousel -->
            </div>
            <div class="prod-thumbnail owl-dots">
              
                <img  src="{{ asset('images/product/' . $product->image) }}" width="110" height="110" alt="product-thumbnail" />

                @foreach($product->productimags as $productimag)
                <div class="owl-dot">
                    <img src="{{ asset('images/product/product_imag/' . $productimag->images) }}" width="110" height="110" alt="product-thumbnail"class="data-zoom-image" />
                </div>
                @endforeach
            </div>
        </div><!-- End .product-single-gallery -->

        <div class="col-md-6">
            <div class="product-single-details mb-0 ml-md-4">
                <h1 class="product-title">{{$product->name}}</h1>

                <div class="ratings-container">
                    <div class="product-ratings">
                        <span class="ratings" style="width:60%"></span><!-- End .ratings -->
                    </div><!-- End .product-ratings -->

                </div><!-- End .ratings-container -->

                <hr class="short-divider">

                <div class="price-box">
                @if($product->pricesale)
                        <del class="old-price">{{ number_format($product->price )}}₫</del>
                        <span class="product-price">{{ number_format($product->pricesale) }}₫</span>
                        @else
                        <span class="product-price">{{ number_format($product->price) }}₫</span>
                        @endif            

                <div class="product-desc">
                    <p>
                    @php
                        $words = explode(' ', $product->description);
                        $limitedWords = array_slice($words, 0, 17);
                        @endphp
                        <p>{{ implode(' ', $limitedWords) }}{{ count($words) > 20 ? '...' : '' }}
                        </p>
                    </p>
                </div><!-- End .product-desc -->

             

                <div class="product-filters-container">
                  

                    <div class="product-single-filter">
                    <ul class="single-info-list">
                    <!---->
                    <li>
                    Số lượng: <strong>{{$product->qty}}</strong>

                    </li>

                    <li>
                    Danh mục: <strong><a href="#" class="product-category">{{ $product->category ? $product->category->name : 'không có danh mục' }}</a></strong>

                    </li>
                    <li>
                            Thương hiệu: <strong><a href="#" class="product-category">{{ $product->brand ? $product->brand->name : 'không có thương hiệu' }}</a></strong>
                        </li>
                </ul>
                        <a class="font1 text-uppercase clear-btn" href="#">Clear</a>
                    </div>
                    <!---->
                </div>

                <div class="product-action">
                  

                    <div class="product-single-qty">
                        <input class="horizontal-quantity form-control" type="text" id="qty"/>
                    </div><!-- End .product-single-qty -->

                    <a href="javascript:;" class="btn btn-dark add-cart mr-2" title="Add to Cart"onclick="handleAddCart({{$product->id}})">Thêm vào giỏ hàng</a>

                    <a href="{{route('cart.index')}}" class="btn btn-gray view-cart d-none">Giỏ hàng</a>
                    </div><!-- End .product-action -->

                <hr class="divider mb-0 mt-0">

                <div class="product-single-share mb-0">
                    <label class="sr-only">Share:</label>

                    <div class="social-icons mr-2">
                        <a href="#" class="social-icon social-facebook icon-facebook" target="_blank"
                            title="Facebook"></a>
                        <a href="#" class="social-icon social-twitter icon-twitter" target="_blank" title="Twitter"></a>
                        <a href="#" class="social-icon social-linkedin fab fa-linkedin-in" target="_blank"
                            title="Linkedin"></a>
                        <a href="#" class="social-icon social-gplus fab fa-google-plus-g" target="_blank"
                            title="Google +"></a>
                        <a href="#" class="social-icon social-mail icon-mail-alt" target="_blank" title="Mail"></a>
                    </div><!-- End .social-icons -->

                    <a href="" class="btn-icon-wish add-wishlist" title="Add to Wishlist"><i
                            class="icon-wishlist-2"onclick="handleAddLike({{ $product->id }})"></i><span>Add to
                            Wishlist</span></a>
                </div><!-- End .product single-share -->
            </div>
        </div><!-- End .product-single-details -->

        <button title="Close (Esc)" type="button" class="mfp-close">
            ×
@extends('layouts.home')
@section('content')
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
<main class="main">
    <div class="container">
        <nav aria-label="breadcrumb" class="breadcrumb-nav">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/"><i class="icon-home"></i></a></li>
                <li class="breadcrumb-item"><a href="#">Chi tiết sản phẩm</a></li>
            </ol>
        </nav>

        <div class="product-single-container product-single-default">
       

            <div class="row">
                <div class="col-lg-5 col-md-6 product-single-gallery">
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
                        <span class="prod-full-screen">
                            <i class="icon-plus"></i>
                        </span>
                    </div>

                    <div class="prod-thumbnail owl-dots">

                        <img class="product-thumbnail" src="{{ asset('images/product/' . $product->image) }}" width="110" height="110" alt="product-thumbnail" />

                        @foreach($product->productimags as $productimag)
                        <div class="owl-dot">
                            <img class="product-thumbnail" src="{{ asset('images/product/product_imag/' . $productimag->images) }}" width="110" height="110" alt="product-thumbnail" />
                        </div>
                        @endforeach
                    </div>

                </div>
                <!-- End .product-single-gallery -->

                <div class="col-lg-7 col-md-6 product-single-details">
                    <h1 class="product-title">{{$product->name}}</h1>

                    <hr class="short-divider">

                    <div class="price-box">
                        @if($product->pricesale)
                        <del class="old-price">{{ number_format($product->price )}}₫</del>
                        <span class="product-price">{{ number_format($product->pricesale) }}₫</span>
                        @else
                        <span class="product-price">{{ number_format($product->price) }}₫</span>
                        @endif
                    </div>
                    <!-- End .price-box -->

                    <div class="product-desc">
                        <p>
                            {{$product->description}}
                        </p>
                    </div>
                    <!-- End .product-desc -->

                    <ul class="single-info-list">

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

                    <div class="product-action">
                        <div class="product-single-qty">
                            <input class="horizontal-quantity form-control" type="text" id="qty">
                        </div>
                        <!-- End .product-single-qty -->

                        <a href="javascript:;" id="btnThemVaoGioHang" class="btn btn-dark add-cart mr-2" title="Add to Cart" onclick="handleAddCart({{$product->id}})">Thêm vào giỏ hàng</a>

                        <a href="{{route('cart.index')}}" class="btn btn-gray view-cart d-none">Giỏ hàng</a>
                    </div>
                    <!-- End .product-action -->

                    <hr class="divider mb-0 mt-0">

                    <div class="product-single-share mb-3">
                        <label class="sr-only">Share:</label>

                        <div class="social-icons mr-2">
                            <a href="#" class="social-icon social-facebook icon-facebook" target="_blank" title="Facebook"></a>
                            <a href="#" class="social-icon social-twitter icon-twitter" target="_blank" title="Twitter"></a>
                            <a href="#" class="social-icon social-linkedin fab fa-linkedin-in" target="_blank" title="Linkedin"></a>
                            <a href="#" class="social-icon social-gplus fab fa-google-plus-g" target="_blank" title="Google +"></a>
                            <a href="#" class="social-icon social-mail icon-mail-alt" target="_blank" title="Mail"></a>
                        </div>
                        <!-- End .social-icons -->

                        <a href="" class="btn-icon-wish add-wishlist" title="Add to Wishlist"onclick="handleAddLike({{ $product->id }})"><i
                                class="icon-wishlist-2"></i><span>Add to
                                Wishlist</span></a>
                    </div>
                    <!-- End .product single-share -->
                </div>
                <!-- End .product-single-details -->
            </div>
            <!-- End .row -->
        </div>
        <!-- End .product-single-container -->

        <div class="product-single-tabs">
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="product-tab-desc" data-toggle="tab" href="#product-desc-content" role="tab" aria-controls="product-desc-content" aria-selected="true">Thông tin chi tiết về Sản phẩm</a>
                </li>


            </ul>

            <div class="tab-content">
                <div class="tab-pane fade show active" id="product-desc-content" role="tabpanel" aria-labelledby="product-tab-desc">
                    <div class="product-desc-content">
                        {!!$product->detail!!}
                    </div>
                    <!-- End .product-desc-content -->
                </div>

            </div>
            <!-- End .tab-content -->
        </div>
        <!-- End .product-single-tabs -->

        <div class="products-section pt-0">
            <h2 class="section-title">Sản phẩm liên quan</h2>

            <div class="products-slider owl-carousel owl-theme dots-top dots-small">
                @foreach ($product_list as $product_item)
                <x-product-card :productitem="$product_item" />
                @endforeach



            </div>
            <!-- End .products-slider -->
        </div>
        <!-- End .products-section -->

        <hr class="mt-0 m-b-5" />


        <!-- End .row -->
    </div>
    <!-- End .container -->
</main>

@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('.product-thumbnail').click(function() {
            // Lấy đường dẫn của hình ảnh thu nhỏ được nhấn
            var newImageSrc = $(this).attr('src');

            // Thay thế hình ảnh chính
            $('#main-product-image').attr('src', newImageSrc);

            // Cập nhật thuộc tính data-zoom-image nếu cần
            $('#main-product-image').attr('data-zoom-image', newImageSrc);
        });
    });
</script>
<div class="dropdown cart-dropdown">
    <a href="#" title="Cart" class="dropdown-toggle dropdown-arrow cart-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
        <i class="minicart-icon"></i> @php
        $count=count(session('carts',[]));
        @endphp
        <span class="cart-count badge-circle">{{$count}}</span>

        </button>
    </a>

    <div class="cart-overlay"></div>

    <div class="dropdown-menu mobile-cart">
        <a href="#" title="Close (Esc)" class="btn-close">×</a>

        <div class="dropdownmenu-wrapper custom-scrollbar">
            <div class="dropdown-cart-header">Giỏ hàng</div>
            <!-- End .dropdown-cart-header -->

            <div class="dropdown-cart-products">
                <form action="{{ route('cart.update') }}" method="post">
                    @csrf
                    @php

                    $totalMoney = 0;
                    @endphp
                    @foreach ($list_cart as $row_cart)
                    @php
                    $subtotal = $row_cart['price'] * $row_cart['qty'];
                    $totalMoney += $subtotal;
                    @endphp
                    <div class="product">
                        <div class="product-details">
                            <h4 class="product-title">
                                <a href="/chi-tiet-san-pham/{{ $row_cart['id'] }}">{{ $row_cart['name'] }}</a>
                            </h4>

                            <span class="cart-product-info">
                                <span class="cart-product-qty">{{ $row_cart['qty'] }}</span> × {{ number_format($row_cart['price']) }} vnd
                            </span>
                        </div>
                        <!-- End .product-details -->

                        <figure class="product-image-container">
                            <a href="product.html" class="product-image">
                                <img src="{{ asset('images/product/' . $row_cart['image']) }}" alt="{{ $row_cart['image'] }}" width="80" height="80">
                            </a>

                            <a href="{{route('cart.detele2',['id'=>$row_cart['id']])}}" class="btn-remove" title="Remove Product"><span>×</span></a>
                        </figure>
                    </div>
                    @endforeach

                    <!-- End .product -->

                </form>

                <!-- End .product -->
            </div>
            <!-- End .cart-product -->

            <div class="dropdown-cart-total">
                <span>Số tiền thanh toán:</span>

                <span class="cart-total-price float-right">{{ number_format($totalMoney) }} vnd</span>
            </div>
            <!-- End .dropdown-cart-total -->

            <div class="dropdown-cart-action">
                <a href="{{route('cart.index')}}" class="btn btn-gray btn-block view-cart">Giỏ hàng</a>
                <a href="{{route('cart.checkout')}}" class="btn btn-dark btn-block">Thanh toán</a>
            </div>
            <!-- End .dropdown-cart-total -->
        </div>
        <!-- End .dropdownmenu-wrapper -->
    </div>
    <!-- End .dropdown-menu -->
</div>
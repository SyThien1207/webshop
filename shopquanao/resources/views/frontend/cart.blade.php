@extends('layouts.home')
@section('content')
<link rel="stylesheet" href="{{asset('fe-asset')}}/assets/css/style.min.css">

<div class="content">
    <main class="main">
        <div class="container">
            <ul class="checkout-progress-bar d-flex justify-content-center flex-wrap">
                <li class="active">
                    <a href="{{route('cart.index')}}">Giỏ hàng</a>
                </li>
                <li>
                    <a href="{{route('cart.checkout')}}">Thanh toán</a>
                </li>
                <li class="disabled">
                    <a href="{{route('product.index')}}">Order Complete</a>
                </li>
            </ul>

            <!-- Cart Update Form -->
            <form action="{{ route('cart.update') }}" method="post">
                @csrf
                @php
                $totalMoney = 0;
                @endphp

                @if($message= Session::get('error'))
                <div class="alert alert-danger alert-block">
                    <button type="button" class="close" data-dismiss="alert">x</button>
                    <strong>{{$message}}</strong>
                </div>
				@elseif($message= Session::get('success'))
				<div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">x</button>
                    <strong>{{$message}}</strong>
                </div>
				
                @endif

                <div class="row">
                    <div class="col-lg-8">
                        <div class="cart-table-container">
                            <table class="table table-cart">
                                <thead>
                                    <tr>
                                        <th class="thumbnail-col"></th>
                                        <th class="product-col">Sản phẩm</th>
                                        <th class="price-col">Giá</th>
                                        <th class="qty-col">Số lượng</th>
                                        <th class="text-right">Thành tiền</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($list_cart as $row_cart)
                                    @php
                                    $subtotal = $row_cart['price'] * $row_cart['qty'];
                                    $totalMoney += $subtotal;
                                    @endphp
                                    <tr class="product-row">
                                        <td>
                                            <figure class="product-image-container">
                                                <a href="/chi-tiet-san-pham/{{ $row_cart['id'] }}" class="product-image">
                                                    <img src="{{ asset('images/product/' . $row_cart['image']) }}" alt="{{ $row_cart['image'] }}" style="height:50px;">
                                                </a>
                                                <a href="{{route('cart.detele',['id'=>$row_cart['id']])}}" class="btn-remove icon-cancel" title="Remove Product"></a>
                                            </figure>
                                        </td>
                                        <td class="product-col">
                                            <h5 class="product-title">
                                                <a href="/chi-tiet-san-pham/{{ $row_cart['id'] }}">{{ $row_cart['name'] }}</a>
                                            </h5>
                                        </td>
                                        <td>{{ number_format($row_cart['price']) }} vnd</td>
                                        <td>
                                            <div class="product-single-qty">
                                                <input class="horizontal-quantity form-control" name="qty[{{ $row_cart['id'] }}]" value="{{ $row_cart['qty'] }}" type="text">
                                            </div>
                                        </td>
                                        <td class="text-right"><span class="subtotal-price">{{ number_format($subtotal) }} vnd</span></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="5" class="clearfix">
                                            <div class="float-right">
                                                <button type="submit" class="btn btn-shop btn-update-cart">
                                                    Cập nhật giỏ hàng
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                    <!-- Coupon Application Form -->
                    <div class="col-lg-4">
                        <div class="cart-summary">
                            <h3>Tổng tiền: {{ number_format($totalMoney,0,',','.') }} VNĐ</h3>
                            <table class="table table-totals">
                                <tfoot>
                                    @if(Session::get('coupon'))
                                    @foreach(Session::get('coupon') as $key => $cou)
                                    @if($cou['coupon_condition'] == 1)
                                    <tr>
                                        <td>Mã giảm:</td>
                                        <td>{{ $cou['coupon_number'] }} %</td>
                                    </tr>
                                    <tr>
                                        @php
                                        $total_coupon = ($totalMoney * $cou['coupon_number']) / 100;
                                        @endphp
                                        <td>Tổng giảm:</td>
                                        <td>{{ number_format($total_coupon,0,',','.') }}đ</td>
                                    </tr>
                                    <tr>
                                        <td>Thanh toán:</td>
                                        <td>{{ number_format($totalMoney - $total_coupon,0,',','.') }}đ</td>
                                    </tr>
                                    @elseif($cou['coupon_condition'] == 2)
                                    <tr>
                                        <td>Mã giảm:</td>
                                        <td>{{ number_format($cou['coupon_number'], 0, ',', '.') }} VNĐ</td>
                                    </tr>
                                    @php
                                    $total_coupon = $totalMoney - $cou['coupon_number'];
                                    @endphp
                                    <tr>
                                        <td>Tổng đã giảm:</td>
                                        <td>{{ number_format($total_coupon, 0, ',', '.') }} VNĐ</td>
                                    </tr>
                                    @endif
                                    @endforeach
                                    @else
                                    <tr>
                                        <td>Số tiền cần thanh toán:</td>
                                        <td>{{ number_format($totalMoney,0,',','.') }} VNĐ</td>
                                    </tr>
                                    @endif
                                </tfoot>
                            </table>

                            <div class="checkout-methods">
                                <a href="{{route('cart.checkout')}}" class="btn btn-block btn-dark">Thanh toán <i class="fa fa-arrow-right"></i></a>
                            </div>

                            <!-- Separate Coupon Form -->
                          
                        </div>
                    </div>
                </div>
            </form> 
			 <div class="cart-discount" style="margin-top: -11%;">
                                <form action="{{ route('apply.coupon') }}" method="POST">
                                    @csrf
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-sm" placeholder="Mã Giảm Giá" name="coupon">
                                        <div class="input-group-append">
                                            <button class="btn btn-sm" name="check_coupon" type="submit" value="Tích mã giảm giá">Áp dụng</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
        </div>
    </main>
</div>

@endsection

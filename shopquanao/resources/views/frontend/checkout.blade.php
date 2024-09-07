@extends('layouts.home')
@section('content')
<link rel="stylesheet" href="{{asset('fe-asset')}}/assets/css/style.min.css">

<div class="content">
    <main class="main main-test">
        <div class="container checkout-container">
            <ul class="checkout-progress-bar d-flex justify-content-center flex-wrap">
                <li>
                    <a href="{{route('cart.index')}}">Giỏ hàng</a>
                </li>
                <li class="active">
                    <a href="{{route('cart.checkout')}}">Thanh toán</a>
                </li>
                <li class="disabled">
                    <a href="{{route('product.index')}}">Mua thêm</a>
                </li>
            </ul>

            @if (!Auth::check())
            <div class="login-form-container">
                <h4>Khách hàng đã trở lại?
                    <button data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" class="btn btn-link btn-toggle">Đăng nhập</button>
                </h4>

                <div id="collapseOne" class="collapse">
                    <div class="login-section feature-box">
                        <div class="feature-box-content">

                        <form action="{{ route("website.dologin") }}" method="post">
				@csrf

                        <p>
                                    Nếu bạn đã mua hàng với chúng tôi trước đây, vui lòng đăng nhập trước khi thanh toán. Nếu bạn là khách hàng mới, vui lòng tạo tài khoản trước khi thanh toán. </p>
       @if($message= Session::get('error'))
<div class="alert alert-danger alert-block">
	<button type="button" class="close" date-dismiss="alert">x</button>
	<strong>{{$message}}</strong>
</div>
@endif
                                <div class="row">
                         
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="mb-0 pb-1">Tên đăng nhập hoặc email <span
                                                    class="required">*</span></label>
                                            <input type="text"  name="username"class="form-control" required />
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="mb-0 pb-1">Mật khẩu <span
                                                    class="required">*</span></label>
                                            <input type="password"  name="password"class="form-control" required />
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn">Đăng nhập</button>
                                <a href="{{ route('website.register') }}" class=" btn-primary btn-md w-10">Đăng ký</a> <!-- Sử dụng thẻ <a> để điều hướng mà không gửi form -->

                                <div class="form-footer mb-1">
                                    <div class="custom-control custom-checkbox mb-0 mt-0">
                                        <input type="checkbox" class="custom-control-input" id="lost-password" />
                                        <label class="custom-control-label mb-0" for="lost-password">Nhớ tài khoản</label>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @else
            @php
            $user = Auth::user();
            @endphp
            <form action="{{ route('cart.docheckout') }}" method="post">
                @csrf
                @method('post')
                <div class="row">

                    <div class="col-lg-7">
                        <ul class="checkout-steps">
                            <li>
                                <h2 class="step-title">Chi tiết thanh toán</h2>


                                <div class="row">

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Tên đầy đủ
                                                <abbr class="required" title="required">*</abbr>
                                            </label>
                                            <input type="text" name="name" class="form-control" required value="{{ $user->name }}" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">


                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Số điện thoại
                                                <abbr class="required" title="required">*</abbr></label>
                                            <input type="text" name="phone" class="form-control" required value="{{ $user->phone }}" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Email
                                                <abbr class="required" title="required">*</abbr>
                                            </label>
                                            <input type="text" class="form-control" required value="{{ $user->email }}" />
                                        </div>
                                    </div>
                                </div>



                                <div class="form-group mb-1 pb-2">
                                    <label>Địa chỉ
                                        <abbr class="required" title="required">*</abbr></label>
                                    <input type="text" class="form-control" name="address" placeholder="House number and street name" required value="{{ $user->address }}" />
                                </div>


                                <div class="form-group">
                                    <label class="order-comments">Ghi chú (không bắt buộc)</label>
                                    <textarea class="form-control" name="note" placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
                                </div>

                            </li>
                        </ul>
                    </div>
                    <!-- End .col-lg-8 -->

                    <div class="col-lg-5">
                        <div class="order-summary">
                            <h3>Đơn hàng của bạn</h3>

                            <table class="table table-mini-cart">
                                <thead>
                                    <tr>
                                        <th colspan="2">Sản phẩm</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $totalMoney = 0;
                                    @endphp
                                    @foreach ($list_cart as $row_cart)
                                    <tr>
                                        <td class="product-col">
                                            <h3 class="product-title">
                                                {{ $row_cart['name'] }} ×
                                                <span class="product-qty">{{ $row_cart['qty'] }}</span>
                                            </h3>
                                        </td>

                                        <td class="price-col">
                                            <span>{{ number_format($row_cart['price'] * $row_cart['qty']) }} vnd</span>
                                        </td>
                                    </tr>
                                    @php
                                    $totalMoney += ($row_cart['price'] * $row_cart['qty']);
                                    @endphp
                                    @endforeach

                                </tbody>
                                <tfoot>
                                    <tr class="cart-subtotal">
                                        <td>
                                            <h4>Tổng tiền:</h4>
                                        </td>

                                        <td class="price-col">
                                            <span>{{ number_format($totalMoney) }} vnđ</span>
                                        </td>
                                    </tr>
                                    @if(Session::get('coupon'))
									@foreach(Session::get('coupon') as $key => $cou)
									@if($cou['coupon_condition'] == 1)
                                    <tr class="order-shipping">
                                        <td class="text-left" colspan="2">
                                            <h4 class="m-b-sm">Voucher giảm giá:</h4>

                                            <div class="form-group form-group-custom-control">
                                                <div>
                                                    <label class="custom-control-label" >Mã giảm: {{ $cou['coupon_number'] }} %</label>
                                                </div>
                                                <!-- End .custom-checkbox -->
                                            </div>
                                            <!-- End .form-group -->
                                            @php
										$total_coupon = ($totalMoney * $cou['coupon_number']) / 100;
										@endphp
                                            <div class="form-group form-group-custom-control mb-0">
                                                <div>
                                                    <label class="custom-control-label">Tổng giảm: {{number_format($total_coupon,0,',','.')}} vnđ</label>
                                                </div>
                                                <!-- End .custom-checkbox -->
                                            </div>
                                            <!-- End .form-group -->
                                        </td>

                                    </tr>
                                 
                                    <tr class="order-total">
                                        
                                        <td>
                                            <h4>Thanh toán:</h4>
                                        </td>
                                        <td>
                                            <b class="total-price"><span>{{ number_format($totalMoney - $total_coupon,0,',','.') }}vnđ</span></b>
                                        </td>
                                    </tr>
                                       @elseif($cou['coupon_condition'] == 2)
                                       <tr class="order-shipping">
                                        <td class="text-left" colspan="2">
                                            <h4 class="m-b-sm">Voucher giảm giá:</h4>

                                            <div class="form-group form-group-custom-control">
                                                <div>
                                                    <label class="custom-control-label">Mã giảm: {{ number_format($cou['coupon_number'],0,',','.') }} vnđ</label>
                                                </div>
                                                <!-- End .custom-checkbox -->
                                            </div>
                                            <!-- End .form-group -->
                                            @php
										$total_coupon = $totalMoney - $cou['coupon_number'];
										@endphp
                                           
                                            <!-- End .form-group -->
                                        </td>

                                    </tr>
                                 
                                    <tr class="order-total">
                                        
                                        <td>
                                            <h4>Thanh toán:</h4>
                                        </td>
                                        <td>
                                            <b class="total-price"><span>{{ number_format($total_coupon,0,',','.') }}vnđ</span></b>
                                        </td>
                                    </tr>
                                       @endif
									@endforeach
                                    @else
                                         <tr class="order-total">
                                        
                                        <td>
                                            <h4>Thanh toán:</h4>
                                        </td>
                                        <td>
                                            <b class="total-price"><span>{{ number_format($totalMoney) }}vnđ</span></b>
                                        </td>
                                    </tr>
									@endif
                                </tfoot>
                            </table>



                            <button type="submit" class="btn btn-dark btn-place-order">
                                Đặt hàng
                            </button>
                        </div>
                        <!-- End .cart-summary -->
                    </div>
                    <!-- End .col-lg-4 -->


                </div>
            </form>
            @endif

            <!-- End .row -->
        </div>
        <!-- End .container -->
    </main>
</div>

@endsection
@extends('layouts.home')
@section('content')
<div class="content">

<main class="main">
            <div class="page-header">
                <div class="container d-flex flex-column align-items-center">
                    <nav aria-label="breadcrumb" class="breadcrumb-nav">
                        <div class="container">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('home.index')}}">Trang chủ</a></li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Yêu thích
                                </li>
                            </ol>
                        </div>
                    </nav>

                    <h1>  Yêu thích</h1>
                </div>
            </div>

            <div class="container">
                <div class="wishlist-title">
                    <h2 class="p-2">Danh sách sản phẩm yêu thích</h2>
                </div>
                <div class="wishlist-table-container">
                    <table class="table table-wishlist mb-0">
                        <thead>
                            <tr>
                                <th class="thumbnail-col"></th>
                                <th class="product-col">Sản phẩm</th>
                                <th class="price-col">Giá</th>
                                <th class="status-col">Trạng thái</th>
                                <th class="action-col">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
            @foreach ($list_like as $row_like)

                            <tr class="product-row">
                                <td>
                                    <figure class="product-image-container">
                                    <a href="/chi-tiet-san-pham/{{ $row_like['id'] }}" class="product-image">
                                                <img src="{{ asset('images/product/' . $row_like['image']) }}" alt="{{ $row_like['image'] }}" style="height:50px;">
												</a>

												<a href="{{route('like.detele',['id'=>$row_like['id']])}}" class="btn-remove icon-cancel" title="Remove Product"></a>
                                    </figure>
                                </td>
                                <td>
                                    <h5 class="product-title">
                                    <a href="/chi-tiet-san-pham/{{ $row_like['id'] }}">{{ $row_like['name'] }}</a>											</h5>
                                    </h5>
                                </td>
                                <td class="price-box">{{ number_format($row_like['price']) }} vnd</td>
                                <td>
                                @if(isset($row_like['qty']) && $row_like['qty'] > 0)
                <span class="stock-status">Còn hàng</span>
            @else
                <span class="stock-status">Hết hàng</span>
            @endif

                                </td>
                                <td class="action">
                                    <a href="{{route('product.quick',['id'=>$row_like['id']])}}" class="btn btn-quickview mt-1 mt-md-0"
                                        title="Quick View">Xem nhanh</a>
      <input style=" display: none;" type="number" id="qty" name="qty" value="1" min="1" />

                                    <button class="btn btn-dark btn-add-cart product-type-simple btn-shop"  onclick="handleAddCart({{$row_like['id']}})">
                                        Mua
                                    </button>
                                </td>
                            </tr>
                            @endforeach

                     

                        </tbody>
                    </table>
                </div><!-- End .cart-table-container -->
            </div><!-- End .container -->
        </main><!-- End .main -->


</div>

@endsection
<div class="tab-pane fade" id="order" role="tabpanel">
    <div class="order-content">
        <h3 class="account-sub-title d-none d-md-block">
            <i class="sicon-social-dropbox align-middle mr-3"></i>Đơn Hàng
        </h3>
        <div class="order-table-container text-center">
            <table class="table table-order text-left">
                <thead>
                    <tr>
                        <th class="thumbnail-col"></th>
                        <th class="order-id">ĐƠN HÀNG</th>
                        <th class="order-date">NGÀY</th>
                        <th class="order-status">TRẠNG THÁI</th>
                        <th class="order-price">TỔNG CỘNG</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($cartItems as $order)
                    @foreach ($order->orderDetails as $orderDetail)
                    <tr>
                        <td> <img src="{{ asset('images/product/' . $orderDetail->product->image) }}" width="20" height="20" alt="{{ $orderDetail->product->image }}">
                        </td>
                        <td>{{ $orderDetail->product->name }}</td>
                        <td>{{ $order->created_at->format('d-m-Y') }}</td>
                        <td>
                            @if( $order->status ==4)Đang chờ xác nhận
                            @elseif($order->status ==3)Đang chuẩn bị hàng
                            @elseif($order->status ==2)Đang giao
                            @elseif($order->status ==1)Đã giao
                            @elseif($order->status ==5)Đã hủy
                            @endif
                        </td>
                        <td>{{ number_format($orderDetail->amount) }} vnđ</td>
                        <td>
                            @if($order->status ==4) 
                            <a href="{{route('profile.status',['id'=>$order['id']])}}" >Hủy đơn hàng
                            @endif
                        </a>
                        </td>

                    </tr>
                    @endforeach
                    @empty
                    <tr>
                        <td colspan="5">
                            <p class="mb-5 mt-5">Bạn chưa có đơn hàng</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            <hr class="mt-0 mb-3 pb-2" />
            <a href="category.html" class="btn btn-dark">Mua sắm ngay</a>
        </div>
    </div>
</div><!-- Kết thúc .tab-pane -->
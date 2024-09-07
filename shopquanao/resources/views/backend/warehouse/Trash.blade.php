@extends('layouts.dashboard')
@section('content')
<style>
    /* Định nghĩa chung cho tất cả các thẻ label */
    .label {
        display: inline-block;
        padding: 0.25em 0.4em;
        font-size: 75%;
        font-weight: 700;
        line-height: 1;
        text-align: center;
        white-space: nowrap;
        vertical-align: baseline;
        border-radius: 0.25rem;
    }

    /* Định nghĩa cho label thành công */
    .label-success {
        color: #fff;
        background-color: #28a745;
        border: 1px solid #28a745;
        /* Viền màu xanh */
    }

    /* Định nghĩa cho label cảnh báo */
    .label-warning {
        color: #212529;
        background-color: #ffc107;
        border: 1px solid #ffc107;
        /* Viền màu vàng */
    }

    /* Định nghĩa cho label nguy hiểm */
    .label-danger {
        color: #fff;
        background-color: #dc3545;
        border: 1px solid #dc3545;
        /* Viền màu đỏ */
    }

    .label-will {
        color: #fff;
        background-color: #33CC99;
        border: 1px solid #33CC99;
        /* Viền màu đỏ */
    }
</style>
<div class="content">
    <section class="content-header my-2">
    <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="mb-0">Thùng rác</h1>
            <a href="{{route('admin.warehouse.index')}}" class="btn btn-secondary">Trở lại</a>
        </div>

        <div class="row my-2 align-items-center">
          
            <div class="col-md-5 text-end">
    <form action="{{ route('admin.warehouse.trash') }}" method="GET" class="d-inline">
        <input type="text" name="search" class="search d-inline" value="{{ request()->get('search') }}" />
        <button type="submit" class="d-inline btnsearch">Tìm kiếm</button>
    </form>
</div>

           
        </div>
    </section>
    <section class="content-body my-2">

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Sản phẩm</th>
                    <th>Nhà cung cấp</th>
                    <th>Số lượng</th>
                 
                </tr>
            </thead>
            <tbody>
                @foreach($list as $row)

                <tr class="datarow">



                    <td>
                        <div class="name">
                            <a href="warehouse_edit.html">
                                {{$row->product->name}}
                            </a>
                        </div>
                        <div class="function_style">

                            @php
                            $agrs =['id'=>$row->id];
                            @endphp
                          
                          <a href="{{route("admin.warehouse.restore",$agrs)}}" class="text-primary mx-1">
                        <i class="bi bi-arrow-clockwise"></i>
                     </a>
                     <a href="{{route("admin.warehouse.delete",$agrs)}}" class="text-danger mx-1">
                        <i class="bi bi-trash2"></i>
                     </a>
                        </div>
                    </td>
                    <td>{{ $row->supplier ? $row->supplier->name : 'không có nhà cung cấp' }}</td>
                    <td>{{$row->qty}}</td>
                    

                </tr>
                @endforeach

            </tbody>
        </table>

    </section>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const priceInput = document.getElementById('price');
        const qtyInput = document.getElementById('qty');
        const totalPriceInput = document.getElementById('total_price');

        function calculateTotal() {
            const price = parseFloat(priceInput.value) || 0;
            const qty = parseInt(qtyInput.value) || 0;
            const totalPrice = price * qty;
            totalPriceInput.value = totalPrice;
        }

        priceInput.addEventListener('input', calculateTotal);
        qtyInput.addEventListener('input', calculateTotal);
    });
</script>
@endsection
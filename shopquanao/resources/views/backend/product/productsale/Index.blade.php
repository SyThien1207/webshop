@extends('layouts.dashboard')

@section('content')
<style>
    .percent-input-wrapper {
        position: relative;
        display: inline-block;
    }

    .percent-input-wrapper input {
        padding-right: 20px;
        /* Space for % sign */
    }

    .percent-input-wrapper .percent-sign {
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        pointer-events: none;
        /* Ensure % sign cannot be clicked */
    }
</style>
<div class="content">
    <section class="content-header my-2">
        <h1 class="d-inline">Sản phẩm giảm giá</h1>
        <hr style="border: none;" />
    </section>
    <section class="content-body my-2">
        <div class="row">


            <div class="row mt-3 align-items-center">
            <div class="col-5">
                    <ul class="manager">
                        <span><a class="bi bi-bookmark" href="category_index.html">Tất cả:{{ $activeCategoryCount1 }} </a></span>
                        <span>|</span>
                        <span><a class="bi bi-bookmark-check-fill" href="#"> Xuất bản:{{ $activeCategoryCount }}</a></span>
                        <span>|</span>
                        <span><a class="bi bi-trash2" href="{{route("admin.category.trash")}}"> Rác:{{ $activeCategoryCount2 }}</a></span>
                    </ul>
                </div>
                <div class="col-md-5 "> 

<form action="{{ route('admin.category.index') }}" method="GET" class="d-inline">
    <input type="text" name="search" class="search d-inline" value="{{ request()->get('search') }}" />
    <button type="submit" class="d-inline btnsearch">Tìm kiếm</button>
</form>
</div>
<div class="col-md-2 text-end">
            <a href="{{route('admin.product.index')}}" class="btn btn-secondary">Thêm</a>

                    </div>
            </div>
           
           
            </div>
            <div class="row my-2 align-items-center">
                {{$list->links()}}
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="text-center" style="width:90px;">Hình ảnh</th>
                        <th>Tên sản phẩm</th>
                        <th>Giá sản phẩm</th>
                        <th>Giảm giá(%)</th>
                        <th>Giá đã giảm</th>
                        <th>Thời gian kết thúc</th>
                        <th class="text-center" style="width:30px;">ID</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($list as $row)
                    <tr class="datarow">
                        <td>
                            <img src="{{asset('/images/product/'.$row->image)}}" class="img-fluid" alt="{{$row->image}}" width="60px">
                        </td>
                        <td>
                            <div class="name">
                                <a href="category_index.html">
                                    {{$row->name}}
                                </a>
                            </div>
                            <div class="function_style">
                                @php
                                $agrs =['id'=>$row->id];
                                @endphp

                                <a href="{{route('admin.product.editsale' ,$agrs)}}" class="px-1 text-primary">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <a href="category_show.html" class="text-info mx-1">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{route("admin.product.delete",$agrs)}}" class="text-danger mx-1">
                                    <i class="bi bi-trash2"></i>
                                </a>
                            </div>
                        </td>
                        <td>
                        {{number_format( $row->price) }}
                        </td>
                        <td>
                            @php
                            $discountPercentage = 0;
                            if ($row->price > 0 && $row->pricesale > 0) {
                            $discountPercentage = (($row->price - $row->pricesale) / $row->price) * 100;
                            }
                            @endphp
                            {{ number_format($discountPercentage)}}%
                        </td>

                        <td> {{number_format( $row->pricesale) }}</td>
                        <td>
                            {{ $row->sale_end_date }}
                        </td>
                        <td class="text-center"> {{$row->id}}</td>
                    </tr>
                    @empty
                    <span style="color: red;">Chưa có dữ liệu</span>
                    @endforelse
                </tbody>
            </table>
        </div>
</div>
</section>
</div>

<script>
    function updateProductDetails() {
        var select = document.getElementById('product_id');
        var selectedOption = select.options[select.selectedIndex];
        var price = selectedOption.getAttribute('data-price');
        document.getElementById('price').value = price;

        // Update the form action with the selected product ID
        var form = document.querySelector('form');
        form.action = form.action.replace(/\/\d+$/, '/' + select.value);
    }

    function calculateDiscount() {
        var price = parseFloat(document.getElementById('price').value);
        var discountInput = document.getElementById('discount');
        var discount = parseFloat(discountInput.value.replace('%', ''));
        var discountedPrice = document.getElementById('discounted-price');

        if (!isNaN(discount) && discount >= 0 && discount <= 100) {
            var discountAmount = (discount / 100) * price;
            var finalPrice = price - discountAmount;
            discountedPrice.value = Math.round(finalPrice); // Round to the nearest integer
            discountInput.value = discount + '%'; // Ensure % sign is always present
        } else {
            discountedPrice.value = ''; // Clear if value is invalid
        }
    }
</script>
@endsection
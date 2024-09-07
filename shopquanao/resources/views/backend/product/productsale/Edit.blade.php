@extends('layouts.dashboard')
@section('content')
<div class="content">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0">Cập nhật sản phẩm</h1>
        <a href="{{route('admin.product.index')}}" class="btn btn-secondary">Trở lại</a>
    </div>
    <hr style="border: none;" />

    <section class="content-body my-2">
        <form action="{{ route('admin.product.updatesale', ['id' => $product->id]) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method ("put")
            <div class="row">

                <div class="col-md-9">
                    <div class="mb-3">
                        <label><strong>Tên sản phẩm (*)</strong></label>
                        <input type="text" value="{{old('name',$product->name)}}" name="name" class="form-control" required/>
                    </div>
                    <div class="mb-3">
                        <label for="image">Hình ảnh</label>

                        <div class="d-flex align-items-center mt-3" id="image-container">
                            <div id="new-image-preview" style="text-align: center; margin-right: 20px;"></div>
                            <div id="arrow" style="text-align: center; margin-right: 20px;"></div>
                            <div id="image-preview" style="text-align: center;">
                                @if($product->image)
                                <img src="{{ asset('/images/product/' . $product->image) }}" alt="Old Category Image" style="max-width: 100px;">
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="price">Giá sản phẩm</label>
                        <input type="text" id="price" value="{{$product->price}}" name="price" class="form-control" required>
                    </div>
                    <div class="mb-3 percent-input-wrapper">
                        <label for="discount">Giảm giá(%)</label>
                        <input type="text" id="discount" name="discount" class="form-control" oninput="calculateDiscount()">
                        <span class="percent-sign">%</span>
                    </div>
                    <div class="mb-3">
                        <label for="discounted-price">Giá đã giảm</label>
                        <input type="text" id="discounted-price" value="{{$product->pricesale}}" name="pricesale" class="form-control" >
                    </div>
                    <div class="mb-3">
                        <label><strong>Thời gian kết thúc sale</strong></label>
                        <input type="datetime-local" value="{{ old('sale_end_date',$product->sale_end_date) }}" name="sale_end_date" class="form-control" required />
                    </div>
                    <div class="mb-3">
                        <label for="status">Trạng Thái</label>
                        <select name="status" id="status" class="form-control">
                            <option value="1">--Xuất bản--</option>
                            <option value="2">--Chưa xuất bản--</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-save"></i> Lưu[Thêm]
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </section>
</div>

<script>
    function calculateDiscount() {
        var price = parseFloat(document.getElementById('price').value);
        var discount = parseFloat(document.getElementById('discount').value);
        if (!isNaN(price) && !isNaN(discount)) {
            var discountedPrice = price - (price * (discount / 100));
            document.getElementById('discounted-price').value =Math.round(discountedPrice);
        } else {
            document.getElementById('discounted-price').value = '';
        }
    }
</script>

@endsection

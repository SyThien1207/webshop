@extends('layouts.dashboard')
@section('content')
<div class="content">
    <section class="content-header my-2">
    <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="mb-0">Thêm sản phẩm nhập kho</h1>
            <a href="{{route('admin.warehouse.index')}}" class="btn btn-secondary">Trở lại</a>
        </div>
        <hr style="border: none;" />
    </section>
    <section class="content-body my-2">
        <form action="{{route('admin.warehouse.store')}}" method="post" enctype="multipart/form-data"> 
            @csrf
            <div class="row">
                <div class="col-md-9">
          <div class="box-container mt-2 bg-white">
    <div class="box-header py-1 px-2 border-bottom">
        <strong>Chọn sản phẩm</strong>
    </div>
    <div class="box-body p-2 border-bottom">
                            <select name="product_id" class="form-select"required>
                                <option value="">Chọn Sản phẩm</option>
                              {!!$html_product_id!!}
                            </select>
                        </div>
</div>
                    <div class="box-container mt-2 bg-white">
                        <div class="box-header py-1 px-2 border-bottom">
                            <strong>Chọn nhà cung cấp</strong>
                        </div>
                        <div class="box-body p-2 border-bottom">
                            <select name="supplier_id" class="form-select">
                                <option value="">Chọn nhà cung cấp</option>
                              {!!$html_supplier_id!!}
                            </select>
                        </div>
                    </div>
               
                
                </div>
                <div class="col-md-3">
                    <div class="box-container mt-4 bg-white">
                        <div class="box-header py-1 px-2 border-bottom">
                            <strong>Đăng</strong>
                        </div>
                        <div class="box-body p-2 border-bottom">
                            <select name="status" class="form-select">
                                <option value="2">Đã thanh toán</option>
                                <option value="3">Chưa thanh toán</option>
                            </select>
                        </div>
                        <div class="box-footer text-end px-2 py-2">
                            <button type="submit" class="btn btn-success btn-sm text-end">
                                <i class="fa fa-save" aria-hidden="true"></i> Đăng
                            </button>
                        </div>
                    </div>
           
                        
                    </div>
                    <div class="box-container mt-2 bg-white">
    <div class="box-header py-1 px-2 border-bottom">
        <strong>Giá và số lượng</strong>
    </div>
    <div class="box-body p-2 border-bottom">
    <div class="row">
    <div class="col-md-4 mb-3">
            <label><strong>Số lượng (*)</strong></label>
            <input id="qty" type="number" value="{{ old('qty') }}" name="qty" class="form-control" required/>
        </div>
        <div class="col-md-4 mb-3">
            <label><strong>Giá nhập(/chiếc) (*)</strong></label>
            <input id="price" type="number" value="{{ old('price') }}" name="price" class="form-control"required />
        </div>
        
        <div class="col-md-4 mb-3">
            <label><strong>Thành tiền</strong></label>
            <input id="total_price" type="number" name="total_price" class="form-control" readonly />
        </div>
        <div class="mb-3">
            <label><strong>Ngày nhập</strong></label>
            <input type="datetime-local" value="{{ old('entry_date') }}" name="entry_date" class="form-control" required/>
        </div>
    </div>
</div>


</div>

                  
                </div>
            </div>
        </form>
    </section>
</div>
@endsection

@section('custom-js')
@section('custom-js')
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
    $(function() {
        var availableProducts = [];

        $.ajax({
            url: "{{ route('getProducts') }}",  // Đường dẫn đến route để lấy danh sách sản phẩm
            method: "GET",
            success: function(data) {
                availableProducts = data;
                $("#product-input").autocomplete({
                    source: availableProducts,
                    select: function(event, ui) {
                        $("#product-input").val(ui.item.label);
                        $("#product_id").val(ui.item.value);
                        return false;
                    }
                });
            }
        });
    });
    document.addEventListener('DOMContentLoaded', function () {
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

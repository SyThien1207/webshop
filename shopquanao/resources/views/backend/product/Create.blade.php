@extends('layouts.dashboard')
@section('content')
<div class="content">
    <section class="content-header my-2">
    <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="mb-0">Thêm sản phẩm</h1>
            <a href="{{route('admin.product.index')}}" class="btn btn-secondary">Trở lại</a>
        </div>
        <hr style="border: none;" />
    </section>
    <section class="content-body my-2">
        <form action="{{route('admin.product.store')}}" method="post" enctype="multipart/form-data"> 
            @csrf
            <div class="row">
                <div class="col-md-9">
                    <div class="mb-3">
                        <label><strong>Tên sản phẩm (*)</strong></label>
                        <input type="text" value="{{old('name')}}" placeholder="Nhập tên sản phẩm" name="name" class="form-control" required/>
                    </div> 
                    <div class="box-container mt-2 bg-white">
                        <div class="box-header py-1 px-2 border-bottom">
                            <strong>Hình đại diện(*)</strong>
                        </div>
                        <div class="box-body p-2 border-bottom">
                            <input type="file" name="image" class="form-control" required/>
                        </div>
                    </div>
                    <div class="box-container mt-2 bg-white">
                        <div class="box-header py-1 px-2 border-bottom">
                            <strong>Hình đại diện phụ(*)</strong>
                        </div>
                        <div class="box-body p-2 border-bottom">
                            <input type="file" name="image2" class="form-control" required/>
                        </div>
                    </div>
                    <div class="box-container mt-2 bg-white">
                        <div class="box-header py-1 px-2 border-bottom">
                            <strong>Hình mô tả</strong>
                        </div>
                        <div class="box-body p-2 border-bottom">
                            <input type="file" name="images[]" class="form-control" multiple/>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label><strong>Mô tả (*)</strong></label>
                        <textarea name="description" rows="3" class="form-control" placeholder="Nhập mô tả"required>{{old('description')}}</textarea>
                    </div>
                    <div class="mb-3">
                        <label><strong>Chi tiết (*)</strong></label>
                        <textarea name="detail" id="editor1" placeholder="Nhập chi tiết sản phẩm" rows="7" class="form-control"required>{{old('detail')}}</textarea>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="box-container mt-4 bg-white">
                        <div class="box-header py-1 px-2 border-bottom">
                            <strong>Đăng</strong>
                        </div>
                        <div class="box-body p-2 border-bottom">
                            <select name="status" class="form-select">
                                <option value="1">Xuất bản</option>
                                <option value="2">Chưa xuất bản</option>
                            </select>
                        </div>
                        <div class="box-footer text-end px-2 py-2">
                            <button type="submit" class="btn btn-success btn-sm text-end">
                                <i class="fa fa-save" aria-hidden="true"></i> Đăng
                            </button>
                        </div>
                    </div>
                    <div class="box-container mt-2 bg-white">
                        <div class="box-header py-1 px-2 border-bottom">
                            <strong>Danh mục(*)</strong>
                        </div>
                        <div class="box-body p-2 border-bottom">
                            <select name="category_id" class="form-select"required>
                                <option>Chọn danh mục</option>
                               {!! $html_category_id !!}
                            </select>
                        </div>
                    </div>
                    <div class="box-container mt-2 bg-white">
                        <div class="box-header py-1 px-2 border-bottom">
                            <strong>Thương hiệu(*)</strong>
                        </div>
                        <div class="box-body p-2 border-bottom">
                            <select name="brand_id" class="form-select"  required>
                                <option value="">Chọn thương hiệu</option>
                              >{!!$html_brand_id!!}
                            </select>
                        </div>
                    </div>
                    <div class="box-container mt-2 bg-white">
    <div class="box-header py-1 px-2 border-bottom">
        <strong>Giá bán</strong>
    </div>
    <div class="box-body p-2 border-bottom">
        <div class="mb-3">
            <label><strong>Giá bán (*)</strong></label>
            <input type="number" value="{{ old('price') }}" min="10000" name="price" class="form-control" required/>
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
<script src="{{asset('assets/ckeditor/ckeditor.js')}}"></script>
<script>
    CKEDITOR.replace('editor1');
</script>
@endsection

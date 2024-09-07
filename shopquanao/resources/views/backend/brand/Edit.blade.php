@extends('layouts.dashboard')
@section('content')
<div class="content">
    <section class="content-header my-2">
        <h1 class="d-inline">Thương hiệu</h1>
        <hr style="border: none;">
    </section>
    <section class="content-body my-2">

        <div class="row">

            <form action="{{ route('admin.brand.update', ['id' => $brand->id]) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method ("put")
                <div class="mb-3">
                    <label>
                        <strong>Tên thương hiệu (*)</strong>
                    </label>
                    <input type="text" value="{{old('name',$brand->name)}}" name="name" id="name" placeholder="Nhập tên danh mục" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label><strong>Mô tả</strong></label>
                    <textarea name="description" rows="4" class="form-control" placeholder="Mô tả">{{old("description",$brand->description)}}</textarea>
                </div>
                <div class="mb-3">
                    <label for="sort_order">Sắp xếp</label>
                    <select name="sort_order" id="sort_order" class="form-control">
                        <option value="0">--Sắp xếp--</option>
                        {!! $htmlsortorder !!}
                    </select>
                </div>
                <div class="mb-3">
                    <label for="image">Hình Ảnh Thay thế</label>
                    <input type="file" name="image" id="image" class="form-control" onchange="previewImage()">

                    <div class="d-flex align-items-center mt-3" id="image-container">
                        <div id="new-image-preview" style="text-align: center; margin-right: 20px;"></div>
                        <div id="arrow" style="text-align: center; margin-right: 20px;"></div>
                        <div id="image-preview" style="text-align: center;">
                            @if($brand->image)
                            <img src="{{ asset('/images/brand/' . $brand->image) }}" {{$brand->image}} style="max-width: 100px;">
                            @endif
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label><strong>Trạng thái</strong></label>
                    <select name="status" class="form-control">
                        <option value="2" {{($brand->status==2)?'selected':''}}>--Chưa xuất bản--</option>
                        <option value="1" {{($brand->status==1)?'selected':''}}>--Xuất bản--</option>
                    </select>
                </div>
                <div class="mb-3 text-end">
                    <button type="submit" class="btn btn-success" name="THEM">
                        <i class="fa fa-save"></i> Lưu[Thêm]
                    </button>
                </div>
            </form>

        </div>


    </section>
</div>

@endsection
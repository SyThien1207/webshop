@extends('layouts.dashboard')
@section('content')
<div class="content">

    <section class="content-header my-2">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="mb-0">Chỉnh sửa danh mục</h1>
            <a href="{{route('admin.category.index')}}" class="btn btn-secondary">Trở lại</a>
        </div>
        <hr style="border: none;" />
    </section>
    <section class="content-body my-2">

        <div class="row">
            <form action="{{ route('admin.category.update', ['id' => $category->id]) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method ("put")
                <div class="mb-3">
                    <label for="name">Tên Danh Mục</label>
                    <input type="text" value="{{old('name',$category->name)}}" name="name" id="id" class="form-control">

                </div>
                <div class="mb-3">
                    <label for="description">Mô tả</label>
                    <textarea name="description" id="description" rows="3" class="form-control">{{old("description",$category->description)}}</textarea>
                </div>
                <div class="mb-3">
                    <label class="parent_id">Cấp cha</label>
                    <select class="form-control" name="parent_id" id="parent_id">
                        <option value="0">--Cấp cha--</option>
                        {!! $htmlparentid !!}

                    </select>
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
                            @if($category->image)
                            <img src="{{ asset('/images/category/' . $category->image) }}" alt="Old Category Image" style="max-width: 100px;">
                            @endif
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="status">Trạng Thái</label>
                    <select name="status" id="status" class="form-control">
                        <option value="2" {{($category->status==2)?'selected':''}}>--Chưa xuất bản--</option>
                        <option value="1" {{($category->status==1)?'selected':''}}>--Xuất bản--</option>
                    </select>
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-success">Cập Nhật Danh Mục</button>
                </div>

                <script>
                    
                </script>


                @endsection
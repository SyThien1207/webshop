@extends('layouts.dashboard')
@section('content')
<div class="content">
    <section class="content-header my-2">
        <h1 class="d-inline">Danh mục</h1>
        <hr style="border: none;" />
    </section>
    <section class="content-body my-2">
        <div class="row">
         
                <form action="{{route('admin.supplier.update',['id' => $list->id])}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="name">Nhà cung cấp</label>
                        <input type="text" value="{{old('name',$list->name)}}" name="name" id="name" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="name">Người liên hệ</label>
                        <input type="text" value="{{old('contact_person',$list->contact_person)}}" name="contact_person" id="contact_person" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="name">Email</label>
                        <input type="text" value="{{old('email',$list->email)}}" name="email" id="email" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="name">Số điện thoại</label>
                        <input type="number" value="{{old('phone',$list->phone)}}" name="phone" id="phone" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="name">Địa chỉ</label>
                        <input type="text" value="{{old('address',$list->address)}}" name="address" id="address" class="form-control">
                    </div>
                  
                    <div class="mb-3">
                        <label for="status">Trạng Thái</label>
                        <select name="status" id="status" class="form-control">
                        <option value="2" {{($list->status==2)?'selected':''}}>--Chưa xuất bản--</option>
                        <option value="1" {{($list->status==1)?'selected':''}}>--Xuất bản--</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-save"></i> Lưu[Thêm]
                        </button>
                    </div>
                </form>
            </div>
    </section>
</div>

@endsection

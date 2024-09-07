@extends('layouts.dashboard')
@section('content')
<div class="content">
    <section class="content-header my-2">
        <h1 class="d-inline">Nhà cung cấp</h1>
        <hr style="border: none;" />
    </section>
    <section class="content-body my-2">
        <div class="row">
            <div class="col-md-4">
                <form action="{{route('admin.supplier.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="name">Nhà cung cấp</label>
                        <input type="text" value="{{old('name')}}" name="name" id="name" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="name">Người liên hệ</label>
                        <input type="text" value="{{old('contact_person')}}" name="contact_person" id="contact_person" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="name">Email</label>
                        <input type="text" value="{{old('email')}}" name="email" id="email" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="name">Số điện thoại</label>
                        <input type="number" value="{{old('phone')}}" name="phone" id="phone" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="name">Địa chỉ</label>
                        <input type="text" value="{{old('address')}}" name="address" id="address" class="form-control">
                    </div>
                  
                    <div class="mb-3">
                        <label for="status">Trạng Thái</label>
                        <select name="status" id="status" class="form-control">
                            <option value="1">--Hiện--</option>
                            <option value="2">--Ẩn--</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-save"></i> Lưu[Thêm]
                        </button>
                    </div>
                </form>
            </div>
            <div class="col-md-8">
                <div class="row mt-3 align-items-center">
                    <div class="col-12">
                        <ul class="manager">
                            <span><a class="bi bi-bookmark" href="category_index.html">Tất cả:{{ $activeCategoryCount1 }} </a></span>
                            <span>|</span>
                            <span><a class="bi bi-bookmark-check-fill" href="#"> Xuất bản:{{ $activeCategoryCount }}</a></span>
                            <span>|</span>
                            <span><a class="bi bi-trash2" href="{{route("admin.supplier.trash")}}"> Rác:{{ $activeCategoryCount2 }}</a></span>
                        </ul>
                    </div>
                </div>
                <div class="row my-2 align-items-center">
                    <div class="col-md-12 text-end">
                        <form action="{{ route('admin.supplier.index') }}" method="GET" class="d-inline">
                            <input type="text" name="search" class="search d-inline" value="{{ request()->get('search') }}" />
                            <button type="submit" class="d-inline btnsearch">Tìm kiếm</button>
                        </form>
                    </div>
                </div>
                <div class="row my-2 align-items-center">
                    {{$list->links()}}
                </div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nhà cùng cấp</th>
                            <th>Người liên hệ</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th class="text-center" style="width:30px;">ID</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($list as $row)
                        <tr class="datarow">
                       
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
                                    @if ($row->status==1)
                                    <a href="{{route("admin.supplier.status",$agrs)}}" class="px-1 text-success">
                                        <i class="bi bi-toggle-on"></i>
                                    </a>
                                    @else
                                    <a href="{{route("admin.supplier.status",$agrs)}}" class="px-1 text-success">
                                        <i class="bi bi-toggle-off"></i>
                                    </a>
                                    @endif
                                    <a href="{{route('admin.supplier.edit' ,$agrs)}}" class="px-1 text-primary">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <a href="category_show.html" class="text-info mx-1">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{route("admin.supplier.destroy",$agrs)}}" class="text-danger mx-1">
                                        <i class="bi bi-trash2"></i>
                                    </a>
                                </div>
                            </td>
                            <td>
                                {{ $row->contact_person }}
                            </td>
                            <td>
                                {{ $row->email }}
                            </td> <td>
                                {{ $row->phone }}
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

@endsection

@extends('layouts.dashboard')
@section('content')
<div class="content">
    <section class="content-header my-2">
    <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="mb-0">Thùng rác</h1>
            <a href="{{route('admin.supplier.index')}}" class="btn btn-secondary">Trở lại</a>
        </div>
        <hr style="border: none;" />
    </section>
    <section class="content-body my-2">
        <div class="row">
                
               
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
                                
                                    <a href="{{route("admin.supplier.restore",$agrs)}}" class="text-primary mx-1">
                        <i class="bi bi-arrow-clockwise"></i>
                     </a>
                     <a href="{{route("admin.supplier.delete",$agrs)}}" class="text-danger mx-1">
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
                        <td>
                        <span style="color: red;">Không có dữ liệu</span></td>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>

@endsection

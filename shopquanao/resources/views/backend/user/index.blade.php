@extends('layouts.dashboard')
@section('content')
<div class="content">
                  <section class="content-header my-2">
                     <h1 class="d-inline">Thành viên</h1>
                     <div class="row my-2 align-items-center">
                <div class="col-5">
                        <ul class="manager">
                            <span><a class="bi bi-bookmark" href="category_index.html">Tất cả:{{ $activeCategoryCount1 }} </a></span>
                            <span>|</span>
                            <span><a class="bi bi-bookmark-check-fill" href="#"> Xuất bản:{{ $activeCategoryCount }}</a></span>
                            <span>|</span>
                            <span><a class="bi bi-trash2" href="{{route("admin.user.trash")}}"> Rác:{{ $activeCategoryCount2 }}</a></span>
                        </ul>
                    </div>
                    <div class="col-md-5 text-end"> 
                        <form action="{{ route('admin.user.index') }}" method="GET" class="d-inline">
                            <input type="text" name="search" class="search d-inline" value="{{ request()->get('search') }}" />
                            <button type="submit" class="d-inline btnsearch">Tìm kiếm</button>
                        </form>
                    </div>
                    <div class="col-md-2 text-end">
            <a href="{{route('admin.user.create')}}" class="btn btn-secondary">Thêm mới</a>

                    </div>
                </div>
                  </section>
                  <section class="content-body my-2">

                     <table class="table table-bordered">
                        <thead>
                           <tr>
                              <th class="text-center" style="width:30px;">
                                 <input type="checkbox" id="checkAll" />
                              </th>
                              <th class="text-center" style="width:90px;">Hình ảnh</th>
                              <th>Họ tên</th>
                              <th>Điện thoại</th>
                              <th>Email</th>
                              <th class="text-center" style="width:30px;">ID</th>
                           </tr>
                        </thead>
                        <tbody>
                        @foreach($list as $row)

                           <tr class="datarow">
                              <td class="text-center">
                                 <input type="checkbox" id="checkId" />
                              </td>
                              <td>
                                 <img class="img-fluid" src="public/images/user.jpg" alt="user.jpg" />
                              </td>
                              <td>
                                 <div class="name">
                                    <a href="menu_index.html">
                                    {{$row->name}}
                                    </a>
                                 </div>
                  <div class="function_style">

                                 @php
                                    $agrs =['id'=>$row->id];
                                    @endphp                                                                                           
                                        @if ($row->status==1)
                     <a href="{{route("admin.user.status",$agrs)}}" class="px-1 text-success">
                        <i class="bi bi-toggle-on"></i>
                     </a>
                     @else
                     <a href="{{route("admin.user.status",$agrs)}}" class="px-1 text-success">
                        <i class="bi bi-toggle-off"></i>
                     </a>
                     @endif
                     <a href="{{route('admin.user.edit' ,$agrs)}}" class="px-1 text-primary">
                        <i class="bi bi-pencil-square"></i>
                     </a>
                     <a href="user_show.html" class="text-info mx-1">
                        <i class="bi bi-eye"></i>
                     </a>
                     <a href="{{route("admin.user.destroy",$agrs)}}" class="text-danger mx-1">
                        <i class="bi bi-trash"></i>
                     </a>
                                 </div>
                              </td>
                              <td> {{$row->phone}}</td>
                              <td> {{$row->email}}</td>
                              <td class="text-center"> {{$row->id}}</td>
                           </tr>
                           @endforeach
                        </tbody>
                     </table>

                  </section>
               </div>
@endsection 
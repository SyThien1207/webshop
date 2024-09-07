@extends('layouts.dashboard')
@section('content')
<div class="content">
                  <section class="content-header my-2">
                     <h1 class="d-inline">Banner</h1>
                 
                     
                     <  <div class="row my-2 align-items-center">
                <div class="col-5">
                        <ul class="manager">
                            <span><a class="bi bi-bookmark" href="category_index.html">Tất cả:{{ $activeCategoryCount1 }} </a></span>
                            <span>|</span>
                            <span><a class="bi bi-bookmark-check-fill" href="#"> Xuất bản:{{ $activeCategoryCount }}</a></span>
                            <span>|</span>
                            <span><a class="bi bi-trash2" href="{{route("admin.banner.trash")}}"> Rác:{{ $activeCategoryCount2 }}</a></span>
                        </ul>
                    </div>
                    <div class="col-md-5 text-end"> 
                        <form action="{{ route('admin.banner.index') }}" method="GET" class="d-inline">
                            <input type="text" name="search" class="search d-inline" value="{{ request()->get('search') }}" />
                            <button type="submit" class="d-inline btnsearch">Tìm kiếm</button>
                        </form>
                    </div>
                    <div class="col-md-2 text-end">
            <a href="{{route('admin.banner.create')}}" class="btn btn-secondary">Thêm mới</a>

                    </div>
                </div>
                  </section>
                  <section class="content-body my-2">

                     <table class="table table-bordered">
                        <thead>
                           <tr>
                              <th class="text-center" style="width:30px;">
                                 <input type="checkbox" id="checkboxAll" />
                              </th>
                              <th class="text-center" style="width:130px;">Hình ảnh</th>
                              <th>Tên banner</th>
                              <th>Vị trí</th>
                              <th>Liên kết</th>
                              <th class="text-center" style="width:30px;">ID</th>
                           </tr>
                        </thead>
                        <tbody>
                        @foreach($list as $row)

                           <tr class="datarow">
                              <td class="text-center">
                                 <input type="checkbox" />
                              </td>
                              <td>
                              <img 
                                       src="{{asset("images/banner/".$row->image)}}"class="img-fluid"
                                        alt="{{$row->image}}">                              </td>
                              <td>
                                 <div class="name">
                                    <a href="banner_edit.html">
                                    {{$row->name}}
                                    </a>
                                 </div>
                                 <div class="function_style">

                                 @php
                                    $agrs =['id'=>$row->id];
                                    @endphp    
                                    @if ($row->status==1)
                                    <a href="{{route("admin.banner.status",$agrs)}}" class="px-1 text-success">
                                        <i class="bi bi-toggle-on"></i>
                                    </a>
                                    @else
                                    <a href="{{route("admin.banner.status",$agrs)}}" class="px-1 text-success">
                                        <i class="bi bi-toggle-off"></i>
                                    </a>
                                    @endif
                                    <a href="{{route('admin.banner.edit' ,$agrs)}}" class="px-1 text-primary">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <a href="banner_show.html" class="text-info mx-1">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{route("admin.banner.destroy",$agrs)}}" class="text-danger mx-1">
                                        <i class="bi bi-trash2"></i>
                                    </a>
                                 </div>
                              </td>
                              <td>                                    {{$row->position}}</td>
</td>
                              <td>                                    {{$row->link}}
</td>
                              <td class="text-center">  {{$row->id}}</td>
                           </tr>
                           @endforeach

                        </tbody>
                     </table>

                  </section>
               </div>
@endsection 
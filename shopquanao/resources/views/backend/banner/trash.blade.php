@extends('layouts.dashboard')
@section('content')
<div class="content">
                  <section class="content-header my-2">
                  <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="mb-0">Chỉnh sửa danh mục</h1>
            <a href="{{route('admin.banner.index')}}" class="btn btn-secondary">Trở lại</a>
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
                                       src="{{asset("image/banners/".$row->image)}}"class="img-fluid"
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
                                                                                                             
                                         
                                         
                                 <a href="{{route("admin.banner.restore",$agrs)}}" class="text-primary mx-1">
                                       <i class="fa fa-undo"></i>
                                    </a>
                                    <a href="{{route("admin.banner.delete",$agrs)}}" class="text-danger mx-1">
                                       <i class="fa fa-trash"></i>
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
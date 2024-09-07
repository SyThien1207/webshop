@extends('layouts.dashboard')
@section('content')
<div class="content">
                  <section class="content-header my-2">
                     <h1 class="d-inline">Quản lý bài viết</h1>
                     <a href="{{route('admin.post.create')}}" class="btn-add">Thêm mới</a>
                     <a class="btn-add" href="{{route('admin.post.index')}}">Trở lại</a>

                   
                  </section>
                  <section class="content-body my-2">

                     <table class="table table-bordered">
                        <thead>
                           <tr>
                              <th class="text-center" style="width:30px;">
                                 <input type="checkbox" id="checkboxAll" />
                              </th>
                              <th class="text-center" style="width:130px;">Hình ảnh</th>
                              <th>Tiêu đề bài viết</th>
                              <th>Tên danh mục</th>
                              <th class="text-center" style="width:30px;">ID</th>
                           </tr>
                        </thead>
                        <tbody>
                        @foreach($list as $row)

                           <tr class="datarow">
                              <td>
                                 <input type="checkbox" id="checkId"  />
                              </td>
                              <td>
                              <img 
                                       src="{{asset("images/post/".$row->image)}}"class="img-fluid"
                                        alt="{{$row->image}}">                              </td>
                              <td>
                                 <div class="name">
                                    <a href="post_edit.html">
                                    {{$row->title}}
                                    </a>
                                 </div>
                                 @php
                                    $agrs =['id'=>$row->id];
                                    @endphp                                                                                           
                                      <a href="{{route("admin.post.restore",$agrs)}}" class="text-primary mx-1">
                                       <i class="fa fa-undo"></i>
                                    </a>
                                    <a href="{{route("admin.post.delete",$agrs)}}" class="text-danger mx-1">
                                       <i class="fa fa-trash"></i>
                                    </a>
                                 </div>
                              </td>
                              <td> {{$row->type}}</td>
                              <td class="text-center">{{$row->id}}</td>
                           </tr>
                           @endforeach
                        </tbody>
                     </table>

                  </section>
               </div>
@endsection 
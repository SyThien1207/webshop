@extends('layouts.dashboard')
@section('content')
<div class="content">
                  <section class="content-header my-2">
                     <h1 class="d-inline">Thành viên</h1>
                     <a href="{{route('admin.user.index')}}" class="btn btn-primary btn-sm">
                                 <i class="fa fa-fa-add"></i> Thêm mới
                              </a>
                     <a href="{{route('admin.user.index')}}" class="btn btn-primary btn-sm">
                                 <i class="fa fa-arrow-left"></i> Về danh sách
                              </a>

                     <div class="row mt-3 align-items-center">
                        <div class="col-6">
                           <ul class="manager">
                              <li><a href="user_index.html">Tất cả (123)</a></li>
                              <li><a href="#">Xuất bản (12)</a></li>
                              <li><a href="user_trash.html">Rác (12)</a></li>
                           </ul>
                        </div>
                        <div class="col-6 text-end">
                           <input type="text" class="search d-inline" />
                           <button class="d-inline btnsearch">Tìm kiếm</button>
                        </div>
                     </div>
                     <div class="row mt-1 align-items-center">
                        <div class="col-md-8">
                           <select name="" class="d-inline me-1">
                              <option value="">Hành động</option>
                              <option value="">Bỏ vào thùng rác</option>
                           </select>
                           <button class="btnapply">Áp dụng</button>
                        </div>
                        <div class="col-md-4 text-end">
                           <nav aria-label="Page navigation example">
                              <ul class="pagination pagination-sm justify-content-end">
                                 <li class="page-item disabled">
                                    <a class="page-link">&laquo;</a>
                                 </li>
                                 <li class="page-item"><a class="page-link" href="#">1</a></li>
                                 <li class="page-item"><a class="page-link" href="#">2</a></li>
                                 <li class="page-item"><a class="page-link" href="#">3</a></li>
                                 <li class="page-item">
                                    <a class="page-link" href="#">&raquo;</a>
                                 </li>
                              </ul>
                           </nav>
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
                                 @php
                                    $agrs =['id'=>$row->id];
                                    @endphp                                                                                           
                                            <a href="{{route("admin.user.restore",$agrs)}}" class="text-primary mx-1">
                        <i class="fa fa-undo"></i>
                     </a>
                     <a href="{{route("admin.user.delete",$agrs)}}" class="text-danger mx-1">
                        <i class="fa fa-trash"></i>
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
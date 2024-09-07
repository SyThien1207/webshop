@extends('layouts.dashboard')
@section('content')
<div class="content">
                  <section class="content-header my-2">
                     <h1 class="d-inline">Mã giảm giá</h1>
                    

                     <hr style="border: none;">
                  </section>
                  <section class="content-body my-2">

                     <div class="row">
                        <div class="col-md-4">
                        <form action="{{route('admin.coupon.store')}}" 
                        method="post"enctype="multipart/form-data"> 
              @csrf
                           <div class="mb-3">
                              <label>
                                 <strong>Tên phiếu giảm giá</strong>
                              </label>
                              <input type="text"value="{{old('name')}}" name="name" id="name" placeholder="Nhập tên phiếu giảm giá"
                                 class="form-control" required>
                           </div>
                           <div class="mb-3">
                              <label>
                                 <strong>Mã giảm giá</strong>
                              </label>
                              <input type="text"value="{{old('code')}}" name="code" id="code" placeholder="Nhập mã giảm giá"
                                 class="form-control" required>
                           </div>
                           <div class="mb-3">
                              <label>
                                 <strong>Số lần sử dụng</strong>
                              </label>
                              <input type="number"value="{{old('time')}}" name="time" id="time" placeholder="Nhập số lần sử dụng"
                                 class="form-control" required>
                           </div>
                           <div class="mb-3">
                <label for="condition">Loại giảm giá</label>
                <select name="condition" id="condition" class="form-control">
                  <option value="0">----Chọn loại giảm giá----</option>
                  <option value="1">Giảm theo %</option>
                  <option value="2">Giảm theo theo tiền</option>
                </select>  
                           </div>             
                <div class="mb-3">
                              <label>
                                 <strong>Giá trị</strong>
                              </label>
                              <input type="number"value="{{old('number')}}" name="number" id="number" placeholder="Nhập giá trị phiếu"
                                 class="form-control" required>
                           </div>

                           <div class="mb-3">
                              <label><strong>Trạng thái</strong></label>
                              <select name="status" class="form-control">
                                 <option value="1">Xuất bản</option>
                                 <option value="2">Chưa xuất bản</option>
                              </select>
                           </div>
                           <div class="mb-3 text-end">
                              <button type="submit" class="btn btn-success" name="THEM">
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

                            <span>
                                <a class="bi bi-trash2" href="{{route("admin.coupon.trash")}}"> Rác:{{ $activeCategoryCount2 }}</a></span>
                        </ul>
                    </div>
                </div>
                <div class="row my-2 align-items-center">
                    
                    <div class="col-md-12 text-end">
                        <form action="{{ route('admin.coupon.index') }}" method="GET" class="d-inline">
                            <input type="text" name="search" class="search d-inline" value="{{ request()->get('search') }}" />
                            <button type="submit" class="d-inline btnsearch">Tìm kiếm</button>
                        </form>
                    </div>

                </div>
                           <table class="table table-bordered">
                              <thead>
                                 <tr>
                             
                                    <th>Tên phiếu</th>
                                    <th>Mã phiếu</th>
                                    <th>Số lần sử dụng</th>
                                    <th class="text-center" style="width:30px;">ID</th>
                                 </tr>
                              </thead>
                              <tbody>
                              @foreach($list as $row)
                                 <tr class="datarow">
                                    
                                    <td>
                                       <div class="name">
                                          <a href="Coupon_index.html">
                                          {{$row->coupon_name}}
                                          </a>
                                       </div>
                                       <div class="function_style">

                                       @php
                                    $agrs =['id'=>$row->id];
                                    $agrs2 =['slug'=>$row->slug];
                                    @endphp                                                                                           
                                          @if ($row->status==1)
                                    <a href="{{route("admin.coupon.status",$agrs)}}" class="px-1 text-success">
                                             <i class="bi bi-toggle-on"></i>
                                          </a>
                                          @else
                                          <a href="{{route("admin.coupon.status",$agrs)}}" class="px-1 text-success">
                                             <i class="bi bi-toggle-off"></i>
                                          </a>
                                    @endif                                                                                       
                                         
                                          <a  href="{{route('admin.coupon.edit' ,$agrs)}}" class="px-1 text-primary">
                                             <i class="bi bi-pencil-square"></i>
                                          </a>
                                         
                                    <a href="{{route("admin.coupon.destroy",$agrs)}}" class="text-danger mx-1">
                                       <i class="bi bi-trash"></i>
                                    </a> </i>
                                    </a>
                                 </div>
                                    </td>
                                    <td> {{$row->coupon_code}}</td>
                                    <td> {{$row->coupon_time}}</td>
                                    <td class="text-center"> {{$row->id}}</td>
                                 </tr>
                           @endforeach

                              </tbody>
                           </table>
                        </div>
                     </div>

                  </section>
               </div>
          
@endsection 
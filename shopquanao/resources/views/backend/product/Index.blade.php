@extends('layouts.dashboard')
@section('content')
<style>
   /* Định nghĩa chung cho tất cả các thẻ label */
   .label {
      display: inline-block;
      padding: 0.25em 0.4em;
      font-size: 75%;
      font-weight: 700;
      line-height: 1;
      text-align: center;
      white-space: nowrap;
      vertical-align: baseline;
      border-radius: 0.25rem;
   }

   /* Định nghĩa cho label thành công */
   .label-success {
      color: #fff;
      background-color: #28a745;
      border: 1px solid #28a745;
      /* Viền màu xanh */
   }

   /* Định nghĩa cho label cảnh báo */
   .label-warning {
      color: #212529;
      background-color: #ffc107;
      border: 1px solid #ffc107;
      /* Viền màu vàng */
   }

   /* Định nghĩa cho label nguy hiểm */
   .label-danger {
      color: #fff;
      background-color: #dc3545;
      border: 1px solid #dc3545;
      /* Viền màu đỏ */
   }

   .label-will {
      color: #fff;
      background-color: #33CC99;
      border: 1px solid #33CC99;
      /* Viền màu đỏ */
   }
</style>
<div class="content">
   <section class="content-header my-2">
      <h1 class="d-inline">Sản phẩm</h1>


      <div class="row my-2 align-items-center">
         <div class="col-5">
            <ul class="manager">
               <span><a class="bi bi-bookmark" href="category_index.html">Tất cả:{{ $activeCategoryCount1 }} </a></span>
               <span>|</span>
               <span><a class="bi bi-bookmark-check-fill" href="#"> Xuất bản:{{ $activeCategoryCount }}</a></span>
               <span>|</span>
               <span><a class="bi bi-trash2" href="{{route("admin.product.trash")}}"> Rác:{{ $activeCategoryCount2 }}</a></span>
            </ul>
         </div>
         <div class="col-md-5 text-end">
            <form action="{{ route('admin.product.index') }}" method="GET" class="d-inline">
               <input type="text" name="search" class="search d-inline" value="{{ request()->get('search') }}" />
               <button type="submit" class="d-inline btnsearch">Tìm kiếm</button>
            </form>
         </div>
         <div class="col-md-2 text-end">
            <a href="{{route('admin.product.create')}}" class="btn btn-secondary">Thêm mới</a>

         </div>
      </div>
   </section>
   <section class="content-body my-2">

      <table class="table table-bordered">
         <thead>
            <tr>

               <th class="text-center" style="width:130px;">Hình ảnh</th>
               <th>Sản phẩm</th>
               <th>Danh mục</th>
               <th>Tên thương hiệu</th>
               <th>Số lượng</th>
               <th>Trạng thái</th>
               <th></th>
            </tr>
         </thead>
         <tbody>
            @foreach($list as $row)

            <tr class="datarow">

               <td>
                  <img src="{{asset("images/product/".$row->image)}}" class="img-fluid" alt="{{$row->image}}" width="70">
               </td>

               <td>
                  <div class="name">
                     <a href="product_edit.html">
                        {{$row->name}}
                     </a>
                  </div>
                  <div class="function_style">

                     @php
                     $agrs =['id'=>$row->id];
                     @endphp
                     @if ($row->status==1)
                     <a href="{{route("admin.product.status",$agrs)}}" class="px-1 text-success">
                        <i class="bi bi-toggle-on"></i>
                     </a>
                     @else
                     <a href="{{route("admin.product.status",$agrs)}}" class="px-1 text-success">
                        <i class="bi bi-toggle-off"></i>
                     </a>
                     @endif
                     <a href="{{route('admin.product.edit' ,$agrs)}}" class="px-1 text-primary">
                        <i class="bi bi-pencil-square"></i>
                     </a>
                     <a href="product_show.html" class="text-info mx-1">
                        <i class="bi bi-eye"></i>
                     </a>
                     <a href="{{route("admin.product.destroy",$agrs)}}" class="text-danger mx-1">
                        <i class="bi bi-trash"></i>
                     </a>
                  </div>
               </td>
               <td>{{ $row->category ? $row->category->name : 'không có danh mục' }}</td>
               <td>{{ $row->brand ? $row->brand->name : 'không có thương hiệu' }}</td>
               <td>{{$row->qty}}</td>
               <td>
                  @if ($row->status == 1)
                  <span class="label label-success">Hiển thị</span>
                  @elseif ($row->status == 2)
                  <span class="label label-warning">Ẩn</span>
                  @elseif ($row->status == 3)
                  <span class="label label-danger">Đã hết</span>
                  @elseif ($row->status == 4)
                  <span class="label label-will">Đang nhập kho</span>
                  @endif
               </td>
               @if ($row->pricesale == null)
               <td class="text-center" style="width:30px;">
                  <a href="{{ route('admin.product.editsale', ['id' => $row->id]) }}">
                     Giảm giá</a>
               </td>
               @else
               <td class="text-center" style="width:30px;">
                  <a href="{{ route('admin.product.sale')}}">
                     Đã giảm giá</a>
               </td>
               @endif

            </tr>
            @endforeach

         </tbody>
         <div style="margin-left:80%;">
         {{$list->links()}}

         </div>
         
      </table>

   </section>
</div>
@endsection
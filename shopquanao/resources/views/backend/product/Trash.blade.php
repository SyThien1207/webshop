@extends('layouts.dashboard')
@section('content')
<div class="content">
<div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="mb-0">Thùng rác</h1>
            <a href="{{route('admin.product.index')}}" class="btn btn-secondary">Trở lại</a>
        </div>
   <section class="content-body my-2">

      <table class="table table-bordered">
         <thead>
            <tr>
               <th class="text-center" style="width:30px;">
                  <input type="checkbox" id="checkboxAll" />
               </th>
               <th class="text-center" style="width:130px;">Hình ảnh</th>
               <th>Tên sản phẩm</th>
               <th>Tên danh mục</th>
               <th>Tên thương hiệu</th>
               <th>ID</th>
            </tr>
         </thead>
         <tbody>
            @foreach($list as $row)

            <tr class="datarow">
               <td>
                  <input type="checkbox" id="checkId" />
               </td>
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
                     <a href="{{route("admin.product.restore",$agrs)}}" class="text-primary mx-1">
                        <i class="bi bi-arrow-clockwise"></i>
                     </a>
                     <a href="{{route("admin.product.delete",$agrs)}}" class="text-danger mx-1">
                        <i class="bi bi-trash2"></i>
                     </a>
                  </div>
               </td>
               <td>{{ $row->category ? $row->category->name : 'không có danh mục' }}</td>
               <td>{{ $row->brand ? $row->brand->name : 'không có thương hiệu' }}</td>
               <td class="text-center" style="width:30px;"> {{$row->id}}</td>
            </tr>
            @endforeach

         </tbody>
      </table>

   </section>
</div>
@endsection
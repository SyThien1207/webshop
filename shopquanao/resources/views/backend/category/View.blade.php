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
    border: 1px solid #28a745; /* Viền màu xanh */
}

/* Định nghĩa cho label cảnh báo */
.label-warning {
    color: #212529;
    background-color: #ffc107;
    border: 1px solid #ffc107; /* Viền màu vàng */
}

/* Định nghĩa cho label nguy hiểm */
.label-danger {
    color: #fff;
    background-color: #dc3545;
    border: 1px solid #dc3545; /* Viền màu đỏ */
}
.label-will {
    color: #fff;
    background-color: #33CC99;
    border: 1px solid #33CC99; /* Viền màu đỏ */
}
</style>
<div class="content">
 
   <section class="content-body my-2">
      <table class="table table-bordered">
         <thead>
            <tr>
               <th class="text-center" style="width:130px;">Hình ảnh</th>
               <th>Sản phẩm</th>
               <th>Danh mục</th>
               
               <th>Số lượng</th>
               <th>Trạng thái</th>
               <th>ID</th>
            </tr>
         </thead>
         <tbody>
         <form action="{{ route('admin.category.view',['slug' => $category['slug']]) }}" method="GET" class="form-inline">

         @forelse($products as $product)
            <tr class="datarow">
               <td>
                  <img src="{{ asset('images/product/' . $product->image) }}" class="img-fluid" alt="{{ $product->image }}" width="70">
               </td>
               <td>
                  <div class="name">
                     <a href="{{ route('admin.product.edit', ['id' => $product->id]) }}">
                        {{ $product->name }}
                     </a>
                  </div>
                  <div class="function_style">
                     @if ($product->status == 1)
                     <a href="{{ route('admin.product.status', ['id' => $product->id]) }}" class="px-1 text-success">
                        <i class="bi bi-toggle-on"></i>
                     </a>
                     @else
                     <a href="{{ route('admin.product.status', ['id' => $product->id]) }}" class="px-1 text-success">
                        <i class="bi bi-toggle-off"></i>
                     </a>
                     @endif
                     <a href="{{ route('admin.product.edit', ['id' => $product->id]) }}" class="px-1 text-primary">
                        <i class="bi bi-pencil-square"></i>
                     </a>
                     <a href="{{ route('admin.product.show', ['id' => $product->id]) }}" class="text-info mx-1">
                        <i class="bi bi-eye"></i>
                     </a>
                     <a href="{{ route('admin.product.destroy', ['id' => $product->id]) }}" class="text-danger mx-1">
                        <i class="bi bi-trash"></i>
                     </a>
                  </div>
               </td>
               <td>{{ $product->category ? $product->category->name : 'Không có danh mục' }}</td>
               <td>{{ $product->qty }}</td>
               <td>
                  @if ($product->status == 1)
                  <span class="label label-success">Hiển thị</span>
                  @elseif ($product->status == 2)
                  <span class="label label-warning">Ẩn</span>
                  @elseif ($product->status == 3)
                  <span class="label label-danger">Đã hết</span>
                  @elseif ($product->status == 4)
                  <span class="label label-will">Đang nhập kho</span>
                  @endif
               </td>
               <td class="text-center" style="width:30px;">{{ $product->id }}</td>
            </tr>
            @empty
                        <span style="color: red;">Không có dữ liệu</span>
                        @endforelse
         </form>
         </tbody>
      </table>

      {{ $products->links() }}
   </section>
</div>
@endsection

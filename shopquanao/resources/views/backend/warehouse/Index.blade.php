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

    /* Styles for modal */
    .modal {
        display: none; /* Ban đầu ẩn modal */
        position: fixed;
    position: fixed; /* Cố định modal trên màn hình (không cuộn theo trang) */
    z-index: 1; /* Đảm bảo modal nằm trên các phần tử khác */
    padding-top: 100px; /* Thêm khoảng cách trên đầu modal */
   
    width: 100%; /* Chiều rộng 100% màn hình */
    height: 100%; /* Chiều cao 100% màn hình */
    overflow: auto; /* Cho phép cuộn nội dung bên trong modal nếu vượt quá kích thước */
    background-color: rgb(0, 0, 0); /* Màu nền đen */
    background-color: rgba(0, 0, 0, 0.4); /* Màu nền đen với độ trong suốt 0.4 */
    justify-content: center; /* Canh giữa modal theo chiều ngang */
    align-items: center; /* Canh giữa modal theo chiều dọc */
}

.modal-content {
    background-color: #fefefe; /* Màu nền trắng của nội dung modal */
    margin: 20px; /* Canh giữa nội dung modal */
    padding: 20px; /* Thêm khoảng cách bên trong nội dung modal */
    border: 1px solid #888; /* Đường viền màu xám nhạt */
    width: 7000px; /* Chiều rộng của nội dung modal, điều chỉnh thành 700px */
    height: 794px; /* Chiều cao của nội dung modal, tương đương kích thước A4 */
    left: 10%;
    bottom: 0%;
    max-width: 60%; /* Chiều rộng tối đa 100% */
    max-height: 120%; /* Chiều cao tối đa 100% */
    box-sizing: border-box; /* Đảm bảo padding và border không làm thay đổi kích thước của modal */
    display: flex; /* Sử dụng flexbox cho bố cục nội dung */
    flex-direction: column; /* Bố cục theo chiều dọc */
    justify-content: center; /* Canh giữa nội dung theo chiều ngang */
    align-items: center; /* Canh giữa nội dung theo chiều dọc */
}


.close {
      position: absolute;
      /* Đặt nút close ở vị trí tuyệt đối */
      top: 10px;
      /* Cách trên cùng của modal 10px */
      right: 20px;
      /* Cách bên phải của modal 20px */
      color: #aaa;
      /* Màu chữ xám nhạt cho nút đóng */
      font-size: 28px;
      /* Kích thước chữ của nút đóng */
      font-weight: bold;
      /* Đậm chữ cho nút đóng */
      z-index: 2;
      /* Đảm bảo nút close nằm trên tất cả các phần tử khác trong modal */
   }
.close:hover,
.close:focus {
    color: black; /* Đổi màu chữ thành đen khi hover hoặc focus */
    text-decoration: none; /* Bỏ gạch chân cho nút đóng khi hover hoặc focus */
    cursor: pointer; /* Thay đổi con trỏ thành hình bàn tay khi hover */
}

</style>
<div class="content">
    <section class="content-header my-2">
        <h1 class="d-inline">Sản phẩm nhập kho</h1>


        <div class="row my-2 align-items-center">
            <div class="col-5">
                <ul class="manager">
                    <span><a class="bi bi-bookmark" href="category_index.html">Tất cả:{{ $activeCategoryCount1 }} </a></span>
                  
                    <span>|</span>
                    <span><a class="bi bi-trash2" href="{{route("admin.warehouse.trash")}}"> Rác:{{ $activeCategoryCount2 }}</a></span>
                </ul>
            </div>
            <div class="col-md-5 text-end">
    <form action="{{ route('admin.warehouse.index') }}" method="GET" class="d-inline">
        <input type="text" name="search" class="search d-inline" value="{{ request()->get('search') }}" />
        <button type="submit" class="d-inline btnsearch">Tìm kiếm</button>
    </form>
</div>

            <div class="col-md-2 text-end">
                <a href="{{route('admin.warehouse.create')}}" class="btn btn-secondary">Thêm mới</a>

            </div>
        </div>
    </section>

    <section class="content-body my-2">

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Sản phẩm</th>
                    <th>Nhà cung cấp</th>
                    <th>Số lượng</th>
                    <th>Trạng thái</th>
                    <th>Actor</th>
                </tr>
            </thead>
            <tbody>
                @foreach($list as $row)

                <tr class="datarow">



                    <td>
                        <div class="name">
                            <a href="warehouse_edit.html">
                                {!!$row->product->name!!}
                            </a>
                        </div>
                        <div class="function_style">

                            @php
                            $agrs =['id'=>$row->id];
                            @endphp
                            @if ($row->status != 1)
                            <a href="{{route('admin.warehouse.edit' ,$agrs)}}" class="px-1 text-primary">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <a href="{{route("admin.warehouse.destroy",$agrs)}}" class="text-danger mx-1">
                                <i class="bi bi-trash"></i>
                            </a>
                            @endif
                            <a href="#" class="text-info mx-1 view-details" data-id="{{ $row->id }}">
                                <i class="bi bi-eye"></i>
                            </a>
                        </div>
                    </td>
                    <td>{{ $row->supplier ? $row->supplier->name : 'không có nhà cung cấp' }}</td>
                    <td>{{$row->qty}}</td>
                    <td>
                        @if ($row->status == 1)
                        <span class="label label-success">Đã nhập kho</span>
                        @elseif ($row->status != 1)
                        <span class="label label-will">Chưa nhập kho</span>
                       
                        @endif
                    </td>
                    <td>
    <div>
        @if ($row->status == 1)
                            </a>
                            <a href="{{route("admin.warehouse.destroy",$agrs)}}" class="text-danger mx-1">  <span class="bi bi-trash">Xóa</span>
        @else
            <a href="{{ route('admin.warehouse.dowProducts', ['id' => $row->id, 'qty' => $row->qty]) }}" class="bi bi-box-arrow-in-down">Nhập sản phẩm</a>
        @endif
    </div>
    </td>

                </tr>
                @endforeach
            </tbody>
        </table>

    </section>
</div>

<!-- Modal Dialog -->
<div id="detailsModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2 style="top: 50px">Phiếu nhập hàng</h2>
        <div id="modalBody">
            <!-- Nội dung sẽ được AJAX load vào đây -->
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const modal = document.getElementById("detailsModal");
        const span = document.getElementsByClassName("close")[0];

        document.querySelectorAll('.view-details').forEach(item => {
            item.addEventListener('click', event => {
                event.preventDefault();
                const warehouseId = item.getAttribute('data-id');

                // Gọi AJAX để lấy nội dung chi tiết
                fetch(`/admin/warehouse/details/${warehouseId}`)
                    .then(response => response.text())
                    .then(data => {
                        document.getElementById('modalBody').innerHTML = data;
                        modal.style.display = "block";
                    })
                    .catch(error => console.error('Error:', error));
            });
        });

        // Đóng Modal khi nhấn vào nút x
        span.onclick = function() {
            modal.style.display = "none";
        }

        // Đóng Modal khi nhấn bên ngoài Modal
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    });
</script>
@endsection
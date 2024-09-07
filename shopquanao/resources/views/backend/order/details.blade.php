<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bảng Báo Giá</title>
    <link rel="stylesheet" href="styles.css">
</head>
<style>
/* General Styles */
body1 {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
}

.container1 {
    width: 80%;
    margin: auto;
    padding: 20px;
}

header1 {
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-bottom: 1px solid #000;
    padding-bottom: 10px;
}

.header1-left {
    max-width: 70%;
}

.header1-right img {
    max-width: 100px;
}

main1 {
    margin-top: 20px;
}


table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

table, th, td {
    border: 1px solid #000;
}



.summary {
    margin-top: 20px;
    text-align: right;
}

footer {
    margin-top: 40px;
}

.signature {
    display: flex;
    justify-content: space-between;
    margin-top: 20px;
}

/* Modal Styles */

.modal-content {
    background-color: #fefefe;
    margin: auto;
    padding: 20px;
    border: 1px solid #888;
    width: 100%;
    max-width: 800px; /* Adjust as needed */
    box-sizing: border-box;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}

.close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
    cursor: pointer;
}

.close:hover,
.close:focus {
    color: black;
    text-decoration: none;
}

</style>
<body1>
    <div class="container1">
 
        <main1>
           
            <p><strong>Người nhận: </strong>{{$order->user->name}}</p>
            <p><strong>Địa chỉ:</strong> {{$order->user->address}} </p>
         <p><strong>Sô điện thoại:  </strong>{{$order->user->phone}}    <strong>Email: </strong>{{$order->user->email}}</p>
            <p>*Nội dung sản phẩm</p>
            <table>
                <thead>
                    <tr>
               <th class="text-center" style="width:130px;">Hình ảnh</th>
                       
                        <th>Tên sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Giảm giá</th>
                        <th>Thành tiền(vnd)</th>
                        <th>Ngày đặt</th>
                        <th>Trạng thái</th>

                    </tr>
                </thead>
                <tbody>
                    <tr>
                       
                    <td>
                    <img src="{{asset("images/product/".$row->product->image)}}" class="img-fluid" alt="{{$row->product->image}}" width="70">

               </td>
               <td>
                {{$row->product->name}}
               </td>
               <td>
                {{$row->qty}}
               </td>
               <td>
                {{$row->discount ? $row->discount:0}}
               </td>
               <td>
                {{$row->amount}}
               </td>
          
               <td> {{ \Carbon\Carbon::parse($order->create_at)->format('d/m/Y') }}
               </td>
           
               <td>
                  @php
                  $agrs =['id'=>$order->id];
                  @endphp
                  @if ($order->status == 5)
                  <span class="label label-warning">Đã hủy </span>
                  @elseif ($order->status == 4)
                  <a href="{{route("admin.order.status",$agrs)}}" class="label label-success">Xác nhận đơn hàng</a>
                  @elseif ($order->status == 3)
                  <a href="{{route("admin.order.status",$agrs)}}" class="label label-warning">Đang chuẩn bị hàng</a>
                  @elseif ($order->status == 2)
                  <a href="{{route("admin.order.status",$agrs)}}" class="label label-warning">Đang giao</a>
                  @elseif ($order->status == 1)
                  <span class="label label-warning">Đã nhận </span>
                  @endif
               </td>
               </td>
                    </tr>
                  
                </tbody>
            </table>
        
          
        </main1>
    </div>
</body1>
</html>

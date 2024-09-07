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
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
}

.container {
    width: 80%;
    margin: auto;
    padding: 20px;
}

header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-bottom: 1px solid #000;
    padding-bottom: 10px;
}

.header-left {
    max-width: 70%;
}

.header-right img {
    max-width: 100px;
}

main {
    margin-top: 20px;
}

h1, h2 {
    text-align: center;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

table, th, td {
    border: 1px solid #000;
}

th, td {
    padding: 10px;
    text-align: center;
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
.modal {
    display: none; /* Initially hidden */
    position: fixed; /* Fixed positioning to overlay */
    z-index: 1; /* On top of other content */
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto; /* Scroll if content exceeds viewport */
    background-color: rgba(0, 0, 0, 0.4); /* Semi-transparent background */
    justify-content: center;
    align-items: center;
    padding: 20px; /* Padding around modal */
}

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
<body>
    <div class="container">
 
        <main>
           
            <p><strong>Kính gửi: </strong>{{$warehouse->supplier->name}}</p>
            <p>Địa chỉ: {{$warehouse->supplier->address}}</p>
            <p>Shop Sỹ Thiện😅 xin trân trọng gửi tới quý Công ty phiêú nhập hàng như sau:</p>
            <p>*Nội dung sản phẩm</p>
            <table>
                <thead>
                    <tr>
                       
                        <th>Tên sản phẩm</th>
                        <th>Đơn vị tính</th>
                        <th>Số lượng</th>
                        <th>Đơn giá(vnd)</th>
                        <th>Thành tiền(vnd)</th>
                        <th>Trạng thái</th>

                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{$warehouse->product->name}}</td>
                        <td>Cái</td>
                        <td>{{$warehouse->qty}}</td>
                        <td>{{$warehouse->price}}</td>
                        <td>{{ number_format($warehouse->qty * $warehouse->price, 0, ',', '.') }}</td>  
                        <td>
                        @if ($warehouse->status != 2)
                        <span >Đã thanh toán</span>
                        @elseif ($warehouse->status == 3)
                        <span >Chưa thanh toán</span>
                       
                        @endif
                    </td>

                    </tr>
                  
                </tbody>
            </table>
        
            <footer>
                <p>tpHCM, {{ \Carbon\Carbon::parse($warehouse->entry_date)->format('d/m/Y') }}</p>
                <div class="signature">
                    <p>Xác nhận của Shop Sỹ Thiện</p>
                  
                </div>
                <div class="signature">
                    <p>Xác nhận của Shop Sỹ Thiện</p>
                    <p>{{$warehouse->supplier->contact_person}}</p>
                </div>
            </footer>
        </main>
    </div>
</body>
</html>

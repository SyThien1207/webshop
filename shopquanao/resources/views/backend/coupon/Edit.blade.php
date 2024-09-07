@extends('layouts.dashboard')
@section('content')
<div class="content">
                  <section class="content-header my-2">
                     <h1 class="d-inline">Cập nhật</h1>
                    

                     <hr style="border: none;">
                  </section>
                  <section class="content-body my-2">

                     <div class="row">
                        <div class="col-md-12">
                        <form action="{{ route('admin.coupon.update', ['id' => $coupon->id]) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method ("put")
                           <div class="mb-3">
                              <label>
                                 <strong>Tên phiếu giảm giá</strong>
                              </label>
                              <input type="text"value="{{old('name',$coupon->coupon_name)}}" name="name" id="name" placeholder="Nhập tên phiếu giảm giá"
                                 class="form-control" required>
                           </div>
                           <div class="mb-3">
                              <label>
                                 <strong>Mã giảm giá</strong>
                              </label>
                              <input type="text"value="{{old('code',$coupon->coupon_code)}}" name="code" id="code" placeholder="Nhập mã giảm giá"
                                 class="form-control" required>
                           </div>
                           <div class="mb-3">
                              <label>
                                 <strong>Số lần sử dụng</strong>
                              </label>
                              <input type="number"value="{{old('time',$coupon->coupon_time)}}" name="time" id="time" placeholder="Nhập số lần sử dụng"
                                 class="form-control" required>
                           </div>
                           <div class="mb-3">
                <label for="condition">Loại giảm giá</label>
                <select name="condition" id="condition" class="form-control">
                  <option value="0">----Chọn loại giảm giá----</option>
                  <option value="1"{{($coupon->coupon_condition==1)?'selected':''}}>Giảm theo %</option>
                  <option value="2"{{($coupon->coupon_condition==2)?'selected':''}}>Giảm theo theo tiền</option>
                </select>  
                           </div>             
                <div class="mb-3">
                              <label>
                                 <strong>Giá trị</strong>
                              </label>
                              <input type="number"value="{{old('number',$coupon->coupon_number)}}" name="number" id="number" placeholder="Nhập giá trị phiếu"
                                 class="form-control" required>
                           </div>

                           <div class="mb-3">
                              <label><strong>Trạng thái</strong></label>
                              <select name="status" class="form-control">
                              <option value="2" {{($coupon->status==2)?'selected':''}}>--Chưa xuất bản--</option>
                              <option value="1" {{($coupon->status==1)?'selected':''}}>--Xuất bản--</option>
                              </select>
                           </div>
                           <div class="mb-3 text-end">
                              <button type="submit" class="btn btn-success" name="THEM">
                                 <i class="bi bi-save"></i> Lưu[Thêm]
                              </button>
                           </div>
            </form>

                        </div>
                      
                     </div>

                  </section>
               </div>
          
@endsection 
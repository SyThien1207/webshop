@extends('layouts.dashboard')
@section('content')
                  <div class="content">   <form action="{{ route('admin.user.update', ['id' => $user->id]) }}" method="post" enctype="multipart/form-data">
                     @csrf
              @method ("put") 
                     <section class="content-header my-2">
                        <h1 class="d-inline">Cập nhật thành viên</h1>
                        <div class="row mt-2 align-items-center">
                           <div class="col-md-12 text-end">
                              <button class="btn btn-success btn-sm" name="CAPNHAT">
                                 <i class="fa fa-save"></i> Lưu [Cập nhật]
                              </button>
                              <a href="user_index.html" class="btn btn-primary btn-sm">
                                 <i class="fa fa-arrow-left"></i> Về danh sách
                              </a>
                           </div>
                        </div>
                     </section>
                     <section class="content-body my-2">
                  
                        <div class="row">
                           <div class="col-md-6">
                              <div class="mb-3">
                                 <label><strong>Tên đăng nhập(*)</strong></label>
                                 <input type="text" value="{{old('username',$user->username)}}"name="username" class="form-control" placeholder="Tên đăng nhập" />
                              </div>
                              <div class="mb-3">
    <label><strong>Mật khẩu(*)</strong></label>
    <input type="text" name="password" class="form-control" value="{{old('password',$user->password)}} "/>
</div>


                              <div class="mb-3">
                                 <label><strong>Email(*)</strong></label>
                                 <input type="text" value="{{old('email',$user->email)}}"name="email" class="form-control" placeholder="Email" />
                              </div>
                              
                              <div class="mb-3">
                                 <label><strong>Điện thoại(*)</strong></label>
                                 <input type="text" value="{{old('phone',$user->phone)}}"name="phone" class="form-control" placeholder="Điện thoại" />
                              </div>
                              <div class="mb-3">
                                 <label><strong>Quyền</strong></label>
                                 <select name="roles" id="gender" class="form-select">
                                    <option>Cấp quyền</option>
                                    { {!!$htmlroles!!} }
                                 </select>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="mb-3">
                                 <label><strong>Họ tên (*)</strong></label>
                                 <input type="text" value="{{old('name',$user->name)}}"name="name" class="form-control" placeholder="Họ tên" />
                              </div>
                              <div class="mb-3">
                                 <label><strong>Giới tính</strong></label>
                                 <select name="gender" id="gender" class="form-select">
                                    <option>Chọn giới tinh</option>
                                    <option value="2"{{($user->gender==2)?'selected':''}}>nu</option>
                                    <option value="1"{{($user->gender==1)?'selected':''}}>nam</option>
                                 </select>
                              </div>
                              <div class="mb-3">
                                 <label><strong>Địa chỉ</strong></label>
                                 <input type="text"value="{{old('address',$user->address)}}" name="address" class="form-control" placeholder="Địa chỉ" />
                              </div>
                              <div class="mb-3">
                <label for="image">Hình Ảnh</label>
                <input type="file"  alt="{{$user->image}}" name="image" id="image" class="form-control">
              </div>
                              <div class="mb-3">
                                 <label><strong>Trạng thái</strong></label>
                                 <select name="status" class="form-select">
                                 <option value="2"{{($user->status==2)?'selected':''}}>--Chưa xuất bản--</option>
                                 <option value="1"{{($user->status==1)?'selected':''}}>--Xuất bản--</option>
                                 </select>
                              </div>
                           </div>
                        </div>
                   
                     </section>  </form>
                  </div>
               @endsection 

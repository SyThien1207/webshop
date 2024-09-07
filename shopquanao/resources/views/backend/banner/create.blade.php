@extends('layouts.dashboard')
@section('content')
<div class="content">
                  <section class="content-header my-2">
                  <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="mb-0">Cập nhật banner</h1>
            <a href="{{route('admin.banner.index')}}" class="btn btn-secondary">Trở lại</a>
        </div>
                  </section>
                  <section class="content-body my-2"> 
                      <form action="{{route('admin.banner.store')}}" 
                        method="post"enctype="multipart/form-data"> 
              @csrf
                     <div class="row">
                        <div class="col-md-9">
                      
                           <div class="mb-3">
                              <label><strong>Tên banner (*)</strong></label>
                              <input type="text" value="{{old('name')}}"  name="name" class="form-control" placeholder="Nhập tên banner" required/>
                           </div>

                         
                           <div class="mb-3">
                              <label><strong>Liên kết</strong></label>
                              <input type="text"  value="{{old('link')}}" name="link" class="form-control" placeholder="Nhập liên kết" required/>
                           </div>  <div class="mb-3">
                        <label for="image">Hình Ảnh</label>
                        <input type="file" name="image" id="image" class="form-control" onchange="previewImage()" required>
                        <div class="mt-2">
                            
                            <div id="new-image-preview" class="d-inline-block"></div>
                        </div>
                    </div>
                           <div class="mb-3">
                              <label><strong>Mô tả (*)</strong></label>
                              <textarea name="description" rows="5" class="form-control"
                                 placeholder="Nhập mô tả" required>{{old("description")}}</textarea>
                           </div>
                        </div>
                        <div class="col-md-3">
                           <div class="box-container mt-4 bg-white">
                              <div class="box-header py-1 px-2 border-bottom">
                                 <strong>Đăng</strong>
                              </div>
                              <div class="box-body p-2 border-bottom">
                                 <p>Chọn trạng thái đăng</p>
                                 <select name="status" id="status" class="form-select">
                                    <option value="1">Xuất bản</option>
                                    <option value="2">Chưa xuất bản</option>
                                 </select>
                              </div>
                              <div class="box-footer text-end px-2 py-3">
                                 <button type="submit" class="btn btn-success btn-sm text-end">
                                    <i class="fa fa-save" aria-hidden="true"></i> Đăng
                                 </button>
                              </div>
                           </div>
                           <div class="box-container mt-4 bg-white">
                              <div class="box-header py-1 px-2 border-bottom">
                                 <strong>Vị trí (*)</strong>
                              </div>
                              <div class="box-body p-2 border-bottom">
                                 <select name="position" class="form-select" required>
                                 <option value="slideshow">slideshow</option>
                                 <option value="banner-clone">banner clone</option>
                                 </select>
                                 <p class="pt-2">Vị trí hiển thị banner</p>
                              </div>
                           </div>
                           </div>
                           </div>
                          
                     </div>     </form>
                  </section>
               </div>
@endsection 
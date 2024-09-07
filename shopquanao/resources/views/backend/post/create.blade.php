@extends('layouts.dashboard')
@section('content')
<div class="content">
                  <section class="content-header my-2">
                     <h1 class="d-inline">Thêm bài viết</h1>
                     <div class="text-end">
                        <a hhref="{{route('admin.post.index')}}" class="btn btn-sm btn-success">
                           <i class="fa fa-arrow-left"></i> Về danh sách
                        </a>
                     </div>
                  </section>
                  <section class="content-body my-2">
                  <form action="{{route('admin.post.store')}}" 
                  method="post" enctype="multipart/form-data">
                  @csrf
                     <div class="row">
                        <div class="col-md-9">
                           <div class="mb-3">
                              <label><strong>Tiêu đề bài viết (*)</strong></label>
                              <input type="text"value="{{old('title')}}" name="title" class="form-control" placeholder="Nhập tiêu đề"required />
                           </div> 
                           <div class="mb-3">
                              <label><strong>Mô tả (*)</strong></label>
                              <textarea name="description" rows="4" class="form-control" placeholder="Mô tả"required>{{old("description")}}</textarea>
                           </div>
                           <div class="mb-3">
                        <label><strong>Chi tiết (*)</strong></label>
                        <textarea name="detail" id="editor1" placeholder="Nhập chi tiết sản phẩm" rows="7" class="form-control"required>{{old('detail')}}</textarea>
                    </div>
                          
                        </div>
                        <div class="col-md-3">
                           <div class="box-container mt-4 bg-white">
                              <div class="box-header py-1 px-2 border-bottom">
                                 <strong>Đăng</strong>
                              </div>
                              <div class="box-body p-2 border-bottom">
                                 <p>Chọn trạng thái đăng</p>
                                 <select name="status" class="form-select">
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
                           <div class="box-container mt-2 bg-white">
                              <div class="box-header py-1 px-2 border-bottom">
                                 <strong>Chủ đề (*)</strong>
                              </div>
                              <div class="box-body p-2 border-bottom">
                                 <select name="topic_id" class="form-select">
                                    <option value="">None</option>
                  {!! $html_topic_id !!}

                                 </select>
                              </div>
                           </div>
                           <div class="box-container mt-4 bg-white">
                              <div class="box-header py-1 px-2 border-bottom">
                                 <strong>Kiểu</strong>
                              </div>
                              <div class="box-body p-2 border-bottom">
                                 <select name="type" class="form-select">
                                 <option value="post">Post</option>
                                 <option value="page">page</option>
                                 </select>
                                 <p class="pt-2">Vị trí hiển thị banner</p>
                              </div>
                           </div>
                           <div class="box-container mt-2 bg-white">
                              <div class="box-header py-1 px-2 border-bottom">
                                 <strong>Hình đại diện</strong>
                              </div>
                              <div class="box-body p-2 border-bottom">
                                 <input type="file" name="image" class="form-control" required/>
                              </div>
                           </div>
                        </div>
                     </div>

            </form>
                  </section>
               </div>
@endsection 

@section('custom-js')
<script src="{{asset('assets/ckeditor/ckeditor.js')}}"></script>
<script>
    CKEDITOR.replace('editor1');
</script>
@endsection
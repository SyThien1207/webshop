@extends('layouts.dashboard')
@section('content')
<div class="content">
                  <section class="content-header my-2">
                     <h1 class="d-inline">Chủ đề bài viết</h1>
                     <hr style="border: none;" />
                  </section>
                  <section class="content-body my-2">
                  <form action="{{ route('admin.topic.update', ['id' => $topic->id]) }}"
                     method="post"enctype="multipart/form-data"> 
              @csrf
              @method ("put") 
                     <div class="row">
                           <div class="mb-3">
                              <label><strong>Tên chủ đề (*)</strong></label>
                              <input type="text" value="{{old('name',$topic->name)}}" name="name" class="form-control" placeholder="Tên chủ để">
                           </div>
                           <div class="mb-3">
                              <label><strong><strong>Mô tả</strong></strong></label>
                              <textarea name="description" rows="6" class="form-control">"{{old('name',$topic->description)}}"</textarea>
                           </div>
                           <div class="col-md-12">
                           <div class="box-container mt-4 bg-white">
                              <div class="box-header py-1 px-2 border-bottom">
                                 <strong>Đăng</strong>
                              </div>
                              <div class="box-container mt-2 bg-white">
                              <div class="box-header py-1 px-2 border-bottom">
                                 <strong>Sắp xếp</strong>
                              </div>
                              <div class="box-body p-2 border-bottom">
                                 <select name="category_id" class="form-select">
                                  { {!! $htmlsortorder !!} }
                                 </select>
                              </div>
                           </div>
                              <div class="box-body p-2 border-bottom">
                              <div class="box-header py-1 px-2 border-bottom">
                                 <strong>Trạng thái</strong>
                              </div>
                                 <select name="status" class="form-select">
                                 <option value="2"{{($topic->status==2)?'selected':''}}>--Chưa xuất bản--</option>
                                 <option value="1"{{($topic->status==1)?'selected':''}}>--Xuất bản--</option>
                                 </select>
                              </div>
                              <div class="box-footer text-end px-2 py-2">
                                 <button type="submit" class="btn btn-success btn-sm text-end">
                                    <i class="fa fa-save" aria-hidden="true"></i> Đăng
                                 </button>
                              </div>
                           </div>
                       
                        
                          
                        </div>
                        </div>
                  </form>

                  </section>
               </div>
               @endsection 

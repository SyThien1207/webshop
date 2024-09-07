@extends('layouts.dashboard')
@section('content')
<div class="content">
                  <section class="content-header my-2">
                     <h1 class="d-inline">Quản lý menu</h1>
                     <a class="btn-add" href="{{route('admin.menu.trash')}}">Thùng rác</a>

        
                  </section>
                  <section class="content-body my-2">
                     <div class="row"> 
                        <div class="col-md-3">
                        <form action="{{ route('admin.menu.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                           <ul class="list-group">
                              <li class="list-group-item mb-2">
                                 <select name="position" class="form-control">
                                 <option value="mainmenu">main menu</option>
                                 <option value="footermenu">footer menu</option>
                                 </select>
                              </li>
                              <li class="list-group-item mb-2 border">
                                 <a class="d-block" href="#multiCollapseCategory" data-bs-toggle="collapse">
                                    Danh mục sản phẩm
                                 </a>
                                 <div class="collapse multi-collapse border-top mt-2" id="multiCollapseCategory">
                                    @foreach ($list_category as $category )
                                    
                                    
                                    <div class="form-check">
                                       <input name="categoryid[]" class="form-check-input" type="checkbox" value="{{ $category->id}}"
                                          id="category{{$category->id}}" />
                                       <label class="form-check-label" for="categoryid{{$category->id}}">
                                         {{$category->name}}
                                       </label>
                                    </div>@endforeach
                                    <div class="my-3"><div class="box-body p-2 border-bottom">
                                 <p>Chọn trạng thái đăng</p>
                                 <select name="status" class="form-select">
                                    <option value="1">Xuất bản</option>
                                    <option value="2">Chưa xuất bản</option>
                                 </select>
                              </div>
                                       <button name="createCategory" type="submit"
                                          class="btn btn-sm btn-success form-control">Thêm</button>
                                    </div>
                                 </div>
                              </li>
                              <li class="list-group-item mb-2 border">
                                 <a class="d-block" href="#multiCollapseBrand" data-bs-toggle="collapse">
                                    Thương hiệu
                                 </a>
                                 <div class="collapse multi-collapse border-top mt-2" id="multiCollapseBrand">
                                 @foreach ($list_brand as $brand )
                                    
                                    
                                    <div class="form-check">
                                       <input name="brandid[]" class="form-check-input" type="checkbox" value="{{ $brand->id}}"
                                          id="brand{{$brand->id}}" />
                                       <label class="form-check-label" for="brandid{{$brand->id}}">
                                         {{$brand->name}}
                                       </label>
                                    </div>@endforeach
                                    <div class="my-3"><div class="box-body p-2 border-bottom">
                                 <p>Chọn trạng thái đăng</p>
                                 <select name="status" class="form-select">
                                    <option value="1">Xuất bản</option>
                                    <option value="2">Chưa xuất bản</option>
                                 </select>
                              </div>
                                       <button name="createBrand" type="submit"
                                          class="btn btn-sm btn-success form-control">Thêm</button>
                                    </div>
                                 </div>
                              </li>
                              <li class="list-group-item mb-2 border">
                                 <a class="d-block" href="#multiCollapseTopic" data-bs-toggle="collapse">
                                    Chủ đề bài viết
                                 </a>
                                 <div class="collapse multi-collapse border-top mt-2" id="multiCollapseTopic">
                                 @foreach ($list_topic as $topic )
                                    
                                    
                                    <div class="form-check">
                                       <input name="topicid[]" class="form-check-input" type="checkbox" value="{{ $topic->id}}"
                                          id="topic{{$topic->id}}" />
                                       <label class="form-check-label" for="topicid{{$topic->id}}">
                                         {{$topic->name}}
                                       </label>
                                    </div>@endforeach
                                    <div class="my-3"><div class="box-body p-2 border-bottom">
                                 <p>Chọn trạng thái đăng</p>
                                 <select name="status" class="form-select">
                                    <option value="1">Xuất bản</option>
                                    <option value="2">Chưa xuất bản</option>
                                 </select>
                              </div>
                                       <button name="createTopic" type="submit"
                                          class="btn btn-sm btn-success form-control">Thêm</button>
                                    </div>
                                 </div>
                              </li>
                              <li class="list-group-item mb-2 border">
                                 <a class="d-block" href="#multiCollapsepost" data-bs-toggle="collapse">
                                    Trang đơn
                                 </a>
                                 <div class="collapse multi-collapse border-top mt-2" id="multiCollapsepost">
                                 @foreach ($list_post as $post )
                                    
                                    
                                    <div class="form-check">
                                       <input name="postid[]" class="form-check-input" type="checkbox" value="{{ $post->id}}"
                                          id="post{{$post->id}}" />
                                       <label class="form-check-label" for="postid{{$post->id}}">
                                         {{$post->title}}
                                       </label>
                                    </div>@endforeach
                                    <div class="my-3"><div class="box-body p-2 border-bottom">
                                 <p>Chọn trạng thái đăng</p>
                                 <select name="status" class="form-select">
                                    <option value="1">Xuất bản</option>
                                    <option value="2">Chưa xuất bản</option>
                                 </select>
                              </div>
                                       <button name="createPost" type="submit"
                                          class="btn btn-sm btn-success form-control">Thêm</button>
                                    </div>
                                 </div>
                              </li>
                              <li class="list-group-item mb-2 border">
            <a class="d-block" href="#multiCollapseCustom" data-bs-toggle="collapse">
                Tùy biến liên kết
            </a>
            <div class="collapse multi-collapse border-top mt-2" id="multiCollapseCustom">
                <div class="mb-3">
                    <label>Tên menu</label>
                    <input type="text" value="{{ old('name') }}" id="name" name="name" class="form-control" />
                </div>
                <div class="mb-3">
                    <label>Liên kết</label>
                    <input type="text" value="{{ old('link') }}" id="link" name="link" class="form-control" />
                </div>
                <div class="box-body p-2 border-bottom">
                    <p>Chọn trạng thái đăng</p>
                    <select name="status" class="form-select">
                        <option value="1">Xuất bản</option>
                        <option value="2">Chưa xuất bản</option>
                    </select>
                    <button name="createCustom" type="submit" class="btn btn-sm btn-success form-control">Thêm</button>
                </div>
            </div>
        </li>
    </ul>
</form>
                        </div>
                        <div class="col-md-9">
                        <div class="row mt-3 align-items-center">
                    <div class="col-12">
                        <ul class="manager">
                            <span><a class="bi bi-bookmark" href="category_index.html">Tất cả:{{ $activeCategoryCount1 }} </a></span>
                            <span>|</span>
                            <span><a class="bi bi-bookmark-check-fill" href="#"> Xuất bản:{{ $activeCategoryCount }}</a></span>
                            <span>|</span>
                            <span><a class="bi bi-trash2" href="{{route("admin.menu.trash")}}"> Rác:{{ $activeCategoryCount2 }}</a></span>
                        </ul>
                    </div>
                </div>
                <div class="row my-2 align-items-center">
                    <div class="col-md-12 text-end">
                        <form action="{{ route('admin.menu.index') }}" method="GET" class="d-inline">
                            <input type="text" name="search" class="search d-inline" value="{{ request()->get('search') }}" />
                            <button type="submit" class="d-inline btnsearch">Tìm kiếm</button>
                        </form>
                    </div>
                </div>
                <div class="row my-2 align-items-center">
                    {{$list->links()}}
                </div>
                           <table class="table table-bordered">
                              <thead>
                                 <tr>
                                    <th class="text-center" style="width:30px;">
                                       <input type="checkbox" id="checkboxAll" />
                                    </th>
                                    <th>Tên menu</th>
                                    <th>Danh mục cha</th>
                                    <th>Vị trí</th>
                                    <th class="text-center" style="width:30px;">ID</th>
                                 </tr>
                              </thead>
                              <tbody>
                        @foreach($list as $row)
                                 <tr class="datarow">
                                    <td class="text-center">
                                       <input type="checkbox" id="checkId" />
                                    </td>
                                    <td>
                                       <div class="name">
                                       {{$row->name}}
                                       </div>
                                       @php
                                    $agrs =['id'=>$row->id];
                                    @endphp                                                                                           
                                     @if ($row->status==1)
                                    <a href="{{route("admin.menu.status",$agrs)}}" class="px-1 text-success">
                                        <i class="bi bi-toggle-on"></i>
                                    </a>
                                    @else
                                    <a href="{{route("admin.menu.status",$agrs)}}" class="px-1 text-success">
                                        <i class="bi bi-toggle-off"></i>
                                    </a>
                                    @endif
                                    <a href="{{route('admin.menu.edit' ,$agrs)}}" class="px-1 text-primary">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <a href="menu_show.html" class="text-info mx-1">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{route("admin.menu.destroy",$agrs)}}" class="text-danger mx-1">
                                        <i class="bi bi-trash2"></i>
                                    </a>
                                       </div>
                                    </td>
                                    <td>                       {{ $row->parent ? $row->parent->name : 'Null' }}
</td>
                                      <td>                                 {{$row->position}}
</td>
                                    <td class="text-center">
                                    {{$row->id}}

                                    </td>
                                 </tr>
                           @endforeach
                              </tbody>
                           </table>
                        </div>
                     </div>

                  </section>
               </div>
@endsection 
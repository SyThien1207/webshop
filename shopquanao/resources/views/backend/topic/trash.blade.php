@extends('layouts.dashboard')
@section('content')
<div class="content">
                  <section class="content-header my-2">
                     <h1 class="d-inline">Chủ đề bài viết</h1>
      <a class="btn-add" href="{{route('admin.topic.index')}}">trở về</a>

                     <hr style="border: none;" />
                  </section>
                  <section class="content-body my-2">

                     <div class="row">
                   
                   
                    
                        <div class="col-md-8">
                        
                           <table class="table table-bordered">
                              <thead>
                                 <tr>
                                    <th class="text-center" style="width:30px;">
                                       <input type="checkbox" id="checkboxAll" />
                                    </th>
                                    <th>Tên chủ đề</th>
                                    <th>Tên slug</th>
                                    <th class="text-center" style="width:30px;">ID</th>
                                 </tr>
                              </thead>
                              <tbody>
                        @foreach($list as $row)

                                 <tr class="datarow">
                                    <td>
                                       <input type="checkbox" id="checkId" />
                                    </td>
                                    <td>
                                       <div class="name">
                                          <a href="topic_edit.html">
                                          {{$row->name}}
                                          </a>
                                       </div>
                                       <div class="function_style">
                                    @php
                                    $agrs =['id'=>$row->id];
                                    @endphp
                     <a href="{{route("admin.topic.restore",$agrs)}}" class="text-primary mx-1">
                        <i class="fa fa-undo"></i>
                     </a>
                     <a href="{{route("admin.topic.delete",$agrs)}}" class="text-danger mx-1">
                        <i class="fa fa-trash"></i>
                     </a>
                                    </td>
                                    <td>{{$row->slug}}</td>
                                    <td class="text-center">{{$row->id}}</td>
                                 </tr>
                           @endforeach
                              </tbody>
                           </table>
                        </div>
                     </div>

                  </section>
               </div>
               @endsection 

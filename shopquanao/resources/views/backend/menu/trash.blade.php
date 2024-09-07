@extends('layouts.dashboard')
@section('content')
<div class="content">
                  <section class="content-header my-2">
                     <h1 class="d-inline">Quản lý menu</h1>
                     <a class="btn-add" href="{{route('admin.menu.index')}}">trở về</a>

                     <div class="row mt-3 align-items-center">
                       
                     </div>
                  </section>
                  <section class="content-body my-2">
                     <div class="row"> 

                        <div class="col-md-9">
                           <div class="row mt-1 align-items-center">
                          
                           </div>
                           <table class="table table-bordered">
                              <thead>
                                 <tr>
                                    <th class="text-center" style="width:30px;">
                                       <input type="checkbox" id="checkboxAll" />
                                    </th>
                                    <th>Tên menu</th>
                                    <th>Liên kết</th>
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
                                              <a href="{{route("admin.menu.restore",$agrs)}}" class="text-primary mx-1">
                                       <i class="fa fa-undo"></i>
                                    </a>
                                    <a href="{{route("admin.menu.delete",$agrs)}}" class="text-danger mx-1">
                                       <i class="fa fa-trash"></i>
                                    </a>
                                       </div>
                                    </td>
                                    <td>                                    {{$row->link}}
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
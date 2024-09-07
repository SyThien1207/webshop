@extends('layouts.home')
@section('content')
<div class="content">
<main class="main">
        <nav aria-label="breadcrumb" class="breadcrumb-nav">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('home.index')}}"><i class="icon-home"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Trang đơn</li>
                </ol>
            </div><!-- End .container -->
        </nav>

        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <article class="post single">
                        

                        <div class="post-body">
               

                            <h2 class="post-title">{{$post->title}}</h2>



                            <div class="post-content">
                                {!!$post->detail!!}
                            </div><!-- End .post-content -->

                           

                        </div><!-- End .post-body -->
                    </article><!-- End .post -->

                    <hr class="mt-2 mb-1">

                 
                </div><!-- End .col-lg-9 -->

                <div class="sidebar-toggle custom-sidebar-toggle">
                    <i class="fas fa-sliders-h"></i>
                </div>
                <div class="sidebar-overlay"></div>
                <aside class="sidebar mobile-sidebar col-lg-3">
                    <div class="sidebar-wrapper" data-sticky-sidebar-options='{"offsetTop": 72}'>
                        <div class="widget widget-categories">
                        
                        </div><!-- End .widget -->

                        <div class="widget">
                            <h4 class="widget-title">Các trang đơn khác</h4>

                            <ul class="simple-post-list">
                                @foreach ($post_list as $row)
                                 <li>
                                    
                                    <div class="post-info">
                                        <a href="/chi-tiet-bai-viet/{{ $row->id }}">{{$row->title}}</a>
                                        <div class="post-meta">
                                          {{$row->created_at->format('d-m-Y')}}
                                        </div><!-- End .post-meta -->
                                    </div><!-- End .post-info -->
                                </li>
                                @endforeach
                             

                              
                            </ul>
                        </div><!-- End .widget -->


                    </div><!-- End .sidebar-wrapper -->
                </aside><!-- End .col-lg-3 -->
            </div><!-- End .row -->
        </div><!-- End .container -->
    </main><!-- End .main -->


</div>

@endsection
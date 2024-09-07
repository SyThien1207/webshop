@extends('layouts.home')
@section('content')
<div class="content">

    <main class="main">
        <nav aria-label="breadcrumb" class="breadcrumb-nav">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('home.index')}}.html"><i class="icon-home"></i></a></li>
						<li class="breadcrumb-item"href="{{route('post.post')}}.html" aria-current="page">Tất cả bài viết</li>

                    <li class="breadcrumb-item active" aria-current="page">{{$post->title}}</li>
                </ol>
            </div><!-- End .container -->
        </nav>

        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <article class="post single">
                        <div class="post-media">
                            <img src="{{ asset('images/post/' . $post->image) }}" alt="Post">
                        </div><!-- End .post-media -->

                        <div class="post-body">
                            @php
                            \Carbon\Carbon::setLocale('vi'); // Đặt ngôn ngữ là tiếng Việt
                            $date = \Carbon\Carbon::parse($post->created_at);
                            $month = $date->translatedFormat('F');@endphp
                            <div datetime="{{ $date->toDateString() }}" class="post-date">
                                <span class="day">{{ $date->format('d') }}</span>
                                <span class="month">{{ $month }}</span>
                            </div>

                            <h2 class="post-title">{{$post->title}}</h2>



                            <div class="post-content">
                                {!!$post->detail!!}
                            </div><!-- End .post-content -->

                            <div class="post-share">
                                <h3 class="d-flex align-items-center">
                                    <i class="fas fa-share"></i>
                                    Share this post
                                </h3>

                                <div class="social-icons">
                                    <a href="#" class="social-icon social-facebook" target="_blank"
                                        title="Facebook">
                                        <i class="icon-facebook"></i>
                                    </a>
                                    <a href="#" class="social-icon social-twitter" target="_blank" title="Twitter">
                                        <i class="icon-twitter"></i>
                                    </a>
                                    <a href="#" class="social-icon social-linkedin" target="_blank"
                                        title="Linkedin">
                                        <i class="fab fa-linkedin-in"></i>
                                    </a>
                                    <a href="#" class="social-icon social-gplus" target="_blank" title="Google +">
                                        <i class="fab fa-google-plus-g"></i>
                                    </a>
                                    <a href="#" class="social-icon social-mail" target="_blank" title="Email">
                                        <i class="icon-mail-alt"></i>
                                    </a>
                                </div><!-- End .social-icons -->
                            </div><!-- End .post-share -->


                        </div><!-- End .post-body -->
                    </article><!-- End .post -->

                    <hr class="mt-2 mb-1">

                    <div class="related-posts">
                        <h4>Bài viết <strong>Liên quan</strong></h4>

                        <div class="owl-carousel owl-theme related-posts-carousel" data-owl-options="{
								'dots': false
							}">
                            @foreach ($post_list as $row )

                            <article class="post">
                                <div class="post-media zoom-effect">
                                    <a href="single.html">
                                        <img src="{{ asset('images/post/' . $post->image) }}" alt="Post">
                                    </a>
                                </div><!-- End .post-media -->

                                <div class="post-body">
                                    @php
                                    \Carbon\Carbon::setLocale('vi'); // Đặt ngôn ngữ là tiếng Việt
                                    $date = \Carbon\Carbon::parse($row->created_at);
                                    $month = $date->translatedFormat('F');@endphp
                                    <div datetime="{{ $date->toDateString() }}" class="post-date">
                                        <span class="day">{{ $date->format('d') }}</span>
                                        <span class="month">{{ $month }}</span>

                                        <h2 class="post-title">
                                            <a href="/chi-tiet-bai-viet/{{ $row->id }}">{{$row->title}}</a>
                                        </h2>

                                        <div class="post-content">
                                            @php
                                            $words = explode(' ', $row->description);
                                            $limitedWords = array_slice($words, 0, 17);
                                            @endphp
                                            <p>{{ implode(' ', $limitedWords) }}{{ count($words) > 17 ? '...' : '' }}
                                            </p>
                                            <a href="/chi-tiet-bai-viet/{{ $row->id }}" class="read-more">read more <i
                                                    class="fas fa-angle-right"></i></a>
                                        </div><!-- End .post-content -->
                                    </div><!-- End .post-body -->
                            </article>
                            @endforeach


                        </div><!-- End .owl-carousel -->
                    </div><!-- End .related-posts -->
                </div><!-- End .col-lg-9 -->

                <div class="sidebar-toggle custom-sidebar-toggle">
                    <i class="fas fa-sliders-h"></i>
                </div>
                <div class="sidebar-overlay"></div>
                <aside class="sidebar mobile-sidebar col-lg-3">
                    <div class="sidebar-wrapper" data-sticky-sidebar-options='{"offsetTop": 72}'>
                        <div class="widget widget-categories">
                            <h4 class="widget-title">Chủ đề nổi bật</h4>

                            <ul class="list">
    @foreach ($list as $topic)
        <li>
            <a href="#">{{ $topic->name }}</a>
            <ul class="list">
                @foreach ($topic->posts()->where('status', 1)->where('type', 'post')->get() as $post)
                    <li><a href="/chi-tiet-bai-viet/{{ $topic->id }}">{{ $post->title }}</a></li>
                @endforeach
            </ul>
        </li>
    @endforeach
</ul>
                        </div><!-- End .widget -->

                        <div class="widget">
                            <h4 class="widget-title">Bài viết mới nhất</h4>

                            <ul class="simple-post-list">
                                @foreach ($post_new as $row)
                                 <li>
                                    <div class="post-media">
                                        <a href="/chi-tiet-bai-viet/{{ $row->id }}">
                                            <img src="{{ asset('images/post/' . $row->image) }}" alt="Post">
                                        </a>
                                    </div><!-- End .post-media -->
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
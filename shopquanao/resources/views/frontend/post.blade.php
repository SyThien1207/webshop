@extends('layouts.home')
@section('content')
<div class="content">

<main class="main">
			<nav aria-label="breadcrumb" class="breadcrumb-nav">
				<div class="container">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="{{route('home.index')}}"><i class="icon-home"></i></a></li>
						<li class="breadcrumb-item active" aria-current="page">Tất cả bài viết</li>
					</ol>
				</div><!-- End .container -->
			</nav>

			<div class="container">
				<div class="row">
					<div class="col-lg-9">
						<div class="blog-section row">
  @foreach ($post_list as $row)
					
							<div class="col-md-6 col-lg-4">
								<article class="post">
									<div class="post-media">
										<a href="single.html">
										<img src="{{ asset('images/post/' . $row->image) }}" alt="Post"style="width:280px; height:250px;object-fit: cover;">

										</a>
                    @php
                    \Carbon\Carbon::setLocale('vi'); // Đặt ngôn ngữ là tiếng Việt
                    $date = \Carbon\Carbon::parse($row->created_at);
                    $month = $date->translatedFormat('F');@endphp
                    <div datetime="{{ $date->toDateString() }}" class="post-date">
                        <span class="day">{{ $date->format('d') }}</span>
                        <span class="month">{{ $month }}</span>
                    </div>
									</div><!-- End .post-media -->

									<div class="post-body">
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
										</div><!-- End .post-content -->
                    <a href="" class="post-comment">Chủ đề: {{$row->topic->name}}</a>
									</div><!-- End .post-body -->
								</article><!-- End .post -->
							</div>
              @endforeach
						</div>
					</div><!-- End .col-lg-9 -->

					<div class="sidebar-toggle custom-sidebar-toggle">
						<i class="fas fa-sliders-h"></i>
					</div>
					<div class="sidebar-overlay"></div>
					<aside class="sidebar mobile-sidebar col-lg-3">
						<div class="sidebar-wrapper" data-sticky-sidebar-options='{"offsetTop": 72}'>
							<div class="widget widget-categories">
								<h4 class="widget-title">Chủ đề</h4>

								<ul class="list">
							@foreach ($list as $row)
								
									<li><a href="bai-viet/{{$row->slug}}">{{$row->name}}</a></li>
						
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
@extends('layouts.home')
@section('content')
<div class="content">
  <main class="main">
    <div class="container">
      <!-- Breadcrumb và các nội dung khác -->

      <div class="row">
        <div class="col-lg-9 main-content">
          <!-- Công cụ để sắp xếp và lọc -->

          <!-- Kiểm tra nếu không có kết quả nào -->
          @if (($type == 'all' || $type == 'product') && $products->isEmpty() && ($type == 'all' || $type == 'post') && $posts->isEmpty())
          <div class="alert alert-warning">
          Không tìm thấy nội dung tìm kiếm          </div>
          @else
          @if($type == 'all' || $type == 'product')
          <h2>Sản phẩm</h2>
          @if ($products->isEmpty())
          <p>Không có sản phẩm nào được tìm thấy.</p>
          @else
          <div class="row">
            @foreach ($products as $product)
            <div class="col-6 col-sm-4 col-md-3">
              <x-product-card :productitem="$product" />
            </div>
            @endforeach
          </div>
          @endif
          @endif

          @if($type == 'all' || $type == 'post')
          <h2>Bài viết</h2>
          @if ($posts->isEmpty())
          <p>Không có bài viết nào được tìm thấy.</p>
          @else
          <div class="row">
            @foreach ($posts as $row)

            <div class="col-md-6 col-lg-4">
              <article class="post">
                <div class="post-media">
                  <a href="single.html">
                    <img src="{{asset("images/post/".$row->image)}}" alt="Post" width="225"
                      height="280">
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
          @endif
          @endif
          @endif

          <!-- Phân trang và các nội dung khác -->
        </div>
        <x-product-category-home />
      </div>
    </div>
  </main>
</div>
@endsection
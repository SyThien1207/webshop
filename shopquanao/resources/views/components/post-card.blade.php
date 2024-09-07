</style>
<section class="blog-section pb-0">
    <div class="container">
        <h2 class="section-title heading-border border-0 appear-animate" data-animation-name="fadeInUp">
            TIN TỨC MỚI NHẤT</h2>

        <div class="owl-carousel owl-theme appear-animate" data-animation-name="fadeIn" data-owl-options="{
						'loop': false,
						'margin': 20,
						'autoHeight': true,
						'autoplay': false,
						'dots': false,
						'items': 2,
						'responsive': {
							'0': {
								'items': 1
							},
							'480': {
								'items': 2
							},
							'576': {
								'items': 3
							},
							'768': {
								'items': 4
							}
						}
					}">
            @foreach ($post_new as $row)
            <article class="post">
                <div class="post-media">
                    <a href="/chi-tiet-bai-viet/{{ $row->id }}">
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




                </div>
                <!-- End .post-media -->

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
                    </div>
                    <!-- End .post-content -->
                    <a href="single.html" class="post-comment">tác giả: {{$row->user_name}}</a>
                </div>
                <!-- End .post-body -->
            </article>
            @endforeach


        </div>

        <hr class="mt-4 m-b-5">


    </div>
</section>
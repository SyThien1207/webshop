@extends('layouts.home')
@section('content')
<div class="content">

  <main class="main">
    <x-slider />
    <div class="container">
      <x-banner-clone />
    </div>
      <section class="new-products-section">
      <div class="container">
        <x-product-new />
      </div>
    </section>
      <section class="new-products-section">
      <div class="container">
      <x-product-best-sale />
      </div>
    </section>
      <section class="new-products-section">
      <div class="container">
      <x-flash-sale />
      </div>
    </section>

   
   

   <x-banner-middle/>
    <h2 class="section-title categories-section-title heading-border border-0 ls-0 appear-animate" data-animation-delay="100" data-animation-name="fadeInUpShorter">Danh mục của chúng tôi
    </h2>
    <x-categories />
    <section class="feature-boxes-container">
      <div class="container appear-animate" data-animation-name="fadeInUpShorter">
      </div>
    </section>
    <section class="promo-section bg-dark" data-parallax="{'speed': 2, 'enableOnMobile': true}" data-image-src="{{asset('fe-asset')}}/assets/images/demoes/demo4/banners/banner-5.jpg">
      <div class="promo-banner banner container text-uppercase">
        <div class="banner-content row align-items-center text-center">
          <div class="col-md-4 ml-xl-auto text-md-right appear-animate" data-animation-name="fadeInRightShorter" data-animation-delay="600">
            <h2 class="mb-md-0 text-white">Những thông báo<br>Mới nhất</h2>
          </div>
          <div class="col-md-4 col-xl-3 pb-4 pb-md-0 appear-animate" data-animation-name="fadeIn" data-animation-delay="300">
            <a href="{{route('post.post')}}" class="btn btn-dark btn-black ls-10">Xem</a>
          </div>
          <div class="col-md-4 mr-xl-auto text-md-left appear-animate" data-animation-name="fadeInLeftShorter" data-animation-delay="600">
            <h4 class="mb-1 mt-1 font1 coupon-sale-text p-0 d-block ls-n-10 text-transform-none">
              <b>Các
                SỰ KIỆN</b>
            </h4>
          </div>
        </div>
      </div>
    </section>


    <x-post-card />
  </main>

</div>

@endsection
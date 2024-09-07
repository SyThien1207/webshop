<div class="home-slider slide-animate owl-carousel owl-theme show-nav-hover nav-big mb-2 text-uppercase" data-owl-options="{
				'loop': false
			}">
      @foreach ($list_banner as $row)
        <div class="home-slide home-slide1 banner">
                    <img class="slide-bg" src="{{ asset('images/banner/' . $row->image) }}" width="1903" height="199" alt="slider image">
                    <div class="container d-flex align-items-center">
                        <div class="banner-layer appear-animate" data-animation-name="fadeInUpShorter">
                            <h4 class="text-transform-none m-b-3">{{$row->description}}</h4>
                            <h2 class="text-transform-none mb-0">{{$row->name}}</h2>
                        
                            <a href="{{$row->link}}" class="btn btn-dark btn-lg">Shop Now!</a>
                        </div>
                        <!-- End .banner-layer -->
                    </div>
                </div>
      @endforeach
            </div>
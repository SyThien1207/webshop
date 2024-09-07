<div class="container">
                <div class="info-boxes-slider owl-carousel owl-theme mb-2" data-owl-options="{
					'dots': false,
					'loop': false,
					'responsive': {
						'576': {
							'items': 2
						},
						'992': {
							'items': 3
						}
					}
				}">
                    <div class="info-box info-box-icon-left">
                        <i class="icon-shipping"></i>

                        <div class="info-box-content">
                            <h4>MIỄN PHÍ GIAO &amp; TRẢ HÀNG</h4>
                            <p class="text-body">Miên phí khi mua trên 5 sản phẩm</p>
                        </div>
                        <!-- End .info-box-content -->
                    </div>
                    <!-- End .info-box -->

                    <div class="info-box info-box-icon-left">
                        <i class="icon-money"></i>

                        <div class="info-box-content">
                            <h4>Chính sách hoàn tiền</h4>
                            <p class="text-body">Hoàn trả 100% nếu hàng lỗi theo chính sách</p>
                        </div>
                        <!-- End .info-box-content -->
                    </div>
                    <!-- End .info-box -->

                    <div class="info-box info-box-icon-left">
                        <i class="icon-support"></i>

                        <div class="info-box-content">
                            <h4>Hỗ trợ khách hàng 24/7</h4>
                            <p class="text-body">Hõ trợ tận tình.</p>
                        </div>
                        <!-- End .info-box-content -->
                    </div>
                    <!-- End .info-box -->
                </div>
                <!-- End .info-boxes-slider -->

                <div class="banners-container mb-2">
                    <div class="banners-slider owl-carousel owl-theme" data-owl-options="{
						'dots': false
					}">
                    @foreach ($list_banner as $row)
                    <div class="banner banner3 banner-sm-vw d-flex align-items-center appear-animate" style="background-color: #ccc;" data-animation-name="fadeInRightShorter" data-animation-delay="500">
                            <figure class="w-100">
                            </figure>
                            <div class="banner-layer text-right">
                                <h3 class="m-b-2">{{$row->name}}</h3>
                                <h4 class="m-b-2 text-secondary text-uppercase">{{$row->description}}</h4>
                                <a href="{{$row->link}}" class="btn btn-sm btn-dark">Shop Now</a>
                            </div>
                        </div>
                    @endforeach
                      
             
                    </div>
                </div>
            </div>
           
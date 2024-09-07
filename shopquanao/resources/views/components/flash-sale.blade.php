
<section class="featured-products-section">
                <div class="container">
                    <h2 class="section-title heading-border ls-20 border-0">Sản phẩm giảm giá</h2>

                    <div class="products-slider custom-products owl-carousel owl-theme nav-outer show-nav-hover nav-image-center" data-owl-options="{
						'dots': false,
						'nav': true
					}">
                    @foreach ($product_sale as $product_item)
                        <x-product-card :productitem="$product_item" />
                    @endforeach
                    </div>
                    <!-- End .featured-proucts -->
                </div>
            </section>


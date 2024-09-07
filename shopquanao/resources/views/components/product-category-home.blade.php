<aside class="sidebar-shop col-lg-3 order-lg-first mobile-sidebar">
                        <div class="sidebar-wrapper">
                            <div class="widget">
                                <h3 class="widget-title">
                                    <a data-toggle="collapse" href="#widget-body-2" role="button" aria-expanded="true" aria-controls="widget-body-2">danh mục</a>
                                </h3>

                                <div class="collapse show" id="widget-body-2">
                                    <div class="widget-body">
                                        <ul class="cat-list">
                                        @foreach ($listcategory as $rowcategory)
                    <x-product-category-item :rowcategory="$rowcategory"/>
                    @endforeach

                                        </ul>
                                    </div>
                                    <!-- End .widget-body -->
                                </div>
                                <!-- End .collapse -->
                            </div>
                            <!-- End .widget -->
                            <div class="widget">
                                <h3 class="widget-title">
                                    <a data-toggle="collapse" href="#widget-body-3" role="button" aria-expanded="true" aria-controls="widget-body-3">Thương hiệu</a>
                                </h3>

                                <div class="collapse show" id="widget-body-3">
                                    <div class="widget-body">
                                        <ul class="cat-list">
                                        <x-product-brand-item :rowbrand="$listbrand" />


                                        </ul>
                                    </div>
                                    <!-- End .widget-body -->
                                </div>
                                <!-- End .collapse -->
                            </div>
                            <div class="widget">
                                <h3 class="widget-title">
                                    <a data-toggle="collapse" href="#widget-body-4" role="button" aria-expanded="true" aria-controls="widget-body-4">Price</a>
                                </h3>

                                <div class="collapse show" id="widget-body-4">
                                    <div class="widget-body pb-0">
                                    <form action="#" method="GET">
    <div class="price-slider-wrapper">
        <div id="price-slider"></div>
        <!-- End #price-slider -->
    </div>
    <!-- End .price-slider-wrapper -->

    <!-- Input ẩn để lưu khoảng giá -->
    <input type="hidden" id="min_price" name="min_price" value="0">
    <input type="hidden" id="max_price" name="max_price" value="1000000">

    <div class="filter-price-action d-flex align-items-center justify-content-between flex-wrap">
        <div class="filter-price-text">
            Giá:
            <span id="filter-price-range">0₫ - 1,000,000₫</span>
        </div>
        <!-- End .filter-price-text -->

        <button type="submit" class="btn btn-primary">Lọc</button>
    </div>
    <!-- End .filter-price-action -->
</form>

                                    </div>
                                    <!-- End .widget-body -->
                                </div>
                                <!-- End .collapse -->
                            </div>
                            <!-- End .widget -->

                            
                            <!-- End .widget -->

                    
                            <!-- End .widget -->

                       
                            <!-- End .widget -->
                        </div>
                        <!-- End .sidebar-wrapper -->
                    </aside>
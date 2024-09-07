@extends('layouts.home')
@section('content')
<div class="content">

    <main class="main">


        <div class="container">
            <nav aria-label="breadcrumb" class="breadcrumb-nav">
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home.index')}}"><i class="icon-home"></i></a></li>
                    <li class="breadcrumb-item"><a href="{{route('product.index')}}">Tất cả sản phẩm</a></li>
                    <li class="breadcrumb-item"><a href="#"> {{$brand->name}}</a></li>
                </ol>
            </nav>

            <div class="row">
                <div class="col-lg-9 main-content">
                    <nav class="toolbox sticky-header" data-sticky-options="{'mobile': true}">
                        <div class="toolbox-left">
                            <a href="#" class="sidebar-toggle"><svg data-name="Layer 3" id="Layer_3"
                                    viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg">
                                    <line x1="15" x2="26" y1="9" y2="9" class="cls-1"></line>
                                    <line x1="6" x2="9" y1="9" y2="9" class="cls-1"></line>
                                    <line x1="23" x2="26" y1="16" y2="16" class="cls-1"></line>
                                    <line x1="6" x2="17" y1="16" y2="16" class="cls-1"></line>
                                    <line x1="17" x2="26" y1="23" y2="23" class="cls-1"></line>
                                    <line x1="6" x2="11" y1="23" y2="23" class="cls-1"></line>
                                    <path
                                        d="M14.5,8.92A2.6,2.6,0,0,1,12,11.5,2.6,2.6,0,0,1,9.5,8.92a2.5,2.5,0,0,1,5,0Z"
                                        class="cls-2"></path>
                                    <path d="M22.5,15.92a2.5,2.5,0,1,1-5,0,2.5,2.5,0,0,1,5,0Z" class="cls-2"></path>
                                    <path d="M21,16a1,1,0,1,1-2,0,1,1,0,0,1,2,0Z" class="cls-3"></path>
                                    <path
                                        d="M16.5,22.92A2.6,2.6,0,0,1,14,25.5a2.6,2.6,0,0,1-2.5-2.58,2.5,2.5,0,0,1,5,0Z"
                                        class="cls-2"></path>
                                </svg>
                                <span>Filter</span>
                            </a>

                            <div class="toolbox-item toolbox-sort">
                                <label>Sắp xếp theo:</label>

                                <div class="select-custom">
                                    <select name="orderby" class="form-control" id="sort-select">
                                        <option value="default" {{ request()->sort == 'default' ? 'selected' : '' }}>Mới nhất</option>
                                        <option value="price_desc" {{ request()->sort == 'price_desc' ? 'selected' : '' }}>Giá cao đến thấp</option>
                                        <option value="price_asc" {{ request()->sort == 'price_asc' ? 'selected' : '' }}>Giá thấp đến cao</option>
                                    </select>
                                </div>

                                <!-- End .select-custom -->


                            </div>
                            <!-- End .toolbox-item -->
                        </div>

                        <div class="toolbox-right">
                            <label>Tìm kiếm:</label>

                            <div class="custom" style="margin-top: 40px; ">

                                <form action="{{ route('product.product', ['slug' => $brand['slug']]) }}" method="GET">
                                    <input type="search" name="key" id="key" placeholder="Tìm kiếm..." required value="{{ request()->input('key') }}" style="width: 300px; height: 35px;">
                                    <button class="btn icon-magnifier p-0" title="search" type="submit" style="margin-left: 5px; height: 35px;">
                                    </button>
                                </form>
                            </div>
                        </div>

                        <!-- End .toolbox-right -->
                    </nav>

                    <div class="row">

                        @if ($product->isEmpty())
                        <p>Không có sản phẩm nào được tìm thấy.</p>
                        @else
                        @foreach ($product as $product_item)
                        <div class="col-6 col-sm-4 col-md-3">
                            <x-product-card :productitem="$product_item" />

                        </div>
                        @endforeach
                        @endif
                    </div>
                    <!-- End .row -->

                    <nav class="toolbox toolbox-pagination">
                        <div class="toolbox-item toolbox-show">
                            <label></label>

                            <div class="-">
                                <div name="count" class="">
                                    <option value="12"></option>
                                    <option value="24"></option>
                                    <option value="36"></option>
                                </div>
                            </div>
                            <!-- End .select-custom -->
                        </div>
                        <!-- End .toolbox-item -->

                        <ul class="pagination toolbox-item">
                                <li class="page-item disabled">
                                    <a class="page-link page-link-btn" href="#"><i class="icon-angle-left"></i></a>
                                </li>
                                {{ $product->links() }}

                            </ul>
                    </nav>
                </div>
                <!-- End .col-lg-9 -->

                <div class="sidebar-overlay"></div>
                <x-product-category-home />
                <!-- End .col-lg-3 -->
            </div>
            <!-- End .row -->
        </div>
        <!-- End .container -->

        <div class="mb-4"></div>
        <!-- margin -->
    </main>

</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        $('#sort-select').change(function() {
            var sort = $(this).val();
            var url = new URL(window.location.href);

            // Remove existing sort parameter if present
            url.searchParams.delete('sort');

            // Add new sort parameter
            if (sort !== 'default') {
                url.searchParams.append('sort', sort);
            }

            // Reload the page with the new sorting option
            window.location.href = url.toString();
        });
    });
</script>

@endsection
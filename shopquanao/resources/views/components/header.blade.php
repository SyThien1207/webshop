<header class="header">
    <div class="header-top">
        <div class="container">
            <div class="header-left d-none d-sm-block">
                <p class="top-message text-uppercase"></p>
            </div>
            <!-- End .header-left -->

            <div class="header-right header-dropdowns ml-0 ml-sm-auto w-sm-100">
                <div class="header-dropdown dropdown-expanded d-none d-lg-block">
                    <a href="#">Links</a>
                    <div class="header-menu">
                        <ul>
                            <li><a href="{{route('profile.index')}}">Thông tin của tôi</a></li>
                            <li><a href="{{route('contact.index')}}">Về chúng tôi</a></li>
                            <li><a href="{{route('post.post')}}">Bài viết</a></li>
                            <li><a href="{{route('cart.index')}}">Giỏ hàng</a></li>
                            @if(Auth::check())
                            <li>
                                <form id="logout-form" action="{{ route('website.logout') }}" method="post" style="display: none;">
                                    @csrf
                                </form>
                                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Đăng xuất

                            </li>

                            @else
                            <li><a href="{{ route('website.getlogin') }}">Đăng nhập</a></li>

                            @endif
                        </ul>
                    </div>
                    <!-- End .header-menu -->
                </div>
                <!-- End .header-dropown -->

                <span class="separator"></span>

                <div class="header-dropdown">
                   
                </div>
                <!-- End .header-dropown -->

                <div class="header-dropdown mr-auto mr-sm-3 mr-md-0">
                   
                </div>
                <!-- End .header-dropown -->

                <span class="separator"></span>

                <div class="social-icons">
                    <a href="{{$configuration_all->facebook}}" class="social-icon social-facebook icon-facebook" target="_blank"></a>
                    <a href="{{$configuration_all->twitter}}" class="social-icon social-twitter icon-twitter" target="_blank"></a>
                    <a href="{{$configuration_all->instagram}}" class="social-icon social-instagram icon-instagram" target="_blank"></a>
                </div>
                <!-- End .social-icons -->
            </div>
            <!-- End .header-right -->
        </div>
        <!-- End .container -->
    </div>
    <!-- End .header-top -->

    <div class="header-middle sticky-header" data-sticky-options="{'mobile': true}">
        <div class="container">
            <div class="header-left col-lg-2 w-auto pl-0">
                <button class="mobile-menu-toggler text-primary mr-2" type="button">
                    <i class="fas fa-bars"></i>
                </button>
                <a href="{{route('home.index')}}" class="logo">
                    <img src="{{asset('images/configuration/' . $configuration_all->logo) }}" width="111" height="44" alt="Porto Logo">
                </a>
            </div>
            <!-- End .header-left -->

            <div class="header-right w-lg-max">
                <div class="header-icon header-search header-search-inline header-search-category w-lg-max text-right mt-0">
                    <a href="#" class="search-toggle" role="button"><i class="icon-search-3"></i></a>
                      <form action="{{ route('product.search') }}" method="GET" >

                        <div class="header-search-wrapper">
                            <input type="search" class="form-control" name="q" id="q" placeholder="Search..." required value="{{ request()->input('q') }}">
                            <div class="select-custom">
                                <select id="type" name="type">
                <option value="all" @if(request()->input('type') == 'all') selected @endif>Tất cả</option>
                <option value="product" @if(request()->input('type') == 'product') selected @endif>Sản phẩm</option>
                <option value="post" @if(request()->input('type') == 'post') selected @endif>Bài viết</option>
                                </select>
                            </div>
                            <!-- End .select-custom -->
                            <button class="btn icon-magnifier p-0" title="search" type="submit"></button>
                        </div>
                        <!-- End .header-search-wrapper -->
                    </form>
                </div>
                <!-- End .header-search -->

                <div class="header-contact d-none d-lg-flex pl-4 pr-4">
                    <img alt="phone" src="{{asset('fe-asset')}}/assets/images/phone.png" width="30" height="30" class="pb-1">
                    <h6><span>Liên hệ</span><a href="tel:#" class="text-dark font1">{{$configuration_all->phone}}</a></h6>
                </div>
                @if(Auth::check())
                <a href="{{route('profile.index')}}" class="header-icon" title="login"><i class="icon-user-2"><span style="font-size: 12px;">
                            hi! {{ explode(' ', Auth::user()->name)[count(explode(' ', Auth::user()->name)) - 1] }}
                        </span>
                    </i>
                </a>
                @else
                <a href="{{ route('website.getlogin') }}" class="header-icon" title="login"><i class="icon-user-2"></i></a>

                @endif
                <a href="{{route('like.index')}}" class="header-icon" title="wishlist"><i class="icon-wishlist-2"></i></a>

                <x-card-drop />
                <!-- End .dropdown -->
            </div>
            <!-- End .header-right -->
        </div>
        <!-- End .container -->
    </div>
    <!-- End .header-middle -->

    <x-main-menu />
    <!-- End .header-bottom -->
</header>
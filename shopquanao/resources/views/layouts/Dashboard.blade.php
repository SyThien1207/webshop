<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Mazer Admin Dashboard</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href={{asset("assets/vendors/iconly/bold.css")}}>
    <link rel="stylesheet" href={{asset("assets/css/bootstrap.css")}}>
    <link rel="stylesheet" href={{asset("assets/css/backend.css")}}>
    <link rel="stylesheet" href={{asset("assets/vendors/perfect-scrollbar/perfect-scrollbar.css")}}>
    <link rel="stylesheet" href={{asset("assets/vendors/bootstrap-icons/bootstrap-icons.css")}}>
    <link rel="stylesheet" href={{asset("assets/css/app.css")}}>
    <link rel="shortcut icon" href={{asset("assets/images/favicon.svg")}} type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />

</head>

<body>
    <div id="app">
        <div id="sidebar" class="active">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header">
                    <div class="d-flex justify-content-between">
                        <div class="logo">
                            <a href="index.html"><img src={{asset("/assets/images/logo/logo.png")}} alt="Logo" srcset=""></a>
                        </div>
                        <div class="toggler">
                            <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                        </div>
                    </div>
                </div>
                <div class="sidebar-menu">
                    <ul class="menu">
                        <li class="sidebar-title">Menu</li>

                        <li class="sidebar-item active ">
                            <a href="index.html" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>

                        <li class="sidebar-item  has-sub">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-stack"></i>
                                <span>Quản lý</span>
                            </a>
                            <ul class="submenu ">
                                <li class="submenu-item ">
                                    <a href={{route("admin.category.index")}}>Danh mục sản phẩm</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="{{route("admin.brand.index")}}">Thương hiệu</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="{{route("admin.product.index")}}">Sản phẩm</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="{{route("admin.warehouse.index")}}">Nhập kho</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="{{route("admin.supplier.index")}}">Nhà cung cấp</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="{{route("admin.product.sale")}}">Khuyến mãi</a>
                                </li>
                            </ul>
                        </li>
                        <li class="sidebar-item  ">
                            <a href="{{route("admin.order.index")}}" class='sidebar-link'>
                                <i class="bi bi-basket-fill"></i>
                                <span>Đơn hàng</span>
                            </a>
                        </li>
                        <li class="sidebar-item  has-sub">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-collection-fill"></i>
                                <span>Giao diện</span>
                            </a>
                            <ul class="submenu ">
                                <li class="submenu-item ">
                                    <a href="{{route("admin.banner.index")}}">Banner</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="{{route('admin.menu.index')}}">Menu</a>
                                </li>

                            </ul>
                        </li>

                        <li class="sidebar-item  has-sub">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-grid-1x2-fill"></i>
                                <span>Bài viết</span>
                            </a>
                            <ul class="submenu ">
                                <li class="submenu-item ">
                                    <a href="{{route('admin.topic.index')}}">Chủ đề</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="{{route('admin.post.index')}}">Bài viết</a>
                                </li>
                         
                            </ul>
                        </li>     <li class="sidebar-item  ">
                            <a href="{{route("admin.contact.index")}}" class='sidebar-link'>
                                <i class="bi bi-chat-dots-fill"></i>
                                <span>Liên hệ</span>
                            </a>
                        </li>
                        <li class="sidebar-item  ">
                            <a href="{{route("admin.user.index")}}" class='sidebar-link'>
                                <i class="bi bi-person-badge-fill"></i>
                                <span>Tài khoản</span>
                            </a>

                        </li>
                   
                     
                        <li class="sidebar-title">Forms &amp; Tables</li>

                        <li class="sidebar-item">
                            <a href="{{route("admin.configuration.index")}}" class='sidebar-link'>
                                <i class="bi bi-hexagon-fill"></i>
                                <span>Cấu hình website</span>
                            </a>

                        </li>
                        <form id="logout-form" action="{{ route('website.logout') }}" method="post" style="display: none;">
    @csrf
</form>
<li class="sidebar-item">
    <a href="{{route('home.index')}}" class='sidebar-link' >
        <i class="bi bi-house-door-fill"></i>
        <span>Trang chủ</span>
    </a>
</li>
<li class="sidebar-item">
    <a href="#" class='sidebar-link' onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <i class="bi bi-person-badge-fill"></i>
        <span>Logout</span>
    </a>
</li>



                    </ul>
                </div>
                <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
            </div>
        </div>
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            @yield('content')

            <footer>
                <div class="footer clearfix mb-0 text-muted">
                    <div class="float-start">
                        <p>2021 &copy; Mazer</p>
                    </div>
                    <div class="float-end">
                        <p>Crafted with <span class="text-danger"><i class="bi bi-heart"></i></span> by <a href="http://ahmadsaugi.com">A. Saugi</a></p>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src={{asset("assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js")}}></script>
    <script src={{asset("assets/js/bootstrap.bundle.min.js")}}></script>

    <script src={{asset("assets/vendors/apexcharts/apexcharts.js")}}></script>
    <script src={{asset("assets/js/pages/dashboard.js")}}></script>
    <script src={{asset("assets/js/main.js")}}></script>
    @yield('custom-js')
    <script src="{{ asset('public/jquery/jquery-3.7.0.min.js') }}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
@if(Session::has('success'))
<script>
   toastr.success("{{ Session::get('success')}}");
</script>

@endif

@if(Session::has('error'))<script>
   toastr.error("{!! Session::get('error')!!}");
</script>

@endif
<script></script>
    <script>
        function previewImage() {
            const input = document.getElementById('image');
            const newImagePreview = document.getElementById('new-image-preview');
            const oldImagePreview = document.getElementById('old-image-preview');
            const arrow = document.getElementById('arrow');

            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    newImagePreview.innerHTML = '<img src="' + e.target.result + '" alt="New Preview Image" style="max-width: 100px;">';
                }
                reader.readAsDataURL(input.files[0]);
            }

            if (oldImagePreview.innerHTML) {
                arrow.innerHTML = '<p>&#8594;</p>'; // Arrow pointing right
            } else {
                arrow.innerHTML = '';
            }
        }

        function previewImage() {
            const input = document.getElementById('image');
            const imageName = document.getElementById('image-name');
            const newImagePreview = document.getElementById('new-image-preview');
            const oldImagePreview = document.getElementById('image-preview');
            const arrow = document.getElementById('arrow');

            if (input.files && input.files[0]) {
                const fileName = input.files[0].name;
                const reader = new FileReader();

                reader.onload = function(e) {

                    newImagePreview.innerHTML = '<img src="' + e.target.result + '" alt="New Preview Image" style="max-width: 100px;">';
                    arrow.innerHTML = '<p>&#8594;</p>'; // Arrow pointing right
                }

                reader.readAsDataURL(input.files[0]);
            }

            if (oldImagePreview.innerHTML) {
                arrow.innerHTML = '<p>&#8594;</p>';
            }
        }
    </script>
</body>

</html>
@extends('layouts.home')
@section('content')
<div class="content">

    <main class="main">
        <div class="page-header">
            <div class="container d-flex flex-column align-items-center">
                <nav aria-label="breadcrumb" class="breadcrumb-nav">
                    <div class="container">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('home.index')}}">trang chủ</a></li>
                            <li class="breadcrumb-item"><a href="{{route('product.index')}}">mua sắm</a></li>
                            <li class="breadcrumb-item active" aria-current="page">
                                đăng ký
                            </li>
                        </ol>
                    </div>
                </nav>

                <h1>Đăng ký</h1>
            </div>
        </div>

        <div class="container login-container">
            <div class="row">
                <div class="col-lg-10 mx-auto">
                    <div class="row justify-content-center">


                        <div class="col-md-6">
                            <div class="heading mb-1">
                                <h2 class="title">Đăng ký</h2>
                            </div>

                            <form action="{{ route("website.signup") }}" method="post">
                                @csrf
                                <label for="register-name">
                                    Tên đăng nhập
                                    <span class="required">*</span>
                                </label>
                                <input type="text" name="username" class="form-input form-wide" id="register-name" required />

                                <label for="register-email">
                                    Địa chỉ email
                                    <span class="required">*</span>
                                </label>
                                <input type="email" name="email" class="form-input form-wide" id="register-email" required />

                                <label for="register-password">
                                    Mật khẩu
                                    <span class="required">*</span>
                                </label>
                                <input type="password" name="password" class="form-input form-wide" id="login-password" required />

                                <i style="position: absolute; right: 20px; top: 53%; transform: translateY(-50%);" class="fa fa-eye toggle-password" her="" toggle="#login-password"></i>
                                <div class="form-footer">
                                    <a href="{{route('website.getlogin')}}"
                                        class="forget-password text-dark form-footer-right">Đã có tài khoản!</a>
                                </div>
                                <div class="form-footer mb-2">
                                    <button type="submit" class="btn btn-dark btn-md w-100 mr-0">
                                        Đăng ký
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main><!-- End .main -->
</div>

@endsection
<script src={{asset("assets/jquery/jquery-3.7.0.min.js")}}></script>

<script>
    $(document).ready(function() {
        $('.toggle-password').click(function() {
            $(this).toggleClass('fa-eye fa-eye-slash');
            var input = $($(this).attr('toggle'));
            if (input.attr('type') === 'password') {
                input.attr('type', 'text');
            } else {
                input.attr('type', 'password');
            }
        });
    });
</script>
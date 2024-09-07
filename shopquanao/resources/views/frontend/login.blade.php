@extends('layouts.home')
@section('content')
<div class="content">

<main class="main">
			<div class="page-header">
				<div class="container d-flex flex-column align-items-center">
					<nav aria-label="breadcrumb" class="breadcrumb-nav">
						<div class="container">
							<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="demo4.html">trang chủ</a></li>
							<li class="breadcrumb-item"><a href="category.html">mua sắm</a></li>
								<li class="breadcrumb-item active" aria-current="page">
									Đăng nhập
								</li>
							</ol>
						</div>
					</nav>

					<h1>Tài khoản của tôi</h1>
				</div>
			</div>
				<form action="{{ route("website.dologin") }}" method="post">
				@csrf
				<div class="container login-container">
					<div class="row">
						<div class="col-lg-10 mx-auto">
							<div class="row justify-content-center">
								<div class="col-md-5">
									<div class="heading mb-1">
										<h2 class="title">Đăng nhập</h2>
									</div>
@if($message= Session::get('error'))
<div class="alert alert-danger alert-block">
	<button type="button" class="close" date-dismiss="alert">x</button>
	<strong>{{$message}}</strong>
</div>
@endif
									
										<label for="login-email">
											Tên đăng nhập hoặc email
											<span class="required">*</span>
										</label>
										<input type="text" name="username" class="form-input form-wide" id="login-email" required />

										<label for="login-password">
											Mật khẩu
											<span class="required">*</span>
										</label>
										<input type="password" name="password" class="form-input form-wide" id="login-password" required />

										<i style="position: absolute; right: 20px; top: 46%; transform: translateY(-50%);" class="fa fa-eye toggle-password" her="" toggle="#login-password"></i>

										<div class="form-footer">
											<div class="custom-control custom-checkbox mb-0">
												<input type="checkbox" class="custom-control-input" id="lost-password" />
												<label class="custom-control-label mb-0" for="lost-password">nhớ tài khoản</label>
											</div>

											<a href="forgot-password.html"
												class="forget-password text-dark form-footer-right">quên mật khẩu?</a>
										</div>
										<button type="submit" class="btn btn-dark btn-md w-100 mb-3">
											Đăng nhập
										</button>
										<a href="{{ route('website.register') }}" class="btn btn-primary btn-md w-100">Đăng ký</a> <!-- Sử dụng thẻ <a> để điều hướng mà không gửi form -->

								
								</div>
								
							</div>
						</div>
					</div>
				</div>
				</form>

			</main>

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
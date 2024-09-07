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
							<li class="breadcrumb-item active" aria-current="page">
								Tài khoản của tôi
							</li>
						</ol>
					</div>
				</nav>

				<h1>Thông tin của tôi</h1>
			</div>
		</div>

		<div class="container account-container custom-account-container">
			<div class="row">
				<div class="sidebar widget widget-dashboard mb-lg-0 mb-3 col-lg-3 order-0">
					<h2 class="text-uppercase">Thông tin của tôi</h2>
					<ul class="nav nav-tabs list flex-column mb-0" role="tablist">
						<li class="nav-item">
							<a class="nav-link active" id="dashboard-tab" data-toggle="tab" href="#dashboard"
								role="tab" aria-controls="dashboard" aria-selected="true">Thông tin cá nhân</a>
						</li>

						<li class="nav-item">
							<a class="nav-link" id="order-tab" data-toggle="tab" href="#order" role="tab"
								aria-controls="order" aria-selected="true">Đơn hàng</a>
						</li>





						<form id="logout-form" action="{{ route('website.logout') }}" method="post" style="display: none;">
							@csrf
						</form>
						<a href="{{route('website.dologin')}}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Đăng xuất
					</ul>
				</div>
				<div class="col-lg-9 order-lg-last order-1 tab-content">
					<!-- End .tab-pane -->

					<x-orders />



					<x-account-details />

				</div><!-- End .row -->
			</div><!-- End .container -->

			<div class="mb-5"></div><!-- margin -->
	</main><!-- End .main -->


</div>

@endsection
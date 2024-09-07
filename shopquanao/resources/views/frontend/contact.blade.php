@extends('layouts.home')
@section('content')
<div class="content">

	<main class="main">
		<nav aria-label="breadcrumb" class="breadcrumb-nav">
			<div class="container">
				<ol class="breadcrumb">
					<li class="breadcrumb-item">
						<a href="{{route('home.index')}}"><i class="icon-home"></i></a>
					</li>
					<li class="breadcrumb-item active" aria-current="page">
						Liên hệ chúng tôi
					</li>
				</ol>
			</div>
		</nav>

		<div id="map">
			<iframe src="{{$configuration_all->link_map}}" style="width: 100%; height: 500px;"></iframe>

		</div>

		<div class="container contact-us-container">
			<div class="contact-info">
				<div class="row">
					<div class="col-12">
						<h2 class="ls-n-25 m-b-1">
							Thông Tin Liên Hệ
						</h2>

						<p>
						{{$configuration_all->description}}
						</p>
					</div>

					<div class="col-sm-6 col-lg-4">
						<div class="feature-box text-center">
							<i class="sicon-location-pin"></i>
							<div class="feature-box-content">
								<h3>Address</h3>
								<h5>{{$configuration_all->address}}</h5>
							</div>
						</div>
					</div>
					<div class="col-sm-6 col-lg-4">
						<div class="feature-box text-center">
							<i class="fa fa-mobile-alt"></i>
							<div class="feature-box-content">
								<h3>Phone Number</h3>
								<h5>{{$configuration_all->phone}}</h5>
							</div>
						</div>
					</div>
					<div class="col-sm-6 col-lg-4">
						<div class="feature-box text-center">
							<i class="far fa-envelope"></i>
							<div class="feature-box-content">
								<h3>E-mail Address</h3>
								<h5><a href="https://portotheme.com/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="25554a57514a65554a57514a514d4048400b464a48">[email&#160;protected]</a></h5>
							</div>
						</div>
					</div>

				</div>
			</div>
			@php
			$user = Auth::check() ? Auth::user() : null;
			@endphp
			<div class="row">
				<div class="col-lg-6">
					<h2 class="mt-6 mb-2">Gửi liên hệ</h2>


					<form action="{{ route('contact.post') }}" method="post" enctype="multipart/form-data">
						@csrf
						<div class="form-group">
							<label class="mb-1" for="contact-name">Tên của bạn
								<span class="required">*</span></label>
							<input type="text" class="form-control" id="contact-name" name="name" value="{{ $user ? $user->name : ''}}"
								required />
						</div>

						<div class="form-group">
							<label class="mb-1" for="contact-email"> E-mail
								<span class="required">*</span></label>
							<input type="email" class="form-control" id="contact-email" name="email" value="{{$user ? $user->email:''}}"
								required />
						</div>

						<div class="form-group">
							<label class="mb-1" for="contact-message">Nội dung
								<span class="required">*</span></label>
							<textarea cols="30" rows="1" id="contact-message" class="form-control"
								name="content" required></textarea>
						</div>

						<div class="form-footer mb-0">
							<button type="submit" class="btn btn-dark font-weight-normal">
								Gửi
							</button>
						</div>
					</form>
				</div>

				<div class="col-lg-6">
					<h2 class="mt-6 mb-1">Những câu hỏi thường gặp</h2>
					<div id="accordion">
						<div class="card card-accordion">
							<a class="card-header" href="#" data-toggle="collapse" data-target="#collapseOne"
								aria-expanded="true" aria-controls="collapseOne">
								Curabitur eget leo at velit imperdiet viaculis
								vitaes?
							</a>

							<div id="collapseOne" class="collapse show" data-parent="#accordion">
								<p>Lorem ipsum dolor sit amet, consectetur
									adipiscing elit. Curabitur eget leo at velit
									imperdiet varius. In eu ipsum vitae velit
									congue iaculis vitae at risus. Nullam tortor
									nunc, bibendum vitae semper a, volutpat eget
									massa.</p>
							</div>
						</div>

						<div class="card card-accordion">
							<a class="card-header collapsed" href="#" data-toggle="collapse"
								data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseOne">
								Curabitur eget leo at velit imperdiet vague
								iaculis vitaes?
							</a>

							<div id="collapseTwo" class="collapse" data-parent="#accordion">
								<p>Lorem ipsum dolor sit amet, consectetur
									adipiscing elit. Curabitur eget leo at velit
									imperdiet varius. In eu ipsum vitae velit
									congue iaculis vitae at risus. Nullam tortor
									nunc, bibendum vitae semper a, volutpat eget
									massa. Lorem ipsum dolor sit amet,
									consectetur adipiscing elit. Integer
									fringilla, orci sit amet posuere auctor,
									orci eros pellentesque odio, nec
									pellentesque erat ligula nec massa. Aenean
									consequat lorem ut felis ullamcorper posuere
									gravida tellus faucibus. Maecenas dolor
									elit, pulvinar eu vehicula eu, consequat et
									lacus. Duis et purus ipsum. In auctor mattis
									ipsum id molestie. Donec risus nulla,
									fringilla a rhoncus vitae, semper a massa.
									Vivamus ullamcorper, enim sit amet consequat
									laoreet, tortor tortor dictum urna, ut
									egestas urna ipsum nec libero. Nulla justo
									leo, molestie vel tempor nec, egestas at
									massa. Aenean pulvinar, felis porttitor
									iaculis pulvinar, odio orci sodales odio, ac
									pulvinar felis quam sit.</p>
							</div>
						</div>

						<div class="card card-accordion">
							<a class="card-header collapsed" href="#" data-toggle="collapse"
								data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
								Curabitur eget leo at velit imperdiet viaculis
								vitaes?
							</a>

							<div id="collapseThree" class="collapse" data-parent="#accordion">
								<p>Lorem ipsum dolor sit amet, consectetur
									adipiscing elit. Curabitur eget leo at velit
									imperdiet varius. In eu ipsum vitae velit
									congue iaculis vitae at risus. Nullam tortor
									nunc, bibendum vitae semper a, volutpat eget
									massa.</p>
							</div>
						</div>

						<div class="card card-accordion">
							<a class="card-header collapsed" href="#" data-toggle="collapse"
								data-target="#collapseFour" aria-expanded="true" aria-controls="collapseThree">
								Curabitur eget leo at velit imperdiet vague
								iaculis vitaes?
							</a>

							<div id="collapseFour" class="collapse" data-parent="#accordion">
								<p>Lorem ipsum dolor sit amet, consectetur
									adipiscing elit. Curabitur eget leo at velit
									imperdiet varius. In eu ipsum vitae velit
									congue iaculis vitae at risus. Nullam tortor
									nunc, bibendum vitae semper a, volutpat eget
									massa. Lorem ipsum dolor sit amet,
									consectetur adipiscing elit. Integer
									fringilla, orci sit amet posuere auctor,
									orci eros pellentesque odio, nec
									pellentesque erat ligula nec massa. Aenean
									consequat lorem ut felis ullamcorper posuere
									gravida tellus faucibus. Maecenas dolor
									elit, pulvinar eu vehicula eu, consequat et
									lacus. Duis et purus ipsum. In auctor mattis
									ipsum id molestie. Donec risus nulla,
									fringilla a rhoncus vitae, semper a massa.
									Vivamus ullamcorper, enim sit amet consequat
									laoreet, tortor tortor dictum urna, ut
									egestas urna ipsum nec libero. Nulla justo
									leo, molestie vel tempor nec, egestas at
									massa. Aenean pulvinar, felis porttitor
									iaculis pulvinar, odio orci sodales odio, ac
									pulvinar felis quam sit.</p>
							</div>
						</div>

						<div class="card card-accordion">
							<a class="card-header collapsed" href="#" data-toggle="collapse"
								data-target="#collapseFive" aria-expanded="true" aria-controls="collapseThree">
								Curabitur eget leo at velit imperdiet varius
								iaculis vitaes?
							</a>

							<div id="collapseFive" class="collapse" data-parent="#accordion">
								<p>Lorem ipsum dolor sit amet, consectetur
									adipiscing elit. Curabitur eget leo at velit
									imperdiet varius. In eu ipsum vitae velit
									congue iaculis vitae at risus. Nullam tortor
									nunc, bibendum vitae semper a, volutpat eget
									massa. Lorem ipsum dolor sit amet,
									consectetur adipiscing elit. Integer
									fringilla, orci sit amet posuere auctor,
									orci eros pellentesque odio, nec
									pellentesque erat ligula nec massa. Aenean
									consequat lorem ut felis ullamcorper posuere
									gravida tellus faucibus. Maecenas dolor
									elit, pulvinar eu vehicula eu, consequat et
									lacus. Duis et purus ipsum. In auctor mattis
									ipsum id molestie. Donec risus nulla,
									fringilla a rhoncus vitae, semper a massa.
									Vivamus ullamcorper, enim sit amet consequat
									laoreet, tortor tortor dictum urna, ut
									egestas urna ipsum nec libero. Nulla justo
									leo, molestie vel tempor nec, egestas at
									massa. Aenean pulvinar, felis porttitor
									iaculis pulvinar, odio orci sodales odio, ac
									pulvinar felis quam sit.</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="mb-8"></div>
	</main>
</div>

@endsection
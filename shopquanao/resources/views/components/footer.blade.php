<footer class="footer bg-dark">
  <div class="footer-middle">
    <div class="container">
      <div class="row">
        <div class="col-lg-3 col-sm-6">
          <div class="widget">
            <h4 class="widget-title">Contact Info</h4>
            <ul class="contact-info">


              @if (!empty($configuration_all->address))
              <li>
                <span class="contact-info-label">Địa chỉ:</span>{{$configuration_all->address}}
              </li>
              @else
              <li>
                <span class="contact-info-label">Địa chỉ:</span>Chưa có
              </li>
              @endif
              
              @if (!empty($configuration_all->email))
              <li>
                <span class="contact-info-label">Email:</span>{{$configuration_all->email}}
              </li>
              @else
              <li>
                <span class="contact-info-label">Email:</span>Chưa có
              </li>
              @endif
             
              @if (!empty($configuration_all->phone))
              <li>
                <span class="contact-info-label">Số điện thoại:</span>{{$configuration_all->phone}}
              </li>
              @else
              <li>
                <span class="contact-info-label">Số điện thoại:</span>Chưa có
              </li>
              @endif
          
            </ul>
            <div class="social-icons">
                    <a href="{{$configuration_all->facebook}}" class="social-icon social-facebook icon-facebook" target="_blank"></a>
                    <a href="{{$configuration_all->twitter}}" class="social-icon social-twitter icon-twitter" target="_blank"></a>
                    <a href="{{$configuration_all->instagram}}" class="social-icon social-instagram icon-instagram" target="_blank"></a>
                </div>
            <!-- End .social-icons -->
          </div>
          <!-- End .widget -->
        </div>
        <!-- End .col-lg-3 -->

        <div class="col-lg-3 col-sm-6">
          <div class="widget">
            <h4 class="widget-title">Chính sách </h4>

            <ul class="links">
@foreach ($listpost as $row)
              <li><a href="chinh-sach/{{$row->slug}}">{{$row->title}}</a></li>

@endforeach

           
            </ul>
          </div>
          <!-- End .widget -->
        </div>
        <!-- End .col-lg-3 -->

        <div class="col-lg-3 col-sm-6">
          <div class="widget">
          <h4 class="widget-title">Menu </h4>

<ul class="links">
@foreach ($listmenu as $row)
  <li><a href="{{$row->link}}">{{$row->name}}</a></li>

@endforeach
          </div>
          <!-- End .widget -->
        </div>
        <!-- End .col-lg-3 -->

        <div class="col-lg-3 col-sm-6">
          <div class="widget widget-newsletter">
            <h4 class="widget-title">ĐĂNG KÝ Nhận thông báo</h4>
            <p>Nhận tất cả các thông tin mới nhất về các sự kiện, bán hàng và cung cấp. Đăng ký nhận bản tin:
            </p>
            <form action="{{ route('contact.post') }}" method="post" enctype="multipart/form-data">
						@csrf
              <input type="email"name="email" class="form-control m-b-3" placeholder="Email address" required>
              <input style="display: none;" type="text" id="qty" name="content" placeholder="Email nhận thông báo" value="email nhận thông báo" />

              <input type="submit" class="btn btn-primary shadow-none" value="Subscribe">
            </form>
          </div>
          <!-- End .widget -->
        </div>
        <!-- End .col-lg-3 -->
      </div>
      <!-- End .row -->
    </div>
    <!-- End .container -->
  </div>
  <!-- End .footer-middle -->

  <div class="container">
    <div class="footer-bottom">
      <div class="container d-sm-flex align-items-center">
        <div class="footer-left">
          <span class="footer-copyright">© Porto eCommerce. 2021. All Rights Reserved</span>
        </div>

        <div class="footer-right ml-auto mt-1 mt-sm-0">
          <div class="payment-icons">
            <span class="payment-icon visa" style="background-image: url({{asset('fe-asset')}}/assets/images/payments/payment-visa.svg)"></span>
            <span class="payment-icon paypal" style="background-image: url({{asset('fe-asset')}}/assets/images/payments/payment-paypal.svg)"></span>
            <span class="payment-icon stripe" style="background-image: url({{asset('fe-asset')}}/assets/images/payments/payment-stripe.png)"></span>
            <span class="payment-icon verisign" style="background-image:  url({{asset('fe-asset')}}/assets/images/payments/payment-verisign.svg)"></span>
          </div>
        </div>
      </div>
    </div>
    <!-- End .footer-bottom -->
  </div>
  <!-- End .container -->
</footer>
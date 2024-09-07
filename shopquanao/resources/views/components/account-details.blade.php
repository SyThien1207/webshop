<div class="tab-pane fade show active" id="dashboard" role="tabpanel">
<h3 class="account-sub-title d-none d-md-block mt-0 pt-1 ml-1"><i
            class="icon-user-2 align-middle mr-3 pr-1"></i>Thông tin cá nhân</h3>
            @php
            $user = Auth::user();
            @endphp
							<div class="dashboard-content">
                            <form action="{{ route('profile.update', ['id' => $user->id]) }}" method="post" enctype="multipart/form-data">
                     @csrf
              @method ("put") 
         
            <div class="row">
                <div class="col-md-9">
                    <div class="form-group">
                        <label for="acc-name">Họ và tên <span class="required"></span></label>
                        <input type="text" class="form-control"
                            id="acc-name" name="name" required value='{{$user->name}}' />
                    </div>
                    <div class="form-group">
                        <label for="acc-name">Tên đăng nhập <span class="required"></span></label>
                        <input type="text" class="form-control"
                            id="acc-name" name="username" required value='{{$user->username}}' />
                    </div>
                    <div class="row">
    <div class="col-md-9">
        <div class="form-group">
            <label for="acc-phone">Số điện thoại <span class="required"></span></label>
            <input type="text" class="form-control" id="acc-phone" name="phone" required value="{{ $user->phone ?? '' }}" />
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label for="acc-gender">Giới tính <span class="required"></span></label>
            <select class="form-control" name="gender">
                <option value="" {{ is_null($user->gender) ? 'selected' : '' }}>Ẩn</option>
                <option value="Nam" {{ $user->gender == 'Nam' ? 'selected' : '' }}>Nam</option>
                <option value="Nữ" {{ $user->gender == 'Nữ' ? 'selected' : '' }}>Nữ</option>
            </select>
        </div>
    </div>
</div>

                
                </div>
                <div class="col-md-3">
                <div class="form-group">
    <!-- Hiển thị ảnh của user -->
    <img id="user-image" src="{{ asset('images/user/' . $user->image) }}" alt="{{$user->image}}" class="img-thumbnail" style="max-width: 160px;">
</div>
<div class="form-group">
    <label for="image-upload">Thay đổi hình ảnh</label>
    <input type="file" id="image-upload" name="image">
</div>
<!-- #region -->
        </div>
        
            </div>
           


            <div class="form-group mb-4">
                <label for="acc-email">Địa chỉ <span class="required">*</span></label>
                <input type="text" class="form-control" id="acc-email" name="address"
                    placeholder=""  value="{{$user->address}}" />
            </div>

            <div class="change-password">
                <h3 class="text-uppercase mb-2">Thay đổi mật khẩu</h3>

                <div class="form-group">
    <label for="acc-password">Mật khẩu hiện tại</label>
    <input type="password" class="form-control" id="acc-password" placeholder="Nhập mật khẩu để thay đổi đổi mật khẩu"name="current_password" />
    @error('current_password')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="acc-new-password">Mật khẩu mới</label>
    <input type="password" class="form-control" id="acc-new-password" name="new_password"  />
</div>

<div class="form-group">
    <label for="acc-confirm-password">Xác nhận mật khẩu mới</label>
    <input type="password" class="form-control" id="acc-confirm-password" name="confirm_password"  />
    @error('confirm_password')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>

            </div>

            <div class="form-footer mt-3 mb-0">
                <button type="submit" class="btn btn-dark mr-0">
                    Lưu thay đôi
                </button>
            </div>
        </form>
    </div>
    <script>
    document.getElementById('image-upload').addEventListener('change', function(event) {
        var reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('user-image').src = e.target.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    });
    document.querySelector('form').addEventListener('submit', function(event) {
    var newPassword = document.getElementById('acc-new-password').value;
    var confirmPassword = document.getElementById('acc-confirm-password').value;

    if (newPassword !== confirmPassword) {
        event.preventDefault(); // Ngăn chặn việc submit form
        alert('Mật khẩu xác nhận không khớp.');
    }
});

</script>

</div><!-- End .tab-pane -->
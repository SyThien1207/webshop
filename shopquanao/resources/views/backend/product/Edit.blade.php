@extends('layouts.dashboard')
@section('content')
<div class="content">
<div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="mb-0">Cập nhật sản phẩm</h1>
            <a href="{{route('admin.product.index')}}" class="btn btn-secondary">Trở lại</a>
        </div>
        <hr style="border: none;" />

   <section class="content-body my-2">
      <form action="{{ route('admin.product.update', ['id' => $product->id]) }}" method="post" enctype="multipart/form-data">
         @csrf
         @method ("put")
         <div class="row">

            <div class="col-md-9">
               <div class="mb-3">
                  <label><strong>Tên sản phẩm (*)</strong></label>
                  <input type="text" value="{{old('name',$product->name)}}" name="name" class="form-control" />
               </div>
               <div class="mb-3">
                  <label for="image">Thay đổi hình ảnh</label>
                  <input type="file" name="image" id="image" class="form-control" onchange="previewImage()">

                  <div class="d-flex align-items-center mt-3" id="image-container">
                     <div id="new-image-preview" style="text-align: center; margin-right: 20px;"></div>
                     <div id="arrow" style="text-align: center; margin-right: 20px;"></div>
                     <div id="image-preview" style="text-align: center;">
                        @if($product->image)
                        <img src="{{ asset('/images/product/' . $product->image) }}" alt="Old Category Image" style="max-width: 100px;">
                        @endif
                     </div>
                  </div>
               </div>
               <div class="mb-3">
    <label for="image2">Thay đổi hình ảnh phụ</label>
    <input type="file" name="image2" id="image2" class="form-control" onchange="previewImage2()">

    <div class="d-flex align-items-center mt-3" id="image-container">
        <div id="new-image-preview2" style="text-align: center; margin-right: 20px;"></div>
        <div id="arrow2" style="text-align: center; margin-right: 20px;"></div>
        <div id="image-preview2" style="text-align: center;">
            @if($product->image2)
            <img src="{{ asset('/images/product/' . $product->image2) }}" alt="Old Secondary Image" style="max-width: 100px;">
            @endif
        </div>
    </div>
</div>

               <div class="box-container mt-2 bg-white">
    <div class="box-header py-1 px-2 border-bottom">
        <strong>Hình Mô tả(*)</strong>
    </div>
    <div class="box-body p-2 border-bottom">
        <input type="file" name="images[]" class="form-control" multiple onchange="previewMultipleImages()">
        <div class="d-flex align-items-center mt-3" id="image-container">
            <div id="new-images-preview" style="text-align: center; margin-right: 20px;"></div>
            <div id="arrow-multiple" style="text-align: center; margin-right: 20px;"></div>
            <div id="images-preview" style="text-align: center;">
                @foreach($product->productimags as $productimage)
                <img src="{{ asset('/images/product/Product_imag/' . $productimage->images) }}" alt="Old Product Image" style="max-width: 100px; margin-right: 10px;">
                @endforeach
            </div>
        </div>
    </div>
</div>


               <div class="mb-3">
                  <label><strong>Mô tả (*)</strong></label>
                  <textarea name="description" rows="3" class="form-control">{{old('description',$product->description)}}</textarea>
               </div>
               <div class="mb-3">
                  <label><strong>Chi tiết (*)</strong></label>
                  <textarea name="detail" rows="7" id="editor1" class="form-control">{{old('detail',$product->detail)}}</textarea>
               </div>

            </div>
            <div class="col-md-3">
               <div class="box-container mt-4 bg-white">
                  <div class="box-header py-1 px-2 border-bottom">
                     <strong>Đăng</strong>
                  </div>
                  <div class="box-body p-2 border-bottom">
                     <select name="status" class="form-select">
                        <option value="2" {{($product->status==2)?'selected':''}}>--Chưa xuất bản--</option>
                        <option value="1" {{($product->status==1)?'selected':''}}>--Xuất bản--</option>
                     </select>
                  </div>
                  <div class="box-footer text-end px-2 py-2">
                     <button type="submit" class="btn btn-success btn-sm text-end">
                        <i class="fa fa-save" aria-hidden="true"></i> Đăng
                     </button>
                  </div>
               </div>
               <div class="box-container mt-2 bg-white">
                  <div class="box-header py-1 px-2 border-bottom">
                     <strong>Danh mục(*)</strong>
                  </div>
                  <div class="box-body p-2 border-bottom">
                     <select name="category_id" class="form-select">
                        { {!! $html_category_id !!} }
                     </select>
                  </div>
               </div>
               <div class="box-container mt-2 bg-white">
                  <div class="box-header py-1 px-2 border-bottom">
                     <strong>Thương hiệu(*)</strong>
                  </div>
                  <div class="box-body p-2 border-bottom">
                     <select name="brand_id" class="form-select">
                        <option value="">Chọn thương hiêu</option>
                        { {!!$html_brand_id!!} }
                     </select>
                  </div>
               </div>
               <div class="box-container mt-2 bg-white">
                  <div class="box-header py-1 px-2 border-bottom">
                     <strong>Giá bán</strong>
                  </div>
                  <div class="box-body p-2 border-bottom">
                     <div class="mb-3">
                        <label><strong>Giá bán (*)</strong></label>
                        <input type="number" value="{{old('price',$product->price)}}" min="10000" name="price" class="form-control" />
                     </div>
                

                  </div>
               </div>

            </div>

         </div>
      </form>

   </section>
</div>
@endsection

@section('custom-js')
<script src="{{asset('assets/ckeditor/ckeditor.js')}}"></script>
<script>
   CKEDITOR.replace('editor1');
</script>
<script>
   

   function previewMultipleImages() {
      const input = document.querySelector('input[name="images[]"]');
      const newImagesPreview = document.getElementById('new-images-preview');
      newImagesPreview.innerHTML = ''; // Clear the previous preview

      if (input.files) {
         Array.from(input.files).forEach(file => {
            const reader = new FileReader();
            reader.onload = function(e) {
               const img = document.createElement('img');
               img.src = e.target.result;
               img.alt = "New Preview Image";
               img.style.maxWidth = '100px';
               img.style.marginRight = '10px';
               newImagesPreview.appendChild(img);
            }
            reader.readAsDataURL(file);
         });
      }
   }
   function previewImage2() {
    const input = document.getElementById('image2');
    const newImagePreview = document.getElementById('new-image-preview2');
    newImagePreview.innerHTML = ''; // Xóa hình ảnh hiển thị trước đó

    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const img = document.createElement('img');
            img.src = e.target.result;
            img.alt = "New Preview Image";
            img.style.maxWidth = '100px';
            newImagePreview.appendChild(img);
        }
        reader.readAsDataURL(input.files[0]);
    }
}

</script>

@endsection
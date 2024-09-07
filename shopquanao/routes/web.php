<?php
use App\Http\Controllers\backend\BannerController;
use App\Http\Controllers\backend\BrandController;
use App\Http\Controllers\backend\CategoryController;
use App\Http\Controllers\backend\ConfigurationController;
use App\Http\Controllers\backend\ContactController;
use App\Http\Controllers\backend\CouponController;
use App\Http\Controllers\backend\DashboardController;
use App\Http\Controllers\backend\MenuController;
use App\Http\Controllers\backend\OrderController;
use App\Http\Controllers\backend\PostController;
use App\Http\Controllers\backend\ProductController;
use App\Http\Controllers\backend\SupplierController;
use App\Http\Controllers\backend\TopicController;
use App\Http\Controllers\backend\UserController;
use App\Http\Controllers\backend\WarehouseController;
use App\Http\Controllers\frontend\AuthController;
use App\Http\Controllers\frontend\CartController;
use App\Http\Controllers\frontend\ContactController as lienheController;
use App\Http\Controllers\frontend\HomeController;
use App\Http\Controllers\frontend\LikeController;
use App\Http\Controllers\frontend\PolicyController;
use App\Http\Controllers\frontend\PostController as FrontendPostController;
use App\Http\Controllers\frontend\ProductController as sanphamController;
use App\Http\Controllers\frontend\ProfileController;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class, 'index',])->name('home.index');

Route::get('/chi-tiet-san-pham/{id}', [sanphamController::class, "product_detail"])->name("product.product-detail");
Route::get('/tat-ca-san-pham', [sanphamController::class, "index"])->name("product.index");
Route::get('/tat-ca-san-pham-list', [sanphamController::class, "index2"])->name("product.index2");
Route::get('/san-pham/{slug}', [sanphamController::class, "product"])->name("product.product");
Route::get('/tim-kiếm', [sanphamController::class, "search"])->name("product.search");
Route::get('/xem-nhanh/{id}', [sanphamController::class, "quick_view"])->name("product.quick");


Route::get('/chinh-sach/{slug}', [PolicyController::class, "index"])->name("policy.index");


Route::get('/lien-he', [lienheController::class, "index"])->name("contact.index");
Route::post('/gui', [lienheController::class, "contact"])->name("contact.post");


Route::get('/profile', [ProfileController::class, "index"])->middleware("middleauth")->name("profile.index");
Route::get('/profile/{id}', [ProfileController::class, "status"])->name("profile.status");
Route::put('update/{id}', [ProfileController::class, "update"])->name("profile.update");


Route::get('/cart-addcart', [CartController::class, "addcart"])->name("cart.addcart");
Route::get('/gio-hang', [CartController::class, "index"])->name("cart.index");
Route::post('/gio-hang/update', [CartController::class, "update"])->name("cart.update");
Route::get('/gio-hang/detele/{id}', [CartController::class, "detele"])->name("cart.detele");
Route::get('/detele/{id}', [CartController::class, "detele2"])->name("cart.detele2");
Route::get('/thanh-toan', [CartController::class, "checkout"])->name("cart.checkout");
Route::post('/thong-bao', [CartController::class, "docheckout"])->name("cart.docheckout");
Route::post('/ma-giam', [CartController::class, "applyCoupon"])->name("apply.coupon");

Route::get('/cart-addlike', [LikeController::class, "addlike"])->name("like.addlike");
Route::get('/san-pham-yeu-thich', [LikeController::class, "index"])->name("like.index");
Route::get('/san-pham-yeu-thich/detele/{id}', [LikeController::class, "detele"])->name("like.detele");


Route::get('/chi-tiet-bai-viet/{id}', [FrontendPostController::class, "post_detail"])->name("post.post-detail");
Route::get('/tat-ca-bai-viet', [FrontendPostController::class, "allpost"])->name("post.post");
Route::get('/bai-viet/{slug}', [FrontendPostController::class, "post_topic"])->name("post");

Route::get('/dang-nhap', [AuthController::class, "getlogin"])->name("website.getlogin");
Route::get('/tao-tai-khoan', [AuthController::class, "register"])->name("website.register");

Route::post('/dang-nhap', [AuthController::class, "dologin"])->name("website.dologin");
Route::post('/dang-xuat', [AuthController::class, "logout"])->name("website.logout");
Route::post('/tao-tai-khoan', [AuthController::class, "signup"])->name("website.signup");

Route::prefix("admin")->middleware("middleauth")->group(function () {
   Route::get('/', [DashboardController::class, "index"])->name("admin.dashoard.index");

   Route::prefix("banner")->group(function () {
      Route::get('/', [BannerController::class, "index"])->name("admin.banner.index");
      Route::get('trash', [BannerController::class, "trash"])->name("admin.banner.trash");
      Route::get('show/{id}', [BannerController::class, "show"])->name("admin.banner.show");
      Route::get('create', [BannerController::class, "create"])->name("admin.banner.create");
      Route::post('banner', [BannerController::class, "store"])->name("admin.banner.store");
      Route::get('edit/{id}', [BannerController::class, "edit"])->name("admin.banner.edit");
      Route::put('update/{id}', [BannerController::class, "update"])->name("admin.banner.update");
      Route::get('delete/{id}', [BannerController::class, "delete"])->name("admin.banner.delete");
      Route::get('restore/{id}', [BannerController::class, "restore"])->name("admin.banner.restore");
      Route::get('destroy/{id}', [BannerController::class, "destroy"])->name("admin.banner.destroy");
      Route::get('status/{id}', [BannerController::class, "status"])->name("admin.banner.status");
   });
   Route::prefix("brand")->group(function () {
      Route::get('/', [BrandController::class, "index"])->name("admin.brand.index");
      Route::get('/{slug}', [BrandController::class, "product"])->name("admin.brand.view");

      Route::get('trash', [BrandController::class, "trash"])->name("admin.brand.trash");
      Route::get('show/{id}', [BrandController::class, "show"])->name("admin.brand.show");
      Route::post('brand', [BrandController::class, "store"])->name("admin.brand.store");
      Route::get('edit/{id}', [BrandController::class, "edit"])->name("admin.brand.edit");
      Route::put('update/{id}', [BrandController::class, "update"])->name("admin.brand.update");
      Route::get('delete/{id}', [BrandController::class, "delete"])->name("admin.brand.delete");
      Route::get('restore/{id}', [BrandController::class, "restore"])->name("admin.brand.restore");
      Route::get('destroy/{id}', [BrandController::class, "destroy"])->name('admin.brand.destroy');
      Route::get('status/{id}', [BrandController::class, "status"])->name("admin.brand.status");
   });
   Route::prefix("category")->group(function () {

      Route::get('/', [CategoryController::class, "index"])->name("admin.category.index");
      Route::get('/{slug}', [CategoryController::class, "product"])->name("admin.category.view");

      Route::get('trash', [CategoryController::class, "trash"])->name("admin.category.trash");
      Route::get('show/{id}', [CategoryController::class, "show"])->name("admin.category.show");
      Route::post('category', [CategoryController::class, "store"])->name("admin.category.store");
      Route::get('edit/{id}', [CategoryController::class, "edit"])->name("admin.category.edit");
      Route::put('update/{id}', [CategoryController::class, "update"])->name("admin.category.update");
      Route::get('delete/{id}', [CategoryController::class, "delete"])->name("admin.category.delete");
      Route::get('restore/{id}', [CategoryController::class, "restore"])->name("admin.category.restore");
      Route::get('destroy/{id}', [CategoryController::class, "destroy"])->name("admin.category.destroy");
      Route::get('status/{id}', [CategoryController::class, 'status'])->name('admin.category.status');

   });
   Route::prefix("contact")->group(function () {
      Route::get('/', [ContactController::class, "index"])->name("admin.contact.index");
      Route::get('trash', [ContactController::class, "trash"])->name("admin.contact.trash");
      Route::get('reply/{id}', [ContactController::class, "reply"])->name("admin.contact.reply");
      Route::get('create', [ContactController::class, "create"])->name("admin.contact.create");
      Route::post('contact', [ContactController::class, "store"])->name("admin.contact.store");
      Route::get('edit/{id}', [ContactController::class, "edit"])->name("admin.contact.edit");
      Route::put('update/{id}', [ContactController::class, "update"])->name("admin.contact.update");
      Route::get('delete/{id}', [ContactController::class, "delete"])->name("admin.contact.delete");
      Route::get('restore/{id}', [ContactController::class, "restore"])->name("admin.contact.restore");
      Route::get('destroy/{id}', [ContactController::class, "destroy"])->name("admin.contact.destroy");
      Route::get('status/{id}', [ContactController::class, "status"])->name("admin.contact.status");
   });
   Route::prefix("menu")->group(function () {
      Route::get('/', [MenuController::class, "index"])->name("admin.menu.index");
      Route::get('trash', [MenuController::class, "trash"])->name("admin.menu.trash");
      Route::get('show/{id}', [MenuController::class, "show"])->name("admin.menu.show");
      Route::post('menu', [MenuController::class, "store"])->name("admin.menu.store");
      Route::get('edit/{id}', [MenuController::class, "edit"])->name("admin.menu.edit");
      Route::put('update/{id}', [MenuController::class, "update"])->name("admin.menu.update");
      Route::get('delete/{id}', [MenuController::class, "delete"])->name("admin.menu.delete");
      Route::get('restore/{id}', [MenuController::class, "restore"])->name("admin.menu.restore");
      Route::get('destroy/{id}', [MenuController::class, "destroy"])->name("admin.menu.destroy");
      Route::get('status/{id}', [MenuController::class, "status"])->name("admin.menu.status");
   });
   Route::prefix("order")->group(function () {
      Route::get('/', [OrderController::class, "index"])->name("admin.order.index");
      Route::get('trash', [OrderController::class, "trash"])->name("admin.order.trash");
      Route::get('show/{id}', [OrderController::class, "show"])->name("admin.order.show");
      Route::get('create', [OrderController::class, "create"])->name("admin.order.create");
      Route::post('order', [OrderController::class, "store"])->name("admin.order.store");
      Route::get('edit/{id}', [OrderController::class, "edit"])->name("admin.order.edit");
      Route::put('update/{id}', [OrderController::class, "update"])->name("admin.order.update");
      Route::get('delete/{id}', [OrderController::class, "delete"])->name("admin.order.delete");
      Route::get('restore/{id}', [OrderController::class, "restore"])->name("admin.order.restore");
      Route::get('destroy/{id}', [OrderController::class, "destroy"])->name("admin.order.destroy");
      Route::get('status/{id}', [OrderController::class, "status"])->name("admin.order.status");
      Route::get('details/{id}', [OrderController::class, 'details'])->name('admin.order.details');

   });

   Route::prefix("product")->group(function () {
      Route::get('/', [ProductController::class, "index"])->name("admin.product.index");
      Route::get('trash', [ProductController::class, "trash"])->name("admin.product.trash");
      Route::get('show/{id}', [ProductController::class, "show"])->name("admin.product.show");
      Route::get('create', [ProductController::class, "create"])->name("admin.product.create");
      Route::post('product', [ProductController::class, "store"])->name("admin.product.store");
      Route::get('edit/{id}', [ProductController::class, "edit"])->name("admin.product.edit");
      Route::put('update/{id}', [ProductController::class, "update"])->name("admin.product.update");
      Route::get('delete/{id}', [ProductController::class, "delete"])->name("admin.product.delete");
      Route::get('restore/{id}', [ProductController::class, "restore"])->name("admin.product.restore");
      Route::get('destroy/{id}', [ProductController::class, "destroy"])->name("admin.product.destroy");
      Route::get('status/{id}', [ProductController::class, "status"])->name("admin.product.status");
      Route::get('/sale', [ProductController::class, "sale"])->name("admin.product.sale");
      Route::get('editsale/{id}', [ProductController::class, "editsale"])->name("admin.product.editsale");
      Route::put('updatesale/{id}', [ProductController::class, "updatesale"])->name("admin.product.updatesale");
      Route::get('deletesale/{id}', [ProductController::class, "deletesale"])->name("admin.product.delete");
   });
   Route::prefix("supplier")->group(function () {
      Route::get('/', [supplierController::class, "index"])->name("admin.supplier.index");
      Route::get('trash', [supplierController::class, "trash"])->name("admin.supplier.trash");
      Route::get('show/{id}', [supplierController::class, "show"])->name("admin.supplier.show");
      Route::get('create', [SupplierController::class, "create"])->name("admin.supplier.create");
      Route::post('supplier', [supplierController::class, "store"])->name("admin.supplier.store");
      Route::get('edit/{id}', [supplierController::class, "edit"])->name("admin.supplier.edit");
      Route::put('update/{id}', [supplierController::class, "update"])->name("admin.supplier.update");
      Route::get('delete/{id}', [supplierController::class, "delete"])->name("admin.supplier.delete");
      Route::get('restore/{id}', [supplierController::class, "restore"])->name("admin.supplier.restore");
      Route::get('destroy/{id}', [supplierController::class, "destroy"])->name("admin.supplier.destroy");
      Route::get('status/{id}', [supplierController::class, "status"])->name("admin.supplier.status");
   });
   Route::prefix("warehouse")->group(function () {
      Route::get('/', [WarehouseController::class, "index"])->name("admin.warehouse.index");
      Route::get('trash', [WarehouseController::class, "trash"])->name("admin.warehouse.trash");
      Route::get('show/{id}', [WarehouseController::class, "show"])->name("admin.warehouse.show");
      Route::get('create', [WarehouseController::class, "create"])->name("admin.warehouse.create");
      Route::post('warehouse', [WarehouseController::class, "store"])->name("admin.warehouse.store");
      Route::get('edit/{id}', [WarehouseController::class, "edit"])->name("admin.warehouse.edit");
      Route::put('update/{id}', [WarehouseController::class, "update"])->name("admin.warehouse.update");
      Route::get('delete/{id}', [WarehouseController::class, "delete"])->name("admin.warehouse.delete");
      Route::get('restore/{id}', [WarehouseController::class, "restore"])->name("admin.warehouse.restore");
      Route::get('destroy/{id}', [WarehouseController::class, "destroy"])->name("admin.warehouse.destroy");
      Route::get('status/{id}', [WarehouseController::class, "status"])->name("admin.warehouse.status");
      Route::get('/get-products', [WarehouseController::class, 'getProducts'])->name('getProducts');
      Route::get('/dow-products/{id}', [WarehouseController::class, 'dowProducts'])->name('admin.warehouse.dowProducts');
      Route::get('details/{id}', [WarehouseController::class, 'details'])->name('admin.warehouse.details');
   });

   Route::prefix("user")->group(function () {
      Route::get('/', [UserController::class, "index"])->name("admin.user.index");
      Route::get('trash', [UserController::class, "trash"])->name("admin.user.trash");
      Route::get('show/{id}', [UserController::class, "show"])->name("admin.user.show");
      Route::get('create', [UserController::class, "create"])->name("admin.user.create");
      Route::post('user', [UserController::class, "store"])->name("admin.user.store");
      Route::get('edit/{id}', [UserController::class, "edit"])->name("admin.user.edit");
      Route::put('update/{id}', [UserController::class, "update"])->name("admin.user.update");
      Route::get('delete/{id}', [UserController::class, "delete"])->name("admin.user.delete");
      Route::get('restore/{id}', [UserController::class, "restore"])->name("admin.user.restore");
      Route::get('destroy/{id}', [UserController::class, "destroy"])->name("admin.user.destroy");
      Route::get('status/{id}', [UserController::class, "status"])->name("admin.user.status");
   });
   Route::prefix("topic")->group(function () {
      Route::get('/', [TopicController::class, "index"])->name("admin.topic.index");
      Route::get('trash', [TopicController::class, "trash"])->name("admin.topic.trash");
      Route::get('show/{id}', [TopicController::class, "show"])->name("admin.topic.show");
      Route::get('create', [TopicController::class, "create"])->name("admin.topic.create");
      Route::post('topic', [TopicController::class, "store"])->name("admin.topic.store");
      Route::get('edit/{id}', [TopicController::class, "edit"])->name("admin.topic.edit");
      Route::put('update/{id}', [TopicController::class, "update"])->name("admin.topic.update");
      Route::get('delete/{id}', [TopicController::class, "delete"])->name("admin.topic.delete");
      Route::get('restore/{id}', [TopicController::class, "restore"])->name("admin.topic.restore");
      Route::get('destroy/{id}', [TopicController::class, "destroy"])->name("admin.topic.destroy");
      Route::get('status/{id}', [TopicController::class, "status"])->name("admin.topic.status");
   });
   Route::prefix("post")->group(function () {
      Route::get('/', [PostController::class, "index"])->name("admin.post.index");
      Route::get('trash', [PostController::class, "trash"])->name("admin.post.trash");
      Route::get('show/{id}', [PostController::class, "show"])->name("admin.post.show");
      Route::get('create', [PostController::class, "create"])->name("admin.post.create");
      Route::post('post', [PostController::class, "store"])->name("admin.post.store");
      Route::get('edit/{id}', [PostController::class, "edit"])->name("admin.post.edit");
      Route::put('update/{id}', [PostController::class, "update"])->name("admin.post.update");
      Route::get('delete/{id}', [PostController::class, "delete"])->name("admin.post.delete");
      Route::get('restore/{id}', [PostController::class, "restore"])->name("admin.post.restore");
      Route::get('destroy/{id}', [PostController::class, "destroy"])->name("admin.post.destroy");
      Route::get('status/{id}', [PostController::class, "status"])->name("admin.post.status");
   });
      Route::prefix("configuration")->group(function () {
         Route::get('/', [ConfigurationController::class, "index"])->name("admin.configuration.index");
      

         Route::get('edit/{id}', [ConfigurationController::class, "edit"])->name("admin.configuration.edit");
         Route::put('update/{id}', [ConfigurationController::class, "update"])->name("admin.configuration.update");
         Route::post('configuration', [ConfigurationController::class, "store"])->name("admin.configuration.store");
      
         Route::get('status/{id}', [ConfigurationController::class, "status"])->name("admin.configuration.status");
      });
      Route::prefix("coupon")->group(function () {
         Route::get('/', [CouponController::class, "index"])->name("admin.coupon.index");
      
         Route::post('coupon', [CouponController::class, "store"])->name("admin.coupon.store");
         Route::get('trash', [CouponController::class, "trash"])->name("admin.coupon.trash");

         Route::get('edit/{id}', [CouponController::class, "edit"])->name("admin.coupon.edit");
         Route::put('update/{id}', [CouponController::class, "update"])->name("admin.coupon.update");
         Route::post('coupon', [CouponController::class, "store"])->name("admin.coupon.store");
         Route::get('destroy/{id}', [CouponController::class, "destroy"])->name("admin.coupon.destroy");
         Route::get('restore/{id}', [CouponController::class, "restore"])->name("admin.coupon.restore");
         Route::get('delete/{id}', [CouponController::class, "delete"])->name("admin.coupon.delete");
      
         Route::get('status/{id}', [CouponController::class, "status"])->name("admin.coupon.status");
      });
});

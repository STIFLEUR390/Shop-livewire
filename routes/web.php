<?php

use App\Http\Livewire\{CartComponent, CategoryComponent, CheckoutComponent, ContactComponent, DetailComponent, HomeComponent, SearchComponent, ShopComponent, ThankyouComponent, WishlistComponent};
use App\Http\Livewire\Admin\{AdminAddAttributeComponent, AdminAddCategoryComponent, AdminAddCouponsComponent, AdminAddHomeSliderComponent, AdminAddProductComponent, AdminAttributesComponent, AdminCategoryComponent, AdminContactComponent, AdminCouponsComponent, AdminDashboardComponent, AdminEditAttributeComponent, AdminEditCategoryComponent, AdminEditCouponsComponent, AdminEditHomeSliderComponent, AdminEditProductComponent, AdminHomeCategoryComponent, AdminHomeSliderComponent, AdminOrderComponent, AdminOrderDetailsComponent, AdminProductComponent, AdminSaleComponent, AdminSettingComponent};
use App\Http\Livewire\User\{UserChangePasswordComponent, UserDashboardComponent, UserEditProfileComponent, UserOrderDetailsComponent, UserOrdersComponent, UserProfileComponent, UserReviewComponent};
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', HomeComponent::class);

Route::get('/shop', ShopComponent::class);

Route::get('/cart', CartComponent::class)->name('product.cart');

Route::get('/checkout', CheckoutComponent::class)->name('checkout');

Route::get('/product/{slug}', DetailComponent::class)->name('product.details');

Route::get('/product-category/{category_slug}/{scategory_slug?}', CategoryComponent::class)->name('product.category');

Route::get('/search', SearchComponent::class)->name('product.search');

Route::get('/wishlist', WishlistComponent::class)->name('product.wishlist');

Route::get('/thank-you', ThankyouComponent::class)->name('thankyou');

Route::get('/contact-us', ContactComponent::class)->name('contact');
// Route::get('/', function () {
//     return view('welcome');
// });

// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');

#For User or Customer
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/user/dashboard', UserDashboardComponent::class)->name('user.dashboard');
    Route::get('/user/orders', UserOrdersComponent::class)->name('user.orders');
    Route::get('/user/order/{order_id}', UserOrderDetailsComponent::class)->name('user.orderdetails');
    Route::get('/user/review/{order_item_id}', UserReviewComponent::class)->name('user.review');
    Route::get('/user/change-password', UserChangePasswordComponent::class)->name('user.changepassword');
    Route::get('/user/profile', UserProfileComponent::class)->name('user.profile');
    Route::get('/user/profile/edit', UserEditProfileComponent::class)->name('user.editprofile');
});

#For Admin
Route::middleware(['auth:sanctum', 'verified', 'authadmin'])->group(function () {
    Route::get('/admin/dashboard', AdminDashboardComponent::class)->name('admin.dashboard');

    // categorie
    Route::get('/admin/categories', AdminCategoryComponent::class)->name('admin.categories');
    Route::get('/admin/category/add', AdminAddCategoryComponent::class)->name('admin.addcategory');
    Route::get('/admin/category/edit/{category_slug}/{scategory_slug?}', AdminEditCategoryComponent::class)->name('admin.editcategory');

    // Produit
    Route::get('/admin/products', AdminProductComponent::class)->name('admin.products');
    Route::get('/admin/product/add', AdminAddProductComponent::class)->name('admin.addproduct');
    Route::get('/admin/product/edit/{product_slug}', AdminEditProductComponent::class)->name('admin.editproduct');

    //Slider accueil
    Route::get('/admin/slider', AdminHomeSliderComponent::class)->name('admin.homeslider');
    Route::get('/admin/slider/add', AdminAddHomeSliderComponent::class)->name('admin.addhomeslider');
    Route::get('/admin/slider/edit/{slide_id}', AdminEditHomeSliderComponent::class)->name('admin.edithomeslider');

    Route::get('/admin/home-categories', AdminHomeCategoryComponent::class)->name('admin.homecategories');
    Route::get('/adin/sale', AdminSaleComponent::class)->name('admin.sale');

    // Coupons
    Route::get('/admin/coupons', AdminCouponsComponent::class)->name('admin.coupons');
    Route::get('/admin/coupon/add', AdminAddCouponsComponent::class)->name('admin.addcoupon');
    Route::get('/admin/coupon/edit/{coupon_id}', AdminEditCouponsComponent::class)->name('admin.editcoupon');

    //Paiement
    Route::get('/admin/orders', AdminOrderComponent::class)->name('admin.orders');
    Route::get('/admin/orders/{order_id}', AdminOrderDetailsComponent::class)->name('admin.orderdetails');

    Route::get('/admin/contact-us', AdminContactComponent::class)->name('admin.contact');

    Route::get('/admin/settings', AdminSettingComponent::class)->name('admin.settings');

    Route::get('admin/attributes', AdminAttributesComponent::class)->name('admin.attributes');
    Route::get('admin/attribute/add', AdminAddAttributeComponent::class)->name('admin.add_attribute');
    Route::get('admin/attribute/{attribute_id}/edit', AdminEditAttributeComponent::class)->name('admin.edit_attribute');
});

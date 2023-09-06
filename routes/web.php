<?php
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SizeController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\ProductController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('admin/login',[AdminController::class,'login'])->name('admin.login');
Route::post('admin/check',[AdminController::class,'user'])->name('admin.auth');
Route::group(["middleware"=>'admin_auth'],function(){
    Route::get('admin/index',[AdminController::class,'index'])->name('admin.dashboard');
    Route::get('admin/category',[CategoryController::class,'index'])->name('admin.category');
    Route::post('admin/category',[CategoryController::class,'getpagination'])->name('admin.category.list');
    Route::post('admin/category-save',[CategoryController::class,'add'])->name('admin.add.category');

    //for size
    Route::get('admin/size',[SizeController::class,'index'])->name('admin.size');
    Route::post('admin/size',[SizeController::class,'getpagination'])->name('admin.size.list');
    Route::post('admin/size-save',[SizeController::class,'add'])->name('admin.add.size');

    //for color
    Route::get('admin/color',[ColorController::class,'index'])->name('admin.color');
    Route::post('admin/color',[ColorController::class,'getpagination'])->name('admin.color.list');
    Route::post('admin/color-save',[ColorController::class,'add'])->name('admin.add.color');

    //for product
    Route::get('admin/product',[ProductController::class,'index'])->name('admin.product');
    Route::post('admin/product',[ProductController::class,'getpagination'])->name('admin.product.list');
    Route::get('admin/add-product',[ProductController::class,'productForm'])->name('admin.product.form');
    Route::post('admin/product-save',[ProductController::class,'add'])->name('admin.add.product');

});

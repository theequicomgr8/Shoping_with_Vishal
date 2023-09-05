<?php
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
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

});

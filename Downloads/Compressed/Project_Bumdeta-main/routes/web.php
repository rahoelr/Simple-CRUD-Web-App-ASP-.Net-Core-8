<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DesaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MitraController;
use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\JenisUsahaController;
use App\Http\Controllers\LandingPageController;

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

Route::get('/', [LandingPageController::class, 'publicView']);

Route::get('/home', [LandingPageController::class, 'publicView']);

Route::get('/tentang_kami', [AboutUsController::class, 'show']);

Route::get('/mitra', [MitraController::class, 'show']);

Route::get('/desa', [DesaController::class, 'show']);

Route::get('/produk', [ProductController::class, 'list_product']);

Route::get('/artikel', [ArticleController::class, 'show']);

Route::get('/detail-artikel/{id}', [ArticleController::class, 'detail_article']);

Route::get('/detail_produk/{id}', [ProductController::class, 'details_product']);

Route::get('/detail_mitra/{id}', [MitraController::class, 'details_mitra']);

Route::get('/detail_desa/{id}', [DesaController::class, 'details_desa']);

Route::post('/sort-desa', [DesaController::class, 'sort']);

Route::resource('admin-products', 'App\Http\Controllers\ProductController');
Route::resource('admin-mitras', 'App\Http\Controllers\MitraController');
Route::resource('admin-articles', 'App\Http\Controllers\ArticleController');
Route::resource('admin-teams', 'App\Http\Controllers\TeamController');
Route::resource('admin-categories', 'App\Http\Controllers\CategoryController');
Route::resource('admin-about_us', 'App\Http\Controllers\AboutUsController');
Route::resource('users', 'App\Http\Controllers\UserController');
Route::resource('admin-message', 'App\Http\Controllers\MessageController');
Route::resource('admin-landing', 'App\Http\Controllers\LandingpageController');
Route::resource('admin-users', 'App\Http\Controllers\UserController');
Route::resource('admin-desas', 'App\Http\Controllers\DesaController');
Route::resource('admin-jenisUsahas', 'App\Http\Controllers\JenisUsahaController');

Auth::routes([
    'reset' => true,
]);

Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/db_mitra/{id}', [ProductController::class, 'mitraViewlatest']);
Route::get('/db_mitra-product/{id}', [ProductController::class, 'mitraView']);
Route::get('/db_mitra-toko/{id}', [MitraController::class, 'mitraView']);
Route::get('/db_admin', [ProductController::class, 'adminViewlatest']);
Route::get('/db_admin-landing/{id}', [LandingPageController::class, 'adminView']);
Route::get('/db_admin-landing-detail/{id}', [LandingPageController::class, 'adminShow']);
Route::get('/db_admin-product', [ProductController::class, 'adminView']);
Route::get('/db_admin-product-detail/{id}', [ProductController::class, 'adminShow']);
Route::get('/db_admin-mitra', [MitraController::class, 'adminView']);
Route::get('/db_admin-mitra-detail/{id}', [MitraController::class, 'adminShow']);
Route::get('/db_admin-article', [ArticleController::class, 'index']);
Route::get('/db_admin-article-detail/{id}', [ArticleController::class, 'adminShow']);
Route::get('/db_admin-category', [CategoryController::class, 'index']);
Route::get('/db_admin-category-detail/{id}', [CategoryController::class, 'adminShow']);
Route::get('/db_admin-aboutus/{id}', [AboutUsController::class, 'adminView']);
Route::get('/db_admin-message', [MessageController::class, 'index']);
Route::get('/db_admin-message-detail/{id}', [MessageController::class, 'adminShow']);
Route::get('/db_admin-team', [TeamController::class, 'index']);
Route::get('/db_admin-team-detail/{id}', [TeamController::class, 'adminShow']);
Route::get('/db_admin-user', [UserController::class, 'index']);
Route::get('/db_admin-user-detail/{id}', [UserController::class, 'show']);
Route::get('/db_admin-desa-detail/{id}', [DesaController::class, 'adminShow']);
Route::get('/db_admin-jenis_usaha', [JenisUsahaController::class, 'index']);
Route::get('/db_admin-usaha-detail/{id}', [JenisUsahaController::class, 'adminShow']);

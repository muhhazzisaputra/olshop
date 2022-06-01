<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminPostController;
use App\Http\Controllers\AdminCategoryController;
use App\Http\Controllers\AdminMerkController;
use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\ImageUploadController;
use App\Http\Controllers\CrudController;
use App\Http\Controllers\AdminPageController;
use App\Http\Controllers\AdminSizeController;
use App\Models\Post;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;

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

/* =================================================================== BLOK HOMEPAGE ====================================================== */
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/product/{product:slug}', [ProductController::class, 'show']);
Route::post('/product/add_to_cart', [ProductController::class, 'addToCart']);

Route::get('/posts', [PostController::class, 'index']);
Route::get('/posts/{post:slug}', [PostController::class, 'show']);

Route::get('/categories', function() {
	return view('categories', [
		'title'    	 => 'Post Categories',
		'categories' => Category::all()
	]);
});

Route::get('/categories/{category:slug}', function(Category $category) {
	return view('category', [
		'title'    => $category->name,
		'posts'    => $category->posts->load('category', 'author'),
		'category' => $category->name
	]);
});

Route::get('/authors/{author:username}', function(User $author) {
	return view('author', [
		'title' => 'Author Posts',
		'posts' => $author->posts->load('category', 'author')
	]);
});

Route::get('/register', [RegisterController::class, 'index']);
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/login', [LoginController::class, 'index'])->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);

Route::post('/logout', [LoginController::class, 'logout']);

// Google URL
Route::prefix('google')->name('google.')->group( function(){
    Route::get('login', [GoogleController::class, 'loginWithGoogle'])->name('login');
    Route::any('callback', [GoogleController::class, 'callbackFromGoogle'])->name('callback');
});

// PAGE
Route::get('/page/{page:slug}', [PageController::class, 'show']);

// CUSTOER PROFILE
Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
/* =================================================================== END BLOK HOMEPAGE ====================================================== */


/* =================================================================== BLOK ADMIN ============================================================= */
Route::get('/admin', [AdminController::class, 'index'])->name('admin')->middleware('guest');
Route::post('/admin', [AdminController::class, 'authenticate']);
Route::get('/adminlogout', [AdminController::class, 'logout']);

Route::get('dashboard', [DashboardController::class, 'index'])->middleware('auth');

Route::get('/adminpost/getSlug', [AdminPostController::class, 'getSlug'])->middleware('auth');
Route::resource('/adminpost', AdminPostController::class)->middleware('auth');

// PRODUCT CATEGORY
Route::get('/admin/category/getSlug', [AdminCategoryController::class, 'getSlug'])->middleware('auth');
Route::resource('/admin/category', AdminCategoryController::class)->middleware('auth');

use App\Http\Controllers\AdminBookController;

Route::get('ajax-book-crud', [AdminBookController::class, 'index']);
Route::post('add-update-book', [AdminBookController::class, 'store']);
Route::post('edit-book', [AdminBookController::class, 'edit']);
Route::post('delete-book', [AdminBookController::class, 'destroy']);

// PRODUCT MERK
Route::resource('/admin/merk', AdminMerkController::class)->middleware('auth');

// PRODUCT
Route::get('/admin/product/getSlug', [AdminProductController::class, 'getSlug'])->middleware('auth');
Route::resource('/admin/product', AdminProductController::class)->middleware('auth');
Route::post('/admin/product/upload', [AdminProductController::class, 'uploadImage'])->middleware('auth');
Route::get('/admin/product/deleteImage/{id}', [AdminProductController::class, 'deleteImage'])->middleware('auth');
Route::post('/admin/product/storeVariant', [AdminProductController::class, 'storeVariant'])->middleware('auth');
Route::get('/admin/product/showVariant/{id}', [AdminProductController::class, 'showVariant'])->middleware('auth');
Route::get('/admin/product/deleteVariant/{id}', [AdminProductController::class, 'deleteVariant'])->middleware('auth');

Route::get('/image-intervention', [ImageUploadController::class, 'index']);
Route::post('/upload', [ImageUploadController::class, 'upload']);

// CRUD AJAX
Route::get('/crud',[CrudController::class,'variant']);
Route::get('/crud/read',[CrudController::class,'read']);
Route::get('/crud/create',[CrudController::class,'create']);
Route::get('/crud/store',[CrudController::class,'store']);
Route::get('/crud/show/{id}',[CrudController::class,'show']);
Route::get('/crud/update/{id}',[CrudController::class,'update']);
Route::get('/crud/destroy/{id}',[CrudController::class,'destroy']);

// SIZE
Route::get('/admin/size',[AdminSizeController::class,'index']);
Route::get('/admin/size/read',[AdminSizeController::class,'read']);
Route::get('/admin/size/create',[AdminSizeController::class,'create']);
Route::get('/admin/size/store',[AdminSizeController::class,'store']);
Route::get('/admin/size/show/{id}',[AdminSizeController::class,'show']);
Route::get('/admin/size/update/{id}',[AdminSizeController::class,'update']);
Route::get('/admin/size/destroy/{id}',[AdminSizeController::class,'destroy']);

// PAGE OLSHOP
Route::get('/admin/page/{page:slug}', [AdminPageController::class, 'show']);
Route::post('/admin/page/{page:slug}', [AdminPageController::class, 'update']);
/* =================================================================== END BLOK ADMIN ========================================================= */
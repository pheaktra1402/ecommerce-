<?php
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\UpdateProfileController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/user/{id}', function ($id) {
    return "User ID is $id";
});

Route::get('/post/{slug?}', function ($slug = 'default-post') {
    return "Post slug: $slug";
});

Route::get('/test', function () {
    $url = route('dashboard');

    return "The URL for the dashboard route is: $url";
});

Route::prefix('admin')->group(function () {
    Route::get('/users', function () {
        return 'Admin Users';
    });

    Route::get('/posts', function () {
        return 'Admin Posts';
    });
});

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', function () {
        return 'User Profile';
    });
});

Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/post-login', [AuthController::class, 'postLogin'])->name('login.post');
Route::get('/registration', [AuthController::class, 'registration'])->name('register');
Route::post('/post-registration', [AuthController::class, 'postRegistration'])->name('register.post');
Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard')->middleware('auth');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');



Route::get('/user/{id}', [UserController::class, 'show']);

Route::fallback(function(){
    return response()->view('errors.404', [], 404);
});

Route::get('/category', [CategoryController::class, 'index'])->name("category.list");

    Route::get('/category/create', [CategoryController::class, 'create'])->name("category.create");

    Route::post('/category', [CategoryController::class, 'store'])->name("category.store");

    Route::get("/category/{categoryId}/edit", [CategoryController::class, 'edit'])->name('category.edit');

    Route::put("/category/{categoryId}", [CategoryController::class, 'update'])->name('category.update');

    Route::delete("/category/{categoryId}", [CategoryController::class, 'destroy'])->name('category.delete');

    Route::get('/category/{cateId}', [CategoryController::class, 'show'])->name("category.show");

Route::get('/product', [ProductController::class, 'index'])->name('product.index');
Route::get('/product/create', [ProductController::class, 'create'])->name('product.create');
Route::post('/product', [ProductController::class, 'store'])->name('product.store');
Route::get('/product/{product}', [ProductController::class, 'show'])->name('product.show');
Route::get('/product/{product}/edit', [ProductController::class, 'edit'])->name('product.edit');
Route::put('/product/{product}', [ProductController::class, 'update'])->name('product.update');
Route::delete('/product/{product}', [ProductController::class, 'destroy'])->name('product.destroy');

Route::get('/',[FrontendController::class,'index']);
Route::get('/list',[FrontendController::class,'list']);
Route::get('/show/{id}',[FrontendController::class,'show']);
Route::get('/search', [FrontendController::class,'getBySearch']);
Route::get('/frontend/{category?}', [FrontendController::class,'getByCategory']);
// change password
Route::get('/change-password', [ChangePasswordController::class, 'index'])->name('form.password');
Route::post('/change-password', [ChangePasswordController::class, 'store'])->name('change.password');

// update profile
Route::get('/update-profile/{user}',  [UpdateProfileController::class, 'editProfile'])->name('profile.edit');
Route::patch('/update-profile/{user}',  [UpdateProfileController::class, 'updateProfile'])->name('profile.update');

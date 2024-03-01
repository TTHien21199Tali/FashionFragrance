<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\User\LoginController;
//use App\Http\Controllers\Admin\MainController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UploadController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\MainController;




/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('admin/users/login', [LoginController::class, 'index'])->name('login');

Route::post('admin/users/login/store', [LoginController::class, 'store']);

Route::middleware(['auth'])->group(function(){
    
    Route::prefix('admin')->group(function(){
        route::get('main',[MainController::class, 'index']);
        route::get('/',[MainController::class, 'index'])->name('admin');

        route::prefix('menu')->group(function(){
            route::get('add',[MenuController::class, 'create']);
            route::post('add',[MenuController::class, 'store']);
            route::get('list',[MenuController::class, 'index']);

            Route::get('edit/{menu}', [MenuController::class, 'edit']);
            Route::post('update/{menu}', [MenuController::class, 'update'])->name('menu.update');
            route::DELETE('destroy',[MenuController::class,'destroy']);
            
        });

        #product
        Route::prefix('products')->group(function(){
            route::get('add',[ProductController::class, 'create'])->name('products.create');
            #upload
            route::post('store', [ProductController::class, 'store'])->name('products.store');
            Route::get('list', [ProductController::class, 'index'])->name('products.index');
            
            Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');

            Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('products.edit');
            Route::post('/update/{id}', [ProductController::class, 'update'])->name('products.update'); 
            
            
        });

        Route::prefix('sliders')->group(function(){
            Route::get('add',[SliderController::class, 'create'])->name('sliders.create');
            Route::post('store', [SliderController::class, 'store'])->name('sliders.store');
            
            Route::get('list', [SliderController::class, 'index'])->name('sliders.index');
            
            Route::get('/edit/{id}', [SliderController::class, 'edit'])->name('sliders.edit');
            Route::post('/update/{id}', [SliderController::class, 'update'])->name('sliders.update'); 

            Route::delete('/sliders/{id}', [SliderController::class, 'destroy'])->name('sliders.destroy');
            
        });    
    });
});


//phần phân trang
Route::get('/', [MainController::class, 'index'])->name('products.index');

Route::post('/load-more', [ProductController::class, 'loadMore'])->name('load-more');
//Route::get('/load-more', 'ProductController@loadMore')->name('load-more');

/*
Route::get('/',[MainController::class, 'index']);

Route::post('/load-more-products', [MainController::class, 'loadMoreProducts'])->name('loadMoreProducts');
*/


//route::get('admin/users',[MainController::class, 'index'])->name('admin')->middleware('auth'); //gọi middleware lẻ


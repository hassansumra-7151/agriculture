<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\HomeController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\PermissionController;
use App\Http\Controllers\admin\RoleController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\BannerController;
use App\Http\Controllers\admin\FertilizerController;
use App\Http\Controllers\admin\TractorPlowController;
use App\Http\Controllers\admin\AgricultureController;

Route::get('/', [HomeController::class, 'home'])->name('admin.home');

Route::group(['middleware' => ['isAdmin']], function() {

	//Banner route
	Route::prefix('banner')->name('banner.')->group(function () {
        Route::get('create', [BannerController::class, 'create'])->name('create');
        Route::post('store', [BannerController::class, 'store'])->name('store');
        Route::get('list', [BannerController::class, 'list'])->name('list');
        Route::get('edit/{id}', [BannerController::class, 'edit'])->name('edit');
        Route::post('update/{id}', [BannerController::class, 'update'])->name('update');
        Route::delete('delete/{id}', [BannerController::class, 'destroy'])->name('delete');
    });
    // Product routes
    Route::prefix('product')->name('product.')->group(function () {
        Route::get('create', [ProductController::class, 'create'])->name('create');
        Route::get('index', [ProductController::class, 'index'])->name('index');
        Route::post('store', [ProductController::class, 'store'])->name('store');
        Route::get('edit/{id}', [ProductController::class, 'edit'])->name('edit');
        Route::get('invoice/{id}', [ProductController::class, 'generateInvoicePDF'])->name('invoice');
        Route::post('update/{id}', [ProductController::class, 'update'])->name('update');
        Route::delete('delete/{id}', [ProductController::class, 'destroy'])->name('delete');
    });

    // Category routes
    Route::get('category/create', [CategoryController::class, 'create'])->name('category.create');
    Route::post('category/store', [CategoryController::class, 'store'])->name('category.store');

    // Permission routes
    Route::get('permission/create', [PermissionController::class, 'create'])->name('permission.create');
    Route::post('permission/store', [PermissionController::class, 'store'])->name('permission.store');
    Route::get('permission/list', [PermissionController::class, 'index'])->name('permission.list');
    Route::get('permission/edit/{id}', [PermissionController::class, 'edit'])->name('edit.permission');
    Route::post('permission/update/{id}', [PermissionController::class, 'update'])->name('update.permission');
    Route::delete('permissions/{id}', [PermissionController::class, 'destroy'])->name('permission.destroy');

    // Role routes
    Route::get('role/create', [RoleController::class, 'create'])->name('role.create');
    Route::post('role/store', [RoleController::class, 'store'])->name('role.store');
    Route::get('role/list', [RoleController::class, 'list'])->name('role.list');
    Route::get('role/edit/{id}', [RoleController::class, 'edit'])->name('role.edit');
    Route::post('role/update/{id}', [RoleController::class, 'update'])->name('update.role');
    Route::delete('role/delete/{id}', [RoleController::class, 'destroy'])->name('role.delete');
    Route::get('add/permission/{roleId}', [RoleController::class, 'addPermissionToRole'])->name('add.permission');
    Route::post('give/permission/{roleId}', [RoleController::class, 'givePermissionToRole'])->name('give.permission');

    // User routes
    Route::get('user/create', [UserController::class, 'create'])->name('user.create');
    Route::post('user/store', [UserController::class, 'store'])->name('user.store');
    Route::get('user/list', [UserController::class, 'list'])->name('user.list');
    Route::get('user/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
    Route::post('user/update/{id}', [UserController::class, 'update'])->name('user.update');
    Route::delete('user/delete/{id}', [UserController::class, 'destroy'])->name('user.delete');
    ////Fertilizer route
    Route::prefix('fertilizer')->name('fertilizer.')->group(function () {
        Route::get('create', [FertilizerController::class, 'create'])->name('create');
        Route::get('list', [FertilizerController::class, 'list'])->name('list');
        Route::post('store', [FertilizerController::class, 'store'])->name('store');
        Route::get('edit/{id}', [FertilizerController::class, 'edit'])->name('edit');
        Route::post('update/{id}', [FertilizerController::class, 'update'])->name('update');
        Route::delete('delete/{id}', [FertilizerController::class, 'destroy'])->name('delete');
    });
   ///Tractor Plow
    Route::prefix('plow')->name('plow.')->group(function () {
        Route::get('create', [TractorPlowController::class, 'create'])->name('create');
        Route::get('list', [TractorPlowController::class, 'list'])->name('list');
        Route::post('store', [TractorPlowController::class, 'store'])->name('store');
        Route::get('edit/{id}', [TractorPlowController::class, 'edit'])->name('edit');
        Route::post('update/{id}', [TractorPlowController::class, 'update'])->name('update');
        Route::delete('delete/{id}', [TractorPlowController::class, 'destroy'])->name('delete');
    });

    ///agriculture route
    Route::prefix('agriculture')->name('agriculture.')->group(function () {
        Route::get('create', [AgricultureController::class, 'create'])->name('create');
        Route::get('list', [AgricultureController::class, 'list'])->name('list');
        Route::get('/agriculture/pdf', [AgricultureController::class, 'downloadPDF'])->name('pdf');

        Route::post('store', [AgricultureController::class, 'store'])->name('store');
        Route::get('edit/{id}', [AgricultureController::class, 'edit'])->name('edit');
        Route::post('update/{id}', [AgricultureController::class, 'update'])->name('update');
        Route::delete('delete/{id}', [AgricultureController::class, 'destroy'])->name('delete');
    });
});
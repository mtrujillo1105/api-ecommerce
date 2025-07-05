<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ListClinicController;
use App\Http\Controllers\ShoppingCartController;
use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\AdminCategoriesController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Autenticacion
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);
Route::post('/profile', [AuthController::class, 'profile']);

// Ruta para los usuarios
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');
Route::get('/categories', [CategoriesController::class, 'index'])->name('categories.index');
Route::get('/categories/{id}/products', [CategoriesController::class, 'productsByCategory'])->name('categories.productsByCategory');

Route::middleware(['auth:api', 'api'])->group(function () {
    
    // ShoppingCart
    Route::get('/shoppingcart', [ShoppingCartController::class, 'index'])->name('shoppingcart.index');
    Route::post('/shoppingcart', [ShoppingCartController::class, 'store'])->name('shoppingcart.store');
    Route::put('/shoppingcart', [ShoppingCartController::class, 'update'])->name('shoppingcart.update');
    Route::delete('/shoppingcart', [ShoppingCartController::class, 'destroy'])->name('shoppingcart.destroy');
    Route::delete('/shoppingcart/vaciar', [ShoppingCartController::class, 'empty'])->name('shoppingcart.empty');

    // Orders
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');

});

 
// Rutas para los administradores
Route::prefix('admin')->middleware(['auth:api', 'api'])->group(function() {
    // Productos
    Route::get('/products', [AdminProductController::class, 'index'])->name('admin.products.index');
    Route::post('/products', [AdminProductController::class, 'store'])->name('admin.products.store');
    Route::put('/products/{id}', [AdminProductController::class, 'update'])->name('admin.products.update');
    Route::delete('/products/{id}', [AdminProductController::class, 'destroy'])->name('admin.products.destroy');
    // Categorias
    Route::get('/categories', [AdminCategoriesController::class, 'index'])->name('admin.categories.index');
    Route::post('/categories', [AdminCategoriesController::class, 'store'])->name('admin.categories.store');
    Route::put('/categories/{id}', [AdminCategoriesController::class, 'update'])->name('admin.categories.update');
    Route::delete('/categories/{id}', [AdminCategoriesController::class, 'destroy'])->name('admin.categories.destroy');
    // Pedidos
    Route::get('/orders', [AdminOrderController::class, 'index'])->name('admin.orders.index');
    Route::get('/orders/{id}', [AdminOrderController::class, 'show'])->name('admin.orders.show');
    Route::get('/orders/{id}/state', [AdminOrderController::class, 'changeState'])->name('admin.orders.changestate');
});
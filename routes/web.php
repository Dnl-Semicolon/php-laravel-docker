<?php

use App\Http\Controllers\AdminOrderController;
use App\Http\Controllers\AdminPizzaController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AdminUserManagementController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderHistoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PizzaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/pizzas', [PizzaController::class, 'index'])->name('pizzas.index');

Route::post('/pizzas/{id}/buy', [PizzaController::class, 'buy'])
    ->middleware(['auth', 'verified'])
    ->name('pizzas.buy');

// Cart and Checkout (member only)
Route::middleware(['auth', 'verified'])->group(function () {
    Route::post('/cart/add/{pizza}', [CartController::class, 'addToCart'])->name('cart.add');
    Route::get('/cart', [CartController::class, 'show'])->name('cart.show');
    Route::post('/checkout', [CartController::class, 'checkout'])->name('checkout');
    Route::post('/cart/update/{pizza}', [CartController::class, 'updateQuantity'])->name('cart.update');
    Route::post('/cart/remove/{pizza}', [CartController::class, 'removeItem'])->name('cart.remove');
    Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');
});

// Admin pizza management
Route::middleware(['auth', 'verified', 'is_admin'])->group(function () {
    Route::get('/admin/pizzas/create', [AdminPizzaController::class, 'create'])->name('admin.pizzas.create');
    Route::post('/admin/pizzas/store', [AdminPizzaController::class, 'store'])->name('admin.pizzas.store');
});

// Legacy (Backdoor for members to view all orders *DURING* development )
Route::get('/orders', [OrderController::class, 'index'])->middleware(['auth', 'verified'])->name('orders.index');

// Member order history
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/orders/history', [OrderHistoryController::class, 'index'])->name('orders.history');
});

// Admin order management
Route::middleware(['auth', 'verified', 'is_admin'])->group(function () {
    Route::get('/admin/orders', [AdminOrderController::class, 'index'])->name('admin.orders.index');
    Route::post('/admin/orders/{id}/status', [AdminOrderController::class, 'updateStatus'])->name('admin.orders.updateStatus');
});

Route::middleware(['auth', 'verified', 'is_admin'])->group(function () {
    Route::get('/admin/create', [AdminUserController::class, 'create'])->name('admin.create');
    Route::post('/admin/create', [AdminUserController::class, 'store'])->name('admin.store');
});

Route::get('/404', function () {
    return view('errors/404');
});

Route::middleware(['auth', 'verified', 'is_admin'])->group(function () {
    Route::get('/admin/users', [AdminUserManagementController::class, 'index'])->name('admin.users.index');
});

require __DIR__.'/auth.php';

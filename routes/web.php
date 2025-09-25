<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    ProductController, AuthController, ProfileController, SettingController,
    UserController, ReportController, HomeController, CheckoutController,
    CategoryController, PromoController, OrderController, CartController,
    WishlistController, NotificationController
};

// =======================
// AUTH
// =======================
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// =======================
// HOME & CUSTOMER
// =======================
Route::get('/', [HomeController::class, 'index'])->name('home');

// Produk customer (lihat & detail)
Route::resource('products', ProductController::class)->only(['index', 'show']);

// =======================
// CHECKOUT (gabungan single & cart)
// =======================
Route::middleware('auth')->group(function () {
    // Checkout 1 produk
    Route::get('/checkout/product/{product}', [CheckoutController::class, 'index'])
        ->name('checkout.product');

    // Checkout keranjang
    Route::get('/checkout', [CheckoutController::class, 'index'])
        ->name('checkout.index');

    // Proses checkout
    Route::post('/checkout/process', [CheckoutController::class, 'process'])
        ->name('checkout.process');
});

// =======================
// CUSTOMER ORDERS
// =======================
Route::middleware('auth')->group(function () {
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::post('/orders/{order}/confirm-payment', [OrderController::class, 'confirmPayment'])
        ->name('orders.confirmPayment');
});

// =======================
// ADMIN
// =======================
Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', fn () => view('admin.dashboard'))->name('admin.dashboard');

    // Orders
    Route::get('/orders', [OrderController::class, 'adminIndex'])->name('admin.orders.index');
    Route::get('/orders/{order}', [OrderController::class, 'adminShow'])->name('admin.orders.show');
    Route::put('/orders/{order}', [OrderController::class, 'update'])->name('admin.orders.update');
    Route::delete('/orders/{order}', [OrderController::class, 'destroy'])->name('admin.orders.destroy');

    // Update ongkir & status
    Route::post('/orders/{order}/shipping', [OrderController::class, 'updateShipping'])->name('admin.orders.updateShipping');
    Route::post('/orders/{order}/status', [OrderController::class, 'updateStatus'])->name('admin.orders.updateStatus');

    // Produk (CRUD admin)
    Route::get('/products/list', [ProductController::class, 'adminIndex'])->name('products.adminIndex');
    Route::resource('products', ProductController::class)->except(['index', 'show']);

    // Lainnya
    Route::resource('categories', CategoryController::class);
    Route::resource('promos', PromoController::class);
    Route::resource('users', UserController::class);

    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');

    // Notifikasi admin
    Route::get('/notifications', [App\Http\Controllers\Admin\NotificationController::class, 'index'])
        ->name('admin.notifications.index');
    Route::post('/notifications/read/{id}', [App\Http\Controllers\Admin\NotificationController::class, 'read'])
        ->name('admin.notifications.read');
    Route::post('/notifications/read-all', [App\Http\Controllers\Admin\NotificationController::class, 'readAll'])
        ->name('admin.notifications.readAll');
});

// =======================
// PROFILE
// =======================
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

// =======================
// PROMO (umum)
// =======================
Route::resource('promos', PromoController::class);

// =======================
// CART & WISHLIST
// =======================
Route::middleware('auth')->group(function () {
    Route::resource('cart', CartController::class);
    Route::resource('wishlist', WishlistController::class);
    Route::get('/notifications/read-and-go/{id}', [App\Http\Controllers\Admin\NotificationController::class, 'readAndGo'])
    ->name('admin.notifications.readAndGo');
});


// =======================
// NOTIFICATIONS CUSTOMER
// =======================
Route::middleware('auth')->group(function () {
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/read/{id}', [NotificationController::class, 'read'])->name('notifications.read');
    Route::post('/notifications/read-all', [NotificationController::class, 'readAll'])->name('notifications.readAll');
    Route::get('/notifications/read-and-go/{id}', [NotificationController::class, 'readAndGo'])
        ->name('notifications.readAndGo');
});

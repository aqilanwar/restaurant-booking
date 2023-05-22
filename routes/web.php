<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{CategoryController,FoodController, OrderController, HomeController};

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

Route::get('/', [HomeController::class , 'HomePage']);
Route::get('/home', [HomeController::class , 'RedirectOnRole'])->name('home');


Route::middleware(['user'])->group(function () {

    Route::post('/user/check-booking', [OrderController::class, 'CheckBooking'])->name('check.booking');
    Route::post('/user/cancel-booking', [OrderController::class, 'CancelBooking'])->name('cancel.booking');
    Route::get('/user/booking', [OrderController::class , 'DisplayBooking'])->name('booking');
    Route::get('/user/cart', [OrderController::class , 'DisplayCart'])->name('cart');

    Route::post('/user/cart/add', [OrderController::class , 'AddCart'])->name('add.cart');
    Route::post('/user/cart/decrease', [OrderController::class , 'DecreaseCart'])->name('decrease.cart');

    Route::get('/user/checkout', [OrderController::class , 'Checkout'])->name('checkout');
    Route::post('/user/upload-receipt', [OrderController::class , 'UploadReceipt'])->name('upload.receipt');
    Route::post('/user/update-receipt', [OrderController::class , 'UpdateReceipt'])->name('update.receipt');
    Route::get('/user/checkout/success', [OrderController::class , 'RedirectPayment'])->name('redirect');
    Route::get('/user/reservation', [OrderController::class , 'ReservationDetail'])->name('reservation');
    Route::post('/user/review', [OrderController::class , 'Review'])->name('review');
    Route::get('/menu', [FoodController::class, 'UserView'])->name('menu');


});

Route::middleware(['admin'])->group(function () {
    //Remove this later
    Route::get('/dashboard' , [HomeController::class, 'AdminReservation'])->name('dashboard');
    Route::get('/admin/reservation' , [OrderController::class, 'AdminReservation'])->name('admin.reservation');
    Route::get('/orders/{id}/status', [OrderController::class, 'UpdateStatus'])->name('orders.update_status');

    Route::get('/admin/category', [CategoryController::class, 'index'])->name('category');
    Route::post('/admin/category/create', [CategoryController::class, 'store'])->name('category.create');
    Route::post('/admin/category/edit', [CategoryController::class, 'edit'])->name('category.edit');
    Route::post('/admin/category/destroy', [CategoryController::class, 'destroy'])->name('category.destroy');

    Route::get('/admin/food', [FoodController::class, 'index'])->name('food');
    Route::post('/admin/food/create', [FoodController::class, 'store'])->name('food.create');
    Route::post('/admin/food/edit', [FoodController::class, 'edit'])->name('food.edit');
    Route::get('/admin/food/destroy/{id}', [FoodController::class, 'destroy'])->name('food.destroy');
    Route::get('/admin/category/destroy/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');
    Route::post('/admin/category/edit', [CategoryController::class, 'edit'])->name('category.edit');

});

// Route::get('/admin/reservation' , [OrderController::class, 'AdminReservation'])->name('dashboard');
// Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified', 'admin'])->group(function () {
//     Route::get('/admin/reservation', function () {
//         return view('dashboard');
//     })->name('dashboard');
    
// });

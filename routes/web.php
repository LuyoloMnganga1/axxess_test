<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\CostomerController;
use App\Http\Controllers\PaymentsController;
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

//********************** AUTHETICATION ROUTES ******************//
    Route::get('/',[LoginController::class,'index']);
    Route::post('/login',[LoginController::class,'login'])->name('login');
    Route::get('/forgot-password',[ForgotPasswordController::class,'index'])->name('forgot_password');
    Route::post('/forgot-password-link',[ForgotPasswordController::class,'forgotpassword'])->name('forgot_password_link');
    Route::get('/reset-password/{id}/{token}', [ResetPasswordController::class,'verifylink'])->name('reset_assword');
    Route::post('/update-password',  [ResetPasswordController::class,'updatepassword'])->name('update_password');     
    Route::get('/logout',[LoginController::class,'logout'])->name('logout');
//**********************END OF  AUTHETICATION ROUTES ******************//
Route::group(['middleware' => ['auth']], function () {
    //********************** DASHBOARD ROUTES ******************//
    Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard');
    Route::get('/user-profile',[DashboardController::class,'profile'])->name('user_profile');
    Route::post('/user-profile-update',[DashboardController::class,'updateprofile'])->name('update_profile');
     //**********************END OF DASHBOARD ROUTES ******************//

     //********************** INVOICES ROUTES ******************//
    Route::view('/customers', 'customers.index');
    Route::get('/get-customers',[CostomerController::class,'index'])->name('getcustomers');
    Route::post('/add-customer',[CostomerController::class,'store'])->name('add_customer');
    Route::post('/update-customer',[CostomerController::class,'update'])->name('update_customer');
    Route::get('/delete-customer/{id}',[CostomerController::class,'delete'])->name('delete_customer');
    Route::get('/find-customer/{username}',[CostomerController::class,'findcustomer'])->name('find_customer');
    Route::get('/all-customers',[CostomerController::class,'allcustomers'])->name('all_customers');
      //**********************END OF INVOICES ROUTES ******************//

     //********************** INVOICES ROUTES ******************//
    Route::view('/invoices_payments', 'invoices.index');
    Route::get('/get-invoices',[InvoiceController::class,'index'])->name('getinvoices');
    Route::post('/add-invoice',[InvoiceController::class,'store'])->name('add_invoice');
    Route::get('/view-invoice/{id}',[InvoiceController::class,'show'])->name('view_invoice');
      //**********************END OF INVOICES ROUTES ******************//

      //********************** PAYMENTS ROUTES ******************//
    Route::get('/get-payments',[PaymentsController::class,'index'])->name('getpayments');
    Route::post('/make-payment',[PaymentsController::class,'payment'])->name('make_payment');
      //**********************END OF PAYMENTS ROUTES ******************//

});

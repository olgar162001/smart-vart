<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\smsController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PurchaseController;
use App\Http\Middleware\EnsureStatusIsActive;
use App\Http\Middleware\CheckCompanyNoAllowed;
use App\Http\Middleware\RedirectIfAlreadyPaid;
use App\Http\Middleware\EnsurePackageIsSelected;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\MonthlyExportController;
use App\Http\Controllers\PurchasesExportController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;


Auth::routes();

Route::get('/yana/register' ,[RegisterController::class, 'showRegistrationForm']);

// Email verification
Route::get('/email/verify', function () {
    return view('auth.verify');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
 
    return redirect('/dashboard');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
 
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');


// Pages routes
Route::get('/', [PagesController::class, 'landing']);
Route::get('/verify_user_email/{user}', [ProfileController::class, 'verify_user_email']);
Route::get('/emailme', [EmailController::class, 'send']);
Route::get('dashboard', [PagesController::class, 'dashboard'])->middleware(['auth', 'verified', EnsureStatusIsActive::class, EnsurePackageIsSelected::class]);
Route::get('monthly-analysis', [PagesController::class, 'analysis'])->middleware([EnsureStatusIsActive::class, EnsurePackageIsSelected::class, 'verified']);

Route::get('/purchase/export', [PurchasesExportController::class, 'export'])->middleware([EnsureStatusIsActive::class, EnsurePackageIsSelected::class, 'verified']);
Route::post('/monthly-analysis/export', [MonthlyExportController::class, 'export'])->middleware([EnsureStatusIsActive::class, EnsurePackageIsSelected::class, 'verified']);

Route::get('company/change/{companyId}',[CompanyController::class, 'changeCompany']);
Route::get('/packages', [PagesController::class, 'packages'])->middleware([RedirectIfAlreadyPaid::class, 'verified']);
Route::put('/packages/{id}', [PagesController::class, 'update']);
Route::get('/payment', [PagesController::class, 'payment_complete'])->middleware([RedirectIfAlreadyPaid::class, EnsurePackageIsSelected::class, 'verified']);
Route::get('/receipt/{receipt_id}/mail', [PagesController::class, 'send_receipt']);
Route::get('/invoice/{invoice_id}/mail', [PagesController::class, 'send_invoice']);
Route::get('verify-payment', [PagesController::class, 'verify'])->middleware([RedirectIfAlreadyPaid::class, EnsurePackageIsSelected::class, 'verified']);

// Resource routes
Route::resource('company', CompanyController::class)->middleware([EnsureStatusIsActive::class, EnsurePackageIsSelected::class, 'verified']);
Route::resource('purchase',PurchaseController::class)->middleware([EnsureStatusIsActive::class, EnsurePackageIsSelected::class, 'verified']);
Route::resource('sales', SalesController::class)->middleware([EnsureStatusIsActive::class, EnsurePackageIsSelected::class, 'verified']);
Route::resource('profile', ProfileController::class)->middleware(['auth', EnsureStatusIsActive::class, EnsurePackageIsSelected::class, 'verified']);

// Route::get('/users/export', [UsersExportController::class, 'export']);
Route::get('/smsmeplz', [smsController::class, 'send_sms']);
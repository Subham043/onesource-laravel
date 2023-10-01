<?php

use App\Modules\Authentication\Controllers\ForgotPasswordController;
use App\Modules\Authentication\Controllers\LoginController;
use App\Modules\Authentication\Controllers\LogoutController;
use App\Modules\Authentication\Controllers\ProfileEditController;
use App\Modules\Authentication\Controllers\ProfileViewController;
use App\Modules\Authentication\Controllers\RegisterController;
use App\Modules\Authentication\Controllers\ResetPasswordController;
use App\Modules\Authentication\Controllers\VerifyRegisteredUserController;
use App\Modules\Calendar\Controllers\CalendarViewController;
use App\Modules\Customer\Controllers\CustomerPaginateController;
use App\Modules\Customer\Controllers\CustomerPasswordResetLinkController;
use App\Modules\Customer\Controllers\CustomerStatusController;
use App\Modules\Customer\Controllers\CustomerUpdateController;
use App\Modules\Customer\Controllers\CustomerViewController;
use App\Modules\Dashboard\Controllers\DashboardController;
use App\Modules\Document\Controllers\DocumentCreateController;
use App\Modules\Document\Controllers\DocumentPaginateController;
use App\Modules\Event\Controllers\EventCreateController;
use App\Modules\Event\Controllers\EventPaginateController;
use App\Modules\Event\Controllers\EventUpdateController;
use App\Modules\Event\Controllers\EventViewController;
use App\Modules\Event\Event\Controllers\EventDeleteController;
use App\Modules\Report\Conflict\Controllers\ConflictViewController;
use App\Modules\Report\Controllers\ReportViewController;
use App\Modules\Report\Export\Controllers\ExportViewController;
use App\Modules\Report\Quickbook\Controllers\QuickbookViewController;
use App\Modules\User\Controllers\UserCreateController;
use App\Modules\User\Controllers\UserDeleteController;
use App\Modules\User\Controllers\UserPaginateController;
use App\Modules\User\Controllers\UserUpdateController;
use Illuminate\Support\Facades\Route;

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

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [LoginController::class, 'get', 'as' => 'login.get'])->name('login.get');
    Route::post('/authenticate', [LoginController::class, 'post', 'as' => 'login.post'])->name('login.post');
    Route::get('/register', [RegisterController::class, 'get', 'as' => 'register.get'])->name('register.get');
    Route::post('/register', [RegisterController::class, 'post', 'as' => 'register.post'])->name('register.post');
    Route::get('/forgot-password', [ForgotPasswordController::class, 'get', 'as' => 'forgot_password.get'])->name('forgot_password.get');
    Route::post('/forgot-password', [ForgotPasswordController::class, 'post', 'as' => 'forgot_password.post'])->name('forgot_password.post');
    Route::get('/reset-password/{token}', [ResetPasswordController::class, 'get', 'as' => 'reset_password.get'])->name('reset_password.get')->middleware('signed');
    Route::post('/reset-password/{token}', [ResetPasswordController::class, 'post', 'as' => 'reset_password.post'])->name('reset_password.post')->middleware('signed');
});

Route::get('/logout', [LogoutController::class, 'get', 'as' => 'logout.get'])->middleware(['auth'])->name('logout.get');

Route::prefix('/email/verify')->middleware(['auth'])->group(function () {
    Route::get('/', [VerifyRegisteredUserController::class, 'index', 'as' => 'index'])->name('verification.notice');
    Route::post('/resend-notification', [VerifyRegisteredUserController::class, 'resend_notification', 'as' => 'resend_notification'])->middleware(['throttle:6,1'])->name('verification.send');
    Route::get('/{id}/{hash}', [VerifyRegisteredUserController::class, 'verify_email', 'as' => 'verify_email'])->middleware(['signed'])->name('verification.verify');
});

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/', [DashboardController::class, 'get', 'as' => 'dashboard.get'])->name('dashboard.get');

    Route::prefix('/profile')->group(function () {
        Route::get('/view', [ProfileViewController::class, 'get', 'as' => 'profile.view.get'])->name('profile.view.get');
        Route::get('/edit', [ProfileEditController::class, 'get', 'as' => 'profile.edit.get'])->name('profile.edit.get');
        Route::post('/edit', [ProfileEditController::class, 'post', 'as' => 'profile.edit.post'])->name('profile.edit.post');
    });

    Route::prefix('/customer')->group(function () {
        Route::get('/', [CustomerPaginateController::class, 'get', 'as' => 'customer.paginate.get'])->name('customer.paginate.get');
        Route::get('/update/{id}', [CustomerUpdateController::class, 'get', 'as' => 'customer.update.get'])->name('customer.update.get');
        Route::post('/update/{id}', [CustomerUpdateController::class, 'post', 'as' => 'customer.update.get'])->name('customer.update.post');
        Route::get('/view/{id}', [CustomerViewController::class, 'get', 'as' => 'customer.view.get'])->name('customer.view.get');
        Route::get('/reset-password-link/{id}', [CustomerPasswordResetLinkController::class, 'get', 'as' => 'customer.reset_password.get'])->name('customer.reset_password.get');
        Route::get('/status/{id}', [CustomerStatusController::class, 'get', 'as' => 'customer.status.get'])->name('customer.status.get');
    });

    Route::prefix('/user')->group(function () {
        Route::get('/', [UserPaginateController::class, 'get', 'as' => 'user.paginate.get'])->name('user.paginate.get');
        Route::get('/create', [UserCreateController::class, 'get', 'as' => 'user.create.get'])->name('user.create.get');
        Route::post('/create', [UserCreateController::class, 'post', 'as' => 'user.create.get'])->name('user.create.post');
        Route::get('/update/{id}', [UserUpdateController::class, 'get', 'as' => 'user.update.get'])->name('user.update.get');
        Route::post('/update/{id}', [UserUpdateController::class, 'post', 'as' => 'user.update.get'])->name('user.update.post');
        Route::get('/view/{id}', [UserViewController::class, 'get', 'as' => 'user.view.get'])->name('user.view.get');
        Route::get('/delete/{id}', [UserDeleteController::class, 'get', 'as' => 'user.delete.get'])->name('user.delete.get');
    });

    Route::prefix('/event')->group(function () {
        Route::get('/', [EventPaginateController::class, 'get', 'as' => 'event.paginate.get'])->name('event.paginate.get');
        Route::get('/create', [EventCreateController::class, 'get', 'as' => 'event.create.get'])->name('event.create.get');
        Route::post('/create', [EventCreateController::class, 'post', 'as' => 'event.create.get'])->name('event.create.post');
        Route::get('/update/{id}', [EventUpdateController::class, 'get', 'as' => 'event.update.get'])->name('event.update.get');
        Route::post('/update/{id}', [EventUpdateController::class, 'post', 'as' => 'event.update.get'])->name('event.update.post');
        Route::get('/view/{id}', [EventViewController::class, 'get', 'as' => 'event.view.get'])->name('event.view.get');
        Route::get('/delete/{id}', [EventDeleteController::class, 'get', 'as' => 'event.delete.get'])->name('event.delete.get');
    });

    Route::prefix('/document')->group(function () {
        Route::get('/', [DocumentPaginateController::class, 'get', 'as' => 'document.paginate.get'])->name('document.paginate.get');
        Route::get('/create', [DocumentCreateController::class, 'get', 'as' => 'document.create.get'])->name('document.create.get');
        Route::post('/create', [DocumentCreateController::class, 'post', 'as' => 'document.create.get'])->name('document.create.post');
        Route::get('/delete/{id}', [DocumentDeleteController::class, 'get', 'as' => 'document.delete.get'])->name('document.delete.get');
    });

    Route::prefix('/calendar')->group(function () {
        Route::get('/', [CalendarViewController::class, 'get', 'as' => 'calendar.view.get'])->name('calendar.view.get');
    });

    Route::prefix('/report')->group(function () {
        Route::get('/', [ReportViewController::class, 'get', 'as' => 'report.view.get'])->name('report.view.get');
        Route::get('/conflict', [ConflictViewController::class, 'get', 'as' => 'report.conflict.view.get'])->name('report.conflict.view.get');
        Route::get('/export', [ExportViewController::class, 'get', 'as' => 'report.export.view.get'])->name('report.export.view.get');
        Route::get('/quickbook', [QuickbookViewController::class, 'get', 'as' => 'report.quickbook.view.get'])->name('report.quickbook.view.get');
    });

});



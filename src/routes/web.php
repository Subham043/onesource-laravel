<?php

use App\Modules\Authentication\Controllers\ForgotPasswordController;
use App\Modules\Authentication\Controllers\LoginController;
use App\Modules\Authentication\Controllers\PasswordUpdateController;
use App\Modules\Authentication\Controllers\ProfileController;
use App\Modules\Authentication\Controllers\RegisterController;
use App\Modules\Authentication\Controllers\ResetPasswordController;
use App\Modules\Calendar\Controllers\CalendarViewController;
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
    Route::get('/register', [RegisterController::class, 'get', 'as' => 'login.get'])->name('login.get');
    Route::get('/forgot-password', [ForgotPasswordController::class, 'get', 'as' => 'forgot_password.get'])->name('forgot_password.get');
    Route::post('/forgot-password', [ForgotPasswordController::class, 'post', 'as' => 'forgot_password.post'])->name('forgot_password.post');
    Route::get('/reset-password/{token}', [ResetPasswordController::class, 'get', 'as' => 'reset_password.get'])->name('reset_password.get')->middleware('signed');
    Route::post('/reset-password/{token}', [ResetPasswordController::class, 'post', 'as' => 'reset_password.post'])->name('reset_password.post')->middleware('signed');
});

Route::middleware(['auth'])->group(function () {});


Route::get('/', [DashboardController::class, 'get', 'as' => 'dashboard.get'])->name('dashboard.get');

Route::prefix('/profile')->group(function () {
    Route::get('/', [ProfileController::class, 'get', 'as' => 'profile.get'])->name('profile.get');
    Route::post('/update', [ProfileController::class, 'post', 'as' => 'profile.post'])->name('profile.post');
    Route::post('/profile-password-update', [PasswordUpdateController::class, 'post', 'as' => 'password.post'])->name('password.post');
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

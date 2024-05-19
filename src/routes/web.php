<?php

use App\Modules\Authentication\Controllers\ForgotPasswordController;
use App\Modules\Authentication\Controllers\LoginController;
use App\Modules\Authentication\Controllers\LogoutController;
use App\Modules\Authentication\Controllers\ProfileEditController;
use App\Modules\Authentication\Controllers\ProfileViewController;
use App\Modules\Authentication\Controllers\RegisterController;
use App\Modules\Authentication\Controllers\ResetPasswordController;
use App\Modules\Authentication\Controllers\VerifyRegisteredUserController;
use App\Modules\Calendar\Controllers\CalendarPrintController;
use App\Modules\Calendar\Controllers\CalendarViewController;
use App\Modules\Client\Controllers\ClientCreateController;
use App\Modules\Client\Controllers\ClientDeleteController;
use App\Modules\Client\Controllers\ClientPaginateController;
use App\Modules\Client\Controllers\ClientUpdateController;
use App\Modules\Client\Controllers\ClientViewController;
use App\Modules\Customer\Controllers\CustomerPaginateController;
use App\Modules\Customer\Controllers\CustomerPasswordResetLinkController;
use App\Modules\Customer\Controllers\CustomerStatusController;
use App\Modules\Customer\Controllers\CustomerUpdateController;
use App\Modules\Customer\Controllers\CustomerViewController;
use App\Modules\Dashboard\Controllers\DashboardController;
use App\Modules\Dashboard\Controllers\DashboardPrintController;
use App\Modules\Document\Controllers\DocumentCreateController;
use App\Modules\Document\Controllers\DocumentDeleteController;
use App\Modules\Document\Controllers\DocumentDeleteMultipleController;
use App\Modules\Document\Controllers\DocumentPaginateController;
use App\Modules\Event\Controllers\EventCreateController;
use App\Modules\Event\Controllers\EventPaginateController;
use App\Modules\Event\Controllers\EventCancelUpdateController;
use App\Modules\Event\Controllers\EventSingleCancelController;
use App\Modules\Event\Controllers\EventSinglePrepController;
use App\Modules\Event\Controllers\EventUpdateController;
use App\Modules\Event\Controllers\EventViewController;
use App\Modules\Event\Controllers\EventWriterDeleteController;
use App\Modules\Event\Controllers\EventDeleteController;
use App\Modules\Event\Controllers\EventPrintController;
use App\Modules\Notification\Controllers\NotificationCreateController;
use App\Modules\Notification\Controllers\NotificationDeleteController;
use App\Modules\Notification\Controllers\NotificationLogController;
use App\Modules\Notification\Controllers\NotificationPaginateController;
use App\Modules\Notification\Controllers\NotificationSendController;
use App\Modules\Notification\Controllers\NotificationTemplateController;
use App\Modules\Notification\Controllers\NotificationUpdateController;
use App\Modules\Report\Conflict\Controllers\ConflictPrintController;
use App\Modules\Report\Conflict\Controllers\ConflictViewController;
use App\Modules\Report\Controllers\ReportViewController;
use App\Modules\Report\Export\Controllers\ExportExcelController;
use App\Modules\Report\Export\Controllers\ExportPrintController;
use App\Modules\Report\Export\Controllers\ExportViewController;
use App\Modules\Report\Quickbook\Controllers\QuickbookPrintController;
use App\Modules\Report\Quickbook\Controllers\QuickbookViewController;
use App\Modules\Seacrh\Controllers\SeacrhViewController;
use App\Modules\Search\Controllers\SearchViewController;
use App\Modules\Tool\Controllers\ToolCreateController;
use App\Modules\Tool\Controllers\ToolDeleteController;
use App\Modules\Tool\Controllers\ToolPaginateController;
use App\Modules\Tool\Controllers\ToolUpdateController;
use App\Modules\Tool\Controllers\ToolViewController;
use App\Modules\User\Controllers\UserCreateController;
use App\Modules\User\Controllers\UserDeleteController;
use App\Modules\User\Controllers\UserMergeController;
use App\Modules\User\Controllers\UserPaginateController;
use App\Modules\User\Controllers\UserStatusController;
use App\Modules\User\Controllers\UserUpdateController;
use App\Modules\User\Controllers\UserViewController;
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
    Route::get('/reset-password/{token}', [ResetPasswordController::class, 'get', 'as' => 'reset_password.get'])->name('reset_password.get');
    Route::post('/reset-password/{token}', [ResetPasswordController::class, 'post', 'as' => 'reset_password.post'])->name('reset_password.post');
});

Route::get('/logout', [LogoutController::class, 'get', 'as' => 'logout.get'])->middleware(['auth'])->name('logout.get');

Route::prefix('/email/verify')->middleware(['auth'])->group(function () {
    Route::get('/', [VerifyRegisteredUserController::class, 'index', 'as' => 'index'])->name('verification.notice');
    Route::post('/resend-notification', [VerifyRegisteredUserController::class, 'resend_notification', 'as' => 'resend_notification'])->middleware(['throttle:6,1'])->name('verification.send');
    Route::get('/{id}/{hash}', [VerifyRegisteredUserController::class, 'verify_email', 'as' => 'verify_email'])->middleware(['signed'])->name('verification.verify');
});

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/', [DashboardController::class, 'get', 'as' => 'dashboard.get'])->name('dashboard.get');
    Route::get('/dashboard-print', [DashboardPrintController::class, 'get', 'as' => 'dashboard_print.get'])->name('dashboard_print.get');

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
        Route::post('/merge/{id}', [UserMergeController::class, 'post', 'as' => 'user.merge.get'])->name('user.merge.post');
        Route::get('/view/{id}', [UserViewController::class, 'get', 'as' => 'user.view.get'])->name('user.view.get');
        Route::get('/delete/{id}', [UserDeleteController::class, 'get', 'as' => 'user.delete.get'])->name('user.delete.get');
        Route::get('/status/{id}', [UserStatusController::class, 'get', 'as' => 'user.status.get'])->name('user.status.get');
    });

    Route::prefix('/tool')->group(function () {
        Route::get('/', [ToolPaginateController::class, 'get', 'as' => 'tool.paginate.get'])->name('tool.paginate.get');
        Route::get('/create', [ToolCreateController::class, 'get', 'as' => 'tool.create.get'])->name('tool.create.get');
        Route::post('/create', [ToolCreateController::class, 'post', 'as' => 'tool.create.get'])->name('tool.create.post');
        Route::get('/update/{id}', [ToolUpdateController::class, 'get', 'as' => 'tool.update.get'])->name('tool.update.get');
        Route::post('/update/{id}', [ToolUpdateController::class, 'post', 'as' => 'tool.update.get'])->name('tool.update.post');
        Route::get('/view/{id}', [ToolViewController::class, 'get', 'as' => 'tool.view.get'])->name('tool.view.get');
        Route::get('/delete/{id}', [ToolDeleteController::class, 'get', 'as' => 'tool.delete.get'])->name('tool.delete.get');
    });

    Route::prefix('/client')->group(function () {
        Route::get('/', [ClientPaginateController::class, 'get', 'as' => 'client.paginate.get'])->name('client.paginate.get');
        Route::get('/create', [ClientCreateController::class, 'get', 'as' => 'client.create.get'])->name('client.create.get');
        Route::post('/create', [ClientCreateController::class, 'post', 'as' => 'client.create.get'])->name('client.create.post');
        Route::get('/update/{id}', [ClientUpdateController::class, 'get', 'as' => 'client.update.get'])->name('client.update.get');
        Route::post('/update/{id}', [ClientUpdateController::class, 'post', 'as' => 'client.update.get'])->name('client.update.post');
        Route::get('/view/{id}', [ClientViewController::class, 'get', 'as' => 'client.view.get'])->name('client.view.get');
        Route::get('/delete/{id}', [ClientDeleteController::class, 'get', 'as' => 'client.delete.get'])->name('client.delete.get');
    });

    Route::prefix('/search')->group(function () {
        Route::get('/', [SearchViewController::class, 'get', 'as' => 'search.paginate.get'])->name('search.paginate.get');
    });

    Route::prefix('/event')->group(function () {
        Route::get('/', [EventPaginateController::class, 'get', 'as' => 'event.paginate.get'])->name('event.paginate.get');
        Route::get('/create', [EventCreateController::class, 'get', 'as' => 'event.create.get'])->name('event.create.get');
        Route::post('/create', [EventCreateController::class, 'post', 'as' => 'event.create.post'])->name('event.create.post');
        Route::get('/update/{id}', [EventUpdateController::class, 'get', 'as' => 'event.update.get'])->name('event.update.get');
        Route::post('/update/{id}', [EventUpdateController::class, 'post', 'as' => 'event.update.get'])->name('event.update.post');
        Route::get('/view/{id}', [EventViewController::class, 'get', 'as' => 'event.view.get'])->name('event.view.get');
        Route::get('/notify/{id}', [EventViewController::class, 'notify', 'as' => 'event.notify.get'])->name('event.notify.get');
        Route::get('/delete/{id}', [EventDeleteController::class, 'get', 'as' => 'event.delete.get'])->name('event.delete.get');
        Route::get('/delete-writer/{id}', [EventWriterDeleteController::class, 'get', 'as' => 'event.delete_writer.get'])->name('event.delete_writer.get');
        Route::get('/status/{id}', [EventSingleCancelController::class, 'get', 'as' => 'event.status.get'])->name('event.status.get');
        Route::get('/prep/{id}', [EventSinglePrepController::class, 'get', 'as' => 'event.prep.get'])->name('event.prep.get');
        Route::post('/status-update', [EventCancelUpdateController::class, 'post', 'as' => 'event.status.post'])->name('event.status.post');
        Route::get('/print', [EventPrintController::class, 'get', 'as' => 'event.print.get'])->name('event.print.get');
    });

    Route::prefix('/document')->group(function () {
        Route::get('/', [DocumentPaginateController::class, 'get', 'as' => 'document.paginate.get'])->name('document.paginate.get');
        Route::get('/create', [DocumentCreateController::class, 'get', 'as' => 'document.create.get'])->name('document.create.get');
        Route::post('/create', [DocumentCreateController::class, 'post', 'as' => 'document.create.get'])->name('document.create.post');
        Route::get('/delete/{id}', [DocumentDeleteController::class, 'get', 'as' => 'document.delete.get'])->name('document.delete.get');
        Route::post('/delete-multiple', [DocumentDeleteMultipleController::class, 'post', 'as' => 'document.delete.post'])->name('document.delete.post');
    });

    Route::prefix('/calendar')->group(function () {
        Route::get('/', [CalendarViewController::class, 'get', 'as' => 'calendar.view.get'])->name('calendar.view.get');
        Route::get('/print', [CalendarPrintController::class, 'get', 'as' => 'calendar.print.get'])->name('calendar.print.get');
    });

    Route::prefix('/report')->group(function () {
        Route::get('/', [ReportViewController::class, 'get', 'as' => 'report.view.get'])->name('report.view.get');
        Route::get('/conflict', [ConflictViewController::class, 'get', 'as' => 'report.conflict.view.get'])->name('report.conflict.view.get');
        Route::get('/conflict-print', [ConflictPrintController::class, 'get', 'as' => 'report.conflict.print.get'])->name('report.conflict.print.get');
        Route::get('/export', [ExportViewController::class, 'get', 'as' => 'report.export.view.get'])->name('report.export.view.get');
        Route::get('/export-excel', [ExportExcelController::class, 'get', 'as' => 'report.export.excel.get'])->name('report.export.excel.get');
        Route::get('/export-print', [ExportPrintController::class, 'get', 'as' => 'report.export.print.get'])->name('report.export.print.get');
        Route::get('/quickbook', [QuickbookViewController::class, 'get', 'as' => 'report.quickbook.view.get'])->name('report.quickbook.view.get');
        Route::get('/quickbook-excel', [QuickbookViewController::class, 'excel', 'as' => 'report.quickbook.excel.get'])->name('report.quickbook.excel.get');
        Route::get('/quickbook-print', [QuickbookPrintController::class, 'get', 'as' => 'report.quickbook.print.get'])->name('report.quickbook.print.get');
    });

    Route::prefix('/notification')->group(function () {
        Route::get('/', [NotificationSendController::class, 'get', 'as' => 'notification.send.get'])->name('notification.send.get');
        Route::post('/', [NotificationSendController::class, 'posevent.update.gett', 'as' => 'notification.send.post'])->name('notification.send.post');
        Route::prefix('/template')->group(function () {
            Route::get('/', [NotificationTemplateController::class, 'get', 'as' => 'notification.template.get'])->name('notification.template.get');
            Route::post('/', [NotificationTemplateController::class, 'post', 'as' => 'notification.template.post'])->name('notification.template.post');
        });
        Route::prefix('/log')->group(function () {
            Route::get('/', [NotificationLogController::class, 'get', 'as' => 'notification.log.get'])->name('notification.log.get');
        });
        Route::prefix('/setting')->group(function () {
            Route::get('/', [NotificationPaginateController::class, 'get', 'as' => 'notification.paginate.get'])->name('notification.paginate.get');
            Route::get('/create', [NotificationCreateController::class, 'get', 'as' => 'notification.create.get'])->name('notification.create.get');
            Route::post('/create', [NotificationCreateController::class, 'post', 'as' => 'notification.create.post'])->name('notification.create.post');
            Route::get('/update/{id}', [NotificationUpdateController::class, 'get', 'as' => 'notification.update.get'])->name('notification.update.get');
            Route::post('/update/{id}', [NotificationUpdateController::class, 'post', 'as' => 'notification.update.get'])->name('notification.update.post');
            Route::get('/delete/{id}', [NotificationDeleteController::class, 'get', 'as' => 'notification.delete.get'])->name('notification.delete.get');
        });
    });

});
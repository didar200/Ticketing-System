<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\PopController;
use App\Http\Controllers\SmtpConfigurationController;
use App\Http\Controllers\NotificationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/clear-cache', function() {

    $configCache = Artisan::call('config:cache');
    $clearCache = Artisan::call('cache:clear');
    return redirect()->route('login');
});

Route::middleware('AlreadyLoginCheck')->group(function(){
	Route::get('/', [LoginController::class, 'login'])->name('login');
	Route::post('/', [LoginController::class, 'loginProcess']);

	Route::get('/forgotPassword', [LoginController::class, 'forgotPassword'])->name('forgotPassword');
	Route::post('/forgotPassword', [LoginController::class, 'forgotPasswordProcess']);

	Route::get('/resetPassword/{token}', [LoginController::class, 'resetPassword'])->name('resetPassword');
	Route::get('/resetPassword', [LoginController::class, 'forgotPassword']);
	Route::post('/resetPassword', [LoginController::class, 'resetPasswordProcess'])->name('resetPasswordProcess');
});

Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware('AuthCheck')->group(function(){

	Route::middleware('AdminUserCheck')->group(function(){

		Route::get('/userRegister', [UserController::class, 'register'])->name('user.register');
		Route::post('/userRegister', [UserController::class, 'registerProcess']);

		Route::get('/userList', [UserController::class, 'userList'])->name('user.list');
		Route::get('/searchUserListByGroup', [UserController::class, 'searchUserListByGroup'])->name('searchUserListByGroup');

		Route::get('/userUpdate', [UserController::class, 'userUpdate'])->name('user.update');
		Route::put('/userUpdateProcess', [UserController::class, 'userUpdateProcess'])->name('user.UpdateProcess');

		// Route::get('/userDelete/{id}', [UserController::class, 'userDelete'])->name('user.delete');
		// Route::delete('/userDeleteProcess', [UserController::class, 'userDeleteProcess'])->name('user.DeleteProcess');

		Route::get('/groupCreate', [GroupController::class, 'groupCreate'])->name('group.create');
		Route::post('/groupCreate', [GroupController::class, 'groupCreateProcess']);

		Route::get('/groupList', [GroupController::class, 'groupList'])->name('group.list');
		Route::get('/groupUpdate', [GroupController::class, 'groupUpdate'])->name('group.update');
		Route::put('/groupUpdateProcess', [GroupController::class, 'groupUpdateProcess'])->name('group.updateProcess');

		Route::get('/popCreate', [PopController::class, 'popCreate'])->name('pop.create');
		Route::post('/popCreate', [PopController::class, 'popCreateProcess']);

		Route::get('/popUpdate', [PopController::class, 'popUpdate'])->name('pop.update');
		Route::put('/popUpdateProcess', [PopController::class, 'popUpdateProcess'])->name('pop.updateProcess');

		Route::get('/customerCreate', [CustomerController::class, 'customerCreate'])->name('customer.create');
		Route::post('/customerCreate', [CustomerController::class, 'customerCreateProcess']);

		Route::get('/customerUpdate', [CustomerController::class, 'customerUpdate'])->name('customer.update');
		Route::put('/customerUpdate', [CustomerController::class, 'customerUpdateProcess'])->name('customer.updateProcess');

		Route::get('/customerEmail', [CustomerController::class, 'customerEmail'])->name('customerEmail');	
		Route::post('/customerEmail', [CustomerController::class, 'customerEmailProcess']);

		Route::get('/smtpConfigure', [SmtpConfigurationController::class, 'smtpConfigure'])->name('smtpConfigure');	
		Route::POST('/smtpConfigure', [SmtpConfigurationController::class, 'smtpConfigureProcess']);

		Route::get('/emailNotification', [NotificationController::class, 'emailNotification'])->name('emailNotification');	
		Route::POST('/emailNotification', [NotificationController::class, 'emailNotificationProcess']);

	});
	
	Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
	Route::get('/changePassword', [UserController::class, 'changePassword'])->name('changePassword');
	Route::post('/changePassword', [UserController::class, 'changePasswordProcess']);

	Route::get('/ticketCreate', [TicketController::class, 'ticketCreate'])->name('ticket.create');
	Route::post('/ticketCreate', [TicketController::class, 'ticketCreateProcess']);
	Route::post('/ticketUpdate', [TicketController::class, 'ticketUpdateProcess'])->name('ticketUpdate');

	Route::get('/myTicketList', [TicketController::class, 'ticketList'])->name('myTicket.list');
	Route::get('/groupTicketList', [TicketController::class, 'groupTicketList'])->name('groupTicket.list');

	Route::get('/detailTicket', [TicketController::class, 'detailTicket'])->name('detailTicket');

	Route::post('/addNoteProcess', [TicketController::class, 'addNoteProcess'])->name('addNoteProcess');

	Route::post('/searchTicketProcess', [TicketController::class, 'searchTicketProcess'])->name('searchTicketProcess');
	Route::get('/searchTicketAjax', [TicketController::class, 'searchTicketAjax'])->name('searchTicketAjax');
	Route::get('/search', [TicketController::class, 'search'])->name('search');
	Route::get('/searchCustomerTicketAjax', [TicketController::class, 'searchCustomerTicketAjax'])->name('searchCustomerTicketAjax');

	Route::post('/searchCustomerTicketProcess', [TicketController::class, 'searchCustomerTicketProcess'])->name('searchCustomerTicketProcess');
	Route::get('/searchCustomerTicketProcess', function(){
		return redirect()->route('dashboard');
		});

	Route::post('/getUserByGroupID', [TicketController::class, 'getUserByGroupID'])->name('getUserByGroupID');

	Route::get('/customerList', [CustomerController::class, 'customerList'])->name('customer.list');
	Route::get('/searchCustomerList', [CustomerController::class, 'searchCustomerList'])->name('searchCustomerList');
	Route::get('/customerDetailAjax', [CustomerController::class, 'customerDetailAjax'])->name('customer.detailAjax');
	Route::get('/searchCustomerListPop', [CustomerController::class, 'searchCustomerListPop'])->name('searchCustomerListPop');

	Route::get('/popList', [PopController::class, 'popList'])->name('pop.list');
	

});


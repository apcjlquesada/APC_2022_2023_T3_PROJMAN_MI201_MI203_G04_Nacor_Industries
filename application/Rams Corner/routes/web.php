<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\KB;


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

Route::get('/', function () {
    return view('welcome');
});



//Login
Route::get('/loginPage', [AuthController::class, 'loginPage'])->name('loginPage');
Route::post('/loginUser', [AuthController::class, 'loginUser'])->name('loginUser');

//Sign out
Route::get('/signout', [AuthController::class, 'signout'])->name('signout');

Route::group(['middleware' => ['auth:sanctum']], function () {


//Client
Route::get('/clientHome', [ClientController::class, 'clientHome'])->name('clientHome');
Route::get('/ticketList', [ClientController::class, 'ticketList'])->name('ticketList');
Route::get('/clientViewTickets', [ClientController::class, 'clientViewTickets'])->name('clientViewTickets');
Route::get('/clientOpenTicket/{t_id}', [ClientController::class, 'clientOpenTicket'])->name('clientOpenTicket');


//Admin
Route::get('/adminHome', [AdminController::class, 'adminHome'])->name('adminHome');
Route::get('/viewTicket', [TicketController::class, 'viewTicket'])->name('viewTicket');
Route::get('/viewAllTickets', [AdminController::class, 'viewAllTickets'])->name('viewAllTickets');
Route::get('/openTicket/{t_id}', [AdminController::class, 'openTicket'])->name('openTicket');


//Staff
Route::get('/staffHome', [StaffController::class, 'staffHome'])->name('staffHome');
Route::get('/staffViewAllTickets', [StaffController::class, 'staffViewAllTickets'])->name('staffViewAllTickets');
Route::get('/staffOpenTickets/{t_id}', [StaffController::class, 'staffOpenTickets'])->name('staffOpenTickets');

//Ticket
Route::get('/createTicketTab', [TicketController::class, 'createTicketTab'])->name('createTicketTab');
Route::post('/createTicket', [TicketController::class, 'createTicket'])->name('createTicket');
Route::post('/cancelTicket', [TicketController::class, 'cancelTicket'])->name('cancelTicket');
Route::post('/updateTicket/{t_id}', [TicketController::class, 'updateTicket'])->name('updateTicket');
Route::post('/saveResolution/{t_id}', [TicketController::class, 'saveResolution'])->name('saveResolution');
Route::get('/viewTags', [TicketController::class, 'viewTags'])->name('viewTags');
Route::get('/escalateTicket/{tID}', [TicketController::class, 'escalateTicket'])->name('escalateTicket');

Route::get('/getTicketData/{id}', [TicketController::class, 'getTicketData'])->name('getTicketData');



//Reports

Route::get('/generateReport', [ReportController::class, 'generateReport'])->name('generateReport');
Route::post('/generate', [ReportController::class, 'generate'])->name('generate');







// KB
Route::get('/admin_KB',[KB::class, 'admin_KB'])->name('admin_KB');
Route::get('/staff_KB',[KB::class, 'staff_KB'])->name('staff_KB');
Route::post('/createKB', [KB::class, 'createkb']);
Route::get('/user_KB',[KB::class, 'user_KB'])->name('user_KB');
Route::get('/adminkbView/{id}', [KB::class, 'adminkbView'])->name('adminkbView');
Route::get('/userkbView/{id}', [KB::class, 'userkbView'])->name('userkbView');
Route::get('/staffkbView/{id}', [KB::class, 'staffkbView'])->name('staffkbView');
Route::post('/updateKB', [KB::class, 'updateKb']);



//extra
Route::get('/summary', [ReportController::class, 'summaryReport'])->name('summary');


});


<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\NewsPageController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ChatController;
use App\Events\Message;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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

//Route::get('/', function () {
//    dd('hello');
//    return view('welcome');
//
//});

Route::get('/', [WelcomeController::class, 'welcomePage'])->name('welcome_page');


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


Route::get('/home', [HomeController::class, 'redirect'])->name('redirect')->middleware('auth', 'verified');
Route::get('/doctors', [HomeController::class, 'doctorPage'])->name('doctor-page')->middleware('auth', 'verified');
Route::get('/appointmentpage', [HomeController::class, 'appointmentPage'])->name('appointmentpage');
Route::post('/appointment', [HomeController::class, 'appointment'])->name('appointment');
Route::get('/my_appointment', [HomeController::class, 'my_appointment'])->name('my_appointment');
Route::get('/vaccination_appointments', [HomeController::class, 'vaccinationAppointment'])->name('vaccination_appointments')->middleware('auth', 'verified');
Route::post('/vaccination_appointments', [HomeController::class, 'vaccinationAppointmentSave'])->name('vaccination_appointments_save');
Route::get('/cancel_appoint/{id}', [HomeController::class, 'cancel_appoint'])->name('cancel_appoint');
Route::get('/symptoms', [HomeController::class, 'symptomsPage'])->name('symptoms');
Route::get('/userDashBoard', [HomeController::class, 'userDashBoard'])->name('userDashBoard');
Route::get('/lung_test', [HomeController::class, 'lungTest'])->name('lung_test');
Route::get('/welcome_page', [HomeController::class, 'welcomePage'])->name('main_page');
Route::get('/vaccination_card', [HomeController::class, 'vaccinationCard'])->name('vaccination_card');


Route::get('/adminDashboard', [AdminController::class, 'admin'])->name('admin_dashboard');
Route::get('/add_doctor_view', [AdminController::class, 'add_view'])->name('add_doctor_view');
Route::post('/upload_doctor', [AdminController::class, 'upload'])->name('upload_doctor');
Route::get('/show_appointment', [AdminController::class, 'show_appointment'])->name('show_appointment');
Route::get('/approved/{id}', [AdminController::class, 'approved'])->name('approved');
Route::get('/canceled/{id}', [AdminController::class, 'canceled'])->name('canceled');
Route::get('/show_doctor_view', [AdminController::class, 'show_doctor_view'])->name('show_doctor_view');
Route::get('/delete_doctor/{id}', [AdminController::class, 'deleteDoctor'])->name('delete_doctor');
Route::get('/update_doctor/{id}', [AdminController::class, 'updateDoctor'])->name('update_doctor');
Route::post('/edit_doctor/{id}', [AdminController::class, 'editDoctor'])->name('edit_doctor');
Route::get('/vaccination_appointment', [AdminController::class, 'vaccinationAppointment'])->name('vaccination_appointments_show');
Route::post('/appointment_update/{id}', [AdminController::class, 'appointmentUpdate'])->name('appointment_update');
Route::get('/delete_vaccination_appointment/{id}', [AdminController::class, 'cancelVaccinationAppoint'])->name('cancel_vaccination_appointment');
Route::get('/search-users', [AdminController::class, 'searchUsersByName'])->name('searchUsersByName');


Route::post('/contact_us', [ContactController::class, 'contactUs'])->name('contact_us');
Route::get('/contact_details', [ContactController::class, 'userContacts'])->name('user_contacts');


Route::get('/chat',[ChatController::class,'chatOption'])->name('chat-option');
Route::post('/chat',[ChatController::class,'chatApplication'])->name('chat-application');

Route::get('/news',[NewsPageController::class,'newsPage'])->name('news_page');


Route::get('/doctors-controller',[DoctorController::class,'showDoctors'])->name('show-all-doctors');

<?php

use App\Http\Controllers\Frontend\AboutUs\AboutUsController;
use App\Http\Controllers\Frontend\Academics\AcademicsController;
use App\Http\Controllers\Frontend\Announcement\AnnouncementController;
use App\Http\Controllers\Frontend\Gallery\GalleryController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\Tracker\EnrollmentTrackerController;
use App\Http\Controllers\General\MailController;
use App\Models\Role;
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

Route::middleware([ 'alert'])->group(function () {
    Route::controller(HomeController::class)->group(function () {
        Route::get('/',  'index')->name('home.index');
        Route::get('/calendar',  'calendar')->name('calendar.index');
        Route::get('/enrollment/form',  'enroll')->name('enroll.index');
    });
    Route::prefix('portals')->controller(LoginController::class)->name('portals.')->group(function () {
        Route::get('/',  function(){
            $roles = Role::all();
            return view('BCA.Frontend.pages.portal.form',compact('roles'));
        })->name('index');
        Route::get('/{role}',  function($role){
            $roles = Role::all();
            return view('BCA.Frontend.pages.portal.form',compact('roles','role'));
        })->name('show');
        Route::view('/admin', 'BCA.Frontend.pages.portal.partials.admin')->name('admin');
        Route::view('/registrar', 'BCA.Frontend.pages.portal.partials.registrar')->name('registrar');
        Route::view('/cashier', 'BCA.Frontend.pages.portal.partials.cashier')->name('cashier');
        Route::view('/teacher', 'BCA.Frontend.pages.portal.partials.teacher')->name('teacher');
        Route::view('/student', 'BCA.Frontend.pages.portal.partials.student')->name('student');
        Route::post('/auth/{role}', 'login')->name('auth.login');
        Route::post('/logout', 'logout')->name('logout')->middleware('auth');
    });
    Route::name('about.')->prefix('about-us')->controller(AboutUsController::class)->group(function () {
        Route::get('/history',  'history')->name('history.index');
        Route::get('/core-values-and-principles',  'cv')->name('cv.index');
    });

    Route::name('academic.')->prefix('academics')->controller(AcademicsController::class)->group(function () {
        Route::get('/primary',  'primary')->name('primary.index');
        Route::get('/elementary',  'elementary')->name('elementary.index');
        Route::get('/junior-high-school',  'juniorHighSchool')->name('juniorHighSchool.index');
    });
    Route::name('tracker.')->prefix('tracker')->controller(EnrollmentTrackerController::class)->group(function () {
        Route::get('/',  'index')->name('index');
        Route::post('/track',  'track')->name('track');
        Route::post('/track/{id}',  'trackViaEmail')->name('track.email');
    });
    Route::name('announcement.')->prefix('announcements')->controller(AnnouncementController::class)->group(function () {
        Route::get('/',  'index')->name('index');
        Route::get('/{id}',  'show')->name('show');
    });
    Route::name('gallery.')->prefix('gallery')->controller(GalleryController::class)->group(function () {
        Route::get('/',  'index')->name('index');
        Route::get('/{id}',  'show')->name('show');
    });
    Route::controller(MailController::class)->group(function () {
        Route::post('/resend/verification/code', 'resendCode')->name('resend.code');
        Route::get('/verify', 'verifyStudent')->name('verify.student');
        Route::post('/send/otp/code', 'resendCode')->name('send.otp');
    });
    Route::view('/resend/verification', 'BCA.Frontend.pages.verification.index');
    Route::view('/send/otp', 'BCA.Frontend.pages.verification.index')->name('otp');
});
Route::get('/send/email/accepted', function () {
    $email = 'royjosephlatayan16@gmail.com';
    $name = 'Roy Joseph';
    $student_id = '2022-00';
    $password = 'password';
    MailController::sendAcceptedMail($name, $student_id, $email, $password, false);
    return 'done';
});

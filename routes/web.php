<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Backend\admin\AnnouncementsController;
use App\Http\Controllers\Backend\admin\BankAccountController;
use App\Http\Controllers\Backend\admin\DashboardController;
use App\Http\Controllers\Backend\admin\DatabaseBackupController;
use App\Http\Controllers\Backend\admin\EventController;
use App\Http\Controllers\Backend\admin\GalleryController;
use App\Http\Controllers\Backend\admin\GradesController;
use App\Http\Controllers\General\ProfileController;
use App\Http\Controllers\Backend\admin\SchoolYearController;
use App\Http\Controllers\Backend\admin\UsersController;
use App\Http\Controllers\Frontend\AboutUs\AboutUsController;
use App\Http\Controllers\Frontend\Academics\AcademicsController;
use App\Http\Controllers\Frontend\Announcement\AnnouncementController;
use App\Http\Controllers\Frontend\Gallery\GalleryController as HomeGalleryController;
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
    Route::name('gallery.')->prefix('gallery')->controller(HomeGalleryController::class)->group(function () {
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
Route::middleware(['auth', 'alert'])->group(function () {
    route::prefix('admin')->name('admin.')->middleware(['isAdmin'])->group(function () {
        Route::get('/dashboard/{selection?}', [DashboardController::class, 'index'])->name('dashboard.index');

        Route::name('manage.')->group(function () {
            route::name('announcement.')->prefix('announcements')->controller(AnnouncementsController::class)->group(function () {
                Route::get('/', 'index')->name('index');
                Route::post('/add', 'store')->name('store');
                Route::put('/update/{id}', 'update')->name('update');
                Route::delete('/delete/{id}', 'destroy')->name('destroy');
            });
            route::name('backups.')->prefix('backups')->controller(DatabaseBackupController::class)->group(function () {
                Route::get('index', 'index')->name('index');
                Route::get('/generate', 'generate')->name('generate');
                Route::get('/download/{id}', 'download')->name('download');

            });
            route::name('events.')->prefix('events')->controller(EventController::class)->group(function () {
                Route::get('/events', 'index')->name('index');
                Route::post('/events/add', 'store')->name('store');
                Route::put('/events/update/{id}', 'update')->name('update');
                Route::delete('/events/delete/{id}', 'destroy')->name('destroy');
            });
            Route::name('gallery.')->prefix('gallery')->controller(GalleryController::class)->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/{id}', 'show')->name('show');
                Route::delete('/delete/{id}', 'destroy')->name('destroy');
            });

            Route::prefix('user')->name('user.')->controller(UsersController::class)->group(function () {
                Route::get('/{type?}', 'index')->name('index');
                Route::get('logs/{id}/{type}', 'show')->name('show');
                Route::put('/logout/{id}', 'forceLogout')->name('logout');
            });
            Route::prefix('grades')->name('grades.')->controller(GradesController::class)->group(function () {
                Route::get('/{level_id?}', 'index')->name('index');
                Route::get('/show/{id}', 'show')->name('show');
            });
            Route::prefix('sy')->name('sy.')->controller(SchoolYearController::class)->group(function () {
                Route::get('/','index')->name('index');
                Route::put('/update/{id}','update')->name('update');
                Route::post('/store','store')->name('store');
                Route::delete('/destroy/{id}','destroy')->name('destroy');
            });
        });

        Route::name('account.')->prefix('bank/accounts')->controller(BankAccountController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('/store', 'store')->name('store');
            Route::put('/update/{id}', 'update')->name('update');
            Route::delete('/delete/{id}', 'destroy')->name('delete');
        });

        Route::name('settings.profile.')->prefix('settings/profile')->controller(ProfileController::class)->group(function () {
            Route::get('/change-password', 'changePassword')->name('changePassword.index');
            Route::put('/update/password', 'updatePassword')->name('updatePassword.update');
        });
    });
    Route::prefix('registrar')->name('registrar.')->middleware(['isRegistrar'])->group(function () {
        /* Dashboard */
        Route::get('/dashboard', [RegistrarDashboardController::class, 'index'])->name('dashboard.index');
        Route::get('/send/verification', [RegistrarDashboardController::class, 'sendVerificationCode'])->name('send.mail');
        Route::get('/accept/all', [RegistrarDashboardController::class, 'acceptAllUnverifiedEmails'])->name('accept.all.unverified.email');
        Route::name('sy.')->controller(SchoolYearController::class)->group(function () {
            Route::post('/update/sy/{id}', 'update')->name('update');
            Route::post('/store/sy', 'store')->name('store');
            Route::get('/open/sy/enrollment', 'open')->name('enrollment.open');
            Route::get('/close/sy/enrollment', 'close')->name('enrollment.close');
            Route::delete('/delete/sy/{id}', 'destroy')->name('destroy');
        });
        /* Enrollment */
        //Enrollee
        route::name('enrollees.')->controller(EnrolleeController::class)->group(function () {
            Route::get('/students/create', 'create')->name('create');
            Route::post('/students/enrollee/{id}/store', 'store')->name('store');
            Route::get('/students/enrollee/{level_id?}', 'index')->name('index');
            Route::get('/students/enrollee/{id}/show', 'show')->name('show');
            Route::get('/students/enrollee/{id}/requirements', 'show')->name('show.requirements');
        });
        Route::post('/students/enrollee/requirements', [EnrolleeRequirementController::class, 'store'])->name('enrollee.store.requirements');
        //Enrolled
        route::name('enrolled.')->controller(EnrolledStudentController::class)->group(function () {
            Route::get('/students/enrolled/{level_id?}', 'index')->name('index');
            Route::get('/students/enrolled/{id}/show', 'show')->name('show');
            Route::put('/students/enrolled/{id}', 'update')->name('update');
            Route::get('/students/enrolled/{id}/requirements', 'show')->name('show.requirements');
            Route::delete('/students/enrolled/{id}', 'destroy')->name('destroy');
        });
        Route::post('/students/enrolled/requirements', [RequirementsController::class, 'store'])->name('enrolled.store.requirements');
        Route::name('class.')->prefix('classes')->controller(ClassController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::get('/{id}', 'show')->name('show');
            Route::post('/store/add', 'store')->name('store');
            Route::put('/update/{id}', 'update')->name('update');
            Route::delete('/delete/{id}', 'destroy')->name('destroy');
        });
        /* Registrar|teacher */
        route::name('teachers.')->controller(TeacherController::class)->group(function () {
            Route::get('/teachers',  'index')->name('index');
            Route::get('/teachers/create',  'create')->name('create');
            Route::post('/teachers',  'store')->name('store');
            Route::put('/teachers/{id}',  'update')->name('update');
            Route::delete('/teachers/delete/{id}',  'destroy')->name('delete');
        });
        /* Registrar|section */
        route::name('section.')->controller(SectionController::class)->group(function () {
            Route::get('/section/{level_id?}', 'index')->name('index');
            Route::get('/section/show/{id}', 'show')->name('show');
            Route::post('/section', 'store')->name('store');
            Route::put('/section/update/{id}', 'update')->name('update');
            Route::delete('/section/delete/{id}', 'destroy')->name('destroy');
        });

        /* Registrar|subject */
        route::name('subject.')->prefix('subjects')->controller(SubjectController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/{id}', 'show')->name('show');
            Route::post('/store', 'store')->name('store');
            Route::put('/update/{id}', 'update')->name('update');
            Route::delete('/delete/{id}', 'destroy')->name('destroy');
        });
        Route::name('archive.')->prefix('archive')->controller(ArchiveController::class)->group(function () {
            Route::get('/{isStudent}', 'show')->name('show');
            Route::put('/update/{id}/{isStudent}', 'update')->name('update');
        });
        Route::name('settings.profile.')->prefix('settings/profile')->controller(ProfileController::class)->group(function () {
            Route::get('/change-password', 'changePassword')->name('changePassword.index');
            Route::put('/update/password', 'updatePassword')->name('updatePassword.update');
        });
    });
    route::prefix('cashier')->name('cashier.')->middleware(['isCashier'])->group(function () {
        /* Dashboard */
        Route::get('/dashboard', [CashierDashboardController::class, 'index'])->name('dashboard.index');
        Route::prefix('payment')->group(function () {
            Route::name('payment.pending.')->prefix('pending')->controller(PendingController::class)->group(function () {
                Route::get('/{level_id?}', 'index')->name('index');
                Route::post('/store', 'store')->name('store');
                Route::post('/update/{id}', 'update')->name('update');
            });
            Route::name('payment.confirmed.')->prefix('confirmed')->controller(ConfirmedController::class)->group(function () {
                Route::get('/{level_id?}', 'index')->name('index');
            });
            Route::name('payment.balance.')->prefix('balance')->controller(StudentPaymentController::class)->group(function () {
                Route::get('/{level_id?}', 'index')->name('index');
            });
        });
        Route::prefix('fees')->name('fees.')->group(function () {
            Route::name('annual.')->prefix('annual')->controller(AnnualController::class)->group(function () {
                Route::get('/{id}', 'show')->name('show');
                Route::post('/store', 'store')->name('store');
                Route::put('/update/{id}', 'update')->name('update');
                Route::delete('/delete/{id}', 'destroy')->name('destroy');
            });
        });
        Route::name('settings.profile.')->prefix('settings/profile')->controller(ProfileController::class)->group(function () {
            Route::get('/change-password', 'changePassword')->name('changePassword.index');
            Route::put('/update/password', 'updatePassword')->name('updatePassword.update');
        });
    });

    route::prefix('teacher')->name('teacher.')->middleware(['isTeacher'])->group(function () {
        Route::get('/dashboard', [TeacherDashboardController::class, 'index'])->name('dashboard.index');

        Route::name('subject.')->prefix('subject')->controller(SubjectsSubjectController::class)->group(function () {
            Route::get('/{id}', 'show')->name('show');
        });
        Route::name('advisory.')->prefix('advisory')->controller(AdvisoryClassController::class)->group(function () {
            Route::get('/class/{id}', 'show')->name('show');
        });
        Route::name('grade.')->prefix('grade')->controller(GradeController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/{id}', 'show')->name('show');
            Route::post('/store/{id}/subject/{subject_id}', 'store')->name('store');
        });
        Route::name('settings.profile.')->prefix('settings/profile')->controller(ProfileController::class)->group(function () {
            Route::get('/change-password', 'changePassword')->name('changePassword.index');
            Route::put('/update/password', 'updatePassword')->name('updatePassword.update');
        });
    });

    route::prefix('student')->name('student.')->middleware(['isStudent'])->group(function () {
        Route::get('/dashboard', [StudentDashboardController::class, 'index'])->name('dashboard.index');

        Route::name('enrolment.')->controller(EnrollmentController::class)->group(function () {
            Route::get('/enrollment', 'index')->name('index');
        });
        Route::name('class.')->controller(ClassClassController::class)->group(function () {
            Route::get('/my-class', 'index')->name('index');
        });
        Route::name('grades.')->controller(GradesController::class)->group(function () {
            Route::get('/grades/sy/{sy_id}', 'show')->name('show');
        });
        Route::name('payment.')->controller(PaymentController::class)->group(function () {
            Route::get('/payment-history', 'index')->name('index');
        });
        Route::name('settings.profile.')->prefix('settings/profile')->controller(ProfileController::class)->group(function () {
            Route::get('/change-password', 'changePassword')->name('changePassword.index');
            Route::put('/update/password', 'updatePassword')->name('updatePassword.update');
        });
    });
});
Route::get('/send/email/accepted', function () {
    $email = 'royjosephlatayan16@gmail.com';
    $name = 'Roy Joseph';
    $student_id = '2022-00';
    $password = 'password';
    MailController::sendAcceptedMail($name, $student_id, $email, $password, false);
    return 'done';
});

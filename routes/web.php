<?php

use Illuminate\Support\Facades\Route;

// ----------- Public Routes -------------- //
Route::get('/', function () {
    return view('auth.login');
});

// --------- Authenticated Routes ---------- //
Route::middleware('auth')->group(function () {
    Route::get('home', function () {
        return view('home');
    });
});

Auth::routes();

Route::group(['namespace' => 'App\Http\Controllers\Auth'],function()
{
    // -----------------------------login--------------------------------------//
    Route::controller(LoginController::class)->group(function () {
        Route::get('/login', 'login')->name('login');
        Route::post('/login', 'authenticate');
        Route::get('/logout', 'logout')->name('logout');
    });

    // ------------------------------ Register ---------------------------------//
    Route::controller(RegisterController::class)->group(function () {
        Route::get('/register', 'register')->name('register');
        Route::post('/register','storeUser')->name('register');    
    });

    // ----------------------------- Forget Password --------------------------//
    Route::controller(ForgotPasswordController::class)->group(function () {
        Route::post('forget-password', 'sendResetLinkEmail')->name('forget-password');    
    });

    // ---------------------------- Reset Password ----------------------------//
    Route::controller(ResetPasswordController::class)->group(function () {
        Route::get('reset-password/{token}', 'getPassword');
        Route::post('reset-password', 'updatePassword')->name('reset-password');    
    });
});

Route::group(['namespace' => 'App\Http\Controllers'],function()
{
    // ------------------------- Main Dashboard ----------------------------//
    Route::controller(HomeController::class)->group(function () {
        Route::middleware('auth')->group(function () {
            Route::get('/home', 'index')->name('home');
            Route::get('/page/blank', 'pageBlank')->name('page/blank');
        });
    });

    // ------------------------- Data Listing ----------------------------//
    Route::controller(UserManagementController::class)->group(function () {
        Route::middleware('auth')->group(function () {
            Route::get('user/data/listing', 'index')->name('user/data/listing');
            Route::get('get-data-user/listing', 'getData')->name('get-data-user.listing');
            Route::post('update-user', 'updateRecord')->name('update-user');
            Route::post('delete-user', 'deleteRecord')->name('delete-user');
        });
    });

    // ------------------------- Setting ----------------------------//
    Route::controller(SettingController::class)->group(function () {
        Route::middleware('auth')->group(function () {
            Route::get('setting/page', 'index')->name('setting/page');
        });
    });

    // ------------------------- Form Upload ----------------------------//
    Route::controller(UploadFormController::class)->group(function () {
        Route::middleware('auth')->group(function () {
            Route::get('form/upload/page', 'index')->name('form/upload/page');
            Route::post('form/upload/save', 'storeFileUpload')->name('form/upload/save');
            Route::get('form/upload/listing', 'showFiles')->name('form/upload/listing');
            Route::get('form/file/listing', 'getData')->name('get-data-file.listing');
            Route::get('/download/{filename}', 'download')->name('file.download');
            Route::post('delete-file', 'destroy')->name('delete-file');
        });
    });
    // ------------------------- Wizard Form ----------------------------//
    Route::controller(WizardFormController::class)->group(function () {
        Route::middleware('auth')->group(function () {
            Route::get('form/pagination/page', 'index')->name('form/pagination/page');
            Route::get('form/pagination/form/get-data/listing', 'getData')->name('form/pagination/form/get-data/listing');
        });
    });
});
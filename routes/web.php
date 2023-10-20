<?php

// Facades
use Illuminate\Support\Facades\{
    Artisan,
    Auth,
    Route
};

use App\Http\Controllers\Auth\{
    AuthController
};


// Shared Restful Controllers
use App\Http\Controllers\All\{
    ProfileController,
    TmpImageUploadController
};

// Admin Restful Controllers
use App\Http\Controllers\Admin\{
    ActivityLogController,
    DashboardController,
    CategoryController,
    UserController
};



Route::get('/', function () {
    return to_route('auth.login');
});

Route::view('/install', 'install')->name('app.install');

// caching
Route::get('/cache', function () {
    Artisan::call('config:cache');
    Artisan::call('route:cache');
    return 'cache';
});

// Route::get('/symlink', function () {
//     symlink('/home/u686793928/iskool/storage/app/public', '/home/u686793928/domains/mainsandbox.com/public_html/sub_iskool/storage');
// });



// Admin 
Route::group(['middleware' => ['auth', 'admin'], 'prefix' => 'admin', 'as' => 'admin.'],function() {
    Route::get('dashboard', DashboardController::class)->name('dashboard.index');
    Route::resource('categories', CategoryController::class);
    
    Route::resource('users', UserController::class);

    //Route::get('role', RoleController::class)->name('role.index');
    
    Route::get('activity_logs', ActivityLogController::class)->name('activity_logs.index');
});



// Shared Controller
Route::group(['middleware' => ['auth']],function() {

    // TMP FILE UPLOAD
    Route::delete('tmp_upload/revert', [TmpImageUploadController::class, 'revert']);
    Route::post('tmp_upload/content', [TmpImageUploadController::class, 'faqImageUpload'])->name('tmpupload.faqImageUpload');
    Route::resource('tmp_upload', TmpImageUploadController::class);
    Route::resource('profile', ProfileController::class)->parameter('profile', 'user');;
  
});

Route::group(['as' => 'auth.', 'controller' => AuthController::class],function() {
    Route::get('/login', 'login')->name('login');
    Route::post('/login', 'attemptLogin')->name('attemptLogin');
    Route::get('/register', 'register')->name('register');
    Route::post('/register', 'attemptRegister')->name('attemptRegister');
    Route::post('/logout', 'logout')->name('logout');


    Route::get('/email/verify/{token}', 'emailVerification')->name('email_verification'); // email verification

});


Auth::routes(['login' => false, 'register' => false, 'logout' => false]);
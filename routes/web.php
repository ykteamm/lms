<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\GroupTestsController;
use App\Http\Controllers\IntegrationController;
use App\Http\Controllers\LessonsController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\RaspisaniyaController;
use App\Http\Controllers\TestCheckController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\UserCheckController;
use App\Http\Controllers\UsersAllController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\UsersPageController;
use App\Http\Controllers\VideoController;
use Illuminate\Support\Facades\Route;

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

Route::group(['prefix' => '/'], function () {
    Route::get('/', [AuthController::class, 'registerView'])->name('register-view');
    Route::post('/register', [AuthController::class, 'register'])->name('register');

    Route::get('/login', [AuthController::class, 'loginView'])->name('login-view');
    Route::post('/login', [AuthController::class, 'login'])->name('login');

    Route::get('/users-region', [AuthController::class, 'ChooseRegion'])->name('users-region');

    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});


Route::group(['prefix' => 'admin','middleware' => ['auth', 'userAdminRole:admin,assistant']], function () {
    Route::get('/', [AdminController::class, 'admin'])->name('admin');
    Route::resource('users', UsersController::class);
    Route::resource('users_all', UsersAllController::class);
    Route::resource('users_check', UserCheckController::class);
    Route::get('/integration',[IntegrationController::class,'index'])->name('integration');
    Route::get('/jang_matrix/{id}',[IntegrationController::class,'jang'])->name('jang_matrix');
    Route::resource('test', TestController::class);
    Route::resource('group_test', GroupTestsController::class);
    Route::resource('video', VideoController::class);
    Route::resource('course', CourseController::class);

    Route::get('/module/{course_id}',[ModuleController::class, 'index'])->name('module-index');
    Route::get('/lesson/{module_id}',[LessonsController::class, 'index'])->name('lessons-index');
    Route::get('/lesson/create/{lesson_id}',[LessonsController::class, 'create'])->name('lesson-create');
//        Route::get('/lessons/show/{lesson_id}',[LessonsController::class, 'create'])->name('lessons-create');
    Route::put('/lesson/video_dars/update/{video_id}',[LessonsController::class, 'VideoDarsUpdate'])->name('lesson-video-dars-update');
    Route::put('/lesson/group_test/{id}',[LessonsController::class, 'GroupTestUpdate'])->name('lesson-group-test-update');

    Route::post('/lesson/video_dars',[LessonsController::class, 'VideoDars'])->name('lessons-video-dars');

    Route::resource('module', ModuleController::class);
    Route::resource('lessons', LessonsController::class);
    Route::resource('raspisaniya', RaspisaniyaController::class);
});

Route::group(['prefix' => 'user','middleware' => ['auth', 'userRole:user']], function () {

    Route::get('/', [AdminController::class, 'user'])->name('user');
    Route::get('/module/{course_id}',[UsersPageController::class,'index'])->name('module');
    Route::get('/lesson/{module_id}',[UsersPageController::class,'lesson'])->name('lesson');
    Route::get('/lesson-show/{lesson_id}',[UsersPageController::class,'LessonShow'])->name('lesson-show');
    Route::get('/lesson-test/{lesson_id}',[UsersPageController::class,'LessonTest'])->name('lesson-test');

    Route::post('/first_test',[TestCheckController::class,'CheckTest'])->name('first_test');
    Route::post('/all_test',[TestCheckController::class,'AllTest'])->name('all_test');

    Route::post('/imkoniyat',[TestCheckController::class,'Imkoniyat'])->name('imkoniyat');
});

<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ReminderController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\WorkspaceController;
use App\Http\Controllers\HomeController;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();



Route::resource('/event', EventController::class);
Route::resource('/reminder', ReminderController::class);
Route::get('/home', [HomeController::class, 'index'])->name('home');
//Route::resource('/company',CompanyController::class);

//admin@test1.com
//y06rYF3R

Route::resource('project', ProjectController::class);
Route::group(['prefix' => 'project'], function () {

    Route::get('{projects_id}/addProject', [ProjectController::class, 'addProject']);
    Route::get('{projects_id}/storeProject', [ProjectController::class, 'storeProject']);
});


Route::resource('task', TaskController::class);
Route::group(['prefix' => 'task'], function () {

    Route::get('{tasks_id}/addPriority', [TaskController::class, 'addPriority']);
    Route::get('{tasks_id}/storePriority', [TaskController::class, 'storePriority']);
    Route::post('checkIn', [TaskController::class, 'checkIn'])->name('task.check-in');

});

Route::group(['prefix' => 'Company'], function () {
    Route::get('home', [CompanyController::class, 'index'])->name('company.home');

    Route::get('register', [CompanyController::class, 'registerPage'])->name('company.register.page');
    Route::post('register', [CompanyController::class, 'registerStore'])->name('company.register.store');
    Route::get('login', [CompanyController::class, 'loginPage'])->name('company.login.page');
    Route::post('login', [CompanyController::class, 'loginCheck'])->name('company.login.check');
    Route::post('logout', [CompanyController::class, 'logout'])->name('company.logout');

    Route::group(['middleware' => 'auth:companyStaff'], function () {
        Route::resource('/workspace', WorkspaceController::class);
        Route::get('workspace/{workspaces_id}/addUser', [WorkspaceController::class, 'addUser']);
        Route::get('workspace/{workspaces_id}/storeUser', [WorkspaceController::class, 'storeUser']);
    });
});

Route::get('/analytics', function () {
    return view('analytics');
});

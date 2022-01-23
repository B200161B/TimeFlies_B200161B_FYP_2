<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CompanyUserController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\FileManagementController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ReminderController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\WorkspaceController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\WorktimeController;
use App\Models\CompanyUser;
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
Route::post('task/{tasks_id}/checkIn', [TaskController::class, 'checkIn']);
//Route::resource('/company',CompanyController::class);

//admin@Testcompany.com
//twb14vFo

Route::resource('project', ProjectController::class);
Route::group(['prefix' => 'project'], function () {

    Route::get('{projects_id}/addProject', [ProjectController::class, 'addProject'])->name('project.addProject');
    Route::get('{projects_id}/editProjectWorkspace', [ProjectController::class, 'editProjectWorkspace'])->name('project.editProjectWorkspace');
    Route::get('{projects_id}/changeWorkspace', [ProjectController::class, 'changeWorkspace'])->name('project.changeWorkspace');
    Route::get('{projects_id}/storeProject', [ProjectController::class, 'storeProject'])->name('project.storeProject');
    Route::get('{projects_id}/viewProjectTasks', [ProjectController::class, 'show'])->name('viewProjectTasks');
});

Route::group(['prefix' => 'profile'], function () {
    Route::get('/', [ProfileController::class, 'index'])->name('profile.index');
    Route::post('reset-password', [ProfileController::class, 'resetPassword'])->name('profile.reset-password');
    Route::put('{id}/', [ProfileController::class, 'update'])->name('profile.update');

});

Route::group(['prefix' => 'work-time'], function () {
    Route::get('/', [WorktimeController::class, 'index'])->name('worktime.index');

});

Route::group(['prefix' => 'file-management'], function () {
    Route::get('/', [FileManagementController::class, 'index'])->name('file-management.index');
});

Route::resource('task', TaskController::class);
Route::group(['prefix' => 'task'], function () {

    Route::get('{tasks_id}/addPriority', [TaskController::class, 'addPriority']);
    Route::get('{tasks_id}/storePriority', [TaskController::class, 'storePriority']);
    Route::post('check-in', [TaskController::class, 'checkIn'])->name('task.check-in');
    Route::get('check-out/{task_history_id}', [TaskController::class, 'checkOut'])->name('task.check-out');
    Route::get('{tasks_id}/addUsers', [TaskController::class, 'addUsers'])->name('task.add-users');
    Route::post('{tasks_id}/storeUsers', [TaskController::class, 'storeUsers'])->name('task.store-users');

});

Route::group(['prefix' => 'Company'], function () {

    Route::group(['prefix' => 'users'], function () {
        Route::get('/', [CompanyUserController::class, 'index'])->name('company-user.index');
    });

    Route::get('home', [CompanyController::class, 'index'])->name('company.home');
    Route::get('viewProject', [WorkspaceController::class, 'show'])->name('company.viewProject');
    Route::get('register', [CompanyController::class, 'registerPage'])->name('company.register.page');
    Route::post('register', [CompanyController::class, 'registerStore'])->name('company.register.store');
    Route::get('login', [CompanyController::class, 'loginPage'])->name('company.login.page');
    Route::post('login', [CompanyController::class, 'loginCheck'])->name('company.login.check');
    Route::post('logout', [CompanyController::class, 'logout'])->name('company.logout');

//    Route::group(['middleware' => 'auth:companyStaff'], function () {
    Route::resource('/workspace', WorkspaceController::class);
    Route::get('workspace/{workspaces_id}/addUser', [WorkspaceController::class, 'addUser'])->name('workspace.addUser');
    Route::get('workspace/{workspaces_id}/storeUser', [WorkspaceController::class, 'storeUser'])->name('workspace.storeUser');
//    });
});

Route::get('/analytics', function () {
    return view('analytics');
});

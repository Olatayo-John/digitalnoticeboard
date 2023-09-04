<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\TaskController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\BloodGroupController;
use App\Http\Controllers\Admin\TechnologyController;
use App\Http\Controllers\Admin\DesignationController;

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



Route::middleware(['auth'])->group(function () {

    // profile
    Route::get('profile', [ProfileController::class, 'index'])->name('profile');
    Route::get('profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('profile/change-password', [ProfileController::class, 'changePassword'])->name('profile.change-password');

    Route::prefix('admin')->group(function () {

        // ---------Dashboard route starts--------------
        Route::get('dashboard', function () {
            return view('admin.dashboard.index', ['title' => 'Dashboard', 'breadcrumbs' => []]);
        })->name('dashboard');

        // user
        Route::get('users', [UserController::class, 'index'])->name('users.index');
        Route::get('add-user', [UserController::class, 'create'])->name('users.create');
        Route::get('user-show/{user}', [UserController::class, 'show'])->name('users.show');
        Route::post('user-save', [UserController::class, 'store'])->name('users.store');
        Route::get('user-edit/{user}', [UserController::class, 'edit'])->name('users.edit');
        Route::put('user-update/{user}', [UserController::class, 'update'])->name('users.update');
        Route::delete('user-delete/{user}', [UserController::class, 'destroy'])->name('users.destroy');
        Route::get('user-technology', [UserController::class, 'get_user_technologies'])->name('users-technology');
        Route::put('user-technology/update', [UserController::class, 'update_user_technologies'])->name('users-technology.update');

        //client
        Route::get('client/get-country-state',[ ClientController::class,'countryStateList'])->name('client.get-country-state');
        Route::resource('client', ClientController::class);

        //project
        Route::post('project/remove-member', [ProjectController::class, 'removeMember'])->name('project.remove-member');
        Route::resource('project', ProjectController::class);
        
        //task
        Route::post('task/remove-image', [TaskController::class, 'removeImage'])->name('task.remove-image');
        Route::resource('task', TaskController::class);

        // settings
        Route::get('setting', [SettingController::class, 'index'])->name('setting');
        Route::put('setting/general', [SettingController::class, 'generalUpdate'])->name('setting-general.update');
        Route::put('setting/smtp', [SettingController::class, 'smtpUpdate'])->name('setting-smtp.update');

        // designation
        Route::post('designation', [DesignationController::class, 'save'])->name('designation.save');
        Route::get('designation', [DesignationController::class, 'show'])->name('designation.show');
        Route::put('designation/update', [DesignationController::class, 'update'])->name('designation.update');
        Route::delete('designation/delete/{designation}', [DesignationController::class, 'delete'])->name('designation.delete');

        // bloodGroup
        Route::post('blood-group', [BloodGroupController::class, 'save'])->name('blood-group.save');
        Route::get('blood-group', [BloodGroupController::class, 'show'])->name('blood-group.show');
        Route::put('blood-group/update', [BloodGroupController::class, 'update'])->name('blood-group.update');
        Route::delete('blood-group/delete/{blood_group}', [BloodGroupController::class, 'delete'])->name('blood-group.delete');;

        // technology
        Route::get('technology/list', [TechnologyController::class, 'list'])->name('technology.list');
        Route::post('technology', [TechnologyController::class, 'save'])->name('technology.save');
        Route::get('technology', [TechnologyController::class, 'show'])->name('technology.show');
        Route::put('technology/update', [TechnologyController::class, 'update'])->name('technology.update');
        Route::delete('technology/delete/{technology}', [TechnologyController::class, 'delete'])->name('technology.delete');
    });
});

Route::get('clear-cache', function () {
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    dd('cleared');
});

Route::get('artisan-storage', function () {
    Artisan::call('storage:link');
    dd('done');
});

Route::get('artisan-migrate', function () {
    Artisan::call('migrate:fresh --seed');
    dd('done');
});

require __DIR__ . '/auth.php';

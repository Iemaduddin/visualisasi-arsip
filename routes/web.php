<?php

use App\Http\Controllers\ArchiveController;
use App\Http\Controllers\CategoryController;
use App\Models\admin;

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

// Route::get('/', function () {
// 	return view('welcome');
// });


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RakController;
use App\Http\Controllers\ResetPassword;

use App\Http\Controllers\ChangePassword;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\RevisionHistoryController;

// Route::get('/', function () {
// 	return redirect('/dashboard');
// })->middleware('auth');
Route::get('/', function () {
	return redirect()->route('login');
});


Route::get('/login', [LoginController::class, 'show'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.perform');

Route::middleware(['guest'])->group(function () {
	Route::get('/register', [RegisterController::class, 'create'])->name('register');
	Route::post('/register', [RegisterController::class, 'store'])->name('register.perform');
	Route::get('/reset-password', [ResetPassword::class, 'show'])->name('reset-password');
	Route::post('/reset-password', [ResetPassword::class, 'send'])->name('reset.perform');
	Route::get('/change-password', [ChangePassword::class, 'show'])->name('change-password');
	Route::post('/change-password', [ChangePassword::class, 'update'])->name('change.perform');
});
Route::get('status', [UserController::class, 'userOnlineStatus']);
Route::group(['middleware' => 'auth'], function () {
	// Halaman Dashboard
	Route::prefix('dashboard')->group(function () {
		// Dashboard Admin
		Route::group(['middleware' => ['role:1'], 'prefix' => 'admin'], function () {
			Route::get('/', [HomeController::class, 'admin'])->name('dashboard_admin');
			Route::resource('/users', UserController::class);
			// Delete ALl
			Route::post('/user/deleteAll', [UserController::class, 'deleteAll'])->name('user.deleteAll');
			// Export Excel
			Route::get('/export-user', [UserController::class, 'export_excel'])->name('export-user');
			// Import Excel
			Route::post('/import-user', [UserController::class, 'import_excel'])->name('import-user');
			// Download Template Excel
			Route::get('/download-template-user', [UserController::class, 'downloadTemplate'])->name('download-template-user');

			// Categories
			Route::resource('/categories', CategoryController::class);
			// Locations
			Route::resource('/locations', LocationController::class);
			// Archives
			Route::resource('/archives', ArchiveController::class);
		});
	});
	Route::post('logout', [LoginController::class, 'logout'])->name('logout');
});

<?php

use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudentClassController;

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

Route::get('/', [RegisterController::class, 'showRegistrationForm'])->name('index');

Route::get('/aboutus', [PageController::class, 'about'])->name('about');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');

// Admin Route
// include ('admin-route.php');
Route::prefix('/admin')->middleware('auth')->name('admin.')->controller(AdminController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/table', 'table')->name('table');
    Route::get('/chart', 'chart')->name('chart');
});

// Student Route
Route::resource('student', StudentController::class)->except(['show'])->middleware(['auth', 'role:admin']);

// Class Route
Route::get('class', [StudentClassController::class, 'index']);

/*
 * From Laravel/UI
 */
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/welcome', [PageController::class, 'welcome'])->name('welcome');

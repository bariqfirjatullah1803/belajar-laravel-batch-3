<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;


// Admin Route
Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
Route::get('/admin/table', [AdminController::class, 'table'])->name('admin.table');
Route::get('/admin/chart', [AdminController::class, 'chart'])->name('admin.chart');


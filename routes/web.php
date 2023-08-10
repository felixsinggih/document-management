<?php

use App\Http\Controllers\admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\admin\CompanyAdminController;
use App\Http\Controllers\admin\CompanyController;
use App\Http\Controllers\admin\DocumentController as AdminDocumentController;
use App\Http\Controllers\client\DashboardController as ClientDashboardController;
use App\Http\Controllers\client\DocumentController as ClientDocumentController;
use App\Http\Controllers\LoginController;
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

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/', [LoginController::class, 'index'])->name('/')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::middleware(['auth'])->group(function () {
    // Admin
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index']);

    Route::controller(AdminController::class)->group(function () {
        Route::get('/admin/admin', 'index');
        Route::get('/admin/admin/add', 'create');
        Route::post('/admin/admin/store', 'store');
        Route::get('/admin/admin/{user}/edit', 'edit');
        Route::put('/admin/admin/update/{user}', 'update');
        Route::delete('/admin/admin/{user}/delete', 'destroy');
    });

    Route::controller(CompanyController::class)->group(function () {
        Route::get('/admin/company', 'index');
        Route::get('/admin/company/add', 'create');
        Route::post('/admin/company/store', 'store');
        Route::get('/admin/company/{company}/edit', 'edit');
        Route::put('/admin/company/update/{company}', 'update');
        Route::delete('/admin/company/{company}/delete', 'destroy');
    });

    Route::controller(CompanyAdminController::class)->group(function () {
        Route::get('/admin/company/{company}/user', 'index');
        Route::get('/admin/company/{company}/user/add', 'create');
        Route::post('/admin/company/{company}/user/store', 'store');
        Route::get('/admin/company/user/{user}/edit', 'edit');
        Route::put('/admin/company/user/update/{user}', 'update');
        Route::delete('/admin/company/user/{user}/delete', 'destroy');
    });

    Route::controller(AdminDocumentController::class)->group(function () {
        Route::get('/admin/document', 'index');
        // Route::get('/admin/company/{company}/user/add', 'create');
        // Route::post('/admin/company/{company}/user/store', 'store');
        Route::get('/admin/document/{document}', 'show');
        // Route::get('/admin/company/user/{user}/edit', 'edit');
        // Route::put('/admin/company/user/update/{user}', 'update');
        // Route::delete('/admin/company/user/{user}/delete', 'destroy');
    });

    // Client
    Route::get('/client/dashboard', [ClientDashboardController::class, 'index']);

    Route::controller(ClientDocumentController::class)->group(function () {
        Route::get('/client/document', 'index');
        Route::get('/client/document/add', 'create');
        Route::post('/client/document/store', 'store');
        Route::get('/client/document/{document}', 'show');
        Route::get('/client/document/{document}/edit', 'edit');
        Route::put('/client/document/update/{document}', 'update');
        Route::delete('/client/document/{document}/delete', 'destroy');
    });
});

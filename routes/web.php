<?php

use App\Http\Controllers\ShowComponentsController;
use App\Http\Controllers\UploadImageController;
use App\Http\Controllers\UsersManagementController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });

Route::redirect('/', 'login');

Route::get('/dashboard', function () {
    return Inertia::render('Main');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::post('/upload-image', [UploadImageController::class, 'imageUploadPost'])->name('upload-image');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/{projectName}/{params}', [ShowComponentsController::class, 'index'])->name('dashboard');
    Route::post('/users-management', [UsersManagementController::class, 'store']);
    Route::put('/users-management', [UsersManagementController::class, 'update']);
    Route::delete('/users-management/{id}', [UsersManagementController::class, 'destroy']);
});
require __DIR__.'/auth.php';

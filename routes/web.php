<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TeacherController;
use App\Http\Middleware\SetLocale;
use App\Models\Contact;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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
// Route::fallback(function () {
//     return redirect('/');
// });
Route::get('/create-symlink', function (){
    symlink(storage_path('/app/public'), public_path('storage'));
    echo "Symlink Created. Thanks";
});
Route::group(['prefix' => '{locale}'], function () {
    Route::get('/', [HomeController::class, 'HomePage']);
    Route::get('/data', [HomeController::class, 'data']);
});
Route::get('/en/admin/{secret}/login', [DashboardController::class, "loginIndex"])->middleware('isAdmin');
Route::post('/en/admin/login', [DashboardController::class, 'authenticate']);
Route::middleware(['authorized'])->group(function () {
    Route::get('/en/admin/dashboard', [DashboardController::class, 'dashboardIndex']);
    Route::get('/en/admin/dashboard/ar', [DashboardController::class, 'arDashboardIndex']);
    Route::get('/en/admin/dashboard/contact', [DashboardController::class, 'ContactDashboardIndex']);
    Route::get('/en/admin/dashboard/trash', [DashboardController::class, 'TrashDashboardIndex']);
    Route::get('/en/admin/dashboard/admins', [DashboardController::class, 'AdminsDashboardIndex']);
    Route::get('/en/admin/dashboard/admins/addAdmin', [DashboardController::class, 'addAdmin']);
    Route::post('/en/admin/dashboard/admins/storeAdmin', [DashboardController::class, 'storeAdmin']);
    Route::delete('/en/admin/dashboard/admins/delete/{id}', [DashboardController::class, 'deleteAdmin']);
    Route::get('/en/admin/dashboard/admins/admin/{id}', [DashboardController::class, 'updateAdmin']);
    Route::put('/en/admin/dashboard/admins/admin/{id}', [DashboardController::class, 'editAdmin']);
    Route::delete('/en/admin/dashboard/{id}', [DashboardController::class, 'deleteEnTeacher']);
    Route::delete('/en/admin/dashboard/ar/{id}', [DashboardController::class, 'deleteArTeacher']);
    Route::post('/en/admin/dashboard/{id}/{ln}', [DashboardController::class, 'recover'])->where('id', '[0-9]+');
    Route::delete('/en/admin/dashboard/delete/{id}/{ln}', [DashboardController::class, 'forceDelete']);
    Route::delete('/en/admin/dashboard/trash/deleteAll', [DashboardController::class, 'deleteAll']);
    Route::get('/en/admin/dashboard/addteacher/{ln}', [TeacherController::class, 'index']);
    Route::post('/en/admin/dashboard/addteacher/{ln}', [TeacherController::class, 'addTeacher']);
    Route::get('/en/admin/dashboard/updateteacher/{id}/{ln}', [TeacherController::class, 'updateTeacher']);
    Route::put('/en/admin/dashboard/updateteacher/{id}/{ln}', [TeacherController::class, 'editTeacher']);
    Route::put('/en/admin/dashboard/contact/{id}', [ContactController::class, 'updateContact']);
    Route::get('/en/admin/logout', [DashboardController::class, "logout"]);
});

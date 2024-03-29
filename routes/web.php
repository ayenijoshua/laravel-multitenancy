<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\UserController;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

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
})->middleware(['set.subdomain']);

Route::get('/error', function () {
    return view('errors.tenant-404');
});//->middleware(['set.subdomain']);


Route::get('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('users.logout');


Route::get('companies/{paginate?}',[CompanyController::class, 'all'])->name('companies');

Route::group(['prefix' => 'admin','middleware'=>['auth','set.subdomain']], function () {
    Route::get('dashboard',[UserController::class, 'index'])->name('admin.dashboard');

    Route::get('create-company',[CompanyController::class, 'create'])->name('admin.create-company');
    Route::post('store-company',[CompanyController::class, 'store'])->name('admin.store-company');
    Route::get('companies',[CompanyController::class, 'companies'])->name('admin.companies');
    Route::get('edit-company/{id}',[CompanyController::class, 'edit'])->name('admin.edit-company');
    Route::post('update-company/{id}',[CompanyController::class,'update'])->name('admin.update-company');
    Route::get('company/{id}',[CompanyController::class, 'company'])->name('admin.company');
    Route::delete('delete-company/{id}',[CompanyController::class, 'destroy'])->name('admin.delete-company');

    Route::get('create-user',[UserController::class, 'create'])->name('admin.create-user');
    Route::get('users',[UserController::class, 'users'])->name('admin.users');
    Route::get('all-users',[UserController::class, 'all'])->name('admin.all-users');
    Route::get('user/{id}',[UserController::class, 'user'])->name('admin.user');

    Route::post('store-user',[UserController::class, 'store'])->name('admin.store-user');
    Route::get('edit-user/{id}',[UserController::class, 'edit'])->name('admin.edit-user');
    Route::post('update-user/{id}',[UserController::class, 'update'])->name('admin.update-user');
    Route::delete('delete-user/{id}',[UserController::class, 'destroy'])->name('admin.delete-user');
});

//Route::domain('{subdomain}.localhost')->group(function(){
    
//});

Route::group(['domain'=>'{subdomain}.localhost','prefix' => 'company','middleware'=>['auth:company','set.subdomain']], function(){
    //Route::group(['prefix' => 'company','middleware'=>['auth:company']], function () {
        Route::get('dashboard',[CompanyController::class, 'index'])->name('company.dashboard');
        Route::get('company-employees',[CompanyController::class, 'companyEmployees'])->name('company-employees');
        Route::get('{id}/employees',[CompanyController::class, 'employees'])->name('company.employees');
        Route::get('create-employee',[CompanyController::class, 'createEmployee'])->name('company.create-employee');
        Route::post('store-employee',[CompanyController::class, 'storeEmployee'])->name('company.store-employee');
        Route::get('{id}/show',[CompanyController::class, 'show'])->name('company.show');
        
    //});
   
});

// Route::group(['prefix' => 'employee','middleware'=>['auth']], function () {
//     Route::get('dashboard',[UserController::class, 'userDashboard'])->name('employee.dashboard');
//     Route::get('user/{id}',[UserController::class, 'user'])->name('employee.user');
//     Route::post('update-employee/{id}',[UserController::class, 'update'])->name('employee.update');
// });

require __DIR__.'/auth.php';

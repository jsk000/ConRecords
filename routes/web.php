<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\RegisterCompanyController;
use App\Http\Controllers\EngineerController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\RecordController;
use App\Http\Controllers\CompanyController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
*/

//welcome page
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

//authentication routes
Auth::routes();
Route::resource('register-company', RegisterCompanyController::class);

//following routes are only accessible if the user is authenticated
Route::middleware('auth')->group(function () {

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    
    //company routes
    Route::get('company', [CompanyController::class, 'index'])->name('company.index');
    Route::middleware('company.access')->group(function () {
        Route::get('company/{company}', [CompanyController::class, 'show'])->name('company.show');
        Route::get('company/{company}/edit', [CompanyController::class, 'edit'])->name('company.edit');
        Route::put('company/{company}', [CompanyController::class, 'update'])->name('company.update');
        Route::delete('company/{company}', [CompanyController::class, 'destroy'])->name('company.destroy');
        Route::delete('company/{company}/confirm-delete', [CompanyController::class, 'confirmDelete'])->name('company.confirmDelete');
    });
    
    //engineers routes
    Route::get('engineers', [EngineerController::class, 'index'])->name('engineers.index');
    Route::post('engineers', [EngineerController::class, 'store'])->name('engineers.store');
    Route::get('engineers/create', [EngineerController::class, 'create'])->name('engineers.create');
    Route::get('engineers/{engineer}', [EngineerController::class, 'show'])->name('engineers.show');
    Route::middleware('engineer.access')->group(function () {
        Route::get('engineers/{engineer}/edit', [EngineerController::class, 'edit'])->name('engineers.edit');
        Route::put('engineers/{engineer}', [EngineerController::class, 'update'])->name('engineers.update');
        Route::delete('engineers/{engineer}', [EngineerController::class, 'destroy'])->name('engineers.destroy');
        Route::delete('engineers/{engineer}/confirm-delete', [EngineerController::class, 'confirmDelete'])->name('engineers.confirmDelete');
    });
    
    //records routes
    Route::get('projects/{project}/records', [RecordController::class, 'index'])->name('projects.records.index');
    Route::get('projects/{project}/records/create', [RecordController::class, 'create'])->name('projects.records.create');
    Route::post('projects/{project}/records', [RecordController::class, 'store'])->name('projects.records.store');
    Route::middleware('record.access')->group(function () {
        Route::get('projects/{project}/records/{record}', [RecordController::class, 'show'])->name('projects.records.show');
        Route::get('projects/{project}/records/{record}/edit', [RecordController::class, 'edit'])->name('projects.records.edit');
        Route::put('projects/{project}/records/{record}', [RecordController::class, 'update'])->name('projects.records.update');
        Route::delete('projects/{project}/records/{record}', [RecordController::class, 'destroy'])->name('projects.records.destroy');
        Route::delete('records/{project}/records/{record}/confirm-delete', [RecordController::class, 'confirmDelete'])->name('projects.records.confirmDelete');
    });
    
    //projects routes
    Route::get('projects', [ProjectController::class, 'index'])->name('projects.index');
    Route::get('projects/create', [ProjectController::class, 'create'])->name('projects.create');
    Route::post('projects', [ProjectController::class, 'store'])->name('projects.store');
    Route::get('projects/{project}', [ProjectController::class, 'show'])->name('projects.show');
    Route::middleware('project.access')->group(function () {
        Route::get('projects/{project}/edit', [ProjectController::class, 'edit'])->name('projects.edit');
        Route::put('projects/{project}', [ProjectController::class, 'update'])->name('projects.update');
        Route::delete('projects/{project}', [ProjectController::class, 'destroy'])->name('projects.destroy');
        Route::delete('projects/{project}/confirm-delete', [ProjectController::class, 'confirmDelete'])->name('projects.confirmDelete');
    });
    
});


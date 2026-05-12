<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\ArchiveController;
use App\Http\Controllers\AdminController;
//use App\Http\Controllers\SearchController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\UserController;  


    Route::get('/', function () {
    return view('welcome');
});
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
 // )};
   Route::middleware(['auth', \App\Http\Middleware\Redirect::class])->group(function () {
    Route::get('/dashboard', function () {
        // Cette partie ne sera techniquement jamais atteinte car le middleware redirige avant
    })->name('dashboard');
    Route::get('/agent/dashboard', [AgentController::class, 'index'])->name('agent.dashboard');
    //Route::get('/chef/dashboard', [ChefController::class, 'index'])->name('chef.dashboard');
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
 });
    // 4. ESPACE AGENT (Opérations d'archivage)
    Route::middleware(['auth', 'role:agent'])->prefix('agent')->name('agent.')->group(function () {
    Route::get('/dashboard', [AgentController::class, 'index'])->name('dashboard');

    // Documents
        Route::controller(DocumentController::class)->group(function () {
        Route::get('/documents', 'index')->name('document.index');
        Route::get('/documents/creer', 'create')->name('document.create');
        Route::post('/documents', 'store')->name('document.store');
        Route::get('/documents/{id}', 'show')->name('document.show');
        Route::put('/documents/{id}/editer', 'edit')->name('document.edit');
        Route::delete('/documents/{id}', 'destroy')->name('document.destroy');
        Route::get('/historiques', 'history')->name('history');
    });

    // Archives
        Route::controller(ArchiveController::class)->group(function () {
        Route::get('/archives', 'index')->name('archive.index');
        Route::post('/archives', 'store')->name('archive.store');
        Route::get ('/archives/creer', 'create')->name('archive.create');
        });
});
// 2. ESPACE ADMINISTRATEUR (Gestion globale)
    Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
        Route::resource('users', UserController::class);
        Route::resource('services', ServiceController::class);
        });

// 3. ESPACE CHEF DE SERVICE (Supervision du service)
        // Route::middleware(['auth', 'role:chef'])->prefix('chef')->name('chef.')->group(function () {
        // Route::get('/dashboard', [ChefController::class, 'index'])->name('dashboard');
        // Route::get('/service/agents', [ChefController::class, 'myAgents'])->name('agents');
        // Route::get('/service/historique', [ChefController::class, 'serviceHistory'])->name('history');
        // });
});
require __DIR__.'/auth.php';
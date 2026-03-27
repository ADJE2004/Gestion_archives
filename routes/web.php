<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\ArchiveController;
use App\Http\Controllers\AdminController;


    Route::get('/', function () {
    return view('welcome');
});
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

    Route::get('/dashboard', function () {
    $user = auth()->user();
    if ($user->role === 'admin') return redirect()->route('admin.dashboard');
    if ($user->role === 'chef') return redirect()->route('chef.dashboard');
    return redirect()->route('agent.dashboard');
    })->middleware(['auth'])->name('dashboard');
 
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
      //  Route::put('/documents/{id}', 'update')->name('document.update');
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
    Route::get('/users', [AdminController::class, 'manageUsers'])->name('users.index');
//     Route::get('/services', [AdminController::class, 'manageServices'])->name('services.index');
//     Route::get('/audit-logs', [AdminController::class, 'globalHistory'])->name('history');
 });

// 3. ESPACE CHEF DE SERVICE (Supervision du service)
        // Route::middleware(['auth', 'role:chef'])->prefix('chef')->name('chef.')->group(function () {
        // Route::get('/dashboard', [ChefController::class, 'index'])->name('dashboard');
        // Route::get('/service/agents', [ChefController::class, 'myAgents'])->name('agents');
        // Route::get('/service/historique', [ChefController::class, 'serviceHistory'])->name('history');
        // });

require __DIR__.'/auth.php';
<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\ArchiveController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // --- PROFIL ---
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // --- AGENT & DASHBOARD ---
    Route::get('/agent/dashboard', [AgentController::class, 'index'])->name('agent.dashboard');
    Route::get('/agent/historiques', [AgentController::class, 'historiques'])->name('agent.historiques');

    // --- MENU DOCUMENTS (Création/Gestion sur le site) ---
    Route::get('/agent/documents', [DocumentController::class, 'index'])->name('agent.document.index'); 
    Route::get('/agent/documents/creer', [DocumentController::class, 'create'])->name('agent.document.create');
    Route::post('/agent/documents', [DocumentController::class, 'store'])->name('agent.document.store');
    Route::get('/agent/documents/{id}/edit', [DocumentController::class, 'edit'])->name('agent.document.edit');
    Route::put('/agent/documents/{id}', [DocumentController::class, 'update'])->name('agent.document.update');
    Route::delete('/agent/documents/{id}', [DocumentController::class, 'destroy'])->name('agent.document.destroy');
    
    // --- MENU ARCHIVES (Enregistrement de documents existants) ---
    Route::get('/agent/archives', [ArchiveController::class, 'index'])->name('agent.archive.index');
    Route::get('/agent/archives/creer', [ArchiveController::class, 'create'])->name('agent.archive.create');
    Route::post('/agent/archives', [ArchiveController::class, 'store'])->name('agent.archive.store');
});

require __DIR__.'/auth.php';
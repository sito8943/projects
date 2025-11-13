<?php
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [WelcomeController::class, 'index']);
Route::get('projects', [ProjectController::class, 'index'])->name('projects.index');
Route::get('projects/{project}', [ProjectController::class, 'show'])->name('projects.show');

Route::get('tags', [TagController::class, 'index'])->name('tag.index');
Route::post('tags', [TagController::class, 'store'])->name('tag.store');
Route::get('tags/create', [TagController::class, 'create'])->name('tag.create');
Route::get('tags/{tag}/edit', [TagController::class, 'edit'])->name('tag.edit');
Route::put('tags/{tag}', [TagController::class, 'update'])->name('tag.update');
Route::get('tags/{tag}', [TagController::class, 'show'])->name('tag.show');

Route::get('/dashboard', function () {
    return view('userzone.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [App\Http\Controllers\Userzone\ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [App\Http\Controllers\Userzone\ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [App\Http\Controllers\Userzone\ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

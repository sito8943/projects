<?php
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminTagController;
use App\Http\Controllers\AdminProjectController;
use App\Http\Controllers\AdminProjectToggleIsPublishedController;
use App\Http\Controllers\AdminUserController;

Route::get('/', [WelcomeController::class, 'index']);

// Projects (public)
Route::get('projects', [ProjectController::class, 'index'])->name('projects.index');
Route::get('projects/{project}', [ProjectController::class, 'show'])->name('projects.show');

// Authors (public)
Route::get('authors', [AuthorController::class, 'index'])->name('authors.index');
Route::get('authors/{author}', [AuthorController::class, 'show'])->name('authors.show');

Route::get('/dashboard', function () {
    return view('userzone.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::resource('admin/tags', AdminTagController::class)->except(['show'])->middleware('is_admin');
    Route::resource('admin/projects', AdminProjectController::class)->except(['show']);
    Route::resource('admin/users', AdminUserController::class)->middleware('is_admin')->except(['show']);

    Route::get('admin/projects/{project}/toggle-is-published', [AdminProjectToggleIsPublishedController::class, 'toggleIsPublished'])->name('project.toggleIsPublished');


    Route::get('/profile', [App\Http\Controllers\Userzone\ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [App\Http\Controllers\Userzone\ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [App\Http\Controllers\Userzone\ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

<?php
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminTagController;
use App\Http\Controllers\AdminProjectController;
use App\Http\Controllers\AdminProjectToggleIsPublishedController;
use App\Http\Controllers\AdminUserController;

Route::get('/', WelcomeController::class)->name('home');

// Projects (public)
Route::resource('projects', ProjectController::class)->only(['index','show']);
Route::post('projects/{project}/reviews', [ReviewController::class, 'store'])->name('projects.reviews.store');

Route::get('/dashboard', function () {
    return view('userzone.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::name('admin.')->prefix('admin')->middleware('auth')->group(function () {
    Route::resource('projects', AdminProjectController::class)->except(['show']);
    Route::resource('tags', AdminTagController::class)->except(['show'])->middleware('is_admin');
    Route::resource('users', AdminUserController::class)->except(['show'])->middleware('is_admin');

    Route::get('/projects/{project}/toggle-is-published', [AdminProjectToggleIsPublishedController::class, 'toggleIsPublished'])->name('project.publish');


    Route::get('/profile', [App\Http\Controllers\Userzone\ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [App\Http\Controllers\Userzone\ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [App\Http\Controllers\Userzone\ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

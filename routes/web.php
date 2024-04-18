<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ContributionController;
use App\Http\Controllers\CoodinatorController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\Submission_dateController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [UserController::class, 'login'])->name('login');
Route::post('/login', [UserController::class, 'check_login']);
Route::get('/logout', [UserController::class, 'logout'])->name('logout');
Route::get('/guest', [UserController::class, 'guest_login'])->name('guest.login');
Route::post('/guest', [UserController::class, 'check_guest_login']);
Route::group(['prefix' => 'guest'], function () {
    Route::get('BA', [UserController::class, 'BA_index'])->name('guest.BA');
    Route::get('graphics', [UserController::class, 'graphics_index'])->name('guest.graphics');
    Route::get('IT', [UserController::class, 'IT_index'])->name('guest.IT');
});
Route::get('/register', [UserController::class, 'register'])->name('register');
Route::post('/register', [UserController::class, 'check_register']);
Route::group(['prefix' => '/admin', 'middleware' => 'admin'], function () {
    Route::get('/', [AdminController::class, 'home'])->name('admin.home');
    Route::resources([
        'user' => UserController::class,
    ]);
    Route::resources([
        'submission_date' => Submission_dateController::class,
    ]);
    Route::get('/contributions', [AdminController::class, 'showcontribution'])->name('contributions.show');

});
Route::group(['prefix' => '/student', 'middleware' => 'student'], function () {
    Route::get('/', [StudentController::class, 'home'])->name('student.home');
    Route::get('/contributions', [StudentController::class, 'formsubmit'])->name('student.submit')->middleware('checkdl');
    Route::post('/contribution', [StudentController::class, 'store'])->name('contributions.store');
    Route::get('/close', [StudentController::class, 'close'])->name('submission_closed');
    Route::get('/contributions/show', [StudentController::class, 'show'])->name('student.show');
});

Route::group(['prefix' => '/manager', 'middleware' => 'manager'], function () {
    Route::get('/', [ManagerController::class, 'home'])->name('manager.home');
    Route::get('/contribution', [ManagerController::class, 'showcontribution'])->name('manager.contribution');
    Route::get('/contribution/down', [ManagerController::class, 'downloadContributions'])->name('download.contributions');
})->middleware('manager');

Route::group(['prefix' => '/coodinator', 'middleware' => 'coodinator'], function () {
    Route::get('/contribution', [CoodinatorController::class, 'showcontribution'])->name('contribution');
    Route::get('/approvecontribution', [CoodinatorController::class, 'approvecontribution'])->name('contribution.approve');
    Route::get('/rejectedcontribution', [CoodinatorController::class, 'rejectedcontribution'])->name('contribution.rejected');
    Route::put('/contribution/approve/{id}', [ContributionController::class, 'approve'])->name('approve');
    Route::DELETE('/contribution/delete/{id}', [ContributionController::class, 'destroy'])->name('delete');
    Route::put('/contribbution/reject/{id}', [ContributionController::class, 'reject'])->name('reject');
    Route::get('/', [CoodinatorController::class, 'home'])->name('coodinator.home');
})->middleware('coodiinator');

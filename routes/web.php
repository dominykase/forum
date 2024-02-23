<?php

use App\Http\Controllers\Posts\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Threads\ThreadController;
use App\Http\Controllers\Topics\TopicController;
use App\Http\Controllers\Users\UserViewController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/post', [PostController::class, 'store'])->name('post.store');
});

Route::get('/thread/{threadId}/{page}', [ThreadController::class, 'view'])
    ->name('thread')
    ->whereNumber('threadId')
    ->whereNumber('page');

Route::get('/topic/{topicId}/{page}', [TopicController::class, 'get'])
    ->name('topic')
    ->whereNumber('topicId')
    ->whereNumber('page');

Route::get('/user/{username}/{page}', [UserViewController::class, 'showProfile'])
    ->name('profile')
    ->whereNumber('page');

require __DIR__.'/auth.php';

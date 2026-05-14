<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MemberController;

// Redirect home to members list
Route::get('/', [MemberController::class, 'index'])->name('dashboard');

// Members CRUD routes
Route::resource('members', MemberController::class);

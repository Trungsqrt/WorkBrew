<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ListingController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Show all listings
Route::get('/', [ListingController::class, "index"]);

// Show create form
Route::get("/listings/create", [ListingController::class, "create"]);

// Store listing data
Route::post("/listings", [ListingController::class, "store"]);

// Show edit form
Route::get("/listings/{listing}/edit", [ListingController::class, "edit"]);

// Update
Route::patch("/listings/{listing}", [ListingController::class, "update"]);

// Delete
Route::delete("/listings/{listing}", [ListingController::class, "destroy"]);

// Show single listing
Route::get("/listings/{listing}", [ListingController::class, "show"]);

// Register form
Route::get("/register", [UserController::class, 'create']);

// Create New User
Route::post('/users', [UserController::class, 'store']);

// Log User Out
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');

// Log In User
Route::post('/users/authenticate', [UserController::class, 'authenticate']);

// Login form
Route::get("/login", [UserController::class, 'login']);

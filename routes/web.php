<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
}); 
// Route untuk melihat Dashboard Admin
Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
});
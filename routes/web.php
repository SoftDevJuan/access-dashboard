<?php

use App\Http\Livewire\Auth\Login;
use App\Http\Livewire\Auth\Register;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Dashboard;
use App\Http\Livewire\ExampleLaravel\UserManagement;
use App\Http\Livewire\ExampleLaravel\DoorManagement;
use App\Http\Livewire\Tables;
use GuzzleHttp\Middleware;

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

Route::get('/', function(){
    return redirect('sign-in');
});

Route::get('sign-up', Register::class)->name('register');
Route::get('sign-in', Login::class)->name('login');
Route::get('user-management', UserManagement::class)->name('user-management');
Route::get('door-management', DoorManagement::class)->name('door-management');
Route::get('dashboard', Dashboard::class)->name('dashboard');
Route::get('tables', Tables::class)->name('tables');
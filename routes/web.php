<?php

use App\Http\Controllers\{
    EventController,
    HomeController
};
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redirect;
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
    return view('landing.index');
})->name('index');
Route::get('/about', function () {
    return view('landing.about');
})->name('about');
Route::get('/events', function () {
    return view('landing.events');
})->name('landing-events');

Auth::routes();


Route::get('/admin', [HomeController::class, 'index'])->name('admin');

Route::post('/events', [EventController::class, 'storeEvent'])->name('events.store');

Route::get('/livewire/message/dashboard-panels', function () {
    return Redirect::to('/admin?' . request()->getQueryString());
});


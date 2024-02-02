<?php

use App\Http\Controllers\{
    EventsController,
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

Route::get('/', [EventsController::class, 'showEventIndex'])->name('index');
Route::get('/about', [EventsController::class, 'showEventAbout'])->name('about');
Route::get('/events', [EventsController::class, 'showEventEvents'])->name('landing-events');
Route::get('/gallery', function () {
    return view('landing.gallery');
})->name('gallery');
Route::get('/gallery/{id}', function () {
    return view('landing.gallery-view');
})->name('gallery-images');

Route::get('/events/registration', function () {
    return view('welcome');
})->name('register-event');

Auth::routes();


Route::get('/admin', [HomeController::class, 'index'])->name('admin');

Route::post('/events', [EventController::class, 'storeEvent'])->name('events.store');

Route::get('/livewire/message/dashboard-panels', function () {
    return Redirect::to('/admin?' . request()->getQueryString());
});


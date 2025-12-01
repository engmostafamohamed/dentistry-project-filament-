<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Website\GuestController;
use App\Http\Controllers\website\HomeController;
use App\Http\Controllers\Website\OfferController;
// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', fn() => view('website.about'))->name('about');
Route::get('/services', fn() => view('website.services'))->name('services');
Route::get('/contact', fn() => view('website.contact'))->name('contact');


Route::post('/guest/offer', [GuestController::class, 'storeOffer'])->name('guest.offer');
Route::post('/check-phone', [OfferController::class, 'checkPhone'])
    ->name('guest.offer.checkPhone');

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Website\GuestController;
use App\Http\Controllers\website\HomeController;
use App\Http\Controllers\Website\OfferController;
// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/available-times', [HomeController::class, 'getAvailableTimes'])->name('available.times');
Route::get('/pages', fn() => view('website.testimonials'))->name('testimonials');
Route::get('/dentists', fn() => view('website.dentists'))->name('dentists');
Route::prefix('services')->group(function () {
    Route::get('/', fn() => view('website.services'))->name('services');
    Route::get('/general-dentistry', fn() => view('website.service-general-dentistry'))->name('services.general');
    Route::get('/cosmetic-dentistry', fn() => view('website.service-cosmetic-dentistry'))->name('services.cosmetic');
    Route::get('/pediatric-dentistry', fn() => view('website.service-pediatric-dentistry'))->name('services.pediatric');
    Route::get('/restorative-dentistry', fn() => view('website.service-restorative-dentistry'))->name('services.restorative');
    Route::get('/preventive-dentistry', fn() => view('website.service-preventive-dentistry'))->name('services.preventive');
    Route::get('/orthodontics', fn() => view('website.service-orthodontics'))->name('services.orthodontics');
});
Route::prefix('pages')->group(function () {
    Route::get('/', fn() => view('website.pages'))->name('pages');
    Route::get('/about-us', fn() => view('website.about'))->name('pages.about');
    Route::get('/faq', fn() => view('website.faq'))->name('pages.faq');
    Route::get('/gallery', fn() => view('website.gallery'))->name('pages.gallery');
    Route::get('/testimonials', fn() => view('website.testimonials'))->name('pages.testimonials');
});
Route::get('/blog', fn() => view('website.blog'))->name('blog');
Route::get('/contact', fn() => view('website.contact'))->name('contact');
Route::get('/booking', fn() => view('website.booking'))->name('booking');

Route::post('/guest/offer', [GuestController::class, 'storeOffer'])->name('guest.offer');
Route::post('/check-phone', [OfferController::class, 'checkPhone'])
    ->name('guest.offer.checkPhone');

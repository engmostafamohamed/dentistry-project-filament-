<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Website\GuestController;
use App\Http\Controllers\website\HomeController;
use App\Http\Controllers\Website\OfferController;
use App\Http\Controllers\Api\GuestCalenderController;
use App\Models\Guest;
use App\Models\Doctor;





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

Route::prefix('admin')
    ->middleware(['web', 'auth'])
    ->group(function () {
        Route::get('/guests-calendar', [GuestCalenderController::class, 'index']);
        Route::get('/doctors', [GuestCalenderController::class, 'doctors']);
        Route::post('/assign-guest/{guest}', [GuestCalenderController::class, 'assign']);
    });

    Route::prefix('admin/guests/calendar')->middleware(['auth'])->group(function () {
        // Get doctors (resources)
        Route::get('/resources', function () {
            return Doctor::where('is_active', true)
                ->get()
                ->map(function ($doctor) {
                    return [
                        'id' => $doctor->id,
                        'title' => $doctor->name,
                    ];
                });
        });

        // Get appointments (events)
        Route::get('/events', function () {
            return Guest::with('doctor')
                ->whereNotNull('doctor_id')
                ->whereNotNull('appointment_date')
                ->get()
                ->map(function ($guest) {
                    return [
                        'id' => $guest->id,
                        'title' => $guest->name,
                        'start' => $guest->appointment_date,
                        'end' => $guest->appointment_end_date ?? \Carbon\Carbon::parse($guest->appointment_date)->addHour(),
                        'resourceId' => $guest->doctor_id,
                        'backgroundColor' => match($guest->status ?? 'pending') {
                            'paid' => '#10b981',
                            'cancelled' => '#ef4444',
                            default => '#f59e0b'
                        }
                    ];
                });
        });

        // Assign guest to doctor
        Route::post('/assign', function () {
            $data = request()->validate([
                'guest_id' => 'required|exists:guests,id',
                'doctor_id' => 'required|exists:doctors,id',
                'start_time' => 'required|date',
            ]);

            $guest = Guest::find($data['guest_id']);
            $guest->update([
                'doctor_id' => $data['doctor_id'],
                'appointment_date' => $data['start_time'],
            ]);

            return response()->json(['success' => true]);
        });

        // Update appointment
        Route::post('/update', function () {
            $data = request()->validate([
                'event_id' => 'required|exists:guests,id',
                'doctor_id' => 'nullable|exists:doctors,id',
                'start_time' => 'required|date',
                'end_time' => 'nullable|date',
            ]);

            $guest = Guest::find($data['event_id']);
            $guest->update([
                'doctor_id' => $data['doctor_id'],
                'appointment_date' => $data['start_time'],
                'appointment_end_date' => $data['end_time'],
            ]);

            return response()->json(['success' => true]);
        });
    });


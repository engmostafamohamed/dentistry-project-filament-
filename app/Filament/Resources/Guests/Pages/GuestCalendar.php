<?php

namespace App\Filament\Resources\Guests\Pages;
use BackedEnum;
use UnitEnum;
use App\Filament\Resources\Guests\GuestResource;
use Filament\Resources\Pages\Page;
use Filament\Support\Icons\Heroicon;
use App\Models\Guest;
use App\Models\Doctor;
class GuestCalendar extends Page
{
    protected static string $resource = GuestResource::class;
    protected static string|BackedEnum|null $navigationIcon = Heroicon::Calendar;
    protected string $view = 'filament.resources.guests.pages.guest-calendar';
    protected static string|UnitEnum|null $navigationGroup = 'Clinic';
    protected static ?string $title = 'Guest Calendar';

    /** @var \Illuminate\Support\Collection<int, \App\Models\Doctor> */
    public $doctors;

    /** @var \Illuminate\Support\Collection<int, \App\Models\Guest> */
    public $guests;

    public function mount()
    {
        $this->doctors = Doctor::where('is_active', true)->get();
        $this->guests = Guest::with('doctor')->get();
    }

    protected function getViewData(): array
    {
        return [
            'doctors' => $this->doctors,
            'guests' => $this->guests,
        ];
    }

}

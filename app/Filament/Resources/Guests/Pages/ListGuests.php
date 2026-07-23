<?php

namespace App\Filament\Resources\Guests\Pages;

use App\Filament\Resources\Guests\GuestResource;
use App\Models\Doctor;
use App\Models\Guest;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
// use Filament\Schemas\Components\Tabs\Tab;
use Illuminate\Contracts\Support\Htmlable;
class ListGuests extends ListRecords
{
    protected static string $resource = GuestResource::class;

    // protected string $view = 'filament.resources.guests.pages.list-guests';

    public $doctors;
    public $guests;

        public function getTitle(): string|Htmlable
    {
        return __('Patient Directory');
    }

    public function getSubheading(): string|Htmlable|null
    {
        $total = Guest::count();
        return __('Managing :total total registered patients across all clinics', ['total' => number_format($total)]);
    }
    public function mount(): void
    {
        parent::mount();

        $this->loadData();
    }

    protected function loadData(): void
    {
        $this->doctors = Doctor::query()
            ->where('is_active', true)
            ->get();

        $this->guests = Guest::query()
            ->with('doctor')
            ->get();
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    // ─── Stats widgets above the table ───────────────────────────────────────
    protected function getHeaderWidgets(): array
    {
        return [
            \App\Filament\Widgets\PatientStatsOverview::class,
        ];
    }

    // ─── Pass extra data to the default Filament list view ───────────────────
    protected function getViewData(): array
    {
        return array_merge(parent::getViewData(), [
            'doctors'   => $this->doctors,
            'guests'    => $this->guests,
        ]);
    }
}


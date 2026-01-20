<?php

namespace App\Filament\Resources\Guests\Pages;

use App\Filament\Resources\Guests\GuestResource;
use App\Models\Doctor;
use App\Models\Guest;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;

class ListGuests extends ListRecords
{
    protected static string $resource = GuestResource::class;

    protected string $view = 'filament.resources.guests.pages.list-guests';

    public $doctors;
    public $guests;

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

    /**
     * Filament v3 tabs
     */
    public function getTabs(): array
    {
        return [
            'list' => Tab::make(__('Guests List'))
                ->icon('heroicon-o-list-bullet'),

            'calendar' => Tab::make(__('Calendar'))
                ->icon('heroicon-o-calendar'),
        ];
    }

    protected function getViewData(): array
    {
        return array_merge(parent::getViewData(), [
            'doctors'   => $this->doctors,
            'guests'    => $this->guests,
            'activeTab' => $this->activeTab ?? 'list',
        ]);
    }
}

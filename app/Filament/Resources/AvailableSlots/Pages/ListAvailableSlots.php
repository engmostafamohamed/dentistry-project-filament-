<?php

namespace App\Filament\Resources\AvailableSlots\Pages;

use App\Filament\Resources\AvailableSlots\AvailableSlotResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListAvailableSlots extends ListRecords
{
    protected static string $resource = AvailableSlotResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}

<?php

namespace App\Filament\Resources\AvailableSlots\Pages;

use App\Filament\Resources\AvailableSlots\AvailableSlotResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditAvailableSlot extends EditRecord
{
    protected static string $resource = AvailableSlotResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}

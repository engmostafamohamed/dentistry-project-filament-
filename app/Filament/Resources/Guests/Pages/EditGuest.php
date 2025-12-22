<?php

namespace App\Filament\Resources\Guests\Pages;

use App\Filament\Resources\Guests\GuestResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditGuest extends EditRecord
{
    protected static string $resource = GuestResource::class;
    protected ?string $maxFormWidth = 'full';
    protected function getRedirectUrl(): ?string
    {
        return $this->getResource()::getUrl('index');
    }
    protected function getHeaderActions(): array
    {
        return [
            // DeleteAction::make(),
        ];
    }
}

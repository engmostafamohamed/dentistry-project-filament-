<?php

namespace App\Filament\Resources\Guests\Pages;

use App\Filament\Resources\Guests\GuestResource;
use App\Models\Branch;
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
    protected function mutateFormDataBeforeFill(array $data): array
    {
        $record = $this->getRecord();

        if ($record->branch_id) {
            $branch = Branch::find($record->branch_id);
            if (isset($branch)) {
                $data['region_id']  = $branch->region_id;
                $data['country_id'] = $branch->country_id;
                $data['branch_id']  = $branch->id;
            }
        }
        return $data;
    }
}

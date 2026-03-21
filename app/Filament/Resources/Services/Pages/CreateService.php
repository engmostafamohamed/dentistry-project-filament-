<?php

namespace App\Filament\Resources\Services\Pages;

use App\Filament\Resources\Services\ServiceResource;
use Filament\Resources\Pages\CreateRecord;

class CreateService extends CreateRecord
{
    protected static string $resource = ServiceResource::class;
    protected function getRedirectUrl(): string
    {
        // Redirect to the staff table (index page) after creating
        return $this->getResource()::getUrl('index');
    }
    /**
     * Mutate form data before creating
     */
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Handle image upload
        if (isset($data['image']) && is_object($data['image'])) {
            $data['image'] = $data['image']->store('services', 'public');
        }

        return $data;
    }
}

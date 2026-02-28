<?php

namespace App\Filament\Resources\Staff\Pages;

use App\Filament\Resources\Staff\StaffResource;
use Filament\Resources\Pages\CreateRecord;

class CreateStaff extends CreateRecord
{
    protected static string $resource = StaffResource::class;


    protected function getRedirectUrl(): string
    {
        // Redirect to the staff table (index page) after creating
        return $this->getResource()::getUrl('index');
    }
}

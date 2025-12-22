<?php

namespace App\Filament\Resources\AvailableSlots\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Schemas\Schema;

class AvailableSlotForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                DatePicker::make('date')
                    ->required(),
                TimePicker::make('time')
                    ->required(),
                TextInput::make('max_bookings')
                    ->required()
                    ->numeric()
                    ->default(3),
                DatePicker::make('expected_date'),
                TimePicker::make('expected_time'),
            ]);
    }
}

<?php

namespace App\Filament\Resources\Guests\Schemas;

use App\Models\Section;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\ToggleButtons;
class GuestForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make(__('filament-language-switcher::guests.heading'))
                ->columns(2)
                ->schema([
                    TextInput::maker('name')
                        ->label(__('filament-language-switcher::guests.name'))
                        ->disabled(),
                    TextInput::make('phone')
                        ->label(__('filament-language-switcher::guests.phone'))
                        ->disabled(),
                    TextInput::make('branch.name')
                        ->label(__('filament-language-switcher::guests.branch')),
                    TextInput::make('offer.title->en')
                        ->label(__('filament-language-switcher::guests.offer')),
                    TextInput::make('service.title->en')
                        ->label(__('filament-language-switcher::guests.service')),
                    Select::make('doctor_id')
                        ->label(__('filament-language-switcher::guests.doctor_name'))
                        ->relationship('doctor', 'name')
                        ->searchable()
                        ->required(),

                    ToggleButtons::make('status')
                        ->label(__('filament-language-switcher::guests.status'))
                        ->inline()
                        ->options([
                            'new' => __('filament-language-switcher::guests.new'),
                            'paid' => __('filament-language-switcher::guests.paid'),
                            'cancelled' => __('filament-language-switcher::guests.cancelled'),
                        ])
                        ->colors([
                            'new' => 'primary',
                            'paid' => 'success',
                            'cancelled' => 'danger',
                        ])
                        ->required(),
                ])
            ]);
    }
}

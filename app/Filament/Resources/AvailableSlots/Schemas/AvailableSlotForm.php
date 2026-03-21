<?php

namespace App\Filament\Resources\AvailableSlots\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Textarea;


class AvailableSlotForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('day_name')
                    ->label(__('filament-language-switcher::availableSlot.day_name'))
                    ->options([
                        'Monday' => __('filament-language-switcher::availableSlot.days.Monday'),
                        'Tuesday' => __('filament-language-switcher::availableSlot.days.Tuesday'),
                        'Wednesday' => __('filament-language-switcher::availableSlot.days.Wednesday'),
                        'Thursday' => __('filament-language-switcher::availableSlot.days.Thursday'),
                        'Friday' => __('filament-language-switcher::availableSlot.days.Friday'),
                        'Saturday' => __('filament-language-switcher::availableSlot.days.Saturday'),
                        'Sunday' => __('filament-language-switcher::availableSlot.days.Sunday'),
                    ])
                    ->reactive()
                    ->afterStateUpdated(fn($state, callable $set) => $set('day_of_week', match($state) {
                        'Monday' => 1,
                        'Tuesday' => 2,
                        'Wednesday' => 3,
                        'Thursday' => 4,
                        'Friday' => 5,
                        'Saturday' => 6,
                        'Sunday' => 7,
                        default => null,
                    }))
                    ->helperText(__('filament-language-switcher::availableSlot.helper_day'))
                    ->columnSpan(1),

                Hidden::make('day_of_week'),

                DatePicker::make('date')
                    ->label(__('filament-language-switcher::availableSlot.specific_date'))
                    ->helperText(__('filament-language-switcher::availableSlot.helper_recurring'))
                    ->columnSpan(1),

                Select::make('type')
                    ->label(__('filament-language-switcher::availableSlot.type'))
                    ->options([
                        'normal' => __('filament-language-switcher::availableSlot.types.normal'),
                        'off' => __('filament-language-switcher::availableSlot.types.off'),
                        'holiday' => __('filament-language-switcher::availableSlot.types.holiday'),
                    ])
                    ->default('normal')
                    ->reactive(),

                TextInput::make('max_bookings')
                    ->numeric()
                    ->default(3)
                    ->label(__('filament-language-switcher::availableSlot.max_bookings'))
                    ->visible(fn($get) => $get('type') === 'normal'),

                TimePicker::make('opening_time')
                    ->label(__('filament-language-switcher::availableSlot.opening_time'))
                    ->visible(fn($get) => $get('type') === 'normal'),

                TimePicker::make('closing_time')
                    ->label(__('filament-language-switcher::availableSlot.closing_time'))
                    ->visible(fn($get) => $get('type') === 'normal'),

                Toggle::make('is_active')
                    ->label(__('filament-language-switcher::availableSlot.is_active'))
                    ->default(true),

                Toggle::make('is_blocked')
                    ->label(__('filament-language-switcher::availableSlot.is_blocked'))
                    ->default(false),

                Textarea::make('note')
                    ->label(__('filament-language-switcher::availableSlot.notes'))
                    ->rows(2)
                    ->columnSpanFull(),
            ]);
    }
}

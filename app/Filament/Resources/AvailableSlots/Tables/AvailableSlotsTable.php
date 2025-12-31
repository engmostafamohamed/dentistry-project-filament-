<?php

namespace App\Filament\Resources\AvailableSlots\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\IconColumn;
class AvailableSlotsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('day_name')
                    ->label(__('filament-language-switcher::availableSlot.day_name'))
                    ->sortable(),
                TextColumn::make('date')
                    ->date()
                    ->label(__('filament-language-switcher::availableSlot.date'))
                    ->sortable(),
                TextColumn::make('opening_time')
                    ->time()
                    ->label(__('filament-language-switcher::availableSlot.opening_time'))
                    ->sortable(),
                TextColumn::make('closing_time')
                    ->time()
                    ->label(__('filament-language-switcher::availableSlot.closing_time'))
                    ->sortable(),
                BadgeColumn::make('type')
                    ->colors([
                        'success' => 'normal',
                        'danger' => 'holiday',
                        'gray' => 'off',
                    ])
                    ->label(__('filament-language-switcher::availableSlot.type'))
                    ->sortable(),
                TextColumn::make('max_bookings')
                    ->label(__('filament-language-switcher::availableSlot.max_bookings'))
                    // ->numeric()
                    ->sortable(),
                TextColumn::make('current_bookings')
                    ->label(__('filament-language-switcher::availableSlot.current_bookings'))
                    // ->numeric()
                    ->sortable(),
                IconColumn::make('is_active')
                    ->boolean()
                    ->label(__('filament-language-switcher::availableSlot.is_active')),

                IconColumn::make('is_blocked')
                    ->boolean()
                    ->label(__('filament-language-switcher::availableSlot.is_blocked')),
                TextColumn::make('note')
                    ->label(__('filament-language-switcher::availableSlot.notes'))
                    ->limit(30)
                    ->toggleable(),

                TextColumn::make('created_at')
                    ->dateTime()

                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}

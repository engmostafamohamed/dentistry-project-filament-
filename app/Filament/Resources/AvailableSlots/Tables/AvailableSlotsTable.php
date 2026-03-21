<?php

namespace App\Filament\Resources\AvailableSlots\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

use function Termwind\terminal;

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
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable()
                    ->sortable(),
                TextColumn::make('current_bookings')
                    ->label(__('filament-language-switcher::availableSlot.current_bookings'))
                    // ->numeric()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable()
                    ->sortable(),
                IconColumn::make('is_active')
                    ->boolean()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable()
                    ->sortable()
                    ->label(__('filament-language-switcher::availableSlot.is_active')),

                IconColumn::make('is_blocked')
                    ->boolean()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable()
                    ->sortable()
                    ->label(__('filament-language-switcher::availableSlot.is_blocked')),
                TextColumn::make('note')
                    ->label(__('filament-language-switcher::availableSlot.notes'))
                    ->limit(30)
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable()
                    ->sortable(),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                TrashedFilter::make(),
                // Example of a ternary filter for the 'type' column
                TernaryFilter::make('type')
                    ->label(__('filament-language-switcher::availableSlot.type'))
                    ->trueLabel(__('filament-language-switcher::availableSlot.normal'))
                    ->falseLabel(__('filament-language-switcher::availableSlot.holiday')),

                TernaryFilter::make('is_active')
                    ->label(__('filament-language-switcher::availableSlot.is_active'))
                    ->trueLabel(__('filament-language-switcher::availableSlot.active'))
                    ->falseLabel(__('filament-language-switcher::availableSlot.inactive')),

                TernaryFilter::make('is_blocked')
                    ->label(__('filament-language-switcher::availableSlot.is_blocked'))
                    ->trueLabel(__('filament-language-switcher::availableSlot.blocked'))
                    ->falseLabel(__('filament-language-switcher::availableSlot.unblocked')),

                TernaryFilter::make('is_deleted')
                    ->label(__('filament-language-switcher::availableSlot.deletedStatus'))
                    ->trueLabel(__('filament-language-switcher::availableSlot.deleted'))
                    ->falseLabel(__('filament-language-switcher::availableSlot.notDeleted')),
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

<?php

namespace App\Filament\Resources\Guests\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
class GuestsTable
{
    public static function configure(Table $table): Table
    {

        return $table
            ->columns([
                TextColumn::make('name')->label(__('filament-language-switcher::guests.name'))->searchable(),
                TextColumn::make('phone')->label(__('filament-language-switcher::guests.phone')),
                TextColumn::make('branch.name')->label(__('filament-language-switcher::guests.branch')),
                TextColumn::make('offer.title->en')->label(__('filament-language-switcher::guests.offer')),
                TextColumn::make('service.title->en')->label(__('filament-language-switcher::guests.service')),
                TextColumn::make('doctor.name->en')->label(__('filament-language-switcher::guests.doctor_name')),

                BadgeColumn::make('status')
                    ->label(__('filament-language-switcher::guests.status'))
                    ->colors([
                        'primary' => 'new',
                        'danger' => 'cancelled',
                        'success' => 'paid',
                    ]),

                TextColumn::make('created_at')
                    ->label(__('filament-language-switcher::guests.created_at'))
                    ->dateTime(),
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
            ])->emptyStateHeading(__('filament-language-switcher::guests.no_guests'));
    }
}

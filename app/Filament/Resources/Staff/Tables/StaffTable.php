<?php

namespace App\Filament\Resources\Staff\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
class StaffTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Name')
                    ->sortable()
                    ->searchable()
                    ->description(fn($record) => $record->position['en'] ?? '')
                    ->icon('heroicon-o-user'),
                TextColumn::make('email')
                    ->label('Contact')
                    ->icon('heroicon-o-envelope')
                    ->copyable(),
                TextColumn::make('availableSlots')
                    ->label('Working Days')
                    ->formatStateUsing(fn($record) => collect($record->availableSlots)->pluck('day_name')->join(', ')),
                TextColumn::make('services_count')
                    ->counts('services')
                    ->label('Assigned Treatments'),
                // TextColumn::make('type')
                //     ->badge()
                //     ->color(fn($state) => $state === 'full-time' ? 'success' : 'warning'),
            ])
            ->filters([
                TrashedFilter::make(),
            ])->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ]);
    }
}

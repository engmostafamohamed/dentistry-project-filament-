<?php

namespace App\Filament\Resources\Staff\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ViewColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Illuminate\Support\Str;

class StaffTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([

                // Photo + Name + Specialty — use real 'name' column so search/sort works
                ViewColumn::make('name')
                    ->label(__('Name'))
                    ->view('filament.tables.columns.staff-info')
                    ->searchable()
                    ->sortable(),

                // Contact info — use real 'phone' column as anchor
                ViewColumn::make('phone')
                    ->label(__('Contact'))
                    ->view('filament.tables.columns.contact')
                    ->searchable(),

                // Working days — use relationship name as anchor
                ViewColumn::make('availableSlots')
                    ->label(__('Working Days'))
                    ->view('filament.tables.columns.working-days'),

                // Assigned Treatments
                TextColumn::make('services_list')
                    ->label(__('Assigned Treatments'))
                    ->getStateUsing(fn($record) =>
                        collect($record->services)->pluck('title')->take(2)->join(', ') .
                        (collect($record->services)->count() > 2
                            ? ' +' . (collect($record->services)->count() - 2)
                            : '')
                    )
                    ->tooltip(fn($record) => collect($record->services)->pluck('title')->join(', '))
                    ->wrap(),

                // Type Badge — TextColumn with ->badge() replaces deprecated BadgeColumn in Filament v3
                TextColumn::make('type')
                    ->label(__('Type'))
                    ->badge()
                    ->color(fn($state) => match (strtolower($state ?? '')) {
                        'full-time' => 'success',
                        'part-time' => 'warning',
                        default     => 'gray',
                    })
                    ->formatStateUsing(fn($state) => Str::headline($state ?? 'part-time')),
            ])
            ->filters([
                TrashedFilter::make(),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ])
            ->paginated([10, 25, 50])
            ->defaultSort('name');

    }
}

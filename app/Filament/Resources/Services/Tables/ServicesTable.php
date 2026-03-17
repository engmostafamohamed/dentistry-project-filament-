<?php

namespace App\Filament\Resources\Services\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ViewColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TernaryFilter;
class ServicesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                // Service image mage/Avatar
                ViewColumn::make('image')
                    ->label(__('filament-language-switcher::services.image'))
                    ->view('filament.tables.columns.services.service-avatar'),

                // Service title with localization support
                TextColumn::make('title')
                    ->label(__('filament-language-switcher::services.serviceName'))
                    ->searchable()
                    ->sortable()
                    ->getStateUsing(function($record) {

                        $title = is_array($record->title) ? $record->title : json_decode($record->title, true);
                        if (!is_array($title)) return '-';

                        $locale = substr(app()->getLocale(), 0, 2);
                        $primary = $title[$locale] ?? null;
                        $fallback = $locale === 'ar' ? ($title['en'] ?? null) : ($title['ar'] ?? null);

                        return $primary ?? $fallback ?? '-';
                    })
                    ->weight('semibold'),
                //service description
                TextColumn::make('description')
                    ->label(__('filament-language-switcher::services.description'))
                    ->limit(50)
                    ->getStateUsing(function ($record) {
                        $locale = app()->getLocale();
                        $description = is_array($record->description)
                            ? $record->description
                            : json_decode($record->description, true);
                        return $description[$locale] ?? $description['en'] ?? '';
                    })
                    ->tooltip(function ($record) {
                        $locale = app()->getLocale();
                        $description = is_array($record->description)
                            ? $record->description
                            : json_decode($record->description, true);
                        return $description[$locale] ?? $description['en'] ?? '';
                    })
                    ->wrap()
                    ->color('gray'),

                // Service active status
                IconColumn::make('is_active')
                    ->label(__('filament-language-switcher::services.activeStatus'))
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger')
                    ->searchable()
                    ->sortable(),

                // assigned doctors count and list
                ViewColumn::make('doctors')
                    ->label(__('filament-language-switcher::services.assignedDoctors'))
                    ->view('filament.tables.columns.services.assigned-doctors')
                    ->searchable(),

                // assigned offers count and list
                ViewColumn::make('offers')
                    ->label(__('filament-language-switcher::services.assignedOffers'))
                    ->view('filament.tables.columns.services.assigned-offers')
                    ->searchable(),

                // service created at and last updated at
                ViewColumn::make('created_at')
                    ->label(__('filament-language-switcher::services.createdAt'))
                    ->view('filament.tables.columns.created-at')
                    ->searchable()
                    ->sortable(),

                ViewColumn::make('updated_at')
                    ->label(__('filament-language-switcher::services.updatedAt'))
                    ->view('filament.tables.columns.updated-at')
                    ->searchable()
                    ->sortable(),


            ])
            ->filters([
                TrashedFilter::make(),
                TernaryFilter::make('is_active')
                    ->label(__('filament-language-switcher::services.activeStatus'))
                    ->trueLabel(__('Active'))
                    ->falseLabel(__('Inactive')),
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

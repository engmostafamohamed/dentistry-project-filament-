<?php

namespace App\Filament\Resources\Services\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\RestoreAction;
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
                    ->view('filament.tables.columns.services.service-avatar')
                    ->toggleable(),

                // Service title with localization support
                TextColumn::make('title')
                    ->label(__('filament-language-switcher::services.serviceName'))
                    ->searchable()
                    ->sortable()
                    ->getStateUsing(fn($record) => $record->getTranslatedTitle())
                    ->weight('semibold')
                    ->wrap()
                    ->tooltip(function ($record) {
                        $locale = app()->getLocale();
                        $title = is_array($record->title)
                            ? $record->title
                            : json_decode($record->title, true);
                        return $title[$locale] ?? $title['en'] ?? '';
                    })
                    ->toggleable(),
                //service description
                TextColumn::make('description')
                    ->label(__('filament-language-switcher::services.description'))
                    ->limit(50)
                    ->getStateUsing(fn($record) => $record->getTranslatedDescription())
                    ->tooltip(function ($record) {
                        $locale = app()->getLocale();
                        $description = is_array($record->description)
                            ? $record->description
                            : json_decode($record->description, true);
                        return $description[$locale] ?? $description['en'] ?? '';
                    })
                    ->wrap()
                    ->color('gray')
                    ->sortable(),

                // Service active status
                IconColumn::make('is_active')
                    ->label(__('filament-language-switcher::services.activeStatus'))
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger')
                    ->sortable()
                    ->toggleable(),

                // assigned doctors count and list
                ViewColumn::make('doctors')
                    ->label(__('filament-language-switcher::services.assignedDoctors'))
                    ->view('filament.tables.columns.services.assigned-doctors')
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                // assigned offers count and list
                ViewColumn::make('offers')
                    ->label(__('filament-language-switcher::services.assignedOffers'))
                    ->view('filament.tables.columns.services.assigned-offers')
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                // service created at and last updated at
                ViewColumn::make('created_at')
                    ->label(__('filament-language-switcher::services.createdAt'))
                    ->view('filament.tables.columns.created-at')
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                ViewColumn::make('updated_at')
                    ->label(__('filament-language-switcher::services.updatedAt'))
                    ->view('filament.tables.columns.updated-at')
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),


            ])
            ->filters([
                TrashedFilter::make(),

                TernaryFilter::make('is_active')
                    ->label(__('filament-language-switcher::services.activeStatus'))
                    ->trueLabel(__('filament-language-switcher::services.active'))
                    ->falseLabel(__('filament-language-switcher::services.inactive')),

                TernaryFilter::make('doctors')
                    ->label(__('filament-language-switcher::services.assignedDoctors'))
                    ->trueLabel(__('filament-language-switcher::services.withDoctors'))
                    ->falseLabel(__('filament-language-switcher::services.withoutDoctors')),

                TernaryFilter::make('offers')
                    ->label(__('filament-language-switcher::services.assignedOffers'))
                    ->trueLabel(__('filament-language-switcher::services.withOffers'))
                    ->falseLabel(__('filament-language-switcher::services.withoutOffers')),


            ])
            ->recordActions([
                EditAction::make(),
                ViewAction::make(),
                DeleteAction::make(),
                RestoreAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    // ForceDeleteBulkAction::make(),
                    // RestoreBulkAction::make(),
                ]),
            ]);
    }
}

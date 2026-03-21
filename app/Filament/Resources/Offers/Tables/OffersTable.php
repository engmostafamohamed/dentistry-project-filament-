<?php

namespace App\Filament\Resources\Offers\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class OffersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
               ImageColumn::make('image')
                    ->label(__('filament-language-switcher::offer.offerImage'))
                    ->view('filament.tables.columns.offers.offer-avatar')
                    ->toggleable(),
                TextColumn::make('title')
                    ->label(__('filament-language-switcher::offer.offerTitle'))
                    ->getStateUsing(function ($record) {
                        $locale = app()->getLocale();
                        $title = is_array($record->title) ? $record->title : json_decode($record->title, true);
                        return $title[$locale] ?? '-';
                    })
                    ->searchable(query: function ($query, $search) {
                        $query->whereRaw("JSON_EXTRACT(title, '$.\"".app()->getLocale()."\"') LIKE ?", ["%{$search}%"])
                              ->orWhereRaw("JSON_EXTRACT(title, '$.\"".(app()->getLocale() === 'ar' ? 'en' : 'ar')."\"') LIKE ?", ["%{$search}%"]);
                    }),
                TextColumn::make('description')
                    ->label(__('filament-language-switcher::offer.offerDescription'))
                    ->getStateUsing(function ($record) {
                        $locale = app()->getLocale();
                        $description = is_array($record->description) ? $record->description : json_decode($record->description, true);
                        return $description[$locale] ?? '-';
                    })
                    ->limit(50)
                    ->searchable(query: function ($query, $search) {
                        $query->whereRaw("JSON_EXTRACT(description, '$.\"".app()->getLocale()."\"') LIKE ?", ["%{$search}%"])
                              ->orWhereRaw("JSON_EXTRACT(description, '$.\"".(app()->getLocale() === 'ar' ? 'en' : 'ar')."\"') LIKE ?", ["%{$search}%"]);
                    }),
                TextColumn::make('discount')
                    ->label(__('filament-language-switcher::offer.discount'))
                    ->suffix('%')
                    ->sortable(),
                TextColumn::make('expires_at')
                    ->label(__('filament-language-switcher::offer.expiresAt'))
                    ->dateTime()
                    ->color(function ($state) {
                        if (!$state) {
                            return 'gray';
                        }
                        return \Carbon\Carbon::parse($state)->isPast() ? 'danger' : 'success';
                    })
                    ->sortable(),
                IconColumn::make('is_active')
                    ->label(__('filament-language-switcher::offer.isActive'))
                    ->boolean()
                    ->sortable(),
                TextColumn::make('services_count')
                    ->label(__('filament-language-switcher::offer.servicesCount'))
                    ->counts('services')
                    ->badge()
                    ->color('info')
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label(__('filament-language-switcher::offer.createdAt'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label(__('filament-language-switcher::offer.updatedAt'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                TrashedFilter::make(),
                TernaryFilter::make('is_active')
                    ->label(__('filament-language-switcher::offer.activeStatus'))
                    ->options([
                        'active' => __('filament-language-switcher::offer.active'),
                        'inactive' => __('filament-language-switcher::offer.inactive'),
                    ])
                    ->query(function ($query, $value) {
                        if ($value === 'active') {
                            $query->where('is_active', true);
                        } elseif ($value === 'inactive') {
                            $query->where('is_active', false);
                        }
                    }),

                TernaryFilter::make('has_discount')
                    ->label(__('filament-language-switcher::offer.hasDiscount'))
                    ->options([
                        'yes' => __('filament-language-switcher::offer.yes'),
                        'no' => __('filament-language-switcher::offer.no'),
                    ])
                    ->query(function ($query, $value) {
                        if ($value === 'yes') {
                            $query->whereNotNull('discount');
                        } elseif ($value === 'no') {
                            $query->whereNull('discount');
                        }
                    }),
                TernaryFilter::make('is_expired')
                    ->label(__('filament-language-switcher::offer.expiredStatus'))
                    ->options([
                        'expired' => __('filament-language-switcher::offer.expired'),
                        'active' => __('filament-language-switcher::offer.active'),
                    ])
                    ->query(function ($query, $value) {
                        if ($value === 'expired') {
                            $query->whereNotNull('expires_at')->where('expires_at', '<', now());
                        } elseif ($value === 'active') {
                            $query->where(function ($q) {
                                $q->whereNull('expires_at')->orWhere('expires_at', '>=', now());
                            });
                        }
                    }),
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

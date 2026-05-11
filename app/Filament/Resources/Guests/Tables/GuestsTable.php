<?php

namespace App\Filament\Resources\Guests\Tables;

use App\Models\Country;
use App\Models\Region;
use App\Models\Doctor;
use App\Models\Service;
use App\Models\Offer;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Builder;

class GuestsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label(__('filament-language-switcher::guests.name'))
                    ->searchable(),

                TextColumn::make('id')
                    ->label(__('Patient ID'))
                    ->formatStateUsing(fn ($state) => 'DC-' . str_pad($state, 4, '0', STR_PAD_LEFT) . '#')
                    ->copyable()
                    ->color('gray'),

                TextColumn::make('phone')
                    ->label(__('filament-language-switcher::guests.phone'))
                    ->searchable(),

                TextColumn::make('branch.name')
                    ->label(__('filament-language-switcher::guests.branch')),

                TextColumn::make('branch.country.name')
                    ->label(__('filament-language-switcher::guests.country_name')),

                TextColumn::make('branch.region.name')
                    ->label(__('filament-language-switcher::guests.region_name')),

                TextColumn::make('service.title')
                    ->label(__('filament-language-switcher::guests.service'))
                    ->default('—')
                    ->getStateUsing(fn ($record) => $record->service?->getTranslatedTitle() ?? '—'),

                TextColumn::make('offer.title')
                    ->label(__('filament-language-switcher::guests.offer'))
                    ->default('—')
                    ->getStateUsing(fn ($record) => $record->offer?->getTranslatedTitle() ?? '—'),

                TextColumn::make('doctor.name')
                    ->label(__('filament-language-switcher::guests.doctor_name'))
                    ->default('—')
                    ->placeholder('—'),

                TextColumn::make('booking_at')
                    ->label(__('filament-language-switcher::guests.booking_date'))
                    ->dateTime('d M Y - h:i A')
                    ->sortable()
                    ->toggleable(),

                TextColumn::make('status')
                    ->label(__('filament-language-switcher::guests.status'))
                    ->badge()
                    ->formatStateUsing(fn (string $state) => match ($state) {
                        'new' => __('filament-language-switcher::guests.new'),
                        'completed' => __('filament-language-switcher::guests.completed'),
                        'cancelled' => __('filament-language-switcher::guests.cancelled'),
                        'warning' => __('filament-language-switcher::guests.continues'),
                        default => $state,
                    })
                    ->colors([
                        'primary' => 'new',
                        'success' => 'completed',
                        'warning' => 'continues',
                        'danger' => 'cancelled',
                    ]),

                // ── NEXT APPT ──
                // TextColumn::make('next_appointment_at')
                //     ->label(__('Next Appt'))
                //     ->date('M d, Y')
                //     ->sortable()
                //     ->color('primary')
                //     ->placeholder('—'),

                // ── LAST VISIT ──
                // TextColumn::make('last_visit_at')
                //     ->label(__('Last Visit'))
                //     ->date('M d, Y')
                //     ->sortable()
                //     ->placeholder('—'),

                TextColumn::make('created_at')
                    ->label(__('filament-language-switcher::guests.created_at'))
                    ->dateTime()
                    ->sortable(),
            ])

            ->filters([
                // Country filter - ULTRA FIXED
                SelectFilter::make('branch.country_id')
                    ->label(__('filament-language-switcher::guests.country_name'))
                    ->options(function () {
                        $locale = app()->getLocale();
                        $nameColumn = $locale === 'ar' ? 'name_ar' : 'name_en';

                        return Country::query()
                            ->whereNotNull($nameColumn)
                            ->where($nameColumn, '!=', '')
                            ->get()
                            ->mapWithKeys(function ($country) {
                                $name = $country->name;
                                // Triple check for null/empty
                                if (empty($name) || is_null($name)) {
                                    return [];
                                }
                                return [$country->id => $name];
                            })
                            ->filter() // Remove any nulls
                            ->toArray();
                    })
                    ->searchable()
                    ->preload(),

                // Region filter - ULTRA FIXED
                SelectFilter::make('branch.region_id')
                    ->label(__('filament-language-switcher::guests.region_name'))
                    ->options(function () {
                        $locale = app()->getLocale();
                        $nameColumn = $locale === 'ar' ? 'name_ar' : 'name_en';

                        return Region::query()
                            ->whereNotNull($nameColumn)
                            ->where($nameColumn, '!=', '')
                            ->get()
                            ->mapWithKeys(function ($region) {
                                $name = $region->name;
                                // Triple check for null/empty
                                if (empty($name) || is_null($name)) {
                                    return [];
                                }
                                return [$region->id => $name];
                            })
                            ->filter() // Remove any nulls
                            ->toArray();
                    })
                    ->searchable()
                    ->preload(),

                // Doctor filter - ULTRA FIXED
                SelectFilter::make('doctor_id')
                    ->label(__('filament-language-switcher::guests.doctor_name'))
                    ->options(function () {
                        return Doctor::query()
                            ->whereNotNull('name')
                            ->where('name', '!=', '')
                            ->get()
                            ->mapWithKeys(function ($doctor) {
                                $name = $doctor->name;
                                // Triple check for null/empty
                                if (empty($name) || is_null($name)) {
                                    return [];
                                }
                                return [$doctor->id => $name];
                            })
                            ->filter() // Remove any nulls
                            ->toArray();
                    })
                    ->searchable()
                    ->preload(),

                // Service filter - ULTRA FIXED
                SelectFilter::make('service_id')
                    ->label(__('filament-language-switcher::guests.service'))
                    ->options(function () {
                        return Service::query()
                            ->get()
                            ->mapWithKeys(function ($service) {
                                $title = $service->title;
                                // Triple check for null/empty
                                if (empty($title) || is_null($title)) {
                                    return [];
                                }
                                return [$service->id => $title];
                            })
                            ->filter() // Remove any nulls
                            ->toArray();
                    })
                    ->searchable()
                    ->preload(),

                // Offer filter - ULTRA FIXED
                SelectFilter::make('offer_id')
                    ->label(__('filament-language-switcher::guests.offer'))
                    ->options(function () {
                        return Offer::query()
                            ->get()
                            ->mapWithKeys(function ($offer) {
                                $title = $offer->title;
                                // Triple check for null/empty
                                if (empty($title) || is_null($title)) {
                                    return [];
                                }
                                return [$offer->id => $title];
                            })
                            ->filter() // Remove any nulls
                            ->toArray();
                    })
                    ->searchable()
                    ->preload(),

                // Status filter
                SelectFilter::make('status')
                    ->label(__('filament-language-switcher::guests.status'))
                    ->options([
                        'new' => __('filament-language-switcher::guests.new'),
                        'paid' => __('filament-language-switcher::guests.paid'),
                        'cancelled' => __('filament-language-switcher::guests.cancelled'),
                    ]),

                // Date filter (Created At)
                Filter::make('created_at')
                    ->label(__('filament-language-switcher::guests.created_at'))
                    ->form([
                        DatePicker::make('from')
                            ->label(__('From'))
                            ->placeholder(__('Start date')),
                        DatePicker::make('until')
                            ->label(__('To'))
                            ->placeholder(__('End date')),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['from'] ?? null,
                                fn (Builder $query, $date) => $query->whereDate('created_at', '>=', $date)
                            )
                            ->when(
                                $data['until'] ?? null,
                                fn (Builder $query, $date) => $query->whereDate('created_at', '<=', $date)
                            );
                    })
                    ->indicateUsing(function (array $data): array {
                        $indicators = [];

                        if ($data['from'] ?? null) {
                            $indicators[] = 'From: ' . \Carbon\Carbon::parse($data['from'])->toFormattedDateString();
                        }

                        if ($data['until'] ?? null) {
                            $indicators[] = 'Until: ' . \Carbon\Carbon::parse($data['until'])->toFormattedDateString();
                        }

                        return $indicators;
                    }),
            ])

            ->actions([
                EditAction::make()
                ->iconButton()
                ->icon('heroicon-o-ellipsis-horizontal'),
            ])

            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc')
            ->striped(false)
            ->paginated([10, 25, 50, 100])
            ->emptyStateIcon('heroicon-o-users')
            ->emptyStateHeading(__('No patients found'))
            ->emptyStateDescription(__('Create your first patient to get started.'))
            ->searchPlaceholder(__('Search patients, procedures, or IDs…'));
    }
}

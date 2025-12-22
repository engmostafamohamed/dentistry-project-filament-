<?php

namespace App\Filament\Resources\Guests\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\DateTimePicker;
use App\Models\Doctor;
use App\Models\Service;
use App\Models\Offer;
use App\Models\Branch;
use App\Models\Country;
use App\Models\Region;

class GuestForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make()
                    ->columns(1)
                    ->columnSpanFull()
                    ->schema([

                        // Guest Info Section
                        Section::make(__('filament-language-switcher::guests.guest_info'))
                            ->columns(2)
                            ->compact()
                            ->schema([
                                TextInput::make('name')
                                    ->label(__('filament-language-switcher::guests.name'))
                                    ->disabled()
                                    ->dehydrated(false),

                                TextInput::make('phone')
                                    ->label(__('filament-language-switcher::guests.phone'))
                                    ->disabled()
                                    ->dehydrated(false),
                            ]),

                        // Branch Info Section
                        Section::make(__('filament-language-switcher::guests.branch_info'))
                            ->columns(3)
                            ->compact()
                            ->schema([
                                TextInput::make('branch_id')
                                    ->label(__('filament-language-switcher::guests.branch'))
                                    ->disabled()
                                    ->dehydrated(false)
                                    ->formatStateUsing(function ($state, $record) {
                                        if (!$state || !$record) {
                                            return '—';
                                        }

                                        $branch = Branch::find($state);
                                        return $branch?->name ?? '—';
                                    }),

                                // Country Name
                                TextInput::make('country_display')
                                    ->label(__('filament-language-switcher::guests.country_name'))
                                    ->disabled()
                                    ->dehydrated(false)
                                    ->formatStateUsing(function ($state, $record) {
                                        if (!$record?->address) return '—';

                                        [$regionId, $countryId] = array_map('trim', explode(',', $record->address));

                                        if (!is_numeric($countryId)) return '—';

                                        $country = Country::find($countryId);
                                        if (!$country) return '—';

                                        $locale = app()->getLocale();

                                        return $country->{'name_' . $locale}
                                            ?? ($locale === 'ar'
                                                ? $country->name_en
                                                : $country->name_ar)
                                            ?? '—';
                                    }),

                                // Region Name
                                TextInput::make('region_display')
                                    ->label(__('filament-language-switcher::guests.region_name'))
                                    ->disabled()
                                    ->dehydrated(false)
                                    ->formatStateUsing(function ($state, $record) {
                                        if (!$record?->address) return '—';

                                        [$regionId, $countryId] = array_map('trim', explode(',', $record->address));

                                        if (!is_numeric($regionId)) return '—';

                                        $region = Region::find($regionId);
                                        if (!$region) return '—';

                                        $locale = app()->getLocale();

                                        return $region->{'name_' . $locale}
                                            ?? ($locale === 'ar'
                                                ? $region->name_en
                                                : $region->name_ar)
                                            ?? '—';
                                    }),

                                Textarea::make('description')
                                    ->label(__('filament-language-switcher::guests.description'))
                                    ->disabled()
                                    ->dehydrated(false)
                                    ->rows(3)
                                    ->columnSpanFull()
                                    ->default(fn($record) => $record?->description ?: '—')
                                    ->visible(fn($record) => !empty($record?->description)),
                            ]),

                        // Application Info Section
                        Section::make(__('filament-language-switcher::guests.application_info'))
                            ->columns(2)
                            ->compact()
                            ->schema([
                                // Service Name
                                TextInput::make('service_id')
                                    ->label(__('filament-language-switcher::guests.service'))
                                    ->disabled()
                                    ->dehydrated(false)
                                    ->formatStateUsing(function ($state) {
                                        if (!$state) {
                                            return '—';
                                        }

                                        $service = Service::find($state);
                                        if (!$service) {
                                            return '—';
                                        }

                                        $locale = app()->getLocale();
                                        $title = $service->title;

                                        return is_array($title)
                                            ? ($title[$locale] ?? $title['en'] ?? reset($title) ?: '—')
                                            : (string)($title ?: '—');
                                    }),


                                // Offer Name
                                TextInput::make('offer_id')
                                    ->label(__('filament-language-switcher::guests.offer'))
                                    ->disabled()
                                    ->dehydrated(false)
                                    ->formatStateUsing(function ($state) {
                                        if (!$state) {
                                            return '—';
                                        }

                                        $offer = Offer::find($state);
                                        if (!$offer) {
                                            return '—';
                                        }

                                        $locale = app()->getLocale();
                                        $title = $offer->title;

                                        return is_array($title)
                                            ? ($title[$locale] ?? $title['en'] ?? reset($title) ?: '—')
                                            : (string)($title ?: '—');
                                    }),


                                // Editable doctor dropdown - FIXED
                                Select::make('doctor_id')
                                    ->label(__('filament-language-switcher::guests.doctor_name'))
                                    ->options(function ($record) {
                                        $query = Doctor::query()
                                            ->whereNotNull('name')
                                            ->where('name', '!=', '');

                                        // Filter by branch if record exists
                                        if ($record && $record->branch_id) {
                                            $query->where('branch_id', $record->branch_id);
                                        }

                                        // Get doctors and filter out any nulls
                                        $doctors = $query
                                            ->orderBy('name')
                                            ->pluck('name', 'id')
                                            ->filter(fn($name) => !empty($name))
                                            ->toArray();

                                        // Add "No Doctor" option
                                        return ['' => '— No Doctor —'] + $doctors;
                                    })
                                    ->searchable()
                                    ->nullable()
                                    ->placeholder(__('Select a doctor'))
                                    ->preload()
                                    ->native(false)
                                    ->getOptionLabelUsing(function ($value) {
                                        if (empty($value)) {
                                            return '— No Doctor —';
                                        }

                                        $doctor = Doctor::find($value);
                                        return $doctor?->name ?? '— Unknown —';
                                    }),

                                // Editable status toggle
                                ToggleButtons::make('status')
                                    ->label(__('filament-language-switcher::guests.status'))
                                    ->inline()
                                    ->required()
                                    ->options([
                                        'new' => __('filament-language-switcher::guests.new'),
                                        'paid' => __('filament-language-switcher::guests.paid'),
                                        'cancelled' => __('filament-language-switcher::guests.cancelled'),
                                    ])
                                    ->colors([
                                        'new' => 'primary',
                                        'paid' => 'success',
                                        'cancelled' => 'danger',
                                    ])
                                    ->icons([
                                        'new' => 'heroicon-o-clock',
                                        'paid' => 'heroicon-o-check-circle',
                                        'cancelled' => 'heroicon-o-x-circle',
                                    ]),
                                DateTimePicker::make('booking_at')
                                    ->label(__('filament-language-switcher::guests.booking_date'))
                                    ->disabled()
                                    ->dehydrated(false)
                                    ->displayFormat('d M Y - h:i A')
                                    ->placeholder('—'),
                            ]),
                    ]),
            ]);
    }
}

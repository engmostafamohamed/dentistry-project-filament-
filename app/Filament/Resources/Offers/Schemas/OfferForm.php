<?php

namespace App\Filament\Resources\Offers\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;

class OfferForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([

            Tabs::make('OfferTabs')
                ->tabs([

                    // ── Tab 1: Offer Information ─────────────────────────────
                    Tab::make(__('filament-language-switcher::offer.offerInformation'))
                        ->icon('heroicon-o-information-circle')
                        ->schema([

                            // ── Basic Information ────────────────────────────
                            Section::make(__('filament-language-switcher::offer.basicInformation'))
                                ->description(__('filament-language-switcher::offer.enterBasicOfferDetails'))
                                ->schema([

                                    Grid::make(3)
                                        ->schema([

                                            // COL 1 — FileUpload: hidden when DB has saved image
                                            FileUpload::make('image')
                                                ->label(__('filament-language-switcher::offer.offerImage'))
                                                ->image()
                                                ->disk('public')
                                                ->directory('offers')
                                                ->imagePreviewHeight('220')
                                                ->helperText(__('filament-language-switcher::offer.uploadOfferImageMaxSize'))
                                                ->live()
                                                ->hidden(fn ($record) => $record && filled($record->image))
                                                ->columnSpan(2),

                                            // COL 2 — Image preview
                                            Placeholder::make('image_preview')
                                                ->label(__('filament-language-switcher::offer.imagePreview'))  // Label for the placeholder
                                                ->content(fn ($get) => view(
                                                    'filament.components.offers.photo-preview',
                                                    ['image' => $get('image')]
                                                ))
                                                ->reactive()
                                                ->dehydrated(false)
                                                ->hidden(fn ($record) => ! ($record && filled($record->image)))
                                                ->columnSpan(fn ($record) => $record && filled($record->image) ? 2 : 1),

                                            // COL 3 — Status + settings
                                            Grid::make(1)
                                                ->schema([

                                                    Toggle::make('is_active')
                                                        ->label(__('filament-language-switcher::offer.activeStatus'))
                                                        ->helperText(__('filament-language-switcher::offer.enableOrDisableOffer'))
                                                        ->default(true)
                                                        ->inline(false)
                                                        ->onColor('success')
                                                        ->offColor('danger'),

                                                    TextInput::make('discount')
                                                        ->label(__('filament-language-switcher::offer.discount'))
                                                        ->numeric()
                                                        ->minValue(0)
                                                        ->maxValue(100)
                                                        ->suffix('%')
                                                        ->placeholder('10'),

                                                    DateTimePicker::make('expires_at')
                                                        ->label(__('filament-language-switcher::offer.expiresAt'))
                                                        ->nullable()
                                                        ->placeholder(__('filament-language-switcher::offer.noExpiry')),

                                                ])
                                                ->columnSpan(1),

                                        ]),

                                ])
                                ->collapsible()
                                ->collapsed(false),

                            // ── Multilingual Content ─────────────────────────
                            Section::make(__('filament-language-switcher::offer.multilingualContent'))
                                ->description(__('filament-language-switcher::offer.enterOfferDetailsInMultipleLanguages'))
                                ->schema([

                                    // English
                                    Grid::make(1)->schema([

                                        TextInput::make('title.en')
                                            ->label(__('filament-language-switcher::offer.offerNameEn'))
                                            ->required()
                                            ->maxLength(255)
                                            ->rules(['required', 'string', 'max:255'])
                                            ->placeholder(__('filament-language-switcher::offer.enterOfferNameInEnglish'))
                                            ->prefixIcon('heroicon-o-language'),

                                        Textarea::make('description.en')
                                            ->label(__('filament-language-switcher::offer.descriptionEn'))
                                            ->rows(3)
                                            ->maxLength(1000)
                                            ->placeholder(__('filament-language-switcher::offer.describeOfferInEnglish'))
                                            ->columnSpanFull(),

                                    ]),

                                    // Arabic
                                    Grid::make(1)->schema([

                                        TextInput::make('title.ar')
                                            ->label(__('filament-language-switcher::offer.offerNameAr'))
                                            ->maxLength(255)
                                            ->rules(['string', 'max:255'])
                                            ->placeholder(__('filament-language-switcher::offer.enterOfferNameInArabic'))
                                            ->prefixIcon('heroicon-o-language'),

                                        Textarea::make('description.ar')
                                            ->label(__('filament-language-switcher::offer.descriptionAr'))
                                            ->rows(3)
                                            ->maxLength(1000)
                                            ->placeholder(__('filament-language-switcher::offer.describeOfferInArabic'))
                                            ->columnSpanFull(),

                                    ]),

                                ])
                                ->collapsible()
                                ->collapsed(false),

                        ]),

                    // ── Tab 2: Assign Services ───────────────────────────────
                    Tab::make(__('filament-language-switcher::offer.assignServices'))
                        ->icon('heroicon-o-wrench-screwdriver')
                        ->schema([

                            Section::make()
                                ->description(__('filament-language-switcher::offer.selectServicesForOffer'))
                                ->schema([

                                    Select::make('services')
                                        ->relationship('services', 'title')
                                        ->multiple()
                                        ->preload()
                                        ->searchable()
                                        ->label(__('filament-language-switcher::offer.offerServices'))
                                        ->helperText(__('filament-language-switcher::offer.offerServicesHelp'))
                                        ->placeholder(__('filament-language-switcher::offer.searchAndSelectServices'))
                                        ->getOptionLabelFromRecordUsing(function ($record) {
                                            $locale = app()->getLocale();
                                            $title  = is_array($record->title)
                                                ? $record->title
                                                : json_decode($record->title, true);
                                            return $title[$locale] ?? $title['en'] ?? __('filament-language-switcher::offer.untitled');
                                        })
                                        ->native(false)
                                        ->columnSpanFull(),

                                ]),

                        ]),

                ])
                ->columnSpanFull()
                ->activeTab(1)
                ->persistTabInQueryString(),

        ]);
    }
}

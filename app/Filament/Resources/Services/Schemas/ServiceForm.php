<?php

namespace App\Filament\Resources\Services\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Toggle;

class ServiceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([

            Tabs::make('ServiceTabs')
                ->tabs([

                    // ── Tab 1: Service Information ───────────────────────────
                    Tab::make(__('filament-language-switcher::services.serviceInformation'))
                        ->icon('heroicon-o-information-circle')
                        ->schema([

                            // ── Basic Information ────────────────────────────
                            Section::make(__('filament-language-switcher::services.basicInformation'))
                                ->description(__('filament-language-switcher::services.enterBasicServiceDetails'))
                                ->schema([

                                    Grid::make(3)
                                        ->schema([

                                            // COL 1 — FileUpload
                                            // Visible when NO saved image in DB
                                            // Hidden after save (record has image)
                                            FileUpload::make('image')
                                                ->label(__('filament-language-switcher::services.serviceImage'))
                                                ->image()
                                                ->disk('public')
                                                ->directory('services')
                                                ->imagePreviewHeight('220')
                                                ->helperText(__('filament-language-switcher::services.uploadServiceImageMaxSize'))
                                                ->live()
                                                ->hidden(fn ($record) => $record && filled($record->image))
                                                ->columnSpan(fn ($record) => $record && filled($record->image) ? 0 : 1),

                                            // COL 2 — Preview
                                            // Hidden when no saved image in DB
                                            // Expands to 2 cols when uploader is hidden
                                            Placeholder::make('image_preview')
                                                ->label(__('filament-language-switcher::services.imagePreview'))
                                                ->content(fn ($get) => view(
                                                    'filament.components.services.photo-preview',
                                                    ['image' => $get('image')]
                                                ))
                                                ->reactive()
                                                ->dehydrated(false)
                                                ->hidden(fn ($record) => ! ($record && filled($record->image)))
                                                ->columnSpan(fn ($record) => $record && filled($record->image) ? 2 : 0),

                                            // COL 3 — Status toggle + quick tip
                                            Grid::make(1)
                                                ->schema([

                                                    Toggle::make('is_active')
                                                        ->label(__('filament-language-switcher::services.activeStatus'))
                                                        ->helperText(__('filament-language-switcher::services.enableOrDisableService'))
                                                        ->default(true)
                                                        ->inline(false)
                                                        ->onColor('success')
                                                        ->offColor('danger'),

                                                    Placeholder::make('info')
                                                        ->label(__('filament-language-switcher::services.quickTip'))
                                                        ->content(__('filament-language-switcher::services.serviceImageTip')),

                                                ])
                                                ->columnSpan(1),

                                        ]),

                                ])
                                ->collapsible()
                                ->collapsed(false),

                            // ── Multilingual Content ─────────────────────────
                            Section::make(__('filament-language-switcher::services.multilingualContent'))
                                ->description(__('filament-language-switcher::services.enterServiceDetailsInMultipleLanguages'))
                                ->schema([

                                    Grid::make(1)->schema([

                                        TextInput::make('title.en')
                                            ->label(__('filament-language-switcher::services.serviceNameEn'))
                                            ->required()
                                            ->maxLength(255)
                                            ->rules(['required', 'string', 'max:255'])
                                            ->validationMessages([
                                                'required' => __('filament-language-switcher::services.validation.serviceNameEnRequired'),
                                                'max'      => __('filament-language-switcher::services.validation.serviceNameMax'),
                                            ])
                                            ->placeholder(__('filament-language-switcher::services.enterServiceNameInEnglish'))
                                            ->prefixIcon('heroicon-o-language'),

                                        Textarea::make('description.en')
                                            ->label(__('filament-language-switcher::services.descriptionEn'))
                                            ->rows(3)
                                            ->maxLength(1000)
                                            ->placeholder(__('filament-language-switcher::services.describeServiceInEnglish'))
                                            ->columnSpanFull(),

                                    ]),

                                    Grid::make(1)->schema([

                                        TextInput::make('title.ar')
                                            ->label(__('filament-language-switcher::services.serviceNameAr'))
                                            ->maxLength(255)
                                            ->rules(['string', 'max:255'])
                                            ->validationMessages([
                                                'max' => __('filament-language-switcher::services.validation.serviceNameMax'),
                                            ])
                                            ->placeholder(__('filament-language-switcher::services.enterServiceNameInArabic'))
                                            ->prefixIcon('heroicon-o-language'),

                                        Textarea::make('description.ar')
                                            ->label(__('filament-language-switcher::services.descriptionAr'))
                                            ->rows(3)
                                            ->maxLength(1000)
                                            ->placeholder(__('filament-language-switcher::services.describeServiceInArabic'))
                                            ->columnSpanFull(),

                                    ]),

                                ])
                                ->collapsible()
                                ->collapsed(false),

                        ]),

                    // ── Tab 2: Assign Doctors ────────────────────────────────
                    Tab::make(__('filament-language-switcher::services.assignDoctors'))
                        ->icon('heroicon-o-user-group')
                        ->schema([

                            Section::make()
                                ->description(__('filament-language-switcher::services.selectDoctorsWhoProvideService'))
                                ->schema([

                                    Select::make('doctors')
                                        ->relationship('doctors', 'name')
                                        ->multiple()
                                        ->preload()
                                        ->searchable()
                                        ->label(__('filament-language-switcher::services.assignedDoctors'))
                                        ->helperText(__('filament-language-switcher::services.chooseWhichDoctorsCanPerformService'))
                                        ->placeholder(__('filament-language-switcher::services.searchAndSelectDoctors'))
                                        ->native(false)
                                        ->columnSpanFull(),

                                ]),

                        ]),

                    // ── Tab 3: Assign Offers ─────────────────────────────────
                    Tab::make(__('filament-language-switcher::services.assignOffers'))
                        ->icon('heroicon-o-gift')
                        ->schema([

                            Section::make()
                                ->description(__('filament-language-switcher::services.linkServiceToPromotionalOffers'))
                                ->schema([

                                    Select::make('offers')
                                        ->relationship('offers', 'title')
                                        ->multiple()
                                        ->preload()
                                        ->searchable()
                                        ->label(__('filament-language-switcher::services.assignedOffers'))
                                        ->helperText(__('filament-language-switcher::services.chooseWhichOffersIncludeService'))
                                        ->placeholder(__('filament-language-switcher::services.searchAndSelectOffers'))
                                        ->getOptionLabelFromRecordUsing(function ($record) {
                                            $locale = app()->getLocale();
                                            $title  = is_array($record->title)
                                                ? $record->title
                                                : json_decode($record->title, true);
                                            return $title[$locale] ?? $title['en'] ?? __('filament-language-switcher::services.untitled');
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

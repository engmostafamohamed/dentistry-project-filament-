<?php

namespace App\Filament\Resources\Staff\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\ViewField;
use App\Models\Service;
use Illuminate\Support\Facades\Storage;
class StaffForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([
            Tabs::make('StaffTabs')
                ->tabs([
                    Tab::make('Staff Info')
                        ->label(__('filament-language-switcher::staff.doctorInfo'))
                        ->schema([
                            // Show small image card if exists
                            ViewField::make('photo_preview')
                                ->label('')
                                ->view('filament.components.photo-preview')
                                ->visible(fn($record) => filled($record?->photo)),

                            FileUpload::make('photo')
                                ->image()
                                ->label(__('filament-language-switcher::staff.uploadPhoto'))
                                ->directory('doctors')
                                ->maxSize(2048)
                                ->helperText(__('filament-language-switcher::staff.validation.photo_image'))
                                ->imagePreviewHeight('200') // preview height
                                ->saveUploadedFileUsing(function ($file, $record) {
                                    // If no new file uploaded → keep old image
                                    if (!$file) {
                                        return $record?->photo;
                                    }

                                    // If new file uploaded → delete old one from disk
                                    if ($record?->photo && Storage::disk('public')->exists($record->photo)) {
                                        Storage::disk('public')->delete($record->photo);
                                    }

                                    // Store and return new file path (will update in DB automatically)
                                    return $file->store('doctors', 'public');
                                })
                                ->deleteUploadedFileUsing(function ($file, $record) {
                                    // Delete when user explicitly clicks "remove" button
                                    if ($record?->photo && Storage::disk('public')->exists($record->photo)) {
                                        Storage::disk('public')->delete($record->photo);
                                    }
                                })
                                ->afterStateHydrated(function ($component, $state) {
                                    // Fix Filament behavior: if no new file uploaded,
                                    // keep the old path in memory (prevent overwriting DB with null)
                                    if (blank($state) && $component->getRecord()?->photo) {
                                        $component->state($component->getRecord()->photo);
                                    }
                                })
                                ->getUploadedFileNameForStorageUsing(function ($file) {
                                    // Optional: rename uploaded file for consistency
                                    return time() . '-' . $file->getClientOriginalName();
                                }),

                            // Select::make('type')
                            //     ->options([
                            //         'full-time' => 'Full time',
                            //         'part-time' => 'Part time',
                            //     ])
                            //     ->label(__('filament-language-switcher::staff.type'))
                            //     ->required(),
                            // TextInput::make('name.en')->label(__('filament-language-switcher::staff.doctorNameEn'))->required(),
                            // TextInput::make('name.ar')->label(__('filament-language-switcher::staff.doctorNameAr')),

                            TextInput::make('name')
                                ->label(__('filament-language-switcher::staff.fullName'))
                                ->required()
                                ->minLength(3)
                                ->maxLength(100)
                                ->rules(['required', 'min:3', 'max:100'])
                                ->validationMessages([
                                    'required' => __('filament-language-switcher::staff.validation.name_required'),
                                    'min'      => __('filament-language-switcher::staff.validation.name_min'),
                                ]),

                            Select::make('branch_id')
                                ->relationship('branch', 'name')
                                ->label(__('filament-language-switcher::staff.branch'))
                                ->required()
                                ->rules(['required'])
                                ->validationMessages([
                                    'required' => __('filament-language-switcher::staff.validation.branch_required'),
                                ]),

                            TextInput::make('phone')
                                ->label(__('filament-language-switcher::staff.phoneNumber'))
                                ->required()
                                ->minLength(11)
                                ->maxLength(11)
                                ->rule('regex:/^01[0125][0-9]{8}$/')
                                ->unique(table: 'doctors', column: 'phone', ignoreRecord: true)
                                ->helperText(__('filament-language-switcher::staff.acceptedPhoneNumber'))
                                ->validationMessages([
                                    'required'  => __('filament-language-switcher::staff.validation.required'),
                                    'numeric'   => __('filament-language-switcher::staff.validation.mustBeNumbers'),
                                    'minLength' => __('filament-language-switcher::staff.validation.mustBe11Digits'),
                                    'maxLength' => __('filament-language-switcher::staff.validation.mustBe11Digits'),
                                    'regex'     => __('filament-language-switcher::staff.validation.invalidPhoneNumber'),
                                ]),

                            TextInput::make('email')
                                ->label(__('filament-language-switcher::staff.email'))
                                ->email()
                                ->required()
                                ->unique(table: 'doctors', column: 'email', ignoreRecord: true)
                                ->rules(['required', 'email'])
                                ->validationMessages([
                                    'required' => __('filament-language-switcher::staff.validation.email_required'),
                                    'email'    => __('filament-language-switcher::staff.validation.email_invalid'),
                                ]),

                            TextInput::make('address')
                                ->label(__('filament-language-switcher::staff.address'))
                                ->maxLength(200)
                                ->required()
                                ->rules(['required', 'max:200'])
                                ->validationMessages([
                                    'required' => __('filament-language-switcher::staff.validation.address_required'),
                                    'max'      => __('filament-language-switcher::staff.validation.address_max'),
                                ]),
                        ])
                        ->icon('heroicon-o-user'),

                    Tab::make('Assigned Services')
                        ->label(__('filament-language-switcher::staff.assignedServices'))
                        ->schema([
                            Select::make('services')
                                ->relationship('services', 'title')
                                ->label(__('filament-language-switcher::staff.assignedServices'))
                                ->multiple() // multi-select dropdown
                                ->preload(),
                        ])
                        ->icon('heroicon-o-clipboard-document'),

                    Tab::make('Working Hours')
                        ->label(__('filament-language-switcher::staff.workingHours'))
                        ->schema([
                            Repeater::make('availableSlots')
                                ->relationship() // auto links with doctor_id
                                ->label(__('filament-language-switcher::staff.workingHours'))
                                ->schema([
                                    Select::make('day_name')
                                        ->options([
                                            'Monday' => 'Monday',
                                            'Tuesday' => 'Tuesday',
                                            'Wednesday' => 'Wednesday',
                                            'Thursday' => 'Thursday',
                                            'Friday' => 'Friday',
                                            'Saturday' => 'Saturday',
                                            'Sunday' => 'Sunday',
                                        ])
                                        ->label(__('filament-language-switcher::staff.day'))
                                        ->required(),

                                    Toggle::make('is_active')
                                        ->label(__('filament-language-switcher::staff.doctorStatus'))
                                        ->default(true),

                                    TimePicker::make('opening_time')
                                        ->label(__('filament-language-switcher::staff.openingTime'))
                                        ->required()
                                        ->rules([
                                            function () {
                                                return function (string $attribute, $value, $fail) {
                                                    // We’ll handle validation in closing_time field below
                                                };
                                            },
                                        ]),

                                    TimePicker::make('closing_time')
                                        ->label(__('filament-language-switcher::staff.closingTime'))
                                        ->required()
                                        ->rules([
                                            function () {
                                                return function (string $attribute, $value, $fail) {
                                                    // Parse both times from state
                                                    $data = request()->input('data', []);
                                                    // Defensive null checks
                                                    $opening = data_get($data, str_replace('.closing_time', '.opening_time', $attribute));
                                                    if ($opening && $value && $opening >= $value) {
                                                        $fail(__('Closing time must be later than opening time.'));
                                                    }
                                                };
                                            },
                                        ]),

                                    TextInput::make('max_bookings')
                                        ->label(__('filament-language-switcher::staff.maxBookings'))
                                        ->numeric()
                                        ->minValue(1)
                                        ->default(3)
                                        ->required(),

                                    // Hidden default type
                                    TextInput::make('type')
                                        ->default('normal')
                                        ->hidden(),
                                ])
                                ->columns(2)
                                ->createItemButtonLabel(__('filament-language-switcher::staff.addWorkingDay')),
                        ])
                        ->icon('heroicon-o-clock'),

                    Tab::make('Days Off')
                        ->label(__('filament-language-switcher::staff.daysOff'))
                        ->schema([
                            Repeater::make('daysOff') // We’ll alias same relation but filter in code
                                ->relationship('availableSlots') // use the same hasMany
                                ->label(__('filament-language-switcher::staff.daysOff'))
                                ->schema([
                                    TextInput::make('note')
                                        ->label(__('filament-language-switcher::staff.dayOffName'))
                                        ->placeholder('e.g. Eid, National Day, Personal Leave'),

                                    DatePicker::make('date')
                                        ->label(__('filament-language-switcher::staff.startDate'))
                                        ->required(),

                                    Select::make('type')
                                        ->label('Day Type')
                                        ->options([
                                            'off' => 'Off Day',
                                            'holiday' => 'Holiday',
                                            'exception' => 'Exception',
                                        ])
                                        ->default('off')
                                        ->required(),

                                    Toggle::make('is_active')
                                        ->label(__('filament-language-switcher::staff.doctorStatus'))
                                        ->default(true),
                                ])
                                ->mutateRelationshipDataBeforeCreateUsing(function (array $data): array {
                                    // Always mark as day off category
                                    $data['opening_time'] = null;
                                    $data['closing_time'] = null;
                                    $data['max_bookings'] = 0;
                                    $data['current_bookings'] = 0;
                                    return $data;
                                })
                                ->columns(2)
                                ->createItemButtonLabel(__('filament-language-switcher::staff.addDayOff')),
                        ])
                        ->icon('heroicon-o-calendar'),
                ])
                ->columnSpanFull(),
        ]);
    }
}

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
use App\Models\Service;

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
                            FileUpload::make('photo')->image()->directory('doctors')->label(__('filament-language-switcher::staff.uploadPhoto')),
                            // Select::make('type')
                            //     ->options([
                            //         'full-time' => 'Full time',
                            //         'part-time' => 'Part time',
                            //     ])
                            //     ->label(__('filament-language-switcher::staff.type'))
                            //     ->required(),
                            TextInput::make('name.en')->label(__('filament-language-switcher::staff.doctorNameEn'))->required(),
                            TextInput::make('name.ar')->label(__('filament-language-switcher::staff.doctorNameAr')),
                            Select::make('branch_id')->relationship('branch', 'name')->label(__('filament-language-switcher::staff.branch')),
                            TextInput::make('phoneNumber')
                                ->label(__('filament-language-switcher::staff.phoneNumber'))
                                ->required()
                                ->numeric()
                                ->minLength(11)
                                ->maxLength(11)
                                ->rule('regex:/^01[0125][0-9]{8}$/')
                                ->helperText(__('filament-language-switcher::staff.acceptedPhoneNumber'))
                                ->validationMessages([
                                    'regex' => __('filament-language-switcher::staff.invalidPhoneNumber'),
                            ]),
                            TextInput::make('email')->label(__('filament-language-switcher::staff.doctorEmail'))->email(),
                            TextInput::make('address')->label(__('filament-language-switcher::staff.doctorAddress'))->maxLength(200),
                        ])
                        ->icon('heroicon-o-user'),

                    Tab::make('Assigned Services')
                        ->label(__('filament-language-switcher::staff.assignedServices'))
                        ->schema([
                            Select::make('services')
                                ->relationship('services', 'title')
                                ->label(__('filament-language-switcher::staff.assignedServices'))
                                ->multiple() // multi-select dropdown
                                ->searchable()
                                ->preload(),
                        ])
                        ->icon('heroicon-o-clipboard-document'),

                    Tab::make('Working Hours')
                        ->label(__('filament-language-switcher::staff.workingHours'))
                        ->schema([
                            // A Repeater to capture working days / slots
                            Repeater::make('availableSlots')
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
                                        ->label(__('filament-language-switcher::staff.day')),
                                    Toggle::make('is_active')->label(__('filament-language-switcher::staff.doctorStatus')),
                                    TimePicker::make('opening_time')->label(__('filament-language-switcher::staff.openingTime')),
                                    TimePicker::make('closing_time')->label(__('filament-language-switcher::staff.closingTime')),
                                    TextInput::make('max_bookings')->label(__('filament-language-switcher::staff.maxBookings'))->numeric(),
                                ])
                                ->columns(2)
                                ->createItemButtonLabel(__('filament-language-switcher::staff.addWorkingDay')),
                        ])
                        ->icon('heroicon-o-clock'),

                    Tab::make('Days Off')
                        ->label(__('filament-language-switcher::staff.daysOff'))
                        ->schema([
                            Repeater::make('days_off')
                                ->label(__('filament-language-switcher::staff.daysOff'))
                                ->schema([
                                    TextInput::make('name')->label(__('filament-language-switcher::staff.dayOffName')),
                                    DatePicker::make('startDate')->label(__('filament-language-switcher::staff.startDate')),
                                    DatePicker::make('endDate')->label(__('filament-language-switcher::staff.endDate')),
                                    Toggle::make('repeatYearly')->label(__('filament-language-switcher::staff.repeatYearly')),
                                ])
                                ->createItemButtonLabel(__('filament-language-switcher::staff.addDayOff'))
                                ->columns(2),
                        ])
                        ->icon('heroicon-o-calendar'),
                ])
                ->columnSpanFull(),
        ]);
    }
}

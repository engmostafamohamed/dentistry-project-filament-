<?php

namespace App\Filament\Resources\AvailableSlots;

use App\Filament\Resources\AvailableSlots\Pages\CreateAvailableSlot;
use App\Filament\Resources\AvailableSlots\Pages\EditAvailableSlot;
use App\Filament\Resources\AvailableSlots\Pages\ListAvailableSlots;
use App\Filament\Resources\AvailableSlots\Schemas\AvailableSlotForm;
use App\Filament\Resources\AvailableSlots\Tables\AvailableSlotsTable;
use App\Models\AvailableSlot;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

use Filament\Tables\Table;

class AvailableSlotResource extends Resource
{
    protected static ?string $model = AvailableSlot::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-calendar';

    protected static ?string $recordTitleAttribute = 'date';

    public static function getNavigationGroup(): ?string
    {
        return __('filament-language-switcher::availableSlot.calendar');
    }

    public static function getNavigationLabel(): string
    {
        return __('filament-language-switcher::availableSlot.availableSlotsListTitle');
    }

    public static function form(Schema $schema): Schema
    {
        return AvailableSlotForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AvailableSlotsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListAvailableSlots::route('/'),
            'create' => CreateAvailableSlot::route('/create'),
            'edit' => EditAvailableSlot::route('/{record}/edit'),
        ];
    }
}

<?php

namespace App\Filament\Widgets;

use App\Models\Guest;
use Carbon\Carbon;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class PatientStatsOverview extends BaseWidget
{
    protected static ?int $sort = 1;

    protected int | string | array $columnSpan = 'full';

    /**
     * Make cards in one row like screenshot
     */
    protected function getColumns(): int
    {
        return 3; // 3 cards in one row
    }

    protected function getStats(): array
    {
        $today = Carbon::today();

        /**
         * Card 1 - Active Patients
         */
        $activePatients = Guest::query()
            ->where('status', '!=', 'cancelled')
            ->count();

        $totalPatients = Guest::count();

        $activeGrowth = $totalPatients > 0
            ? round(($activePatients / $totalPatients) * 100)
            : 0;

        /**
         * Card 2 - New This Month
         */
        $newThisMonth = Guest::query()
            ->whereYear('created_at', $today->year)
            ->whereMonth('created_at', $today->month)
            ->count();

        $prevMonth = $today->copy()->subMonth();

        $prevMonthNew = Guest::query()
            ->whereYear('created_at', $prevMonth->year)
            ->whereMonth('created_at', $prevMonth->month)
            ->count();

        $statusText = $newThisMonth >= $prevMonthNew ? 'Stable' : 'Down';

        /**
         * Card 3 - Appointments Today
         */
        $apptToday = Guest::query()
            ->whereDate('booking_at', $today)
            ->count();

        return [

            /**
             * Active Patients
             */
            Stat::make(__('Active Patients'), number_format($activePatients))
                ->description('+' . $activeGrowth . '%')
                ->descriptionIcon('heroicon-o-users')
                ->color('success')
                ->extraAttributes([
                    'class' =>
                        'rounded-2xl bg-gray-900 border border-gray-800
                        shadow-sm px-6 py-5 min-h-[140px]',
                ]),

            /**
             * New This Month
             */
            Stat::make(__('New This Month'), number_format($newThisMonth))
                ->description(__($statusText))
                ->descriptionIcon('heroicon-o-calendar-days')
                ->color('warning')
                ->extraAttributes([
                    'class' =>
                        'rounded-2xl bg-gray-900 border border-gray-800
                        shadow-sm px-6 py-5 min-h-[140px]',
                ]),

            /**
             * Appointments Scheduled
             */
            Stat::make(__('Appts Scheduled'), number_format($apptToday))
                ->description(__('Today'))
                ->descriptionIcon('heroicon-o-calendar')
                ->color('primary')
                ->extraAttributes([
                    'class' =>
                        'rounded-2xl bg-gray-900 border border-gray-800
                        shadow-sm px-6 py-5 min-h-[140px]',
                ]),
        ];
    }
}

@php
    // All 7 days in order
    $allDays = [
        ['label' => 'S', 'full' => 'sunday'],
        ['label' => 'M', 'full' => 'monday'],
        ['label' => 'T', 'full' => 'tuesday'],
        ['label' => 'W', 'full' => 'wednesday'],
        ['label' => 'T', 'full' => 'thursday'],
        ['label' => 'F', 'full' => 'friday'],
        ['label' => 'S', 'full' => 'saturday'],
    ];

    // Get active day names - only where is_active = true
    $slots = $getRecord()->availableSlots;

    $activeDays = collect($slots)
        ->filter(fn($slot) => (bool) data_get($slot, 'is_active') === true)
        ->map(fn($slot) => strtolower(trim(data_get($slot, 'day_name', ''))))
        ->filter()
        ->values()
        ->toArray();
@endphp

<div style="display:flex; align-items:center; gap:4px;">
    @foreach ($allDays as $day)
        @php
            $isActive = in_array($day['full'], $activeDays);
        @endphp
        <span
            title="{{ ucfirst($day['full']) }}"
            style="
                width: 26px;
                height: 26px;
                border-radius: 50%;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                font-size: 11px;
                font-weight: 600;
                user-select: none;
                flex-shrink: 0;
                background-color: {{ $isActive ? '#3b82f6' : '#e5e7eb' }};
                color: {{ $isActive ? '#ffffff' : '#9ca3af' }};
            "
        >
            {{ $day['label'] }}
        </span>
    @endforeach
</div>

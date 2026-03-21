@php
    $doctorsCount = $getRecord()->doctors()->count();
    $doctors = $getRecord()->doctors()->take(3)->get();
@endphp

<div style="display:flex; flex-direction:column; gap:4px;">
    @if ($doctorsCount > 0)
        {{-- Doctors count badge --}}
        <span style="display:inline-flex; align-items:center; justify-content:center; padding:2px 8px; background:#3b82f6; color:white; border-radius:9999px; font-size:12px; font-weight:600; width:fit-content;">
            {{--  {{ $doctorsCount }} {{ $doctorsCount === 1 ? __('filament-language-switcher::services.doctor') : __('filament-language-switcher::services.doctors') }}  --}}
            {{ $doctorsCount }} {{ __('filament-language-switcher::services.doctor') }}
        </span>

        {{-- First 3 doctor names --}}
        <div style="display:flex; flex-direction:column; gap:2px;">
            @foreach ($doctors as $doctor)
                <span style="font-size:12px; color:#6b7280;">
                    • {{ $doctor->name }}
                </span>
            @endforeach

            @if ($doctorsCount > 3)
                <span style="font-size:12px; color:#9ca3af; font-style:italic;">
                    +{{ $doctorsCount - 3 }} {{ __('more') }}
                </span>
            @endif
        </div>
    @else
        <span style="font-size:12px; color:#9ca3af; font-style:italic;">
            {{ __('filament-language-switcher::services.noDoctorsAssigned') }}
        </span>
    @endif
</div>

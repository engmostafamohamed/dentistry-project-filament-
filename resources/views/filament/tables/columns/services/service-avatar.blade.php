@php
    // Get current language (en or ar)
    $locale = app()->getLocale();

    // Parse the title JSON field
    $title = is_array($getRecord()->title)
        ? $getRecord()->title
        : json_decode($getRecord()->title, true);

    // Get service name in current language, fallback to English, then 'S'
    $serviceName = $title[$locale] ?? $title['en'] ?? 'S';

    // Extract and capitalize first letter
    $firstLetter = strtoupper(substr($serviceName, 0, 1));
@endphp

<div style="flex-shrink:0; width:50px; height:50px;">
    @if ($getRecord()->image)
        {{-- Show uploaded image --}}
        <img
            src="{{ asset('storage/' . $getRecord()->image) }}"
            alt="{{ $serviceName }}"
            style="width:50px; height:50px; border-radius:50%; object-fit:cover; object-position:center; border:2px solid #e5e7eb;"
        />
    @else
        {{-- Show first letter in purple circle --}}
        <div style="width:50px; height:50px; border-radius:50%; background:#6366f1; display:flex; align-items:center; justify-content:center; color:white; font-size:18px; font-weight:600;">
            {{ $firstLetter }}
        </div>
    @endif
</div>

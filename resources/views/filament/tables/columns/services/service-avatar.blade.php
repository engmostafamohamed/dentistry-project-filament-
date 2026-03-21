@php
    // Use the model method instead of accessor
    $serviceName = $getRecord()->getTranslatedTitle();

    // Extract and capitalize first letter (use mb_substr for Arabic support)
    $firstLetter = strtoupper(mb_substr($serviceName, 0, 1));

    // Get image
    $image = $getRecord()->image;
@endphp

<div style="flex-shrink:0; width:50px; height:50px;">
    @if ($image)
        {{-- Show uploaded image --}}
        <img
            src="{{ asset('storage/' . $image) }}"
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

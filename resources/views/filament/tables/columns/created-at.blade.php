@php
    $createdAt = $getRecord()->created_at;
@endphp

<div style="display:flex; flex-direction:column; gap:2px;">
    <span style="font-size:13px; font-weight:500; color:inherit;">
        {{ $createdAt->format('M d, Y') }}
    </span>
    <span style="font-size:11px; color:#9ca3af;">
        {{ $createdAt->format('h:i A') }}
    </span>
</div>

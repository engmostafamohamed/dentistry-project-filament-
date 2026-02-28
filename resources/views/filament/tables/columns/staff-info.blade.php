<div style="display:flex; align-items:center; gap:10px;">
    {{-- Circular Avatar --}}
    <div style="flex-shrink:0; width:40px; height:40px;">
        @if ($getRecord()->photo)
            <img
                src="{{ asset('storage/' . $getRecord()->photo) }}"
                alt="{{ $getRecord()->name }}"
                style="width:40px; height:40px; border-radius:50%; object-fit:cover; object-position:center; border:2px solid #e5e7eb;"
            />
        @else
            <div style="width:40px; height:40px; border-radius:50%; background:#6366f1; display:flex; align-items:center; justify-content:center; color:white; font-size:14px; font-weight:600;">
                {{ strtoupper(substr($getRecord()->name, 0, 1)) }}
            </div>
        @endif
    </div>

    {{-- Name + Position --}}
    <div style="display:flex; flex-direction:column; min-width:0;">
        <span style="font-size:14px; font-weight:600; color:inherit; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">
            {{ $getRecord()->name }}
        </span>
        @if ($getRecord()->position)
            <span style="font-size:12px; color:#9ca3af; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">
                {{ $getRecord()->position }}
            </span>
        @endif
    </div>
</div>

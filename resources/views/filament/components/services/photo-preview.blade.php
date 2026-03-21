@php
    $src = null;

    if ($image) {
        $file = is_array($image) ? array_values($image)[0] : $image;
        $src = filter_var($file, FILTER_VALIDATE_URL)
            ? $file
            : asset('storage/' . $file);
    }
@endphp

@if ($src)

    <div style="display:flex; flex-direction:column; width:100%; gap:10px; margin-top:28px;">

        {{-- Image --}}
        <div style="position:relative; width:100%; height:220px; border-radius:12px;
                    overflow:hidden; border:1px solid #374151;">

            <img src="{{ $src }}" alt="{{ __('filament-language-switcher::services.currentPhoto') }}"
                 style="width:100%; height:100%; object-fit:cover; display:block;" />

            {{-- Current Photo badge --}}
            <div style="position:absolute; top:8px; left:8px;
                        background:rgba(34,197,94,0.9); color:#fff;
                        font-size:11px; font-weight:600; padding:3px 8px;
                        border-radius:999px; display:flex; align-items:center; gap:4px;">
                <svg width="10" height="10" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                          d="M16.707 5.293a1 1 0 010 1.414L8.414 15 3.293 9.879a1 1 0 011.414-1.414L8.414 12.172l6.879-6.879a1 1 0 011.414 0z"
                          clip-rule="evenodd"/>
                </svg>
                {{ __('filament-language-switcher::services.currentPhoto') }}
            </div>

        </div>

        {{-- Remove button — below the image, full width, properly styled --}}
        <button
            type="button"
            wire:click="removeImage"
            wire:confirm="{{ __('filament-language-switcher::services.confirmRemoveImage') }}"
            wire:loading.attr="disabled"
            style="display:flex; align-items:center; justify-content:center; gap:8px;
                   width:100%; padding:8px 16px; border-radius:8px; border:none;
                   cursor:pointer; background:#ef4444; color:#fff;
                   font-size:13px; font-weight:600; transition:background 0.2s;"
            onmouseover="this.style.background='#dc2626'"
            onmouseout="this.style.background='#ef4444'"
        >
            <svg wire:loading.remove wire:target="removeImage"
                 width="15" height="15" fill="none" stroke="currentColor" stroke-width="2"
                 viewBox="0 0 24 24" style="flex-shrink:0;">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M1 7h22M8 7V4a1 1 0 011-1h6a1 1 0 011 1v3"/>
            </svg>
            <span wire:loading.remove wire:target="removeImage">
                {{ __('filament-language-switcher::services.removeCurrentImage') }}
            </span>
            <span wire:loading wire:target="removeImage">
                {{ __('filament-language-switcher::services.removing') }}
            </span>
        </button>

    </div>

@else

    {{-- Empty state — shown after removal or when no image set --}}
    <div style="display:flex; flex-direction:column; align-items:center; justify-content:center;
                width:100%; height:220px; border-radius:12px; margin-top:28px;
                border:2px dashed #4b5563; background:#111827;">

        <svg width="36" height="36" fill="none" stroke="#6b7280" stroke-width="1.5"
             viewBox="0 0 24 24" style="margin-bottom:12px;">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
        </svg>

        <p style="color:#9ca3af; font-size:13px; font-weight:500; margin:0;">
            {{ __('filament-language-switcher::services.noImageUploaded') }}
        </p>
        <p style="color:#6b7280; font-size:11px; margin:4px 0 0 0;">
            {{ __('filament-language-switcher::services.uploadImageUsingUploader') }}
        </p>

    </div>

@endif

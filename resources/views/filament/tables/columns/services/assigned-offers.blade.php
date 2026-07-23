@php
    $offersCount = $getRecord()->offers()->count();
    $offers = $getRecord()->offers()->take(3)->get();
@endphp

<div style="display:flex; flex-direction:column; gap:4px;">
    @if ($offersCount > 0)
        {{-- Offers count badge --}}
        <span style="display:inline-flex; align-items:center; justify-content:center; padding:2px 8px; background:#10b981; color:white; border-radius:9999px; font-size:12px; font-weight:600; width:fit-content;">
            {{--  {{ $offersCount }} {{ $offersCount === 1 ? __('filament-language-switcher::services.offer') : __('filament-language-switcher::services.offers') }}  --}}
            {{ $offersCount }} {{ __('filament-language-switcher::services.offer')}}
        </span>

        {{-- First 3 offer names --}}
        <div style="display:flex; flex-direction:column; gap:2px;">
            @foreach ($offers as $offer)
                @php
                    $locale = app()->getLocale();
                    $offerTitle = is_array($offer->title) ? $offer->title : json_decode($offer->title, true);
                    $title = $offerTitle[$locale] ?? $offerTitle['en'] ?? __('Untitled');
                @endphp
                <span style="font-size:12px; color:#6b7280;">
                    • {{ $title }}
                </span>
            @endforeach

            @if ($offersCount > 3)
                <span style="font-size:12px; color:#9ca3af; font-style:italic;">
                    +{{ $offersCount - 3 }} {{ __('more') }}
                </span>
            @endif
        </div>
    @else
        <span style="font-size:12px; color:#9ca3af; font-style:italic;">
            {{ __('filament-language-switcher::services.noOffersAssigned') }}
        </span>
    @endif
</div>

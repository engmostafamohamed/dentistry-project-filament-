<x-filament-panels::page>

    {{-- Tabs --}}
    <x-filament::tabs>
        <x-filament::tabs.item
            :active="$this->activeTab === 'list'"
            wire:click="$set('activeTab', 'list')"
        >
            {{ __('Guests List') }}
        </x-filament::tabs.item>

        <x-filament::tabs.item
            :active="$this->activeTab === 'calendar'"
            wire:click="$set('activeTab', 'calendar')"
        >
            {{ __('Calendar') }}
        </x-filament::tabs.item>
    </x-filament::tabs>

    <div class="mt-6">
        @if ($this->activeTab === 'calendar')
            @include('filament.resources.guests.pages.guest-calendar', [
                'guests' => $guests,
                'doctors' => $doctors,
            ])
        @else
            {{ $this->table }}
        @endif
    </div>

</x-filament-panels::page>

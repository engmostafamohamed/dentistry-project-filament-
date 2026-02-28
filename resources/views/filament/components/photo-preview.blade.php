@if ($getRecord()?->photo)
    <div class="flex items-center gap-3">
        <img src="{{ asset('storage/'.$getRecord()->photo) }}"
             class="w-24 h-24 rounded-full object-cover border border-gray-300 shadow-sm">
        <p class="text-sm text-gray-500 dark:text-gray-300">{{ __('Current Photo') }}</p>
    </div>
@endif

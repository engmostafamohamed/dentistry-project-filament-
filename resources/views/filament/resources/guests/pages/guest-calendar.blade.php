<div class="flex flex-col gap-6">
    <div class="grid grid-cols-12 gap-6">

        {{-- Unassigned Guests --}}
        <div class="col-span-12 md:col-span-3">
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow p-4 border">
                <h3 class="text-lg font-semibold mb-4">
                    Unassigned Guests
                </h3>

                <div id="unassigned-guests" class="space-y-3 max-h-[70vh] overflow-y-auto">
                    @foreach ($guests->whereNull('doctor_id') as $guest)
                        <div
                            class="p-3 bg-gray-100 dark:bg-gray-700 rounded-lg cursor-move"
                            data-id="{{ $guest->id }}"
                        >
                            <div class="font-medium">{{ $guest->name }}</div>
                            <div class="text-sm text-gray-500">{{ $guest->phone }}</div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Calendar --}}
        <div class="col-span-12 md:col-span-9">
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow p-4 border">
                <div id="calendar" class="h-[80vh]"></div>
            </div>
        </div>
    </div>
</div>

{{-- Filament v3 assets --}}
@assets
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css">
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
@endassets

@script
<script>
    let calendarInitialized = false;

    function initCalendar() {
        if (calendarInitialized) return;

        const calendarEl = document.getElementById('calendar');
        const unassigned = document.getElementById('unassigned-guests');

        if (!calendarEl || !unassigned || typeof FullCalendar === 'undefined') {
            setTimeout(initCalendar, 150);
            return;
        }

        new FullCalendar.Draggable(unassigned, {
            itemSelector: '[data-id]',
            eventData: el => ({
                id: el.dataset.id,
                title: el.querySelector('.font-medium').innerText,
            }),
        });

        const calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'resourceTimeGridDay',
            height: '100%',
            editable: true,
            droppable: true,
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'resourceTimeGridDay,resourceTimeGridWeek,dayGridMonth',
            },
            resources: '/admin/doctors',
            events: '/admin/guests-calendar',
        });

        calendar.render();
        calendarInitialized = true;
    }

    document.addEventListener('DOMContentLoaded', initCalendar);
    document.addEventListener('livewire:navigated', initCalendar);
</script>
@endscript

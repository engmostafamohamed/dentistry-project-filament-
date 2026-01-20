import { Calendar } from '@fullcalendar/core';
import resourceTimeGridPlugin from '@fullcalendar/resource-timegrid';
import interactionPlugin, { Draggable } from '@fullcalendar/interaction';

document.addEventListener('DOMContentLoaded', function () {
    const calendarEl = document.getElementById('calendar');
    if (!calendarEl) return;

    // Make unassigned guests draggable
    new Draggable(document.getElementById('unassigned-guests'), {
        itemSelector: '.p-3',
        eventData: function (el) {
            return {
                id: el.dataset.id,
                title: el.querySelector('strong').innerText,
            };
        },
    });

    const calendar = new Calendar(calendarEl, {
        plugins: [resourceTimeGridPlugin, interactionPlugin],
        initialView: 'resourceTimeGridDay',
        editable: true,
        droppable: true,
        resources: async (fetchInfo, successCallback) => {
            
            const res = await fetch('/admin/doctors');
            const data = await res.json();
            successCallback(data.map(d => ({
                id: d.id,
                title: d.name.en ?? d.name,
            })));
        },
        events: async (fetchInfo, successCallback) => {
            const res = await fetch('/admin/guests-calendar');
            const data = await res.json();
            successCallback(data);
        },
        drop: (info) => {
            const guestId = info.draggedEl.dataset.id;
            const doctorId = info.resource.id;

            fetch(`/admin/assign-guest/${guestId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                },
                body: JSON.stringify({ doctor_id: doctorId }),
            });
        },
    });

    calendar.render();
});

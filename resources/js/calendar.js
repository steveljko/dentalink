import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import timeGridPlugin from '@fullcalendar/timegrid';
import interactionPlugin from '@fullcalendar/interaction';
import listPlugin from '@fullcalendar/list';

const defaultCalendarOptions = {
    plugins: [ timeGridPlugin ],
    views: { timeGrid: { slotLabelFormat: { hour: '2-digit', minute: '2-digit', hour12: false } } },
    initialView: 'timeGrid',
    timeZone: 'local',
    allDaySlot: false,
    nowIndicator: true,
    // show only time between 9am and 11pm
    slotMinTime: '09:00:00',
    slotMaxTime: '23:00:00',
    eventClick: (info) => {
        const id = info.event.extendedProps.patientId;
        window.location.replace(`/patient/${id}`);
    }
};

function transformAppointmentsToEvents(appointments) {
    return appointments.map(appointment => {
        const startTime = new Date(appointment.scheduled_start);
        console.log(startTime);
        const e = startTime.getTime() + (appointment.duration * 60 * 1000);
        const endTime = new Date(e);

        return {
            id: appointment.id.toString(),
            title: `${appointment.patient.id} | ${appointment.patient.first_name} ${appointment.patient.last_name}`,
            start: startTime.toISOString(),
            end: endTime.toISOString(),
            patientId: appointment.patient.id,
        };
    });
}

document.addEventListener('DOMContentLoaded', () => {
    const calendarEl = document.getElementById('calendar');
    if (calendarEl) {
        const appointments = JSON.parse(calendarEl.getAttribute('data-appointments')) || {};
        const appointmentsAsEvents = transformAppointmentsToEvents(appointments);

        const calendar = new Calendar(calendarEl, {
            ...defaultCalendarOptions,
            headerToolbar: { left: '', center: '', right: '' },
            events: appointmentsAsEvents,
        });

        calendar.render();
    }

    const fullcalendarEl = document.getElementById('full-calendar');
    if (fullcalendarEl) {
        const appointments = JSON.parse(fullcalendarEl.getAttribute('data-appointments')) || {};
        const appointmentsAsEvents = transformAppointmentsToEvents(appointments);

        const calendar = new Calendar(fullcalendarEl, {
            ...defaultCalendarOptions,
            events: appointmentsAsEvents,
        });

        calendar.render();
    }
});

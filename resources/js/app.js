import htmx from 'htmx.org';
import modal from './modal';
import { Fancybox } from "@fancyapps/ui";
import "@fancyapps/ui/dist/fancybox/fancybox.css";
window.htmx = htmx;
window.modal = modal;
window.htmx.config.defaultFocusScroll = 'true';

import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import timeGridPlugin from '@fullcalendar/timegrid';
import interactionPlugin from '@fullcalendar/interaction';
import listPlugin from '@fullcalendar/list';


htmx.on('htmx:afterSwap', (e) => {
  if (e.detail.target.id == 'dialog') {
        window.modal.show();
  }
});

htmx.on('htmx:beforeSwap', (e) => {
    if (e.detail.target.id == 'dialog' && !e.detail.xhr.response) {
        window.modal.hide();

        e.detail.shouldSwap = false;
    }
});

// remove all validation messages before request starts
document.addEventListener('htmx:beforeRequest', function (event) {
    const errors = document.querySelectorAll('[id$="-error"]');
    errors.forEach(error => {
        error.classList.add('hidden');
        error.innerHTML = '';
    });
});

// handle validation errors
document.addEventListener('htmx:responseError', function (event) {
    const errors = JSON.parse(event.detail.xhr.response).errors;

    for (const [field, messages] of Object.entries(errors)) {
        const input = document.getElementById(field);
        const error = document.querySelector(`#${field}-error`);

        input.addEventListener('keydown', e => {
            error.classList.remove('hidden');
            error.innerHTML = '';
        });

        error.classList.remove('hidden');
        error.innerHTML = messages[0];
    }
});

function previewImage(event) {
    const file = event.target.files[0];
    const previewContainer = document.getElementById('image-preview');
    const previewImg = document.getElementById('preview-img');
    const uploadBtn = document.getElementById('upload-btn');

    if (file) {
        if (!file.type.startsWith('image/')) {
            alert('Please select a valid image file.');
            event.target.value = '';
            return;
        }

        if (file.size > 5 * 1024 * 1024) {
            alert('File size must be less than 5MB.');
            event.target.value = '';
            return;
        }

        const reader = new FileReader();
        reader.onload = function(e) {
            previewImg.src = e.target.result;
            previewContainer.classList.remove('hidden');
            uploadBtn.disabled = false;
        };
        reader.readAsDataURL(file);
    } else {
        previewContainer.classList.add('hidden');
        uploadBtn.disabled = true;
    }
}

function removeImage() {
    const fileInput = document.getElementById('image');
    const previewContainer = document.getElementById('image-preview');
    const uploadBtn = document.getElementById('upload-btn');

    fileInput.value = '';
    previewContainer.classList.add('hidden');
    uploadBtn.disabled = true;
}

window.previewImage = previewImage;
window.removeImage = removeImage;

// user menu
document.addEventListener('DOMContentLoaded', () => {
    const userMenuButton = document.getElementById('userMenuButton');
    if (userMenuButton) {
        const dropdown = document.getElementById('userDropdown');

        userMenuButton.addEventListener('click', () => dropdown.classList.toggle('hidden'));
    }

    Fancybox.bind("[data-fancybox='gallery']", {});

    const calendarEl = document.getElementById('calendar');
    if (calendarEl) {
        const appointments = JSON.parse(calendarEl.getAttribute('data-appointments')) || {};

        const appointmentsAsEvents = appointments.map(appointment => {
            const startTime = new Date(appointment.scheduled_start);
            const e = startTime.getTime() + (appointment.duration * 60 * 1000);
            const endTime = new Date(e);

            return {
                id: appointment.id.toString(),
                title: `${appointment.patient.id} | ${appointment.patient.first_name} ${appointment.patient.last_name}`,
                start: startTime.toISOString(),
                end: endTime.toISOString(),
            };
        });

        const calendar = new Calendar(calendarEl, {
            plugins: [ timeGridPlugin ],
            headerToolbar: { left: '', center: '', right: '' },
            views: {
                timeGrid: {
                    slotLabelFormat: { hour: '2-digit', minute: '2-digit', hour12: false }
                }
            },
            initialView: 'timeGrid',
            timeZone: 'Europe/Belgrade',
            allDaySlot: false,
            nowIndicator: true,
            events: appointmentsAsEvents,
        });

        calendar.render();
    }
});


import htmx from 'htmx.org';
import modal from './modal';
import { Fancybox } from "@fancyapps/ui";
import "@fancyapps/ui/dist/fancybox/fancybox.css";
window.htmx = htmx;
window.modal = modal;
window.htmx.config.defaultFocusScroll = 'true';


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
});


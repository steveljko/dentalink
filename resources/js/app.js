import htmx from 'htmx.org';
import { Fancybox } from "@fancyapps/ui";
import "@fancyapps/ui/dist/fancybox/fancybox.css";
window.htmx = htmx;
window.htmx.config.defaultFocusScroll = 'true';

class Modal {
    constructor() {
        this.modal = document.getElementById('modal-container');
        this.dialog = document.getElementById('dialog');
        this.backdrop = document.getElementById('modal-backdrop');
        this.modal.addEventListener('keydown', (event) => {
            if (event.key == 'Escape') this.hide();
        });
    }

    toggleModal() {
        this.modal.classList.toggle('hidden');
        this.modal.setAttribute('aria-hidden', 'false');
        this.toggleBackdrop();
        this.modal.focus();
    }

    toggleBackdrop() {
        this.backdrop.classList.toggle('hidden');
    }

    clearDialog () {
        this.dialog.innerHTML = '';
        this.modal.setAttribute('aria-hidden', 'true');
        this.modal.blur();
    }

    setupCloseButtons() {
        if (this.modal) {
            this.modal.querySelectorAll('[data-hide-modal="true"]')
                    .forEach(e => e.addEventListener('click', _ => this.hide()));
        }
    }

    show() {
        this.toggleModal();
        this.setupCloseButtons();
    }

    hide() {
        this.toggleModal();
        this.clearDialog();
    }
}

window.modal = new Modal;

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

// handle validation errors
document.addEventListener('htmx:responseError', function (event) {
    const errors = JSON.parse(event.detail.xhr.response).errors;

    for (const [field, messages] of Object.entries(errors)) {
        const container = document.querySelector(`#${field}-error`);
        container.classList.remove('hidden');
        container.innerHTML = messages[0];
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
    const btn = document.getElementById('userMenuButton');
    const dropdown = document.getElementById('userDropdown');

    userMenuButton.addEventListener('click', () => dropdown.classList.toggle('hidden'));

    Fancybox.bind("[data-fancybox='gallery']", {});

});


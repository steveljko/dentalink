import htmx from 'htmx.org';
window.htmx = htmx;

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

// user menu
document.addEventListener('DOMContentLoaded', () => {
    const btn = document.getElementById('userMenuButton');
    const dropdown = document.getElementById('userDropdown');

    userMenuButton.addEventListener('click', () => dropdown.classList.toggle('hidden'));
});

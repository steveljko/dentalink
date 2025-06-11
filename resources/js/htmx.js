import htmx from 'htmx.org';

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


htmx.config.defaultFocusScroll = 'true';

window.htmx = htmx;

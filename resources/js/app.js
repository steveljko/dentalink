import './htmx';
import './modal';
import './calendar';
import './gallery';

// user menu
document.addEventListener('DOMContentLoaded', () => {
    const userMenuButton = document.getElementById('userMenuButton');
    if (userMenuButton) {
        const dropdown = document.getElementById('userDropdown');
        userMenuButton.addEventListener('click', () => dropdown.classList.toggle('hidden'));
    }
});

// TODO: Find better way to pass route url
function handleKeydown(event) {
    if (event.shiftKey && event.key === 'P') {
        event.preventDefault();

        htmx.ajax('GET', '/patient/create', { target:'#dialog' })
    }
}

document.addEventListener('keydown', handleKeydown);

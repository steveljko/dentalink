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


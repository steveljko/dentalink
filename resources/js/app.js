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

document.addEventListener('DOMContentLoaded', () => {
    document.getElementById('notificationToggle').addEventListener('click', () => {
        const dropdown = document.getElementById('notificationDropdown');
        const isVisible = dropdown.classList.contains('opacity-100');

        if (isVisible) {
            dropdown.classList.remove('opacity-100', 'visible', 'translate-y-0');
            dropdown.classList.add('opacity-0', 'invisible', '-translate-y-2');
        } else {
            dropdown.classList.remove('opacity-0', 'invisible', '-translate-y-2');
            dropdown.classList.add('opacity-100', 'visible', 'translate-y-0');
        }

        // close dropdown when clicking outside
        setTimeout(() => {
            document.addEventListener('click', function closeDropdown(event) {
                if (!event.target.closest('.relative')) {
                    dropdown.classList.remove('opacity-100', 'visible', 'translate-y-0');
                    dropdown.classList.add('opacity-0', 'invisible', '-translate-y-2');
                    document.removeEventListener('click', closeDropdown);
                }
            });
        }, 100);
    });

    // autohide after 10 seconds of inactivity
    let hideTimer;
    const dropdown = document.getElementById('notificationDropdown');

    dropdown.addEventListener('mouseenter', () => clearTimeout(hideTimer));

    dropdown.addEventListener('mouseleave', function() {
        hideTimer = setTimeout(() => {
            this.classList.remove('opacity-100', 'visible', 'translate-y-0');
            this.classList.add('opacity-0', 'invisible', '-translate-y-2');
        }, 10000);
    });
});

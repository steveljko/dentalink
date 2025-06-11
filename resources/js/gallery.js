import { Fancybox } from "@fancyapps/ui";
import "@fancyapps/ui/dist/fancybox/fancybox.css";

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

document.addEventListener('DOMContentLoaded', () => {
    Fancybox.bind("[data-fancybox='gallery']", {});
});

<form hx-post="{{ route('patient.attach', $patient) }}" hx-encoding="multipart/form-data" id="modal-content">
    <x-modal.header>Asd</x-modal.header>
    <x-modal.body>
        @fragment('form')
            <div class="space-y-4">
                <x-input type="file" name="file" accept="image/*" :required="true"
                    class="file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100"
                    onchange="window.previewImage(event)" />

                <div id="image-preview" class="hidden">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Preview
                    </label>
                    <div class="relative">
                        <img id="preview-img" src="" alt="Image preview"
                            class="max-w-full h-auto max-h-64 rounded-lg border border-gray-300 shadow-sm">
                        <button type="button" onclick="removeImage()"
                            class="absolute top-2 right-2 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-sm hover:bg-red-600">
                            ×
                        </button>
                    </div>
                </div>

                <x-textarea name="description" label="Opis fotografije" />
            </div>
        @endfragment
    </x-modal.body>
    <x-modal.footer>
        <x-button variant="secondary" data-hide-modal="true">Zatvori</x-button>
        <x-button id="upload-btn" type="submit">Upload</x-button>
    </x-modal.footer>
</form>

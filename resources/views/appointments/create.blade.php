<form hx-post="{{ route('patient.store.appointment', $patient->id) }}" hx-indicator="button #spinner" id="modal-content">
    <x-modal.header>Novo zakazivanje</x-modal.header>
    <x-modal.body>
        @fragment('form')
            <div class="space-y-4">
                <x-input type="datetime-local" name="scheduled_start" label="Vreme" :required="true" />
                <x-select name="duration" label="Dužina" :options="[
                    '30' => '30 minuta',
                    '45' => '45 minuta',
                    '60' => '1 sat',
                    '90' => '1.5 sat',
                    '120' => '2 sata',
                ]" :required="true" />
                <x-textarea name="notes" label="Notes" />

            </div>
        @endfragment
    </x-modal.body>
    <x-modal.footer>
        <x-button data-hide-modal="true" variant="secondary">Zatvori</x-button>
        <x-button type="submit">Zakaži</x-button>
    </x-modal.footer>
</form>

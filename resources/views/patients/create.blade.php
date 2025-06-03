<form hx-post="{{ route('patient.store') }}" id="modal-content">
    <x-modal.header>{{ __('patients.create') }}</x-modal.header>
    <x-modal.body>
        @fragment('form')
            <div class="space-y-4">
                <x-input name="first_name" :label="__('patients.first_name')" :required="true" />
                <x-input name="last_name" :label="__('patients.last_name')" :required="true" />
                <x-input name="date_of_birth" :label="__('patients.date_of_birth')" type="date" />
                <x-input name="phone" :label="__('patients.phone')" />
                <x-select name="gender" :label="__('patients.gender')" :options="['male' => 'Muško', 'female' => 'Žensko']" :required="true" />
            </div>
        @endfragment
    </x-modal.body>
    <x-modal.footer>
        <x-button variant="secondary" data-hide-modal="true">Zatvori</x-button>
        <x-button type="submit">{{ __('patients.save') }}</x-button>
    </x-modal.footer>
</form>

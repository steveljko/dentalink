<form hx-put="{{ route('patient.update', $patient) }}" id="modal-content">
    <x-modal.header>Izmeni Pacijenta</x-modal.header>
    <x-modal.body>
        @fragment('form')
            <div class="space-y-4">
                <x-input name="first_name" :label="__('patients.first_name')" :required="true" :value="$patient->first_name" />
                <x-input name="last_name" :label="__('patients.last_name')" :required="true" :value="$patient->last_name" />
                <x-input name="date_of_birth" :label="__('patients.date_of_birth')" type="date" :value="$patient->date_of_birth" />
                <x-input name="phone" :label="__('patients.phone')" :value="$patient->phone" />
                <x-select name="gender" :label="__('patients.gender')" :options="['male' => 'Muško', 'female' => 'Žensko']" :required="true" :value="$patient->gender" />

                <div class="w-full bg-gray-200 h-[1px] my-4"></div>

                <x-input name="emergency_contact_name" :label="__('patients.emergency_contact_name')" :value="$patient->emergency_contact_name" />
                <x-input name="emergency_contact_phone" :label="__('patients.emergency_contact_phone')" :value="$patient->emergency_contact_phone" />

                <div class="w-full bg-gray-200 h-[1px] my-4"></div>
                <x-textarea name="notes" label="Opis" :value="$patient->notes" />
            </div>
        @endfragment
    </x-modal.body>
    <x-modal.footer>
        <x-button variant="secondary" data-hide-modal="true">Zatvori</x-button>
        <x-button type="submit">{{ __('patients.save') }}</x-button>
    </x-modal.footer>
</form>

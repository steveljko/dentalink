<form hx-post="{{ route('patient.store') }}" class="modal-box">
    <h5>{{ __('patients.create') }}</h5>
    <div>
        @fragment('form')
        <div class="space-y-4">
            <x-input name="health_card_number" :label="__('patients.health_card_number')" :required="true" />
            <x-input name="first_name" :label="__('patients.first_name')" :required="true" />
            <x-input name="last_name" :label="__('patients.last_name')" :required="true" />
            <x-input name="date_of_birth" :label="__('patients.date_of_birth')" type="date" />
            <x-input name="phone" :label="__('patients.phone')" />
            <x-select name="gender" :label="__('patients.gender')" :options="['male' => 'Muško', 'female' => 'Žensko']" :required="true" />
        </div>
        @endfragment
    </div>
    <div class="flex justify-end gap-2 mt-4">
        <button class="btn btn-outline">Zatvori</button>
        <button class="btn btn-primary" type="submit">{{ __('patients.save') }}</button>
    </div>
</form>

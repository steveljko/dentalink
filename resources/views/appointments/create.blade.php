<form hx-post="{{ route('patient.store.appointment', $patient->id) }}" hx-indicator="button #spinner" id="modal-content">
    <x-modal.header>Novo zakazivanje</x-modal.header>
    <x-modal.body>
        @fragment('form')
            <div class="space-y-4">
                <div class="w-full flex space-x-4">
                    <div class="flex-1">
                        <label for="date" class="block text-sm font-semibold text-gray-700 mb-2">
                            Datum
                        </label>
                        <input type="date" id="date"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200">
                        <div class="flex space-x-1 mt-2">
                            <button type="button" onclick="dateTimePicker.setDate(0)"
                                class="px-2 py-1 bg-blue-500 hover:bg-blue-600 text-sm text-white font-medium rounded-full transition-colors duration-200 shadow-sm cursor-pointer hover:shadow-md">Danas</button>
                            <button type="button" onclick="dateTimePicker.setDate(1)"
                                class="px-2 py-1 bg-green-500 hover:bg-green-600 text-sm text-white font-medium rounded-full transition-colors duration-200 shadow-sm cursor-pointer hover:shadow-md">+1
                                dan</button>
                            <button type="button" onclick="dateTimePicker.setDate(5)"
                                class="px-2 py-1 bg-red-500 hover:bg-red-600 text-sm text-white font-medium rounded-full transition-colors duration-200 shadow-sm cursor-pointer hover:shadow-md">+5
                                dan</button>
                            <button type="button" onclick="dateTimePicker.setDate(7)"
                                class="px-2 py-1 bg-orange-500 hover:bg-orange-600 text-sm text-white font-medium rounded-full transition-colors duration-200 shadow-sm cursor-pointer hover:shadow-md">+1
                                Nedelja</button>
                        </div>
                    </div>
                    <div class="flex flex-1 space-x-2">
                        <div class="flex-1">
                            <label for="hour" class="block text-sm font-semibold text-gray-700 mb-2">Sati</label>
                            <select id="hour"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm"></select>
                        </div>
                        <div class="flex-1">
                            <label for="minutes" class="block text-sm font-semibold text-gray-700 mb-2">Minuti</label>
                            <select id="minutes" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm">
                                <option value="00">00</option>
                                <option value="15">15</option>
                                <option value="30" selected>30</option>
                                <option value="45">45</option>
                            </select>
                        </div>
                    </div>
                    <input class="hidden" id="datetime" name="scheduled_start" />
                </div>

                <x-select name="duration" label="Dužina" :options="[
                    '30' => '30 minuta',
                    '45' => '45 minuta',
                    '60' => '1 sat',
                    '90' => '1.5 sat',
                    '120' => '2 sata',
                ]" :required="true" />

                <x-textarea name="notes" :label="__('appointments.notes')" />
            </div>
        @endfragment
    </x-modal.body>
    <x-modal.footer>
        <x-button data-hide-modal="true" variant="secondary">Zatvori</x-button>
        <x-button type="submit">Zakaži</x-button>
    </x-modal.footer>
    <script>
        class DateTimePicker {
            constructor() {
                this.elements = {
                    date: document.getElementById('date'),
                    hour: document.getElementById('hour'),
                    minutes: document.getElementById('minutes'),
                    field: document.getElementById('datetime'),
                };

                this.init();
            }

            init() {
                this.setDefaultDate();
                this.populateHours();
                this.bindEvents();
                this.updateDateTime();
            }

            setDefaultDate() {
                if (this.elements.date) {
                    this.elements.date.value = new Date().toISOString().split('T')[0];
                }
            }

            setDate(daysOffset) {
                const date = new Date();
                date.setDate(date.getDate() + daysOffset);
                this.elements.date.value = date.toISOString().split('T')[0];
                this.updateDateTime();
            }

            populateHours() {
                const {
                    hour
                } = this.elements;
                if (!hour) return;

                hour.innerHTML = '';

                for (let i = 8; i <= 23; i++) {
                    const option = document.createElement('option');
                    const hourString = i.toString().padStart(2, '0');

                    option.value = hourString;
                    option.textContent = hourString;
                    option.selected = i === 9;

                    hour.appendChild(option);
                }
            }

            updateDateTime() {
                const {
                    date,
                    hour,
                    minutes,
                    field
                } = this.elements;

                if (!date?.value || !hour?.value || !minutes?.value || !field) return;

                field.value = `${date.value} ${hour.value}:${minutes.value}:00`;
            }

            bindEvents() {
                const {
                    date,
                    hour,
                    minutes
                } = this.elements;

                date?.addEventListener('change', this.updateDateTime());
                hour?.addEventListener('change', this.updateDateTime());
                minutes?.addEventListener('change', this.updateDateTime());
            }
        }

        const dateTimePicker = new DateTimePicker();
    </script>
</form>

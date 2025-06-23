<ul class="absolute top-full left-0 w-[360px] bg-white border border-gray-200 rounded-lg shadow-lg mt-1 z-50 list-none max-h-[300px] overflow-y-auto">
    @foreach ($patients as $patient)
        <li class="border-b border-gray-100 last:border-b-0">
            <a href="http://localhost:8000/patient/{{ $patient->id }}"
               class="flex items-center justify-between px-4 py-3 text-gray-800 hover:bg-blue-50 hover:text-blue-700 transition-colors duration-150 focus:bg-blue-50 focus:text-blue-700 focus:outline-none">
                <div class="flex flex-col">
                    <span class="font-medium">{{ $patient->first_name }} {{ $patient->last_name }}</span>
                    @if(isset($patient->date_of_birth))
                        <span class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($patient->date_of_birth)->format('d.m.Y') }}</span>
                    @endif
                    @if(isset($patient->id))
                        <span class="text-xs text-gray-400">Broj: {{ $patient->id }}</span>
                    @endif
                </div>
                <i class="fas fa-chevron-right"></i>
            </a>
        </li>
    @endforeach

    @if(count($patients) > 0)
        <li class="border-t border-gray-200 bg-gray-50">
            <a href="http://localhost:8000/patient?search={{ $name }}"
               class="flex items-center justify-center px-4 py-3 text-blue-600 font-medium hover:bg-blue-100 transition-colors duration-150 focus:bg-blue-100 focus:outline-none">
                <i class="fas fa-search mr-2"></i>
                Prikaži sve rezultate ({{ count($patients) }})
            </a>
        </li>
    @else
        <li class="px-4 py-6 text-center text-gray-500">
            <i class="fas fa-users"></i>
            <p class="font-medium">Nema rezultata</p>
            <p class="text-sm">Pokušajte sa drugim pojmom pretrage</p>
        </li>
    @endif
</ul>

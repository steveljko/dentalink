@props(['patient'])

<div class="lg:col-span-3 mt-6">
    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
        <div class="px-6 py-4 border-b border-gray-200">
            <div class="flex justify-between items-center">
                <h2 class="text-lg font-semibold text-gray-900">Prilozi</h2>
                <x-button hx-get="{{ route('patient.upload', $patient) }}" hx-target="#dialog" icon="plus"
                    size="sm">
                    Dodaj prilog
                </x-button>
            </div>
        </div>
        <div class="p-6">
            @if ($patient->attachments && $patient->attachments->count() > 0)
                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
                    @foreach ($patient->attachments as $attachment)
                        <div class="relative group">
                            <a href="{{ asset('storage/' . $attachment->destination) }}" data-fancybox="gallery"
                                data-caption="{{ $attachment->description }}">
                                <img src="{{ asset('storage/' . $attachment->destination) }}"
                                    class="w-full h-64 object-cover rounded-lg shadow-md transition-transform duration-200 transform group-hover:scale-102 border border-gray-200">
                            </a>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">Nema priloga</h3>
                    <p class="mt-1 text-sm text-gray-500">
                        Pacijent nema još uvek ni jedan prilog.
                    </p>
                    <div class="mt-6">
                        <x-button hx-get="{{ route('patient.upload', $patient) }}" hx-target="#dialog">
                            Otpremi prvi prilog
                        </x-button>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

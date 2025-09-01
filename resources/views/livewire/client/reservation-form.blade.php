<div class="max-w-6xl mx-auto p-6 mt-10 bg-gray-100">
    <h2 class="text-xl font-bold mb-4">Nowa rezerwacja</h2>

    @if (session()->has('success'))
        <div class="text-green-600 mb-4">{{ session('success') }}</div>
    @endif

    @if (session()->has('error'))
        <div class="text-red-600 mb-4">{{ session('error') }}</div>
    @endif

    <form wire:submit.prevent="reserve" class="space-y-4">
        {{-- Wybór usługi --}}
        <div>
            <label for="service" class="block">Usługa</label>
            <select wire:model="service_id" class="border p-2 rounded w-full">
                <option value="">-- wybierz usługę --</option>
                @foreach($services as $service)
                    <option value="{{ $service->id }}">{{ $service->name }} ({{ $service->price }} zł)</option>
                @endforeach
            </select>
            @error('service_id') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        {{-- Wybór terminu --}}
        <div>
            <label for="slot" class="block">Termin</label>
            <select wire:model="slot_id" class="border p-2 rounded w-full">
                <option value="">-- wybierz termin --</option>
                @foreach($slots as $slot)
                    <option value="{{ $slot->id }}">
                        {{ $slot->date }} {{ $slot->time }}
                    </option>
                @endforeach
            </select>
            @error('slot_id') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">
            Zarezerwuj
        </button>
    </form>
</div>

<div class="max-w-6xl mx-auto p-6">
    <h2 class="text-xl font-bold mb-4 text-gray-50">Lista wszystkich rezerwacji</h2>

    @if (session()->has('success'))
        <div class="text-green-600 mb-4">{{ session('success') }}</div>
    @endif

    <table class="w-full border text-sm">
        <thead>
        <tr class="bg-gray-100 text-left">
            <th class="border px-4 py-2">ID</th>
            <th class="border px-4 py-2">Klient</th>
            <th class="border px-4 py-2">Usługa</th>
            <th class="border px-4 py-2">Data</th>
            <th class="border px-4 py-2">Godzina</th>
            <th class="border px-4 py-2">Status</th>
            <th class="border px-4 py-2">Akcje</th>
        </tr>
        </thead>
        <tbody>
        @forelse($reservations as $reservation)
            <tr class="bg-gray-100">
                <td class="border px-4 py-2">{{ $reservation->id }}</td>
                <td class="border px-4 py-2">{{ $reservation->user->name }} <br>
                    <span class="text-gray-500">{{ $reservation->user->email }}</span>
                </td>
                <td class="border px-4 py-2">{{ $reservation->service->name }}</td>
                <td class="border px-4 py-2">{{ $reservation->slot->date }}</td>
                <td class="border px-4 py-2">{{ $reservation->slot->time }}</td>
                <td class="border px-4 py-2">
                    @if($reservation->status === 'pending')
                        Oczekująca
                    @elseif($reservation->status === 'confirmed')
                        Potwierdzona
                    @else
                        Anulowana
                    @endif
                </td>
                <td class="border px-4 py-2">
                    <button wire:click="updateStatus({{ $reservation->id }}, 'confirmed')"
                            class="bg-green-500 text-white px-2 py-1 rounded text-xs">Potwierdź
                    </button>

                    <button wire:click="updateStatus({{ $reservation->id }}, 'cancelled')"
                            class="bg-red-500 text-white px-2 py-1 rounded text-xs">Anuluj
                    </button>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7" class="text-center p-4">Brak rezerwacji</td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>

<div class="max-w-6xl mx-auto p-6 mt-10 bg-gray-100">
    <h2 class="text-xl font-bold mb-4">Moje rezerwacje</h2>

    <table class="w-full border">
        <thead>
        <tr class="bg-gray-100">
            <th class="border px-4 py-2">Usługa</th>
            <th class="border px-4 py-2">Data</th>
            <th class="border px-4 py-2">Godzina</th>
            <th class="border px-4 py-2">Status</th>
        </tr>
        </thead>
        <tbody>
        @forelse($reservations as $reservation)
            <tr>
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
            </tr>
        @empty
            <tr>
                <td colspan="4" class="text-center p-4">Brak rezerwacji</td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>

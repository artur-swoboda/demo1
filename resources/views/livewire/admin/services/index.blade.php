<div class="max-w-6xl mx-auto p-6">
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">Usługi</h2>
        <button wire:click="create" class="px-3 py-2 rounded bg-green-600 text-white">+ Dodaj</button>
    </div>

    @if (session()->has('success'))
        <div class="mb-4 p-3 rounded bg-green-100 text-green-800">{{ session('success') }}</div>
    @endif

    <div class="overflow-x-auto border rounded">
        <table class="min-w-full text-sm">
            <thead class="bg-gray-100">
            <tr>
                <th class="p-3 text-left">Nazwa</th>
                <th class="p-3 text-left">Czas (min)</th>
                <th class="p-3 text-left">Cena</th>
                <th class="p-3 text-left">Akcje</th>
            </tr>
            </thead>
            <tbody>
            @forelse($services as $service)
                <tr class="border-t bg-gray-400">
                    <td class="p-3 border-gray-100">{{ $service->name }}</td>
                    <td class="p-3">{{ $service->duration }}</td>
                    <td class="p-3">{{ number_format($service->price,2) }} zł</td>
                    <td class="p-3">
                        <button wire:click="edit({{ $service->id }})" class="underline text-blue-600 mr-2">Edytuj
                        </button>

                        <button onclick="confirm('Usunąć?') || event.stopImmediatePropagation()"
                                wire:click="delete({{ $service->id }})"
                                class="underline text-red-600">
                            Usuń
                        </button>
                    </td>
                </tr>
            @empty
                <tr class="bg-gray-200">
                    <td class="p-3" colspan="4">Brak usług.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $services->links() }}
    </div>

    @if($showModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
            <div class="bg-white rounded-lg w-11/12 md:w-2/3 lg:w-1/2 p-6">
                <h3 class="text-lg font-semibold mb-4">{{ $serviceId ? 'Edytuj usługę' : 'Dodaj usługę' }}</h3>

                <div class="space-y-3">
                    <div>
                        <label class="block text-sm mb-1">Nazwa</label>
                        <input wire:model.defer="name" type="text" class="w-full border rounded p-2">
                        @error('name')
                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div> @enderror
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm mb-1">Czas (min)</label>
                            <input wire:model.defer="duration" type="number" min="5" class="w-full border rounded p-2">
                            @error('duration')
                            <div class="text-red-600 text-sm mt-1">{{ $message }}</div> @enderror
                        </div>

                        <div>
                            <label class="block text-sm mb-1">Cena</label>
                            <input wire:model.defer="price" type="number" step="0.01" class="w-full border rounded p-2">
                            @error('price')
                            <div class="text-red-600 text-sm mt-1">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm mb-1">Opis</label>
                        <textarea wire:model.defer="description" rows="3" class="w-full border rounded p-2"></textarea>
                        @error('description')
                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="mt-4 flex justify-end gap-2">
                    <button wire:click="$set('showModal', false)" class="px-3 py-2 border rounded">Anuluj</button>
                    <button wire:click="save" class="px-3 py-2 bg-blue-600 text-white rounded">Zapisz</button>
                </div>
            </div>
        </div>
    @endif
</div>

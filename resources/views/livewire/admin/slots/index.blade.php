<div class="max-w-6xl mx-auto p-6">
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">Zarządzanie slotami</h2>
        <button wire:click="create" class="px-3 py-2 rounded bg-green-600 text-white">+ Dodaj</button>
    </div>

    @if($showModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
            <div class="bg-white rounded-lg w-11/12 md:w-2/3 lg:w-1/2 p-6">
                <form wire:submit.prevent="{{ $isEditMode ? 'update' : 'store' }}" class="mb-6 space-y-3">
                    <input type="date" wire:model="date" class="border rounded p-2 w-full">
                    <input type="time" wire:model="time" class="border rounded p-2 w-full">
                    {{$date}}
                    <label class="flex items-center space-x-2">
                        <input type="checkbox" wire:model="is_available">
                        <span>Dostępny</span>
                    </label>

                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">
                        {{ $isEditMode ? 'Zapisz zmiany' : 'Dodaj slot' }}
                    </button>
                </form>
            </div>
        </div>
    @endif

    @if (session()->has('message'))
        <div class="mt-4 text-green-600">
            {{ session('message') }}
        </div>
    @endif

    {{-- Lista slotów --}}
    <table class="w-full border">
        <thead>
        <tr class="bg-gray-100">
            <th class="border px-4 py-2">Data</th>
            <th class="border px-4 py-2">Godzina</th>
            <th class="border px-4 py-2">Dostępność</th>
            <th class="border px-4 py-2">Akcje</th>
        </tr>
        </thead>
        <tbody>
        @foreach($slots as $slot)
            <tr class="bg-gray-50">
                <td class="border px-4 py-2">{{ $slot->date }}</td>
                <td class="border px-4 py-2">{{ $slot->time }}</td>
                <td class="border px-4 py-2">
                    @if($slot->is_available)
                        Dostępny
                    @else
                        Zajęty
                    @endif
                </td>
                <td class="border px-4 py-2 space-x-2">
                    <button wire:click="edit({{ $slot->id }})" class="bg-yellow-500 text-white px-2 py-1 rounded">
                        Edytuj
                    </button>
                    <button wire:click="delete({{ $slot->id }})" class="bg-red-500 text-white px-2 py-1 rounded">Usuń
                    </button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

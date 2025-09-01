<?php

namespace App\Livewire\Admin\Slots;

use App\Models\Slot;
use Livewire\Component;

class Index extends Component
{
    public $slots;
    public $date;
    public $time;
    public $is_available = true;
    public $slot_id;
    public $isEditMode = false;
    public $showModal = false;

    protected $rules = [
        'date' => 'required|date',
        'time' => 'required',
        'is_available' => 'boolean',
    ];

    public function render()
    {
        $this->slots = Slot::orderBy('date')->orderBy('time')->get();
        return view('livewire.admin.slots.index');
    }

    public function store()
    {
        $this->validate();

        Slot::create([
            'date' => $this->date,
            'time' => $this->time,
            'is_available' => $this->is_available,
        ]);

        session()->flash('message', 'Slot utworzony!');

        $this->showModal = false;
        $this->resetForm();
    }

    public function create()
    {
        $this->resetForm();
        $this->showModal = true;
    }

    public function resetForm()
    {
        $this->date = '';
        $this->time = '';
        $this->is_available = true;
        $this->slot_id = null;
        $this->isEditMode = false;
    }

    public function edit($id)
    {
        $slot = Slot::findOrFail($id);
        $this->slot_id = $slot->id;
        $this->date = $slot->date;
        $this->time = $slot->time;
        $this->is_available = $slot->is_available;
        $this->isEditMode = true;
        $this->showModal = true;
    }

    public function update()
    {
        $this->validate();

        $slot = Slot::findOrFail($this->slot_id);
        $slot->update([
            'date' => $this->date,
            'time' => $this->time,
            'is_available' => $this->is_available,
        ]);

        session()->flash('message', 'Slot zaktualizowany!');

        $this->showModal = false;
        $this->resetForm();
    }

    public function delete($id)
    {
        Slot::findOrFail($id)->delete();
        session()->flash('message', 'Slot usunięty!');
    }
}

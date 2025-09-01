<?php

namespace App\Livewire\Admin\Services;

use App\Models\Service;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $name;
    public $duration = 30;
    public $price = 0.00;
    public $description;
    public $serviceId = null;
    public $showModal = false;

    protected $paginationTheme = 'tailwind';

    public function render()
    {
        $services = Service::latest()->paginate(2);
        return view('livewire.admin.services.index', compact('services'));
    }

    public function edit($id)
    {
        $service = Service::findOrFail($id);
        $this->serviceId = $service->id;
        $this->name = $service->name;
        $this->duration = $service->duration;
        $this->price = $service->price;
        $this->description = $service->description;
        $this->showModal = true;
    }

    public function save()
    {
        $data = $this->validate();

        if ($this->serviceId) {
            Service::find($this->serviceId)->update($data);
            session()->flash('success', 'Usługa zaktualizowana.');
        } else {
            Service::create($data);
            session()->flash('success', 'Usługa dodana.');
        }

        $this->showModal = false;
        $this->resetForm();
        $this->resetPage();
    }

    public function create()
    {
        $this->resetForm();
        $this->showModal = true;
    }

    private function resetForm()
    {
        $this->serviceId = null;
        $this->name = null;
        $this->duration = 30;
        $this->price = 0.00;
        $this->description = null;
        $this->resetValidation();
    }

    public function delete($id)
    {
        Service::findOrFail($id)->delete();
        session()->flash('success', 'Usługa usunięta.');
        $this->resetPage();
    }

    protected function rules()
    {
        return [
            'name' => 'required|string|max:120',
            'duration' => 'required|integer|min:5|max:480',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string|max:1000',
        ];
    }
}

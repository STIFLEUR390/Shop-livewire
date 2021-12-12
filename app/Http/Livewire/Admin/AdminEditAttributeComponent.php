<?php

namespace App\Http\Livewire\Admin;

use App\Models\ProductAttribute;
use Livewire\Component;

class AdminEditAttributeComponent extends Component
{
    public $product_attribute_id;
    public $name;

    protected $rules = [
        'name' => 'required|min:2',
    ];

    public function mount($attribute_id)
    {
        $product_attribute = ProductAttribute::findorFail($attribute_id);
        $this->product_attribute_id = $product_attribute->id;
        $this->name = $product_attribute->name;
    }

    public function render()
    {
        return view('livewire.admin.admin-edit-attribute-component')->layout('layouts.base');
    }
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function updateAttribute()
    {

        $validatedData = $this->validate();

        $product_attribute = ProductAttribute::find($this->product_attribute_id);
        $product_attribute->name = $this->name;
        $product_attribute->save();

        $this->dispatchBrowserEvent('swal', [
            'title' => 'L\'attribut a été mis à jour avec succès',
            'timer'=>3000,
            'icon'=>'success',
            'toast'=>false,
            'position'=>'center',
            'showConfirmButton' => false,
        ]);
    }
}

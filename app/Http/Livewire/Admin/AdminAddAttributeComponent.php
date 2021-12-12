<?php

namespace App\Http\Livewire\Admin;

use App\Models\ProductAttribute;
use Livewire\Component;

class AdminAddAttributeComponent extends Component
{
    public $name;

    protected $rules = [
        'name' => 'required|min:2',
    ];

    public function render()
    {
        return view('livewire.admin.admin-add-attribute-component')->layout('layouts.base');
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function storeAttribute()
    {

        $validatedData = $this->validate();

        $product_attribute = new ProductAttribute();
        $product_attribute->name = $this->name;
        $product_attribute->save();

        $this->dispatchBrowserEvent('swal', [
            'title' => 'L\'attribut a été créé avec succès',
            'timer'=>3000,
            'icon'=>'success',
            'toast'=>false,
            'position'=>'center',
            'showConfirmButton' => false,
        ]);
    }
}

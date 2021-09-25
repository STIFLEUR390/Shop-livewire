<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use Livewire\Component;
use Illuminate\Support\Str;

class AdminAddCategoryComponent extends Component
{

    public $name;
    public $slug;

    protected $rules = [
        'name' => 'required',
        'slug' => 'required|unique:categories'
    ];

    public function generateSlug()
    {
        $this->slug = Str::slug($this->name);
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function storeCategory()
    {
        $validatedData = $this->validate();

        $category = new Category();
        $category->name = $this->name;
        $category->slug = $this->slug;
        $category->save();

        // session()->flash('message', 'La category a été créer avec succès');
        $this->dispatchBrowserEvent('swal', [
            'title' => 'La category a été créer avec succès',
            'timer'=>3000,
            'icon'=>'success',
            'toast'=>false,
            'position'=>'center',
            'showConfirmButton' => false,
        ]);
    }

    public function render()
    {
        return view('livewire.admin.admin-add-category-component')->layout('layouts.base');
    }
}

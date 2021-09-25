<?php

namespace App\Http\Livewire\Admin;

use App\Models\{Category, HomeCategory};
use Livewire\Component;

class AdminHomeCategoryComponent extends Component
{
    public $selected_categories = [];
    public $numberofproducts;

    public function mount()
    {
        $category = HomeCategory::find(1);
        $this->selected_categories = explode(',', $category->sel_categories);
        $this->numberofproducts = $category->no_of_products;
    }

    public function updateCategory()
    {
        $category = HomeCategory::find(1);
        $category->sel_categories = implode(',', $this->selected_categories);
        $category->no_of_products = $this->numberofproducts;
        $category->save();

        // session()->flash('message', 'Homecategory has been updated successfully!');
        $this->alert('success', 'La catégorie Accueil a été mise à jour avec succès !', [
            'position' =>  'center',
            'timer' =>  3000,
            'toast' =>  false,
            'text' =>  '',
            'confirmButtonText' =>  'Ok',
            'cancelButtonText' =>  'Cancel',
            'showCancelButton' =>  false,
            'showConfirmButton' =>  false,
        ]);
    }

    public function render()
    {
        $categories = Category::all();
        return view('livewire.admin.admin-home-category-component', ['categories' => $categories])->layout('layouts.base');
    }
}

<?php

namespace App\Http\Livewire\Admin;

use App\Models\{Category, Subcategory};
use Livewire\Component;
use Illuminate\Support\Str;

class AdminEditCategoryComponent extends Component
{

    public $category_slug;
    public $category_id;
    public $name;
    public $slug;
    public $sub_category_id;
    public $sub_category_slug;

    protected $rules = [
        'name' => 'required',
        'slug' => 'required|unique:categories'
    ];

    public function mount($category_slug, $scategory_slug = null)
    {
        if ($scategory_slug) {
            $this->sub_category_slug = $scategory_slug;
            $sub_category = Subcategory::where('slug', $scategory_slug)->first();
            $this->sub_category_id = $sub_category->id;
            $this->category_id = $sub_category->category_id;
            $this->name = $sub_category->name;
            $this->slug = $sub_category->slug;
        }
        else {
            $this->category_slug = $category_slug;
            $category = Category::where('slug', $category_slug)->first();
            $this->category_id = $category->id;
            $this->name = $category->name;
            $this->slug = $category->slug;
        }
    }

    public function generateSlug()
    {
        $this->slug = Str::slug($this->name);
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function updateCategory()
    {
        $validatedData = $this->validate();

        if ($this->sub_category_id) {
            $sub_category = Subcategory::find($this->sub_category_id);
            $sub_category->name = $this->name;
            $sub_category->slug = $this->slug;
            $sub_category->category_id = $this->category_id;
            $sub_category->save();
        } 
        else {
            $category = Category::find($this->category_id);
            $category->name = $this->name;
            $category->slug = $this->slug;
            $category->save();
        }
        // session()->flash('message', 'La category a été mise a jour avec succès');
        $this->alert('success', 'La category a été mise a jour avec succès', [
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
        return view('livewire.admin.admin-edit-category-component', compact('categories'))->layout('layouts.base');
    }
}

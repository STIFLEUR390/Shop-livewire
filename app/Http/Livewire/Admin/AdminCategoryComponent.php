<?php

namespace App\Http\Livewire\Admin;

use App\Models\{Category, Subcategory};
use Livewire\Component;
use Livewire\WithPagination;

class AdminCategoryComponent extends Component
{
    use WithPagination;

    public $category_id;
    public $sub_category_id;

    protected $listeners = [
        'confirmedCategorie' => 'confirmedCategorie', 
        'cancelled' => 'cancelled',
        'confirmedSubCategorie' => 'confirmedSubCategorie',
    ];

    public function deleteCategory($id)
    {
        $this->category_id = $id;
        $category = Category::find($id);
        $message = "confirmer la suppression de la catégorie: ". $category->name;
        $this->confirm($message, [
            'toast' => false,
            'position' => 'center',
            'showConfirmButton' => true,
            'cancelButtonText' => 'Annulé',
            'confirmButtonText' => 'Supprimer',
            'onConfirmed' => 'confirmedCategorie',
            'onCancelled' => 'cancelled'
        ]);
    }

    public function deleteSubCategory($id)
    {
        $this->sub_category_id = $id;
        $sub_category = Subcategory::find($id);
        $message = "confirmer la suppression de la sous catégorie: ". $sub_category->name;
        $this->confirm($message, [
            'toast' => false,
            'position' => 'center',
            'showConfirmButton' => true,
            'cancelButtonText' => 'Annulé',
            'confirmButtonText' => 'Supprimer',
            'onConfirmed' => 'confirmedSubCategorie',
            'onCancelled' => 'cancelled'
        ]);
    }

    public function render()
    {
        $categories = Category::paginate(5);
        return view('livewire.admin.admin-category-component', compact('categories'))->layout('layouts.base');
    }

    public function confirmedCategorie()
    {
        $category = Category::find($this->category_id);
        $category->delete();
        // session()->flash('message', 'La categorie a bien été suprimer');
        $this->alert('success', 'La categorie a bien été suprimer', [
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

    public function cancelled()
    {
        // Example code inside cancelled callback
        $this->alert('info', 'suppression annulé', [
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

    public function confirmedSubCategorie()
    {
        $sub_category = Subcategory::find($this->sub_category_id);
        $sub_category->delete();
        // session()->flash('message', 'La categorie a bien été suprimer');
        $this->alert('success', 'La sous categorie a bien été suprimer', [
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
}
